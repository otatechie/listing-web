<template>
    <div class="w-full mx-auto max-w-7xl min-h-screen bg-white text-gray-800 p-4 md:p-8">
        <div class="bg-orange-50 rounded p-4 md:p-8 mb-8 shadow-sm">
            <h1 class="text-2xl md:text-4xl font-bold text-gray-800 mb-2 md:mb-4">Find Your Perfect Beat</h1>
            <p class="text-base md:text-lg text-gray-600 mb-4 md:mb-6">Browse through thousands of high-quality beats
                from top producers worldwide</p>
            <div class="flex flex-col sm:flex-row gap-6 sm:gap-6">
                <Button class="btn-primary w-full sm:w-auto">Start Creating</Button>
                <button class="border border-cyan-600 text-cyan-600 px-4 py-3 hover:bg-cyan-50 w-full sm:w-auto">Learn
                    more</button>
            </div>
        </div>

        <div class="divide-y divide-gray-100">
            <div class="mb-6">
                <h2 class="text-xl font-semibold font-heading mb-4">Explore new beats</h2>

                <div class="flex flex-col sm:flex-row gap-4 mb-6">
                    <div class="relative flex-grow">
                        <input type="text" v-model="searchQuery" placeholder="Search beats..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                        <span class="absolute right-3 top-2.5 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                    </div>
                    <div class="flex gap-3">
                        <select v-model="selectedGenre"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                            <option value="">All Genres</option>
                            <option v-for="genre in genres" :key="genre" :value="genre">{{ genre }}</option>
                        </select>
                        <select v-model="sortBy"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                            <option value="newest">Newest</option>
                            <option value="price-low">Price: Low to High</option>
                            <option value="price-high">Price: High to Low</option>
                            <option value="bpm">BPM</option>
                        </select>
                    </div>
                </div>
            </div>

            <div v-for="beat in filteredBeats" :key="beat.id"
                class="flex flex-col sm:flex-row items-start sm:items-center gap-4 p-4 hover:bg-gray-50">
                <div class="flex gap-4 items-start w-full sm:hidden">
                    <div class="w-20 h-20 flex-shrink-0 rounded-md overflow-hidden relative group">
                        <img :src="beat.cover_art" :alt="beat.title" class="w-full h-full object-cover">
                        <div
                            class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <button @click="playBeat(beat)"
                                class="text-white transform scale-90 group-hover:scale-100 transition-transform"
                                :title="audioStore.isCurrentBeat(beat.id) && audioStore.isPlaying ? 'Pause' : 'Play'">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path v-if="!audioStore.isCurrentBeat(beat.id) || !audioStore.isPlaying"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                    <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex-grow min-w-0">
                        <h3 class="font-medium text-base truncate" :title="beat.title">{{ beat.title }}</h3>
                        <div class="flex flex-wrap items-center text-sm text-gray-500 gap-2">
                            <span>{{ beat.user.username }}</span>
                            <span v-if="beat.bpm">{{ beat.bpm }} BPM</span>
                            <span>{{ beat.genre }}</span>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-2">
                            <span class="px-3 py-1 bg-gray-100 rounded-full text-xs text-gray-600">
                                {{ beat.genre }}
                            </span>
                            <span class="px-3 py-1 bg-gray-100 rounded-full text-xs text-gray-600">
                                {{ beat.type }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="hidden sm:block w-12 h-12 flex-shrink-0 rounded-md overflow-hidden relative group">
                    <img :src="beat.cover_art" :alt="beat.title" class="w-full h-full object-cover">
                    <div
                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <button @click="playBeat(beat)"
                            class="text-white transform scale-90 group-hover:scale-100 transition-transform"
                            :title="audioStore.isCurrentBeat(beat.id) && audioStore.isPlaying ? 'Pause' : 'Play'">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path v-if="!audioStore.isCurrentBeat(beat.id) || !audioStore.isPlaying"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="hidden sm:block flex-grow min-w-0">
                    <h3 class="font-medium text-base truncate" :title="beat.title">{{ beat.title }}</h3>
                    <div class="flex items-center text-sm text-gray-500">
                        <span>{{ beat.user.username }}</span>
                        <span v-if="beat.bpm" class="mx-2">•</span>
                        <span v-if="beat.bpm">{{ beat.bpm }} BPM</span>
                        <span class="mx-2 text-xs">•</span>
                        <span>Published: {{ beat.created_at }}</span>
                    </div>
                </div>

                <div class="hidden sm:flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-gray-100 rounded-full text-xs text-gray-600">
                        {{ beat.genre }}
                    </span>
                    <span class="px-3 py-1 bg-gray-100 rounded-full text-xs text-gray-600">
                        {{ beat.type }}
                    </span>
                </div>

                <div class="flex items-center justify-between sm:justify-end gap-4 w-full sm:w-auto">
                    <div class="flex gap-4">
                        <button title="Download"
                            class="flex items-center gap-1 px-2 py-1.5 border border-gray-300 rounded hover:bg-gray-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            <span class="text-xs">MP3</span>
                        </button>

                        <button title="Add to cart"
                            class="flex items-center gap-2 px-2 py-1.5 bg-gray-900 text-white rounded hover:bg-gray-800">
                            <span class="font-medium text-xs">$50.00</span>
                        </button>
                    </div>

                    <div class="flex items-center gap-1">
                        <button title="Like this beat" class="p-1.5 text-gray-600 hover:text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>

                        <button title="Share this beat" class="p-1.5 text-gray-600 hover:text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import Nav from '../Layouts/Nav.vue';
import Button from 'primevue/button';
import { useAudioStore } from "@/stores/audioStore";

defineOptions({
    layout: Nav
});

const audioStore = useAudioStore()

const props = defineProps({
    beats: {
        type: Array,
        required: true
    },
    auth: {
        type: Object,
        required: false,
        default: null
    }
});

const playBeat = (beat) => {
    const beatData = {
        id: beat.id,
        title: beat.title,
        user: beat.user,
        media: {
            audio: beat.audio,
            cover_art: beat.cover_art
        }
    };
    audioStore.playBeat(beatData);
};

const searchQuery = ref('');
const selectedGenre = ref('');
const sortBy = ref('newest');

const genres = computed(() => {
    return [...new Set(props.beats.map(beat => beat.genre).filter(Boolean))];
});

const filteredBeats = computed(() => {
    let filtered = props.beats;

    if (searchQuery.value) {
        const query = searchQuery.value.toLowerCase();
        filtered = filtered.filter(beat =>
            beat.title.toLowerCase().includes(query) ||
            beat.user.username.toLowerCase().includes(query) ||
            (beat.genre && beat.genre.toLowerCase().includes(query)) ||
            (beat.bpm && beat.bpm.toString().includes(query))
        );
    }

    if (selectedGenre.value) {
        filtered = filtered.filter(beat =>
            beat.genre === selectedGenre.value
        );
    }

    return filtered.sort((a, b) => {
        switch (sortBy.value) {
            case 'newest':
                return new Date(b.created_at) - new Date(a.created_at);
            case 'bpm':
                return (parseInt(a.bpm) || 0) - (parseInt(b.bpm) || 0);
            default:
                return 0;
        }
    });
});
</script>

<style scoped></style>
