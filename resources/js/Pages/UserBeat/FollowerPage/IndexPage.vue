<template>
    <Head title="Following" />

    <div class="px-5">
        <div class="container-border">
            <Tabs value="0">
                <TabList class="border-b border-gray-200">
                    <Tab value="0" class="font-bold text-lg px-6 py-3">Followers</Tab>
                    <Tab value="1" class="font-bold text-lg px-6 py-3">Following</Tab>
                </TabList>
                <TabPanels>
                    <TabPanel value="0" class="p-4">
                        <div class="space-y-4">
                            <template v-if="followers.length > 0">
                                <div v-for="follower in followers"
                                     :key="follower.id"
                                     class="flex items-center justify-between hover:bg-gray-50 rounded-lg">
                                    <div class="flex items-center gap-4">
                                        <img src="https://api.dicebear.com/9.x/bottts/svg"
                                             class="w-12 h-12 rounded-full object-cover" />
                                        <div>
                                            <h4 class="font-semibold text-gray-900">{{ follower.username }}</h4>
                                            <p class="text-sm text-gray-500">{{ follower.bio || '' }}</p>
                                        </div>
                                    </div>
                                    <button class="px-4 py-1.5 border border-gray-800 rounded-full hover:bg-gray-50
                                               transition-colors duration-200 text-sm font-medium">
                                        Follow
                                    </button>
                                </div>
                            </template>
                            <div v-else class="text-center text-gray-500">
                                You don't have any followers.
                            </div>
                        </div>
                    </TabPanel>

                    <TabPanel value="1" class="p-4">
                        <div class="space-y-4">
                            <template v-if="following.length > 0">
                                <div v-for="user in following"
                                     :key="user.id"
                                     class="flex items-center justify-between hover:bg-gray-50 rounded-lg">
                                    <div class="flex items-center gap-4">
                                        <img src="https://api.dicebear.com/9.x/bottts/svg"
                                             class="w-12 h-12 rounded-full object-cover" />
                                        <div>
                                            <h4 class="font-semibold text-gray-900">{{ user.username }}</h4>
                                            <p class="text-sm text-gray-500">{{ user.bio || '' }}</p>
                                        </div>
                                    </div>
                                    <button class="px-4 py-1.5 border border-gray-800 rounded-full hover:bg-gray-50
                                               transition-colors duration-200 text-sm font-medium">
                                        Unfollow
                                    </button>
                                </div>
                            </template>
                            <div v-else class="text-center text-gray-500">
                                You don't follow anyone.
                            </div>
                        </div>
                    </TabPanel>
                </TabPanels>
            </Tabs>
        </div>
    </div>
</template>

<script setup>
import Default from '../../../Layouts/Default.vue';
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';
import TabPanels from 'primevue/tabpanels';
import TabPanel from 'primevue/tabpanel';

const props = defineProps({
    followers: Array,
    following: Array,
});

defineOptions({
    layout: Default
});
</script>
