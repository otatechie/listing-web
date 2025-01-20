<template>

    <Head title="Categories" />

    <div class="max-w-5xl mx-auto">
        <div class="container-border p-6 relative">
            <!-- Product Header with improved spacing -->
            <div class="mb-8">
                <div ref="headerRef" class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4 mb-6">
                    <div>
                        <h1 class="text-3xl font-semibold text-gray-900">
                            {{ mobileDevice.phone_brand?.name }} {{ mobileDevice.phone_variant?.name }}
                        </h1>
                        <!-- Location tag -->
                        <div
                            class="mt-3 inline-flex items-center gap-2 bg-indigo-50 text-indigo-700 px-4 py-2 rounded-full">
                            <i class="pi pi-map-marker"></i>
                            <span class="font-medium">{{ mobileDevice.location }}</span>
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

                <!-- Combined specifications and badges in one row -->
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
                    <!-- Featured and Approved badges -->
                    <span class="flex items-center px-2 py-1 bg-orange-100 text-orange-600 rounded-full text-xs">
                        <i class="pi pi-star-fill mr-1 text-[10px]"></i>
                        Featured
                    </span>
                    <span class="flex items-center px-2 py-1 bg-green-100 text-green-600 rounded-full text-xs">
                        <i class="pi pi-check-circle mr-1 text-[10px]"></i>
                        Approved
                    </span>
                </div>

                <!-- Buy Button with hover effect -->
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

            <!-- Product Images Grid with improved layout -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-8">
                <div v-for="(image, index) in mobileDevice.images" :key="index"
                    class="aspect-square rounded overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-200 cursor-pointer">
                    <img :src="image"
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-300" />
                </div>
            </div>

            <!-- Device Details with improved cards -->
            <div class="space-y-8">
                <!-- Condition Details Card -->
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

                <!-- Design Details -->
                <div class="border rounded-lg p-6 shadow-sm bg-white">
                    <!-- Title with subtle underline -->
                    <h1 class="text-2xl font-semibold mb-6 pb-2 border-b border-gray-100">
                        {{ mobileDevice.listing_title }}
                    </h1>

                    <!-- Condition Line with improved visual -->
                    <div class="flex items-center mb-8 bg-gray-50 p-4 rounded-lg">
                        <div class="w-1 h-8 bg-green-500 rounded-full mr-4"></div>
                        <p class="text-gray-700 font-medium">
                            {{ mobileDevice.damage_wear_description || 'No damage or wear reported' }}
                        </p>
                    </div>

                    <!-- Need More Info Section with improved styling -->
                    <div class="flex items-center justify-between mb-8 border-y border-gray-100 py-6">
                        <span class="text-lg font-semibold text-gray-700">Need more information?</span>
                        <Button label="Message seller" severity="primary" variant="outlined" size="small" />
                    </div>

                    <!-- Seller Information Section -->
                    <Link :href="route('user.profile', mobileDevice.user_id)">
                    <div
                        class="flex items-center gap-4 mb-8 p-4 bg-gray-50 rounded-lg border border-gray-200 hover:bg-white transition-colors cursor-pointer">
                        <img :src="`https://api.dicebear.com/9.x/initials/svg?seed=${encodeURIComponent(mobileDevice.user.name)}&backgroundType=gradientLinear&scale=100&fontSize=50`" :alt="`${mobileDevice.user.name}'s profile`"

                            class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-sm">
                        <div class="flex-grow">
                            <div class="flex items-center gap-2">
                                <h3 class="text-lg font-medium">{{ mobileDevice.user.name }}</h3>
                                <i class="pi pi-verified text-blue-500"></i>
                                <div class="flex text-green-500">
                                    <i v-for="n in 5" :key="n" class="pi pi-star-fill"></i>
                                </div>
                                <span class="text-sm text-gray-500">103</span>
                            </div>
                            <div class="text-sm text-gray-600">
                                <p>• Member since: {{ mobileDevice.joined_at_human }}</p>
                                <p>• Listings: {{ mobileDevice.count_listings }} total, 1 active</p>
                                <p>• Location: <i class="pi pi-map-marker"></i> {{ mobileDevice.location }}, {{
                                    mobileDevice.region }}</p>
                            </div>
                        </div>
                        <i class="pi pi-chevron-right text-gray-400"></i>
                    </div>
                    </Link>

                    <!-- Dates Section with improved layout -->
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

                    <!-- Action Buttons with improved styling -->
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

    <!-- Improved Mobile Bottom Bar -->
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

    <!-- Move Dialog component outside of other elements -->
    <Dialog v-model:visible="visible" modal header="Request Contact" :style="{ width: '30rem' }">
        <form @submit.prevent="handleSubmit">
            <div class="flex flex-col gap-4">
                <!-- Info message -->
                <div class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-full bg-indigo-50 flex items-center justify-center flex-shrink-0">
                        <i class="pi pi-phone text-xl text-indigo-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Want to see the seller's phone number?</h3>
                        <p class="text-gray-600">Send a contact request and we'll notify the seller.</p>
                    </div>
                </div>

                <!-- Safety tip -->
                <div class="bg-orange-50 p-3 rounded-lg flex items-start gap-2">
                    <i class="pi pi-info-circle text-orange-500 mt-1"></i>
                    <p class="text-sm text-orange-700">For your safety, always meet in a public place and never send
                        payments before seeing the device.</p>
                </div>
            </div>

            <div class="flex justify-end gap-2 mt-6">
                <Button type="button" label="Cancel" severity="secondary" @click="visible = false"></Button>
                <Button type="submit" label="Send Request" :loading="form.processing"></Button>
            </div>
        </form>
    </Dialog>

    <!-- Discussion Section -->
    <div class="relative max-w-5xl bg-white rounded border pt-4 mx-auto my-8 shadow-sm">
        <!-- Header -->
        <div class="absolute px-4 py-1.5 top-0 left-0 bg-gray-100 rounded-br-lg">
            <div class="flex items-center gap-2">
                <i class="pi pi-comments text-indigo-600"></i>
                <h2 class="text-md font-semibold text-gray-800">Discussion</h2>
            </div>
        </div>

        <!-- Comment Form -->
        <form class="mt-8">
            <div class="w-full px-6 mb-3">
                <Textarea v-model="value" rows="5" cols="30" class="w-full" />
            </div>
            <div class="w-full flex justify-between px-4 pb-4">
                <div class="text-sm text-gray-500">
                    <i class="pi pi-info-circle"></i>
                    <span class="ml-1">Please be polite, your comment will be visible to everyone</span>
                </div>
                <Button type="submit" label="Post Comment" icon="pi pi-send" size="small" />
            </div>
        </form>
    </div>

