<template>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex flex-col sm:flex-row justify-between items-start gap-8 mt-8
                    bg-cyan-50 border-2 border-cyan-900 p-6
                    shadow-[3px_3px_0px_0px_rgba(120,53,15,1)]">
            <div class="flex flex-row items-center gap-4 w-full">
                <div class="w-32 h-32 rounded-full bg-cyan-100 flex-shrink-0
                            border-2 border-cyan-900
                            shadow-[inset_2px_2px_4px_rgba(120,53,15,0.3)]">
                </div>
                <div class="flex-grow ml-1.5">
                    <div class="flex flex-row sm:flex-col justify-between items-center sm:items-start">
                        <div>
                            <h1 class="text-xl font-heading text-cyan-900">{{ user.username }}</h1>
                            <p class="text-cyan-700 text-sm">{{ user.city }} ,{{ user.country }}</p>
                            <div class="flex gap-3 mt-2">
                                <a href="#" target="_blank"
                                    class="text-cyan-800 hover:text-cyan-600 transition-colors">
                                    <i class="pi pi-instagram text-lg"></i>
                                </a>
                                <a href="#" target="_blank"
                                    class="text-cyan-800 hover:text-cyan-600 transition-colors">
                                    <i class="pi pi-twitter text-lg"></i>
                                </a>
                                <a href="#" target="_blank"
                                    class="text-cyan-800 hover:text-cyan-600 transition-colors">
                                    <i class="pi pi-youtube text-lg"></i>
                                </a>
                            </div>
                        </div>
                        <div class="flex gap-4 sm:mt-4">
                            <Button v-if="$page.props.auth.user && user.username !== $page.props.auth.user.username"
                                @click="handleFollow" :title="isFollowing ? 'Unfollow' : 'Follow'" class="bg-cyan-800 hover:bg-cyan-700 border-2 border-cyan-950
                                       font-pixel tracking-wider
                                       shadow-[2px_2px_0px_0px_rgba(120,53,15,1)]
                                       active:shadow-none active:translate-x-[2px] active:translate-y-[2px]"
                                size="small">
                                {{ isFollowing ? 'Following' : 'Follow' }}
                            </Button>
                            <Button class="bg-cyan-100 hover:bg-cyan-200 border-2 border-cyan-950
                                       text-cyan-950 font-pixel tracking-wider
                                       shadow-[2px_2px_0px_0px_rgba(120,53,15,1)]
                                       active:shadow-none active:translate-x-[2px] active:translate-y-[2px]"
                                size="small" severity="secondary">Share</Button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full sm:w-auto md:mt-2">
                <div class="flex justify-center sm:justify-end gap-8 text-gray-600">
                    <div class="text-center">
                        <div class="text-base font-heading">{{ user.followers_count }}</div>
                        <div class="text-sm font-medium">Followers</div>
                    </div>
                    <div class="h-8 w-px bg-gray-300 self-center"></div>
                    <div class="text-center">
                        <div class="text-base font-heading">{{ user.following_count }}</div>
                        <div class="text-sm font-medium">Following</div>
                    </div>
                    <div class="h-8 w-px bg-gray-300 self-center"></div>
                    <div class="text-center">
                        <div class="text-base font-heading">{{ beats.length }}</div>
                        <div class="text-sm font-medium">Tracks</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-b mb-8 overflow-x-auto mt-6">
            <div class="card">
                <Tabs value="0" class="border-none">
                    <TabList class="border-b border-gray-200">
                        <Tab value="0" class="px-6 py-3 text-sm font-medium hover:text-cyan-600">Overview</Tab>
                        <Tab value="1">Albums</Tab>
                        <Tab value="2">Tracks</Tab>
                        <Tab value="3">Popular</Tab>
                        <Tab value="4">About</Tab>
                    </TabList>
                    <TabPanels>
                        <TabPanel value="0">
                            <div v-for="beat in beats" :key="beat.id" class="flex flex-col gap-4 p-4
                                       hover:bg-cyan-50 transition-colors duration-200
                                       border-2 border-cyan-800
                                       bg-white
                                       shadow-[3px_3px_0px_0px_rgba(146,64,14,1)]
                                       hover:shadow-[4px_4px_0px_0px_rgba(146,64,14,1)]
                                       mb-4">
                                <div class="flex items-center gap-4">
                                    <div class="relative group">
                                        <img :src="beat.cover_art" :alt="beat.title"
                                            class="w-16 h-16 object-cover rounded-lg" />
                                        <button @click="playBeat(beat)"
                                            class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-60 rounded-lg flex items-center justify-center transition-all">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="flex-grow">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <p class="text-sm text-gray-500">{{ beat.user.username }}</p>
                                                <h3 class="font-medium">{{ beat.title }}</h3>
                                            </div>
                                            <div class="text-right">
                                                <span
                                                    class="text-xs text-cyan-700 bg-cyan-50 px-2 py-1 rounded-full border border-cyan-200">
                                                    {{ beat.genre }}
                                                </span>
                                                <p class="text-xs text-gray-500 mt-2">
                                                    {{ beat.created_at }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="flex items-center justify-between text-sm text-gray-600">
                                    <div class="flex items-center space-x-4">
                                        <button class="flex items-center gap-1 hover:text-cyan-600 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                            <span class="text-xs text-gray-500">185K</span>
                                        </button>
                                        <button class="flex items-center gap-1 hover:text-cyan-600 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                            </svg>
                                            <span class="text-xs text-gray-500">Share</span>
                                        </button>
                                        <button class="flex items-center gap-1 hover:text-cyan-600 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                            <span class="text-xs text-gray-500">Report</span>
                                        </button>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-xs text-gray-500">{{ beat.stats.plays_count }} plays</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between text-sm text-gray-600">
                                    <div class="flex items-center space-x-4">
                                        <button
                                            @click="handleReaction('like', beat.id)"
                                            class="flex items-center gap-1 hover:text-cyan-600 transition-colors rounded-full hover:bg-cyan-50 px-2 py-1"
                                            :class="{ 'bg-cyan-50': beat.user_reactions?.includes('like') }">
                                            <span>👍</span>
                                            <span class="text-xs text-gray-500">{{ reactionCounts[beat.id]?.like || 0 }}</span>
                                        </button>

                                        <button
                                            @click="handleReaction('fire', beat.id)"
                                            class="flex items-center gap-1 hover:text-cyan-600 transition-colors rounded-full hover:bg-cyan-50 px-2 py-1"
                                            :class="{ 'bg-cyan-50': beat.user_reactions?.includes('fire') }">
                                            <span>🔥</span>
                                            <span class="text-xs text-gray-500">{{ reactionCounts[beat.id]?.fire || 0 }}</span>
                                        </button>

                                        <button
                                            @click="handleReaction('love', beat.id)"
                                            class="flex items-center gap-1 hover:text-cyan-600 transition-colors rounded-full hover:bg-cyan-50 px-2 py-1"
                                            :class="{ 'bg-cyan-50': beat.user_reactions?.includes('love') }">
                                            <span>❤️</span>
                                            <span class="text-xs text-gray-500">{{ reactionCounts[beat.id]?.love || 0 }}</span>
                                        </button>

                                        <button
                                            @click="handleReaction('clap', beat.id)"
                                            class="flex items-center gap-1 hover:text-cyan-600 transition-colors rounded-full hover:bg-cyan-50 px-2 py-1"
                                            :class="{ 'bg-cyan-50': beat.user_reactions?.includes('clap') }">
                                            <span>👏</span>
                                            <span class="text-xs text-gray-500">{{ reactionCounts[beat.id]?.clap || 0 }}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </TabPanel>
                        <TabPanel value="1">
                            <p class="m-0">
                                Albums content here...
                            </p>
                        </TabPanel>
                        <TabPanel value="2">
                            <p class="m-0">
                                Tracks content here...
                            </p>
                        </TabPanel>
                        <TabPanel value="3">
                            <p class="m-0">
                                Popular tracks content here...
                            </p>
                        </TabPanel>
                        <TabPanel value="4">
                            <div class="p-8 border-2 border-cyan-900
                                        shadow-[3px_3px_0px_0px_rgba(120,53,15,1)] mt-4">
                                <div class="flex items-center gap-3 mb-6">
                                    <div class="w-1 h-8 bg-gray-700"></div>
                                    <h3 class="font-heading text-2xl text-gray-700">Bio</h3>
                                </div>
                                <p class="text-gray-500">
                                    {{ user.profile.bio || 'No bio available yet.' }}
                                </p>
                            </div>
                        </TabPanel>
                    </TabPanels>
                </Tabs>
            </div>
        </div>

        <div>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Featured Albums and EPs</h2>
                <button class="text-sm text-gray-600">View All</button>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                <div v-for="n in 5" :key="n" class="aspect-square bg-gray-200 rounded-lg"></div>
            </div>
        </div>
    </div>

</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useAudioStore } from "@/stores/audioStore";
import Button from 'primevue/button'
import { Link, useForm, usePage, router } from '@inertiajs/vue3'
import BaseLayout from '../../Layouts/BaseLayout.vue'
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';
import TabPanels from 'primevue/tabpanels';
import TabPanel from 'primevue/tabpanel';

