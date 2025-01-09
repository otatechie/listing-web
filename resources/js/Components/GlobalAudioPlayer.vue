<template>
    <div class="mt-4">
        <div class="bg-gray-50 shadow-inner p-2" :class="{ 'hidden': !audioStore.currentBeat }">
            <div class="w-full md:w-10/12 mx-auto px-3">
                <div class="flex flex-col md:flex-row md:items-center gap-3">
                    <div class="flex items-center gap-2 justify-between md:justify-start">
                        <div class="flex items-center gap-5">
                            <button type="button" class="text-gray-800 hover:text-orange-500">
                                <i class="pi pi-backward"></i>
                            </button>

                            <button @click="togglePlay" type="button"
                                class="w-8 h-8 flex items-center justify-center bg-[#444444] hover:bg-orange-500 rounded-full">
                                <i class="pi text-white" :class="audioStore.isPlaying ? 'pi-stop' : 'pi-play'"></i>
                            </button>

                            <button type="button" class="text-gray-800 hover:text-orange-500">
                                <i class="pi pi-forward"></i>
                            </button>

                            <button type="button" @click="toggleRepeat"
                                :class="{ 'text-orange-500': audioStore.isRepeat, 'text-gray-800 hover:text-orange-500': !audioStore.isRepeat }">
                                <i class="pi pi-replay"></i>
                            </button>
                        </div>

                        <div class="md:hidden">
                            <div class="relative group flex items-center" @mouseleave="handleVolumeMouseLeave"
                                @mouseenter="showVolumeSlider = true">
                                <button type="button" @click="toggleMute" class="text-gray-800 hover:text-orange-500">
                                    <i class="pi" :class="{
                                        'pi-volume-off': audioStore.isMuted || audioStore.volume === 0,
                                        'pi-volume-down': !audioStore.isMuted && audioStore.volume > 0 && audioStore.volume <= 0.5,
                                        'pi-volume-up': !audioStore.isMuted && audioStore.volume > 0.5
                                    }"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 flex-1">
                        <span class="text-xs text-gray-800 min-w-[40px]">{{ formatTime(audioStore.currentTime) }}</span>

                        <div class="flex-1 h-[48px] flex items-center">
                            <div ref="waveform" class="w-full"></div>
                        </div>

                        <span class="text-xs text-gray-800 min-w-[40px]">{{ formatTime(audioStore.duration) }}</span>
                    </div>

                    <div class="hidden md:block">
                        <div class="relative group flex items-center">
                            <button type="button" @click="toggleMute" class="text-gray-800 hover:text-orange-500">
                                <i class="pi"
                                    :class="audioStore.isMuted ? 'pi-volume-off' : audioStore.volume === 0 ? 'pi-volume-off' : 'pi-volume-up'"></i>
                            </button>

                            <div class="absolute w-full h-3 bottom-full opacity-0"></div>

                            <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 hover:opacity-100"
                                @mouseenter="isDraggingVolume = true" @mouseleave="isDraggingVolume = false">
                                <div class="bg-gray-600 shadow-lg rounded-lg p-2 h-32">
                                    <div class="h-full flex items-center justify-center">
                                        <div class="relative h-full w-4 flex items-center justify-center cursor-pointer"
                                            @mousedown="startVolumeDrag"
                                            @touchstart="startVolumeDrag"
                                            @mousemove="handleVolumeDrag"
                                            @touchmove="handleVolumeDrag"
                                            @mouseup="stopVolumeDrag"
                                            @touchend="stopVolumeDrag">
                                            <div class="relative h-full w-0.5">
                                                <div class="absolute inset-0 bg-gray-300 rounded-full"></div>
                                                <div class="absolute bottom-0 left-0 w-full bg-orange-500 rounded-full"
                                                    :style="{ height: `${audioStore.volume * 100}%` }"></div>
                                                <div class="absolute w-2.5 h-2.5 -left-1 bg-orange-500 rounded-full shadow-sm"
                                                    :style="{ bottom: `calc(${audioStore.volume * 100}% - 6px)` }">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 justify-between md:justify-start md:ml-2">
                        <div class="flex items-center gap-3 min-w-0">
                            <img :src="audioStore.currentBeat?.media?.cover_art?.[0]?.original_url || audioStore.currentBeat?.media?.cover_art"
                                class="w-8 h-8 rounded object-cover" alt="Cover Art" @error="handleImageError">
                            <div class="flex flex-col min-w-0">
                                <div class="text-xs text-gray-800 font-medium truncate">
                                    {{ audioStore.currentBeat?.title }}
                                </div>
                                <div class="text-xs text-gray-500 font-medium truncate">
                                    {{ userName }}
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <button
                                type="button"
                                @click="toggleFollow"
                                class="text-gray-800 hover:text-orange-500"
                                :class="{ 'text-orange-500': audioStore.isFollowing }"
                            >
                                <i class="pi" :class="audioStore.isFollowing ? 'pi-user-minus' : 'pi-user-plus'"></i>
                            </button>
                            <button type="button" @click="toggleFavorite" class="text-gray-800 hover:text-orange-500">
                                <i class="pi pi-heart"></i>
                            </button>
                        </div>
                    </div>

                    <audio ref="audioPlayer"
                        :src="audioStore.currentBeat?.media?.audio[0]?.original_url || audioStore.currentBeat?.media?.audio"
                        @timeupdate="updateProgress" @ended="handleEnded" @loadedmetadata="handleLoadedMetadata"
                        preload="metadata" class="hidden"></audio>
                </div>
            </div>
        </div>
    </div>

