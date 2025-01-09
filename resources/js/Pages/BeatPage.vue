<template>
    <div class="min-h-screen mt-5">
        <div class="max-w-6xl mx-auto p-6">
            <div
                class="flex flex-col md:flex-row items-start gap-6 mb-8 bg-gray-50 rounded border border-solid border-gray-200 p-8">
                <div class="flex-1 w-full">
                    <div class="flex items-center gap-3">
                        <button @click="togglePlay"
                            class="w-12 h-12 bg-[#ff5500] hover:bg-[#ff7744] rounded-full flex items-center justify-center transform hover:scale-105 transition-all duration-300 shadow-md">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8 5v10l7-5-7-5z" v-if="!isPlaying" />
                                <path d="M5 4h3v12H5V4zm7 0h3v12h-3V4z" v-else />
                            </svg>
                        </button>
                        <div class="flex flex-col flex-1">
                            <h1
                                class="text-2xl font-semibold text-gray-800 mb-2 hover:text-[#ff5500] transition-colors duration-300">
                                {{ beat.title }}
                            </h1>

                            <div class="w-full h-16 mb-3 relative" ref="waveformContainer">
                                <div id="waveform"></div>
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="flex items-center gap-1.5 text-xs bg-gray-100 px-3 py-1 rounded-sm"
                                    title="Followers">
                                    <i class="pi pi-heart text-[10px] text-gray-400"></i>
                                    <span class="font-medium text-gray-600">6.7k</span>
                                </div>

                                <div class="flex items-center gap-1.5 text-xs bg-gray-100 px-3 py-1 rounded-sm"
                                    title="Plays">
                                    <i class="pi pi-play text-[10px] text-gray-400"></i>
                                    <span class="font-medium text-gray-600">869.4k</span>
                                </div>

                                <div class="flex items-center gap-1.5 text-xs bg-gray-100 px-3 py-1 rounded-sm"
                                    title="BPM">
                                    <i class="pi pi-chart-line text-[10px] text-gray-400"></i>
                                    <span class="font-medium text-gray-600">78 BPM</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex flex-col gap-2 justify-start">
                        <span class="text-[#999] text-sm">{{ beat.created_at }}</span>
                        <span
                            class="bg-gray-200 px-2 py-1 rounded text-[#666] text-sm hover:bg-[#999]/20 transition-colors cursor-pointer">{{
                                beat.genre }}</span>
                    </div>
                    <div class="w-40 h-40 bg-[#f2f2f2] rounded shadow-md overflow-hidden">
                        <img :src="beat.cover_art" :alt="beat.title" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex flex-wrap items-center gap-2 text-sm border-b border-gray-200 py-3">
                        <button
                            class="inline-flex items-center gap-1 hover:text-[#ff5500] transition-colors border border-gray-300 rounded px-3 py-1">
                            <i class="far fa-heart text-sm"></i>
                            <span class="text-gray-700">Like</span>
                        </button>

                        <button
                            class="inline-flex items-center gap-1 hover:text-[#ff5500] transition-colors border border-gray-300 rounded px-3 py-1">
                            <i class="fas fa-retweet text-sm"></i>
                            <span class="text-gray-700">Repost</span>
                        </button>

                        <button
                            class="inline-flex items-center gap-1 hover:text-[#ff5500] transition-colors border border-gray-300 rounded px-3 py-1">
                            <i class="fas fa-share text-sm"></i>
                            <span class="text-gray-700">Share</span>
                        </button>

                        <button
                            class="inline-flex items-center gap-1 hover:text-[#ff5500] transition-colors border border-gray-300 rounded px-3 py-1">
                            <i class="fas fa-ellipsis-h text-sm"></i>
                            <span class="text-gray-700">More</span>
                        </button>
                    </div>

                    <div class="mt-6 bg-white border border-gray-200 rounded p-6 shadow-sm">
                        <h3 class="text-lg font-semibold mb-4">License & Download</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-md hover:border-cyan-500 transition-colors cursor-pointer">
                                <div>
                                    <h4 class="font-medium text-gray-800">Basic License</h4>
                                    <p class="text-sm text-gray-600 mt-1">MP3 file • Limited distribution</p>
                                </div>
                                <button
                                    class="bg-cyan-500 hover:bg-cyan-600 text-white px-3 py-2 font-medium">
                                    $29.99
                                </button>
                            </div>

                            <div
                                class="flex items-center justify-between p-4 border border-gray-200 rounded-md hover:border-cyan-500 transition-colors cursor-pointer">
                                <div>
                                    <h4 class="font-medium text-gray-800">Premium License</h4>
                                    <p class="text-sm text-gray-600 mt-1">WAV + Track Stems • Unlimited distribution</p>
                                </div>
                                <button
                                    class="bg-cyan-500 hover:bg-cyan-600 text-white px-3 py-2 font-medium">
                                    $99.99
                                </button>
                            </div>

                            <div
                                class="flex items-center justify-between p-4 border border-gray-200 rounded-md hover:border-cyan-500 transition-colors cursor-pointer">
                                <div>
                                    <h4 class="font-medium text-gray-800">Exclusive Rights</h4>
                                    <p class="text-sm text-gray-600 mt-1">Full ownership • All files • Remove from store
                                    </p>
                                </div>
                                <button
                                    class="bg-cyan-500 hover:bg-cyan-600 text-white px-3 py-2 font-medium">
                                    $499.99
                                </button>
                            </div>
                        </div>

                        <div class="mt-4 text-center">
                            <button class="text-sm text-gray-600 hover:text-cyan-500 transition-colors">
                                Compare license terms
                                <i class="fas fa-chevron-right ml-1 text-xs"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mt-12">
                        <div class="flex items-start gap-8 pb-8">
                            <div class="w-80 bg-white rounded overflow-hidden border border-gray-200 shadow-sm">
                                <div class="px-6 pt-6 pb-4">
                                    <div class="flex justify-between items-start mb-3">
                                        <div class="flex gap-3">
                                            <div class="relative">
                                                <div class="w-12 h-12 rounded overflow-hidden">
                                                    <img :src="avatarUrl"
                                                         :alt="beat.user.username"
                                                         class="w-full h-full object-cover">
                                                </div>
                                            </div>
                                            <div>
                                                <h3 class="text-base font-semibold text-gray-900">{{ beat.user.username }}</h3>
                                                <div class="text-sm text-gray-500">{{ beat.user.city }}, {{ beat.user.country }}</div>
                                            </div>
                                        </div>
                                        <button class="bg-gray-100 p-2 rounded-full hover:bg-gray-200 transition-colors">
                                            <i class="fas fa-ellipsis-h text-gray-600"></i>
                                        </button>
                                    </div>

                                    <div class="flex items-center gap-4 text-xs text-gray-400 mb-3">
                                        <div class="flex items-center gap-1">
                                            <i class="fas fa-calendar text-gray-300"></i>
                                            <span>Joined, {{ beat.user.joined_date || 'Jan 2024' }}</span>
                                        </div>
                                    </div>

                                    <div class="mb-6">
                                        <button class="w-full bg-cyan-500 text-white px-4 py-2.5 font-medium
                                                     flex items-center justify-center gap-2 hover:bg-cyan-600 transition-colors">
                                            <i class="pi pi-plus text-[12px]"></i>
                                            Follow
                                        </button>
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 border-t border-gray-100">
                                    <div class="px-2 py-4 text-center hover:bg-gray-50 transition-colors cursor-pointer">
                                        <div class="text-lg font-semibold text-gray-900">6.7k</div>
                                        <div class="text-xs text-gray-500">Followers</div>
                                    </div>
                                    <div class="px-2 py-4 text-center border-x border-gray-100 hover:bg-gray-50 transition-colors cursor-pointer">
                                        <div class="text-lg font-semibold text-gray-900">317</div>
                                        <div class="text-xs text-gray-500">Tracks</div>
                                    </div>
                                    <div class="px-2 py-4 text-center hover:bg-gray-50 transition-colors cursor-pointer">
                                        <div class="text-lg font-semibold text-gray-900">400</div>
                                        <div class="text-xs text-gray-500">Plays</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-2">
                        <h3 class="font-semibold mb-4">Reactions</h3>
                        <div class="flex gap-4 items-center mb-6">
                            <div class="flex gap-2 flex-wrap">
                                <button v-tooltip.bottom="'John, Sarah, and 22 others'" @click="animateReaction($event)"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-gray-200 hover:bg-gray-50 transition-all duration-200 active:scale-95">
                                    <span class="text-lg reaction-emoji">🔥</span>
                                    <span class="text-sm text-gray-700">24</span>
                                </button>
                                <button v-tooltip.bottom="'Mike, Alex, and 16 others'" @click="animateReaction($event)"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-gray-200 hover:bg-gray-50 transition-all duration-200 active:scale-95">
                                    <span class="text-lg reaction-emoji">💯</span>
                                    <span class="text-sm text-gray-700">18</span>
                                </button>
                                <button v-tooltip.bottom="'Emma, David, and 13 others'" @click="animateReaction($event)"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-gray-200 hover:bg-gray-50 transition-all duration-200 active:scale-95">
                                    <span class="text-lg reaction-emoji">🎵</span>
                                    <span class="text-sm text-gray-700">15</span>
                                </button>
                                <button v-tooltip.bottom="'Lisa, Tom, and 10 others'" @click="animateReaction($event)"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-gray-200 hover:bg-gray-50 transition-all duration-200 active:scale-95">
                                    <span class="text-lg reaction-emoji">👏</span>
                                    <span class="text-sm text-gray-700">12</span>
                                </button>
                                <button v-tooltip.bottom="'James, Anna, and 6 others'" @click="animateReaction($event)"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-gray-200 hover:bg-gray-50 transition-all duration-200 active:scale-95">
                                    <span class="text-lg reaction-emoji">❤️</span>
                                    <span class="text-sm text-gray-700">8</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-1">
                    <h3 class="flex justify-between items-center mb-4">
                        <span class="font-semibold text-gray-800">Related Tracks</span>
                        <a href="#" class="text-sm text-gray-600 hover:text-gray-800">View all</a>
                    </h3>
                    <div class="border-b border-gray-200 mb-4"></div>

                    <div class="space-y-4 mb-8">
                        <div class="flex gap-3 group cursor-pointer">
                            <div class="w-12 h-12 bg-gray-100 border-2 border-gray-800 overflow-hidden shadow-md">
                                <img src="" alt="Related Track" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-700 group-hover:text-gray-600">Oliver Anthony -
                                    Rich Men North ...</p>
                                <p class="text-xs text-gray-600">4.38M • 52.9K</p>
                            </div>
                        </div>
                        <div class="flex gap-3 group cursor-pointer">
                            <div class="w-12 h-12 bg-gray-100 border-2 border-gray-800 overflow-hidden shadow-md">
                                <img src="" alt="Related Track" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-700 group-hover:text-gray-600">Good News</p>
                                <p class="text-xs text-gray-600">499K • 13.1K</p>
                            </div>
                        </div>
                    </div>

                    <h3 class="flex justify-between items-center mb-4">
                        <span class="font-semibold text-gray-800">Albums</span>
                        <a href="#" class="text-sm text-gray-600 hover:text-gray-800">View all</a>
                    </h3>
                    <div class="border-b border-gray-200 mb-4"></div>

                    <div class="space-y-4">
                        <div class="flex gap-3 group cursor-pointer">
                            <div class="w-12 h-12 bg-gray-100 border-2 border-gray-800 overflow-hidden shadow-md">
                                <img src="" alt="Album Cover" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-700 group-hover:text-gray-600">Album Name</p>
                                <p class="text-xs text-gray-600">12 tracks • 45 min</p>
                            </div>
                        </div>
                    </div>

                    <div class="border-b border-gray-200 mt-4"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3'
