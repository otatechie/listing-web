<template>

    <Head title="Categories" />

    <div class="max-w-5xl mx-auto">
        <div class="container-border p-6 relative">
            <div class="mb-8">
                <div ref="headerRef" class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4 mb-6">
                    <div>
                        <h1 class="text-3xl font-semibold text-gray-900">
                            {{ mobileDevice.phone_brand?.name }} {{ mobileDevice.phone_variant?.name }}
                        </h1>
                        <div
                            class="text-sm mt-3 inline-flex items-center gap-2 bg-indigo-50 text-indigo-500 px-4 py-2 rounded-full">
                            <i class="pi pi-map-marker"></i>
                            <span class="font-medium">{{ mobileDevice.user.location }}, {{ mobileDevice.user.region
                                }}</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <button
                            class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-100 transition-colors">
                            <i class="pi pi-heart text-gray-400"></i>
                        </button>
                        <div class="text-3xl font-semibold text-indigo-600 flex items-center gap-2">
                            <span class="text-sm text-gray-500">Selling for</span>
                            ${{ mobileDevice.price }}
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-2 mb-6">
                    <span v-if="mobileDevice.condition"
                        class="px-2 py-1 bg-gray-100 rounded-full text-xs text-gray-700 capitalize">{{
                            mobileDevice.condition }}</span>
                    <span v-if="mobileDevice.storage_capacity"
                        class="px-2 py-1 bg-gray-100 rounded-full text-xs text-gray-700 capitalize">{{
                            formattedStorage }}</span>
                    <span v-if="mobileDevice.color"
                        class="px-2 py-1 bg-gray-100 rounded-full text-xs text-gray-700 capitalize">{{
                            mobileDevice.color }}</span>
                    <span v-if="mobileDevice.ram && !isAppleDevice"
                        class="px-2 py-1 bg-gray-100 rounded-full text-xs text-gray-700 capitalize">{{
                            mobileDevice.ram }}GB</span>
                    <span v-if="mobileDevice.phone_model?.name"
                        class="px-2 py-1 bg-gray-100 rounded-full text-xs text-gray-700 capitalize">{{
                            mobileDevice.phone_model?.name }}</span>
                    <span v-if="mobileDevice.phone_model?.model_number"
                        class="px-2 py-1 bg-gray-100 rounded-full text-xs text-gray-700">{{
                            mobileDevice.phone_model?.model_number }}</span>
                    <span class="flex items-center px-2 py-1 bg-orange-100 text-orange-600 rounded-full text-xs">
                        <i class="pi pi-star-fill mr-1 text-[10px]"></i>
                        Featured
                    </span>
                    <span class="flex items-center px-2 py-1 bg-green-100 text-green-600 rounded-full text-xs">
                        <i class="pi pi-check-circle mr-1 text-[10px]"></i>
                        Approved
                    </span>
                </div>

                <div class="flex gap-4 w-full">
                    <template v-if="mobileDevice.user_id !== $page.props.auth.user?.id">
                        <Button label="Chat with seller" size="small" icon="pi pi-comments" class="flex-1" />
                        <Button label="Request Contact" severity="secondary" size="small" icon="pi pi-user"
                            @click="visible = true" class="flex-1" />
                    </template>
                    <template v-else>
                        <Button label="Respond to contact requests" size="small" icon="pi pi-envelope" class="flex-1" />
                        <Link :href="route('mobile-device.edit', mobileDevice.id)" class="flex-1 w-full">
                        <Button label="Edit Listing" severity="secondary" size="small" icon="pi pi-pencil"
                            class="w-full" />
                        </Link>
                    </template>

                </div>
                <div class="border-t mt-6 border-gray-100"></div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-8">
                <div v-for="(image, index) in mobileDevice.images" :key="index"
                    class="aspect-square rounded overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-200 cursor-pointer">
                    <img :src="image"
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-300" />
                </div>
            </div>

            <div class="space-y-8">
                <div class="border rounded-lg p-6 bg-gray-50 hover:bg-white transition-colors duration-200">
                    <div class="mb-4">
                        <div class="flex items-center gap-3">
                            <span class="text-xl font-semibold text-gray-900">Condition</span>
                            <span v-if="mobileDevice.condition"
                                class="px-3 py-1 bg-white border-2 border-gray-200 rounded-full text-gray-800 capitalize">
                                {{ mobileDevice.condition }}
                            </span>
                            <div v-if="mobileDevice.battery_health && !isAppleDevice"
                                class="flex items-center px-3 py-1 bg-white border border-orange-500 rounded-full text-orange-600 text-xs font-medium">
                                <i class="pi pi-bolt mr-1"></i>
                                Battery Health {{ mobileDevice.battery_health }}%
                            </div>
                        </div>
                    </div>
                    <ul class="space-y-3">
                        <li v-for="(detail, index) in mobileDevice.condition_details || []" :key="index"
                            class="flex items-start gap-2 text-gray-700">
                            <i class="pi pi-check text-green-500 mt-1"></i>
                            <span>{{ detail }}</span>
                        </li>
                    </ul>
                </div>

                <div class="border rounded-lg p-6 shadow-sm bg-white">
                    <h1 class="text-2xl font-semibold mb-6 pb-2 border-b border-gray-100">
                        {{ mobileDevice.listing_title }}
                    </h1>

                    <div class="flex items-center mb-8 bg-gray-50 p-4 rounded-lg">
                        <div class="w-1 h-8 bg-green-500 rounded-full mr-4"></div>
                        <p class="text-gray-700 font-medium">
                            {{ mobileDevice.damage_wear_description || 'No damage or wear reported' }}
                        </p>
                    </div>

                    <div class="flex items-center justify-between mb-8 border-y border-gray-100 py-6">
                        <span class="text-lg font-semibold text-gray-700">Need more information?</span>
                        <Button label="Message seller" severity="primary" variant="outlined" size="small" />
                    </div>

                    <Link :href="route('user.profile', mobileDevice.user_id)">
                    <div
                        class="flex items-center gap-4 mb-8 p-4 bg-gray-50 rounded-lg border border-gray-200 hover:bg-white transition-colors cursor-pointer">
                        <img :src="`https://api.dicebear.com/9.x/initials/svg?seed=${encodeURIComponent(mobileDevice.user.name)}&backgroundType=gradientLinear&scale=100&fontSize=50`"
                            :alt="`${mobileDevice.user.name}'s profile`"
                            class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-sm">
                        <div class="flex-grow">
                            <div class="flex items-center gap-2">
                                <h3 class="text-lg font-medium mb-1">{{ mobileDevice.user.name }}</h3>
                                <i class="pi pi-verified text-blue-500"></i>
                                <div class="flex text-green-500">
                                    <i v-for="n in 5" :key="n" class="pi pi-star-fill"></i>
                                </div>
                                <span class="text-sm text-gray-500">103</span>
                            </div>
                            <div class="text-sm text-gray-600">
                                <p>• Member since: {{ mobileDevice.joined_at_human }}</p>
                                <p>• Listings: {{ mobileDevice.count_listings }} total, 1 active</p>
                                <p>• Location: {{ mobileDevice.user.location }}, {{ mobileDevice.user.region
                                    }}</p>
                            </div>
                        </div>
                        <i class="pi pi-chevron-right text-gray-400"></i>
                    </div>
                    </Link>

                    <div class="grid grid-cols-3 gap-4 mb-8 bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <i class="pi pi-calendar mr-2 text-indigo-600"></i>
                            <div>
                                <p class="text-xs text-gray-500">Created</p>
                                <p class="text-sm font-medium">{{ mobileDevice.created_at_human }}</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="pi pi-refresh mr-2 text-indigo-600"></i>
                            <div>
                                <p class="text-xs text-gray-500">Updated</p>
                                <p class="text-sm font-medium">{{ mobileDevice.updated_at_human }}</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="pi pi-clock mr-2 text-indigo-600"></i>
                            <div>
                                <p class="text-xs text-gray-500">Expires</p>
                                <p class="text-sm font-medium">Jan 12, 2025</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-100">
                        <template v-if="mobileDevice.user_id !== $page.props.auth.user?.id">
                            <Button label="Report" severity="danger" variant="outlined" size="small" />
                        </template>
                        <template v-else>
                            <Button label="Mark as sold" severity="secondary" variant="outlined" size="small" />
                            <Button label="Archive" severity="warn"
                                title="Archiving will hide your listing from the public" variant="outlined"
                                size="small" />
                            <Button label="Delete" severity="danger" variant="outlined" size="small" />
                        </template>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="relative max-w-5xl bg-white rounded-lg border pt-4 mx-auto my-10 shadow-sm">
        <div class="absolute px-4 py-2 top-0 left-0 bg-indigo-50 rounded-br-lg rounded-tl-lg">
            <div class="flex items-center gap-2">
                <i class="pi pi-comments text-gray-700"></i>
                <h2 class="text-md font-semibold text-gray-800">Discussion</h2>
                <span class="text-gray-600 ml-1">({{ mobileDevice.discussions?.length || 0 }})</span>
            </div>
        </div>

        <div class="px-6 mt-10 mb-6">
            <div v-if="mobileDevice.discussions?.length">
                <div v-for="discussion in mobileDevice.discussions" :key="discussion.id"
                    class="flex gap-4 pt-2 hover:bg-gray-50 p-2 rounded-lg transition-colors">
                    <img :src="`https://api.dicebear.com/9.x/initials/svg?seed=${encodeURIComponent(discussion.user.name)}`"
                        class="w-10 h-10 rounded-full flex-shrink-0 border-2 border-white shadow-sm"
                        :alt="`${discussion.user.name}'s avatar`" />
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-2 mb-1">
                            <span class="font-medium text-gray-800 break-all text-sm">{{ discussion.user.name }}</span>
                            <span v-if="discussion.user.id === mobileDevice.user_id"
                                class="px-2 py-0.5 bg-indigo-50 text-indigo-600 text-xs rounded-full font-medium whitespace-nowrap">
                                Owner
                            </span>
                            <span class="text-xs text-gray-500 whitespace-nowrap">• {{ discussion.created_at_human }}</span>
                        </div>
                        <div v-if="editingDiscussion === discussion.id">
                            <Textarea v-model="editDiscussionForm.message" rows="3"
                                class="w-full !bg-white mb-2 text-sm sm:text-base"
                                :class="{ '!border-red-300': editDiscussionForm.errors.message }" />
                            <div class="flex gap-2">
                                <Button type="button" label="Cancel" severity="secondary" size="small"
                                    @click="cancelEdit" />
                                <Button type="button" label="Save" size="small" :loading="editDiscussionForm.processing"
                                    @click="updateDiscussion(discussion.id)" />
                            </div>
                        </div>
                        <p v-else class="text-gray-500 whitespace-pre-wrap leading-relaxed text-sm break-words">
                            {{ discussion.message }}
                        </p>
                        <div class="flex gap-2 mt-2">
                            <button v-if="canEditDiscussion(discussion) && !isEditTimeExpired(discussion)"
                                class="text-xs text-gray-400 link-hover flex items-center gap-1 underline"
                                @click="startEdit(discussion)">
                                Edit
                            </button>
                        </div>
                        <div class="border-b border-gray-200 py-2"></div>
                    </div>
                </div>
            </div>
            <div v-else class="text-center py-12 bg-gray-50 rounded-lg">
                <i class="pi pi-comments text-4xl mb-3 text-gray-400"></i>
                <p class="text-gray-600 font-medium">No comments yet</p>
                <p class="text-sm text-gray-500">Be the first to start the discussion!</p>
            </div>
        </div>

        <div class="border-t bg-gray-50 rounded-b-lg">
            <div class="w-full px-6 pt-6">
                <div class="mb-2 flex items-center">
                    <span class="text-lg font-medium text-gray-700">
                        {{ $page.props.auth.user ? 'Post a comment' : 'Sign in to comment' }}
                    </span>
                </div>
                <Textarea v-model="createDiscussionForm.message" rows="4" placeholder="" class="w-full !bg-white"
                    :class="{ '!border-red-300': createDiscussionForm.errors.message }"
                    :disabled="!$page.props.auth.user" />
                <p v-if="createDiscussionForm.errors.message" class="mt-2 text-xs text-red-600">
                    {{ createDiscussionForm.errors.message }}
                </p>
            </div>

            <div class="w-full flex justify-between p-4 items-center">
                <div class="text-sm text-gray-500 flex items-center">
                    <i class="pi pi-info-circle text-gray-400"></i>
                    <span class="ml-2 text-xs">Be respectful and constructive</span>
                </div>
                <Button type="submit" @click="submitDiscussionForm" label="Post Comment" icon="pi pi-send" size="small"
                    :disabled="!$page.props.auth.user" :loading="createDiscussionForm.processing" class="px-4" />
            </div>
        </div>
    </div>

    <div class="fixed bottom-0 left-0 right-0 h-[80px] md:hidden bg-white border-t shadow-lg z-50 backdrop-blur-lg bg-white/90"
        v-show="showMobileBar">
        <div class="max-w-7xl mx-auto px-4 h-full">
            <div class="flex items-center justify-between gap-3 h-full">
                <button
                    class="w-12 h-12 flex items-center justify-center rounded-full bg-gray-50 text-gray-600 hover:bg-gray-100 transition-colors">
                    <i class="pi pi-heart text-xl"></i>
                </button>
                <template v-if="mobileDevice.user_id !== $page.props.auth.user?.id">
                    <Button label="Chat" icon="pi pi-comments" class="p-button-primary flex-1" />
                    <Button label="Request Contact" icon="pi pi-user" @click="visible = true"
                        class="p-button-outlined p-button-primary flex-1" />
                </template>
                <template v-else>
                    <Button label="Respond to requests" icon="pi pi-envelope" class="p-button-primary flex-1" />
                </template>
            </div>
        </div>
    </div>

    <Dialog v-model:visible="visible" modal header="Request Contact" :style="{ width: '30rem' }">
        <form @submit.prevent="handleContactRequest">
            <div class="flex flex-col gap-4">
                <div class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-full bg-indigo-50 flex items-center justify-center flex-shrink-0">
                        <i class="pi pi-phone text-xl text-indigo-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Want to see the seller's phone number?</h3>
                        <p class="text-gray-600">Send a contact request and we'll notify the seller.</p>
                    </div>
                </div>

                <div class="bg-orange-50 p-3 rounded-lg flex items-start gap-2">
                    <i class="pi pi-info-circle text-orange-500 mt-1"></i>
                    <p class="text-sm text-orange-700">For your safety, always meet in a public place and never send
                        payments before seeing the device.</p>
                </div>
            </div>

            <div class="flex justify-end gap-2 mt-6">
                <Button type="button" label="Cancel" severity="secondary" @click="visible = false"></Button>
                <Button type="submit" label="Send Request" :loading="contactRequestForm.processing"></Button>
            </div>
        </form>
    </Dialog>