</template>

<script setup>
import { ref, onMounted, onUnmounted, computed, watch, nextTick } from "vue";
import { usePage, useForm } from "@inertiajs/vue3";
import { useAudioStore } from '@/Stores/audioStore';
import WaveSurfer from "wavesurfer.js";

const page = usePage();
const form = useForm({});
const audioStore = useAudioStore();
const waveform = ref(null);

const progressBarRef = ref(null);
const hoverPosition = ref(0);
const isDraggingVolume = ref(false);
const isHovering = ref(false);

const togglePlay = async () => {
    if (!audioStore.waveSurferInstance) {
        return;
    }

    try {
        await audioStore.togglePlay();
    } catch (error) {
        // Error handling removed
    }
};

const toggleLike = () => {
    audioStore.isLiked = !audioStore.isLiked;
    audioStore.likeCount += audioStore.isLiked ? 1 : -1;
};

const updateProgress = () => {
    if (audioStore.audioElement) {
        audioStore.currentTime = audioStore.audioElement.currentTime;
        audioStore.duration = audioStore.audioElement.duration;
        audioStore.progress = (audioStore.audioElement.currentTime / audioStore.audioElement.duration) * 100;
    }
};

const handleEnded = () => {
    if (audioStore.isRepeat) {
        if (audioStore.audioElement) {
            audioStore.audioElement.currentTime = 0;
            audioStore.audioElement.play();
            audioStore.isPlaying = true;
            recordPlay();
        }
    } else {
        audioStore.isPlaying = false;
        audioStore.progress = 0;
    }
};

const userName = computed(() => {
    const authUser = page.props.auth?.user;
    const currentBeat = audioStore.currentBeat;

    return (
        (authUser && currentBeat?.user_id === authUser.id && authUser.username) ||
        currentBeat?.user?.username ||
        currentBeat?.producer_name ||
        'Unknown Artist'
    );
});

const formatTime = (seconds) => {
    if (!seconds) return '0:00';
    const minutes = Math.floor(seconds / 60);
    const remainingSeconds = Math.floor(seconds % 60);
    return `${minutes}:${remainingSeconds.toString().padStart(2, '0')}`;
};