defineOptions({
    layout: BaseLayout
})

const props = defineProps({
    user: {
        type: Object,
        required: true
    },
    beats: {
        type: Array,
        required: true
    },
    following: {
        type: Boolean,
        default: false
    },
});

const audioStore = useAudioStore()

const form = useForm({
    beat_id: null,
    reaction_type: null
})

const isFollowing = ref(props.following)

const handleFollow = () => {
    form.post(route('user.follow', { userId: props.user.id }), {
        onSuccess: () => {
            isFollowing.value = !isFollowing.value
        }
    })
}

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

const page = usePage()

const reactionCounts = ref({});

const handleReaction = (type, beatId) => {
    const beat = props.beats.find(b => b.id === beatId);
    if (beat) {
        const existingReactionIndex = beat.user_reactions.findIndex(reaction => reaction !== type);
        if (existingReactionIndex !== -1) {
            const oldReaction = beat.user_reactions[existingReactionIndex];
            if (beat.reaction_counts[oldReaction] > 0) {
                beat.reaction_counts[oldReaction] -= 1;
            }
            beat.user_reactions.splice(existingReactionIndex, 1);
        }

        form.beat_id = beatId;
        form.reaction_type = type;

        form.post(route('reaction.add'), {
            preserveScroll: true,
            onSuccess: () => {
                beat.reaction_counts[type] = (beat.reaction_counts[type] || 0) + 1;
                beat.user_reactions.push(type);
                reactionCounts.value[beat.id] = beat.reaction_counts;
            }
        });
    }
};

onMounted(() => {
    props.beats.forEach(beat => {
        reactionCounts.value[beat.id] = beat.reaction_counts || {};
    });
});
</script>
