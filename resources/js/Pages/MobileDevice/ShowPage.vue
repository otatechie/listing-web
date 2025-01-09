<template>

    <Head title="Categories" />

    <Breadcrumb :home="home" :model="items" />
    <div class="max-w-5xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <!-- Product Header with improved spacing -->
            <div class="mb-8">
                <div ref="headerRef" class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4 mb-6">
                    <h1 class="text-3xl font-bold text-gray-900">Samsung Galaxy S24 Ultra Unlocked</h1>
                    <div class="text-3xl font-bold text-green-600 flex items-center gap-2">
                        <span class="text-sm text-gray-500">Starting at</span>
                        $938
                    </div>
                </div>

                <!-- Specifications with pills design -->
                <div class="flex flex-wrap items-center gap-2 mb-6">
                    <span class="px-3 py-1 bg-gray-100 rounded-full text-sm text-gray-700">Mint</span>
                    <span class="px-3 py-1 bg-gray-100 rounded-full text-sm text-gray-700">512 GB</span>
                    <span class="px-3 py-1 bg-gray-100 rounded-full text-sm text-gray-700">Black</span>
                    <span class="px-3 py-1 bg-gray-100 rounded-full text-sm text-gray-700">SM-S928U1</span>
                    <span class="px-3 py-1 bg-gray-100 rounded-full text-sm text-gray-700">12 GB</span>
                </div>

                <!-- Badges with improved styling -->
                <div class="flex flex-wrap items-center gap-3 mb-6">
                    <span class="flex items-center px-3 py-1.5 bg-orange-100 text-orange-600 rounded-lg text-sm font-medium">
                        <i class="pi pi-star-fill mr-2"></i>
                        Featured
                    </span>
                    <span class="flex items-center px-3 py-1.5 bg-green-100 text-green-600 rounded-lg text-sm font-medium">
                        <i class="pi pi-check-circle mr-2"></i>
                        Approved
                    </span>
                </div>

                <!-- Buy Button with hover effect -->
                <Button label="Buy Now"
                    class="p-button-success w-full h-12 text-lg font-semibold shadow-md hover:shadow-lg transition-all" />
            </div>

            <!-- Product Images Grid with improved layout -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-8">
                <div v-for="(image, index) in device.images" :key="index"
                    class="aspect-square rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-200 cursor-pointer">
                    <img :src="image" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300" />
                </div>
            </div>

            <!-- Device Details with improved cards -->
            <div class="space-y-8">
                <!-- Condition Details Card -->
                <div class="border rounded-xl p-6 bg-gray-50 hover:bg-white transition-colors duration-200">
                    <h2 class="text-xl font-semibold mb-4 text-gray-900">Condition</h2>
                    <ul class="space-y-3">
                        <li v-for="(detail, index) in device.condition_details" :key="index"
                            class="flex items-start gap-2 text-gray-700">
                            <i class="pi pi-check text-green-500 mt-1"></i>
                            <span>{{ detail }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Design Details -->
                <div class="border rounded-lg p-6 shadow-sm bg-white hover:shadow-md transition-shadow duration-200">
                    <!-- Title with subtle underline -->
                    <h1 class="text-2xl font-bold mb-6 pb-2 border-b border-gray-100">
                        iPhone 16 Unlocked 2 Months Old
                    </h1>

                    <!-- Condition Line with improved visual -->
                    <div class="flex items-center mb-8 bg-gray-50 p-4 rounded-lg">
                        <div class="w-1 h-8 bg-green-500 rounded-full mr-4"></div>
                        <p class="text-gray-700 font-medium">Like New, no scratches. Cycle count 56.</p>
                    </div>

                    <!-- Need More Info Section with improved styling -->
                    <div class="flex items-center justify-between mb-8 border-y border-gray-100 py-6">
                        <span class="text-lg font-semibold text-gray-800">Need more information?</span>
                        <button
                            class="text-green-600 border-2 border-green-600 rounded-lg px-6 py-2.5 flex items-center hover:bg-green-50 transition-colors duration-200 font-medium">
                            <i class="pi pi-comments mr-2 text-lg"></i>
                            Message Seller
                        </button>
                    </div>

                    <!-- Dates Section with improved layout -->
                    <div class="grid grid-cols-3 gap-4 mb-8 bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <i class="pi pi-calendar mr-2 text-green-600"></i>
                            <div>
                                <p class="text-xs text-gray-500">Created</p>
                                <p class="text-sm font-medium">Jan 2, 2025</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="pi pi-calendar mr-2 text-green-600"></i>
                            <div>
                                <p class="text-xs text-gray-500">Updated</p>
                                <p class="text-sm font-medium">Jan 4, 2025</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="pi pi-calendar mr-2 text-green-600"></i>
                            <div>
                                <p class="text-xs text-gray-500">Expires</p>
                                <p class="text-sm font-medium">Jan 12, 2025</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons with improved styling -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-100">
                        <button
                            class="text-gray-700 bg-gray-50 border border-gray-200 rounded-lg px-5 py-2.5 flex items-center hover:bg-gray-100 transition-colors duration-200">
                            <i class="pi pi-ban mr-2"></i>
                            Mark Unavailable
                        </button>
                        <button
                            class="text-red-600 bg-red-50 border border-red-200 rounded-lg px-5 py-2.5 flex items-center hover:bg-red-100 transition-colors duration-200">
                            <i class="pi pi-flag mr-2"></i>
                            Report
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Improved Mobile Bottom Bar -->
    <div class="fixed bottom-0 left-0 right-0 h-[80px] md:hidden bg-white border-t shadow-lg z-50 backdrop-blur-lg bg-white/90"
         v-show="showMobileBar">
        <div class="max-w-7xl mx-auto px-4 h-full">
            <div class="flex items-center justify-between h-full">
                <div class="flex items-center gap-4">
                    <button class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors">
                        <i class="pi pi-comments text-xl"></i>
                    </button>
                    <div class="flex flex-col">
                        <span class="text-sm text-gray-500">Price</span>
                        <span class="text-2xl font-bold text-green-600">$938</span>
                    </div>
                </div>
                <button class="bg-green-600 text-white px-8 py-3 rounded-lg font-medium hover:bg-green-700 transition-all duration-200 shadow-md hover:shadow-lg">
                    Buy Now
                </button>
            </div>
        </div>
    </div>

</template>

<script setup>
import Default from '../../Layouts/Default.vue';
import { computed, ref, onMounted, onUnmounted } from 'vue';
import { usePage } from '@inertiajs/vue3';
import Stepper from 'primevue/stepper';
import StepItem from 'primevue/stepitem';
import Step from 'primevue/step';
import StepPanel from 'primevue/steppanel';
import Button from 'primevue/button';
import FloatLabel from 'primevue/floatlabel';
import Select from 'primevue/select';
import Breadcrumb from 'primevue/breadcrumb';
import { Head, useForm } from '@inertiajs/vue3';
import Textarea from 'primevue/textarea';
import InputText from 'primevue/inputtext';

defineOptions({
    layout: Default,
})

const home = ref({
    icon: 'pi pi-home'
});
const items = ref([
    { label: 'Listings' }
]);

const device = ref({
    name: 'iPhone 16 Unlocked 2 Months Old',
    price: 938,
    condition: 'Like New',
    carrier_info: 'AT&T • T-Mobile • Unlocked • Verizon • US Cellular • Consumer Cellular • Cricket • Google Fi',
    condition_details: [
        'Like New, no scratches',
        'Cycle count 56',
        'Power cord/charger not included',
        'Retail packaging and materials not included'
    ],
    images: [
        '/path/to/image1.jpg',
        '/path/to/image2.jpg',
        '/path/to/image3.jpg',
    ],
    design: {
        dimensions: '162.3 x 79 x 8.6 mm',
        weight: '233 g',
        build: 'Glass front & back, titanium frame',
        protection: 'IP68 dust/water resistant'
    }
});

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
</script>