const startDragging = (event) => {
    event.preventDefault();
    audioStore.isDragging = true;

    const progressBar = progressBarRef.value;
    if (progressBar) {
        const rect = progressBar.getBoundingClientRect();
        const x = Math.max(0, Math.min(event.clientX - rect.left, rect.width));
        const percentage = (x / rect.width) * 100;
        hoverPosition.value = percentage;

        audioStore.progress = percentage;
        if (audioStore.audioElement) {
            const time = (percentage / 100) * audioStore.audioElement.duration;
            audioStore.audioElement.currentTime = time;
        }
    }

    window.addEventListener('mousemove', handleDrag);
    window.addEventListener('mouseup', stopDragging);
    window.addEventListener('mouseleave', stopDragging);
};

const handleDrag = (event) => {
    event.preventDefault();
    const progressBar = progressBarRef.value;
    if (!progressBar) return;

    const rect = progressBar.getBoundingClientRect();
    const x = Math.max(0, Math.min(event.clientX - rect.left, rect.width));
    const percentage = (x / rect.width) * 100;
    hoverPosition.value = percentage;

    if (audioStore.isDragging) {
        audioStore.progress = percentage;
        if (audioStore.audioElement) {
            const time = (percentage / 100) * audioStore.audioElement.duration;
            audioStore.audioElement.currentTime = time;
        }
    }
};

const stopDragging = (event) => {
    if (event) event.preventDefault();
    audioStore.isDragging = false;

    window.removeEventListener('mousemove', handleDrag);
    window.removeEventListener('mouseup', stopDragging);
    window.removeEventListener('mouseleave', stopDragging);
};

const handleLoadedMetadata = () => {
    if (audioStore.audioElement) {
        audioStore.duration = audioStore.audioElement.duration;
    }
};

const handleVolumeChange = () => {
    if (audioStore.waveSurferInstance) {
        audioStore.waveSurferInstance.setVolume(audioStore.volume);
        if (audioStore.volume > 0) {
            audioStore.isMuted = false;
        }
    }
};

const toggleMute = () => {
    if (audioStore.waveSurferInstance) {
        if (!audioStore.isMuted) {
            audioStore.previousVolume = audioStore.volume;
            audioStore.volume = 0;
        } else {
            audioStore.volume = audioStore.previousVolume || 1;
        }
        audioStore.waveSurferInstance.setVolume(audioStore.volume);
        audioStore.isMuted = !audioStore.isMuted;
    }
};

const handleImageError = (e) => {
    e.target.src = '/default-cover.jpg';
    e.target.onerror = null;
};

const toggleRepeat = () => {
    audioStore.isRepeat = !audioStore.isRepeat;
    if (audioStore.audioElement) {
        audioStore.audioElement.loop = audioStore.isRepeat;
    }
};

const handleVolumeDrag = (event) => {
    if (!audioStore.isVolumeDragging) return;
    event.preventDefault();

    const container = event.target.closest('.relative.h-full.w-4');
    if (!container) return;

    const rect = container.getBoundingClientRect();
    const clientY = event.type.includes('touch') ? event.touches[0].clientY : event.clientY;
    const y = clientY - rect.top;
    const height = rect.height;

    // Calculate volume (inverted since slider goes bottom to top)
    const newVolume = Math.max(0, Math.min(1, 1 - (y / height)));

    audioStore.volume = newVolume;
    if (audioStore.waveSurferInstance) {
        audioStore.waveSurferInstance.setVolume(newVolume);
        if (newVolume > 0) {
            audioStore.isMuted = false;
        }
    }
};

const startVolumeDrag = (event) => {
    event.preventDefault();
    audioStore.isVolumeDragging = true;

    // Initial volume set on click/touch
    handleVolumeDrag(event);

    // Use capture phase for better drag handling
    document.addEventListener('mousemove', handleVolumeDrag, { capture: true });
    document.addEventListener('touchmove', handleVolumeDrag, { capture: true });
    document.addEventListener('mouseup', stopVolumeDrag, { capture: true });
    document.addEventListener('touchend', stopVolumeDrag, { capture: true });
};