import Button from 'primevue/button';
import { computed, ref, onMounted, onBeforeUnmount } from 'vue';
import Tooltip from 'primevue/tooltip';
import WaveSurfer from 'wavesurfer.js'
import Nav from '../Layouts/Nav.vue';

defineOptions({
    layout: Nav
})

const props = defineProps({
    beat: {
        type: Object,
        required: true
    },
});

const avatarUrl = computed(() => {
    return `https://api.dicebear.com/9.x/initials/svg?seed=${encodeURIComponent(props.beat.user.username)}&backgroundType=gradientLinear&scale=100&fontSize=50`;
});

const waveformContainer = ref(null);
let wavesurfer = null;

const isPlaying = ref(false);

const togglePlay = () => {
    if (wavesurfer) {
        if (isPlaying.value) {
            wavesurfer.pause();
        } else {
            wavesurfer.play();
        }
        isPlaying.value = !isPlaying.value;
    }
};

onMounted(() => {
    wavesurfer = WaveSurfer.create({
        container: '#waveform',
        waveColor: '#D1D5DB',
        progressColor: '#FF5500',
        cursorColor: '#FF5500',
        barWidth: 2,
        barGap: 1,
        height: 64,
        normalize: true,
        responsive: true
    });

    wavesurfer.load(props.beat.audio);

    wavesurfer.on('ready', () => {
        console.log('Waveform ready');
    });

    wavesurfer.on('finish', () => {
        isPlaying.value = false;
    });
});

const animateReaction = (event) => {
    const emoji = event.currentTarget.querySelector('.reaction-emoji');
    emoji.style.transform = 'scale(1.4)';
    emoji.style.transition = 'transform 0.2s ease';

    setTimeout(() => {
        emoji.style.transform = 'scale(1)';
    }, 200);
};

onBeforeUnmount(() => {
    if (wavesurfer) {
        wavesurfer.destroy();
    }
});
</script>

<style scoped>
.reaction-emoji {
    display: inline-block;
    transform-origin: center;
    will-change: transform;
}

#waveform {
    width: 100%;
    height: 100%;
}

#waveform > wave {
    border-radius: 3px;
}
</style>