</template>

<script setup>
import Default from '../../Layouts/Default.vue';
import Button from 'primevue/button';
import { ref, onMounted, onUnmounted, computed } from 'vue';
import Dialog from 'primevue/dialog';
import { useForm, usePage } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';
import Textarea from 'primevue/textarea';

const props = defineProps({
    mobileDevice: {
        type: Object,
        required: true
    }
});

defineOptions({
    layout: Default,
})

const page = usePage();
const visible = ref(false);
const headerRef = ref(null);
const showMobileBar = ref(false);
const editingDiscussion = ref(null);
const EDIT_TIME_LIMIT_MINUTES = 10;

const createDiscussionForm = useForm({
    message: null,
    mobile_device_id: props.mobileDevice.id,
});

const editDiscussionForm = useForm({
    message: '',
});

const submitDiscussionForm = () => {
    createDiscussionForm.post(route('discussion.store'), {
        preserveScroll: true,
        onSuccess: () => {
            createDiscussionForm.reset('message');
        },
        onError: (errors) => {
            console.error('Form submission failed:', errors);
        }
    });
};

const updateDiscussion = (discussionId) => {
    editDiscussionForm.put(route('discussion.update', discussionId), {
        preserveScroll: true,
        onSuccess: () => {
            editingDiscussion.value = null;
            editDiscussionForm.reset();
        },
        onError: (errors) => {
            console.error('Failed to update discussion:', errors);
        }
    });
};