const stopVolumeDrag = (event) => {
    if (event) event.preventDefault();
    audioStore.isVolumeDragging = false;

    // Clean up all event listeners
    document.removeEventListener('mousemove', handleVolumeDrag, { capture: true });
    document.removeEventListener('touchmove', handleVolumeDrag, { capture: true });
    document.removeEventListener('mouseup', stopVolumeDrag, { capture: true });
    document.removeEventListener('touchend', stopVolumeDrag, { capture: true });
};

const toggleFollow = () => {
    if (!page.props.auth?.user) {
        return;
    }

    if (!audioStore.currentBeat?.user?.id) {
        return;
    }

    // Don't allow following yourself
    if (audioStore.currentBeat.user.id === page.props.auth.user.id) {
        return;
    }

    form.post(route('user.follow', { userId: audioStore.currentBeat.user.id }), {
        onSuccess: () => {
            audioStore.isFollowing = !audioStore.isFollowing;
        },
        onError: (errors) => {
            // Error handling can remain silent
        }
    });
};

const toggleFavorite = () => {
    audioStore.isFavorite = !audioStore.isFavorite;
};

const recordPlay = () => {
    const beatId = audioStore.currentBeat?.id;

    // Record play count
    form.post(route('beats.record.play', { beat: beatId }), {
        preserveScroll: true,
        onSuccess: (response) => {
            if (response?.plays_count && audioStore.currentBeat?.stats) {
                audioStore.currentBeat.stats.plays_count = response.plays_count;
                audioStore.updateBeatStats(beatId, { plays_count: response.plays_count });
            }
        }
    });

    // Record recent play
    form.post(route('beats.record.recent.play', { beat: beatId }), {
        preserveScroll: true,
    });
};

onMounted(async () => {
    await nextTick();

    if (waveform.value) {
        try {
            const waveSurfer = WaveSurfer.create({
                container: waveform.value,
                waveColor: '#9CA3AF',
                progressColor: '#F97316',
                cursorColor: '#F97316',
                barWidth: 3,
                barGap: 2,
                height: 32,
                normalize: true,
                responsive: true,
                interact: true,
                fillParent: true,
                barRadius: 3,
                peaks: true,
                hideScrollbar: true
            });

            audioStore.setWaveSurfer(waveSurfer);

            if (audioStore.currentBeat) {
                const audioUrl = audioStore.currentBeat?.media?.audio[0]?.original_url || audioStore.currentBeat?.media?.audio;
                if (audioUrl) {
                    await waveSurfer.load(audioUrl);
                }
            }
        } catch (error) {
            // Error handling removed
        }
    }
});

onUnmounted(() => {
    if (audioStore.volumeUpdateTimeout) {
        clearTimeout(audioStore.volumeUpdateTimeout);
    }
    stopDragging();
    stopVolumeDrag();
    audioStore.cleanup();
    window.removeEventListener('beat-play-started', recordPlay);
    if (audioStore.waveSurferInstance) {
        audioStore.waveSurferInstance.destroy();
    }
});

// Ensure that playBeat is called after initialization
const playBeat = (beat) => {
    if (!audioStore.waveSurferInstance) {
        return;
    }
    audioStore.playBeat(beat);
};

</script>

<style scoped>
.relative.group {
    padding: 2px;
}

/* Updated hover styles */
.group:hover .absolute,
.absolute:hover {
    opacity: 1 !important;
    pointer-events: auto;
}

.absolute {
    pointer-events: none;
}

/* Add a small delay before hiding */
.absolute {
    transition: opacity 200ms ease;
}

.group:hover .absolute {
    transition-delay: 0ms;
}

.absolute:not(:hover) {
    transition-delay: 150ms;
}
</style>