</template>

<script setup>
import Default from '../../Layouts/Default.vue';
import Button from 'primevue/button';
import Breadcrumb from 'primevue/breadcrumb';
import { ref, onMounted, onUnmounted, computed } from 'vue';
import Dialog from 'primevue/dialog';
import { useForm } from '@inertiajs/vue3';
import InputText from 'primevue/inputtext';
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

const visible = ref(false);
const headerRef = ref(null);
const showMobileBar = ref(false);

const checkScroll = () => {
    if (!headerRef.value) return;

    const headerPosition = headerRef.value.getBoundingClientRect().bottom;
    showMobileBar.value = headerPosition < 0;
};

onMounted(() => {
    window.addEventListener('scroll', checkScroll);
    // Initial check
    checkScroll();
});

onUnmounted(() => {
    window.removeEventListener('scroll', checkScroll);
});

const formattedStorage = computed(() => {
    if (!props.mobileDevice.storage_capacity) return null;

    const storage = Number(props.mobileDevice.storage_capacity);
    if (storage >= 1024) {
        return `${storage / 1024}TB`;
    }
    return `${storage}GB`;
});

const form = useForm({
    mobile_device_id: props.mobileDevice.id,
});

const handleSubmit = () => {
    form.post(route('contact-request.store'), {
        onSuccess: () => {
            visible.value = false;
            form.reset();
        },
    });
};

const isAppleDevice = computed(() => {
    return props.mobileDevice.phone_brand?.name?.toLowerCase() === 'apple';
});
</script>
