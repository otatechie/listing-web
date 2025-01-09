<template>

    <Head title="Home" />

    <slot>

        <div class="px-4 sm:px-6 lg:mx-auto lg:max-w-6xl lg:px-8 font-mono">
            <div class="py-5 md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <div class="flex items-center">
                        <div>
                            <p
                                class="text-base text-gray-600 font-heading tracking-wide border-b-2 border-gray-600 pb-1">
                                Hello 👋, {{ user.name }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex space-x-3 md:ml-4 md:mt-0">
                    <div v-if="hasRole('producer')">
                        <Link :href="route('beat.create')">
                        <Button label="Add beat" size="small"
                            class="w-full btn-primary" />
                        </Link>
                    </div>

                    <div v-else>
                        <p class="text-xs text-gray-500 my-2">You are in listener mode</p>
                        <Link :href="route('user.switch.role')" method="post" as="button">
                        <Button type="button" severity="contrast" label="Switch to producer" size="small"
                            class="btn-dark" />
                        </Link>
                    </div>
                </div>
            </div>
            <div class="card">
                <Tabs value="0">
                    <TabList>
                        <Tab value="0">Overview</Tab>
                        <Tab value="1">Likes</Tab>
                        <Tab value="2">Purchases</Tab>
                        <Tab value="3">Albums</Tab>
                        <Tab value="4">Following</Tab>
                    </TabList>
                    <TabPanels>
                        <TabPanel value="0">
                            <div class="mt-4">
                                <div class="mx-auto max-w-6xl">
                                    <h2 class="text-lg font-semibold leading-6 text-gray-800">Recommended for You</h2>
                                    <div class="mt-2 flex gap-5 overflow-x-auto">
                                        <div
                                            class="border border-gray-800 bg-white shadow-[2px_2px_0px_0px_rgba(31,41,55,1)] w-[200px] flex-shrink-0">
                                            <div class="p-5">
                                                <h3 class="text-sm font-bold text-gray-800 font-mono">Track Name</h3>
                                                <p class="text-gray-600">Artist Name</p>
                                            </div>
                                        </div>
                                        <!-- Repeat similar blocks for other recommended tracks -->
                                    </div>

                                    <h2 class="mt-12 text-lg font-semibold leading-6 text-gray-800">Recently Played
                                    </h2>
                                    <div class="mt-2 flex gap-5 overflow-x-auto">
                                        <div v-for="recentPlay in recentPlays" :key="recentPlay.id"
                                            class="border border-gray-800 bg-white shadow-[2px_2px_0px_0px_rgba(31,41,55,1)] w-[200px] flex-shrink-0">
                                            <div v-if="!recentPlay.beat.cover_art"
                                                class="w-full h-[200px] bg-gray-100 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-300"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                                </svg>
                                            </div>
                                            <img v-else :src="recentPlay.beat.cover_art" :alt="recentPlay.beat.title"
                                                class="w-full h-[100px] object-cover" />
                                            <div class="p-2">
                                                <h3 class="text-xs font-medium text-gray-800 font-mono">{{
                                                    recentPlay.beat.title }}</h3>
                                                <p class="text-gray-600 text-xs">{{ recentPlay.beat.user.username }} Aro</p>
                                            </div>
                                        </div>
                                    </div>

                                    <h2 class="mt-12 text-lg font-semibold leading-6 text-gray-800">Liked Tracks</h2>
                                    <div class="mt-2 flex gap-5 overflow-x-auto">
                                        <div
                                            class="border border-gray-800 bg-white shadow-[2px_2px_0px_0px_rgba(31,41,55,1)] w-[200px] flex-shrink-0">
                                            <div class="p-5">
                                                <h3 class="text-sm font-bold text-gray-800 font-mono">Track Name</h3>
                                                <p class="text-gray-600">Artist Name</p>
                                            </div>
                                        </div>
                                        <!-- Repeat similar blocks for other liked tracks -->
                                    </div>

                                    <h2 class="mt-12 text-lg font-semibold leading-6 text-gray-800">Favorite Tracks
                                    </h2>
                                    <div class="mt-2 flex gap-5 overflow-x-auto">
                                        <div
                                            class="border border-gray-800 bg-white shadow-[2px_2px_0px_0px_rgba(31,41,55,1)] w-[200px] flex-shrink-0">
                                            <div class="p-5">
                                                <h3 class="text-sm font-bold text-gray-800 font-mono">Track Name</h3>
                                                <p class="text-gray-600">Artist Name</p>
                                            </div>
                                        </div>
                                        <!-- Repeat similar blocks for other favorite tracks -->
                                    </div>

                                    <h2 class="mt-12 text-lg font-semibold leading-6 text-gray-800">Trending Tracks
                                    </h2>
                                    <div class="mt-2 flex gap-5 overflow-x-auto">
                                        <div
                                            class="border border-gray-800 bg-white shadow-[2px_2px_0px_0px_rgba(31,41,55,1)] w-[200px] flex-shrink-0">
                                            <div class="p-5">
                                                <h3 class="text-sm font-bold text-gray-800 font-mono">Track Name</h3>
                                                <p class="text-gray-600">Artist Name</p>
                                            </div>
                                        </div>
                                        <!-- Repeat similar blocks for other trending tracks -->
                                    </div>

                                    <h2 class="mt-12 text-lg font-semibold leading-6 text-gray-800">Your Beats</h2>
                                    <div class="mt-2 flex gap-5 overflow-x-auto">
                                        <div v-for="beat in beats" :key="beat.id"
                                            class="border border-gray-800 bg-white shadow-[2px_2px_0px_0px_rgba(31,41,55,1)] w-[200px] flex-shrink-0">
                                            <div v-if="!beat.cover_art"
                                                class="w-full h-[200px] bg-gray-100 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-300"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                                </svg>
                                            </div>
                                            <img v-else :src="beat.cover_art" :alt="beat.title"
                                                class="w-full h-[200px] object-cover" />
                                            <div class="p-5">
                                                <h3 class="text-sm font-bold text-gray-800 font-mono">{{ beat.title }}
                                                </h3>
                                                <p class="text-gray-600">{{ beat.user.name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </TabPanel>
                        <TabPanel value="1">
                            <p class="m-0">Likes content goes here.</p>
                        </TabPanel>
                        <TabPanel value="2">
                            <p class="m-0">Playlists content goes here.</p>
                        </TabPanel>
                        <TabPanel value="3">
                            <p class="m-0">Albums content goes here.</p>
                        </TabPanel>
                        <TabPanel value="4">
                            <p class="m-0">Following content goes here.</p>
                        </TabPanel>
                    </TabPanels>
                </Tabs>
            </div>
        </div>

    </slot>

</template>

<script setup>
import { Head, usePage } from '@inertiajs/vue3'
import { computed, ref, onMounted } from 'vue'
import Default from '../Layouts/Default.vue'
import Button from 'primevue/button'
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';
import TabPanels from 'primevue/tabpanels';
import TabPanel from 'primevue/tabpanel';

defineProps({
    recentPlays: Object,
    beats: Object,
    user: Object
})

defineOptions({
    layout: Default
})

const page = usePage()

const hasRole = (role) => {
    const page = usePage();
    return page.props.auth?.user?.roles?.includes(role) || false;
};

</script>

<style>
.p-tabpanels {
    background-color: transparent !important;
}

.p-tablist-tab-list {
    background: transparent !important;
}
</style>