const contactRequestForm = useForm({
    mobile_device_id: props.mobileDevice.id,
});

const handleContactRequest = () => {
    contactRequestForm.post(route('contact-request.store'), {
        onSuccess: () => {
            visible.value = false;
            contactRequestForm.reset();
        },
    });
};

const checkScroll = () => {
    if (headerRef.value) {
        showMobileBar.value = headerRef.value.getBoundingClientRect().bottom < 0;
    }
};

onMounted(() => {
    window.addEventListener('scroll', checkScroll);
    checkScroll();
});

onUnmounted(() => {
    window.removeEventListener('scroll', checkScroll);
});

const formattedStorage = computed(() => {
    if (!props.mobileDevice.storage_capacity) return null;
    const storage = Number(props.mobileDevice.storage_capacity);
    return storage >= 1024 ? `${storage / 1024}TB` : `${storage}GB`;
});

const isAppleDevice = computed(() => {
    return props.mobileDevice.phone_brand?.name?.toLowerCase() === 'apple';
});

const startEdit = (discussion) => {
    editingDiscussion.value = discussion.id;
    editDiscussionForm.message = discussion.message;
};

const cancelEdit = () => {
    editingDiscussion.value = null;
    editDiscussionForm.reset();
};

const canEditDiscussion = (discussion) => {
    return page.props.auth.user && discussion.user_id === page.props.auth.user.id;
};

const isEditTimeExpired = (discussion) => {
    const createdAt = new Date(discussion.created_at);
    const now = new Date();
    return (now - createdAt) / (1000 * 60) > EDIT_TIME_LIMIT_MINUTES;
};
</script>
