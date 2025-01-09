<template>

    <div class="flex flex-col md:flex-row ">
        <div class="w-full md:w-1/2 relative h-[50vh] md:h-full group">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-black/20 to-black/60 z-10">
                <div class="flex flex-col items-center justify-center h-full text-white p-4 md:p-8">
                    <h2 class="text-5xl md:text-5xl font-heading font-bold mb-4 md:mb-6">Buy Beats</h2>
                    <p class="text-center mb-6 md:mb-8 max-w-md text-lg leading-relaxed">
                        Find the perfect beat for your next track. Browse thousands of high-quality instrumentals.
                    </p>
                    <Button label="Explore beats"
                        class="btn-primary shadow-md hover:shadow-cyan-500/20 transform hover:-translate-y-0.5 transition-all duration-200" />
                </div>
            </div>
            <img src="https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=1200&h=800&fit=crop"
                class="w-full h-full object-cover transition-all duration-300 hover:grayscale">
        </div>
        <div class="w-full md:w-1/2 relative h-[50vh] md:h-full group transition-all duration-300 hover:grayscale">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-black/20 to-black/60 z-10">
                <div class="flex flex-col items-center justify-center h-full text-white p-4 md:p-8">
                    <h2 class="text-5xl md:text-5xl font-heading font-bold mb-2 md:mb-4">Sell Beats</h2>
                    <p class="text-center mb-4 md:mb-6 max-w-md text-base md:text-lg px-4">
                        Share your productions with the world. Join our community of music creators.
                    </p>
                    <Link :href="route('register')">
                    <Button label="Start selling - Sign up for free" severity="contrast" class="btn-secondary" />
                    </Link>
                </div>
            </div>
            <img src="https://images.unsplash.com/photo-1511379938547-c1f69419868d?q=80&w=1200&h=800&fit=crop"
                class="w-full h-full object-cover" alt="Music studio with instruments and production equipment">
        </div>
    </div>

    <div class="py-16">
        <div class="w-full md:w-2/4 mx-auto px-5 mb-12">
            <div
                class="bg-gradient-to-r from-gray-700 to-gray-800 p-8 shadow-md border border-gray-700/50 backdrop-blur-sm rounded">
                <p class="text-center text-white text-lg font-medium mb-6">
                    Discover the perfect beats for your next project
                </p>
                <div class="flex flex-col sm:flex-row items-center gap-4">
                    <div class="relative flex-1 w-full">
                        <input type="text" placeholder="Search by title, genre, or producer"
                            class="w-full bg-gray-100 rounded p-2.5 text-gray-800 border border-gray-200 focus:border-cyan-600 focus:ring-1 focus:ring-cyan-600 outline-none">
                        <button class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400
                                     hover:text-cyan-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </button>
                    </div>
                    <span class="text-gray-400">or</span>
                    <Button label="Upload your beats" class="btn-primary w-full sm:w-auto whitespace-nowrap" />
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
            <div class="flex items-center justify-center mb-6">
                <h2 class="text-3xl font-heading text-gray-800 relative">
                    Browse Categories
                </h2>
            </div>
            <div class="flex flex-wrap justify-center gap-3 overflow-x-auto pb-2 scrollbar-hide">
                <button v-for="category in ['Hip Hop', 'R&B', 'Trap', 'Afrobeats', 'Pop']" :key="category" class="px-6 py-2 mt-2 rounded-full bg-gray-600/95 text-white font-medium
                           hover:bg-gray-700 hover:shadow-md transform hover:-translate-y-0.5
                           transition-all duration-200 whitespace-nowrap border border-gray-500/50
                           hover:border-cyan-500/30 hover:shadow-cyan-500/10">
                    {{ category }}
                </button>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center my-12">
                <h2 class="text-3xl font-heading text-gray-800">Trending beats</h2>
                <p class="mt-2 text-gray-500 font-medium">Fresh drops from our hottest producers</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-5">
                <div class="group relative" v-for="beat in beats" :key="beat.id">
                    <div class="aspect-square overflow-hidden transition-all duration-200
                                border border-gray-200/50 shadow rounded hover:shadow-xl
                                hover:scale-[0.99] relative backdrop-blur-sm">
                        <img :src="beat.cover_art" :alt="beat.title"
                            class="h-full w-full object-cover group-hover:brightness-[0.8] transition-all duration-200">
                        <div class="absolute inset-0 bg-gradient-to-b from-black/10 via-transparent to-black/80">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <button @click="playBeat(beat)" class="p-3 bg-cyan-500 rounded-full shadow-md
                                               border-2 border-cyan-600 transform translate-y-2 opacity-0
                                               group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-200
                                               hover:bg-cyan-400 hover:scale-105 active:scale-95">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8 5v10l7-5-7-5z"
                                            v-if="!audioStore.isCurrentBeat(beat.id) || !audioStore.isPlaying" />
                                        <path d="M5 4h3v12H5V4zm7 0h3v12h-3V4z" v-else />
                                    </svg>
                                </button>
                            </div>

                            <div class="absolute bottom-4 left-0 right-0">
                                <div class="flex items-center justify-center gap-6">
                                    <button type="button"
                                        class="text-white/90 hover:text-cyan-400 transition-colors p-2" title="Follow">
                                        <i class="pi pi-user-plus text-xl"></i>
                                    </button>
                                    <button type="button"
                                        class="text-white/90 hover:text-cyan-400 transition-colors p-2"
                                        title="Favorite">
                                        <i class="pi pi-heart text-xl"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 px-1">
                        <Link :href="route('beat.public.index', { beat: beat.slug })"
                            class="text-gray-800 hover:text-gray-500 font-medium text-sm truncate block">{{ beat.title }}</Link>
                        <Link :href="route('producer.show', { id: beat.user.user_slug })"
                            class="text-gray-500 hover:text-gray-800 truncate block">
                        {{ beat.user.username }}
                        </Link>
                    </div>
                </div>
            </div>

            <div class="mt-12 text-center flex items-center justify-center gap-4">
                <Button label="Discover more beats" class="btn-primary" />
                <span class="text-gray-400">or</span>
                <Link :href="route('public.new.beat')"
                class="text-gray-800 font-medium text-md truncate block underline hover:text-gray-600">Explore new beats</Link>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-r from-gray-800 via-gray-800 to-gray-900 py-12 sm:py-24">
        <div class="relative isolate">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="mx-auto flex max-w-2xl flex-col gap-16 bg-white/5 px-6 py-12 ring-1 ring-white/10 sm:rounded sm:p-8 lg:mx-0 lg:max-w-none lg:flex-row lg:items-center lg:py-20 xl:gap-x-20 xl:px-20">
                    <img class="h-96 w-full flex-none rounded object-cover shadow-md lg:aspect-square lg:h-auto lg:max-w-sm"
                        src="/images/image-dj.webp" alt="Music producer in studio">
                    <div class="w-full flex-auto">
                        <h2 class="text-4xl font-semibold text-white sm:text-5xl">Hey
                            producers</h2>
                        <p class="mt-6 text-lg/8 text-white">Time to drop your beats, connect with fans, and level up
                            your vibe on Afropulse. What are you waiting for?</p>
                        <ul role="list"
                            class="mt-10 grid grid-cols-1 gap-x-8 gap-y-3 text-base/7 text-white sm:grid-cols-2">
                            <li class="flex gap-x-3">
                                <svg class="h-7 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                                Vibrant music creator community
                            </li>
                            <li class="flex gap-x-3">
                                <svg class="h-7 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                                Build your brand
                            </li>
                            <li class="flex gap-x-3">
                                <svg class="h-7 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                                Revenue opportunities
                            </li>
                            <li class="flex gap-x-3">
                                <svg class="h-7 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                                Collaborate across borders
                            </li>
                            <li class="flex gap-x-3">
                                <svg class="h-7 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                                Celebrate authenticity
                            </li>
                            <li class="flex gap-x-3">
                                <svg class="h-7 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                                Support for emerging talent
                            </li>
                        </ul>
                        <div class="mt-10 flex">
                            <Button class="btn-dark" label="Join now" severity="primary">
                            </Button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="absolute inset-x-0 -top-16 -z-10 flex transform-gpu justify-center overflow-hidden blur-3xl"
                aria-hidden="true">
                <div class="aspect-[1318/752] w-[82.375rem] flex-none bg-gradient-to-r from-[#fff080] to-[#e99103] opacity-25"
                    style="clip-path: polygon(73.6% 51.7%, 91.7% 11.8%, 100% 46.4%, 97.4% 82.2%, 92.5% 84.9%, 75.7% 64%, 55.3% 47.5%, 46.5% 49.4%, 45% 62.9%, 50.3% 87.2%, 21.3% 64.1%, 0.1% 100%, 5.4% 51.1%, 21.4% 63.9%, 58.9% 0.2%, 73.6% 51.7%)">
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-b from-white to-gray-50/50 py-16">
        <div class="max-w-7xl mx-auto text-center px-4">
            <p class="text-3xl font-heading font-semibold tracking-wider text-gray-800
                    bg-gradient-to-r from-gray-800 to-gray-900 bg-clip-text text-transparent">
                Thanks for vibing. Now get involved.
            </p>
            <p class="text-xl font-medium text-gray-500 mt-5">Save beats, follow producers, and purchase your
                favorites—all for free.</p>
            <div
                class="mt-8 sm:mt-12 flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4">
                <Button label="Create an account" class="btn-primary" />
                <p class="text-gray-500 font-medium">Already have an account?
                    <Link :href="route('login')"
                        class="font-medium leading-6 text-gray-800 hover:text-gray-600 underline" role="button">
                    Login
                    </Link>
                </p>
            </div>
        </div>
    </div>

</template>

<script setup>
import Nav from '../Layouts/Nav.vue';
import Button from 'primevue/button'
import { Link } from '@inertiajs/vue3'
import { useAudioStore } from "@/stores/audioStore";

const audioStore = useAudioStore()

const props = defineProps({
    beats: Array,
})

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

defineOptions({
    layout: Nav
})
</script>


<style scoped>
*:focus {
    outline: 0;
}

.scrollbar-hide {
    -ms-overflow-style: none;
    /* IE and Edge */
    scrollbar-width: none;
    /* Firefox */
}

.scrollbar-hide::-webkit-scrollbar {
    display: none;
    /* Chrome, Safari and Opera */
}
</style>
