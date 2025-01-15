<template>

    <Head>
        <title>Buy and Sell Phones | Your Site Name</title>
        <meta name="description"
            content="Find the best deals on used phones, including iPhones, Samsung, and Google Pixels">
    </Head>

    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-2 md:grid-cols-3 divide-x divide-gray-100">
            <div
                class="flex items-center justify-center py-4 px-4 hover:bg-gradient-to-b hover:from-gray-50 hover:to-white transition-all duration-300 group cursor-pointer">
                <div class="flex items-center gap-3">
                    <span
                        class="text-xl bg-green-50 p-2 rounded group-hover:scale-110 group-hover:bg-green-100 transition-all duration-300">👥</span>
                    <div class="flex flex-col">
                        <span class="font-semibold text-gray-800">People Powered</span>
                        <span class="text-xs text-gray-500">By the community</span>
                    </div>
                </div>
            </div>
            <div
                class="flex items-center justify-center py-4 px-4 hover:bg-gradient-to-b hover:from-gray-50 hover:to-white transition-all duration-300 group cursor-pointer">
                <div class="flex items-center gap-3">
                    <span
                        class="text-xl bg-blue-50 p-2 rounded group-hover:scale-110 group-hover:bg-blue-100 transition-all duration-300">🔒</span>
                    <div class="flex flex-col">
                        <span class="font-semibold text-gray-800">Secure Trading</span>
                        <span class="text-xs text-gray-500">Safe marketplace</span>
                    </div>
                </div>
            </div>
            <div
                class="flex items-center justify-center py-4 px-4 hover:bg-gradient-to-b hover:from-gray-50 hover:to-white transition-all duration-300 group cursor-pointer">
                <div class="flex items-center gap-3">
                    <span
                        class="text-xl bg-purple-50 p-2 rounded group-hover:scale-110 group-hover:bg-purple-100 transition-all duration-300">🚫</span>
                    <div class="flex flex-col">
                        <span class="font-semibold text-gray-800">No Junk, No Jerks</span>
                        <span class="text-xs text-gray-500">Quality guaranteed</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-16 mt-6">
            <div class="text-center py-16 bg-gradient-to-b from-white to-gray-50 rounded-xl shadow-sm">
                <h1 class="text-5xl font-bold mb-4 text-gray-800 animate-fade-in">Phones For Sale</h1>
                <p class="text-gray-600 mb-8 text-lg">Best deals on cheap phones and used phones.</p>
                <div class="flex justify-center gap-6">
                    <Button severity="contrast" outlined>
                        <span class="text-indigo-600">🍎</span>
                        <span class="font-medium text-gray-800">iPhones</span>
                    </Button>
                    <Button severity="contrast" outlined>
                        <span class="text-indigo-600">🤖</span>
                        <span class="font-medium text-gray-800">Android</span>
                    </Button>
                    <Button severity="primary">
                        <span>💰</span>
                        <span class="font-medium">
                            <Link :href="route('mobile-device.create')">Sell Phone</Link>
                        </span>
                    </Button>
                </div>
            </div>

            <div class="space-y-20">
                <section class="phone-section" aria-labelledby="iphone-section">
                    <h2 id="iphone-section" class="text-3xl font-bold text-center mb-8 text-gray-800">
                        {{ deviceConfig.iphone.title }}
                    </h2>
                    <div v-if="iphoneDevices.length" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                        <div v-for="(device, index) in iphoneDevices" :key="device.id"
                            class="phone-card bg-white border rounded p-6 text-center">
                            <img :src="getIphoneImage(device, index)" :alt="`${device.phone_brand.name} ${device.name}`"
                                loading="lazy" @error="(e) => e.target.src = deviceConfig.iphone.defaultImage"
                                class="mx-auto mb-4 h-36 object-contain">
                            <h3 class="font-medium text-gray-500 text-sm py-2">
                                {{ device.phone_brand.name }}
                                {{ device.name }}
                            </h3>
                            <Link :href="route('phone.variant.index', device.slug)">
                            <Button size="small" class="mt-3 text-xs" outlined
                                :aria-label="`View ${device.name} listings`">
                                View listings
                            </Button>
                            </Link>
                        </div>
                    </div>
                    <div v-else class="text-center py-8 text-gray-500">
                        No iPhones available at the moment
                    </div>
                </section>

                <section class="phone-section" aria-labelledby="samsung-section">
                    <h2 id="samsung-section" class="text-3xl font-bold text-center mb-8 text-gray-800">
                        {{ deviceConfig.samsung.title }}
                    </h2>
                    <div v-if="samsungDevices.length" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                        <div v-for="device in samsungDevices" :key="device.id"
                            class="phone-card bg-white border rounded p-6 text-center">
                            <img :src="getDeviceImage(device, 'samsung')"
                                :alt="`${device.phone_brand.name} ${device.name}`" loading="lazy"
                                @error="(e) => e.target.src = deviceConfig.samsung.defaultImage"
                                class="mx-auto mb-4 h-36 object-contain">
                            <h3 class="font-medium text-gray-500 text-sm py-2">
                                {{ device.phone_brand.name }}
                                {{ device.name }}
                            </h3>
                            <Link :href="route('phone.variant.index', device.slug)">
                            <Button size="small" class="mt-3 text-xs" outlined
                                :aria-label="`View ${device.name} listings`">
                                View listings
                            </Button>
                            </Link>
                        </div>
                    </div>
                    <div v-else class="text-center py-8 text-gray-500">
                        No Samsung phones available at the moment
                    </div>
                </section>

                <section class="phone-section" aria-labelledby="pixel-section">
                    <h2 id="pixel-section" class="text-2xl font-bold text-center mb-6 text-gray-800">
                        {{ deviceConfig.pixel.title }}
                    </h2>
                    <div v-if="pixelDevices.length" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                        <div v-for="device in pixelDevices" :key="device.id"
                            class="phone-card bg-white border rounded p-6 text-center">
                            <img :src="getDeviceImage(device, 'pixel')" :alt="device.name" loading="lazy"
                                @error="(e) => e.target.src = deviceConfig.pixel.defaultImage"
                                class="mx-auto mb-2 h-32 object-contain">
                            <h3 class="font-medium text-gray-500 text-sm py-2">
                                {{ device.phone_brand.name }}
                                {{ device.name }}
                            </h3>
                            <Link :href="route('phone.variant.index', device.slug)">
                            <Button size="small" class="mt-3 text-xs" outlined>
                                View listing
                            </Button>
                            </Link>
                        </div>
                    </div>
                    <div v-else class="text-center py-8 text-gray-500">
                        No Google Pixel phones available at the moment
                    </div>
                </section>
            </div>

            <div class="text-center py-12">
                <Button severity="primary" label="Browse all available phones" size="large">
                    Shop All Phones →
                </Button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import Default from '../../Layouts/Default.vue';
import Button from 'primevue/button';
import { onMounted } from 'vue';

const deviceConfig = {
    iphone: {
        defaultImage: '/images/phones/iphone13.png',
        brandIcon: '/images/brands/apple-icon.png',
        title: 'iPhones'
    },
    samsung: {
        defaultImage: '/images/phones/s24-ultra.png',
        brandIcon: '/images/brands/samsung-icon.png',
        title: 'Samsung Phones'
    },
    pixel: {
        defaultImage: '/images/phones/pixel-6.png',
        brandIcon: '/images/brands/google-icon.png',
        title: 'Google Pixels'
    },
};

// Samsung phone image mapping
const samsungImages = {
    'Galaxy S24 Ultra': 'https://fdn2.gsmarena.com/vv/bigpic/samsung-galaxy-s24-ultra-5g-sm-s928-stylus.jpg',
    'Galaxy S24+': 'https://fdn2.gsmarena.com/vv/bigpic/samsung-galaxy-s24-plus-5g-sm-s926.jpg',
    'Galaxy S24': 'https://fdn2.gsmarena.com/vv/bigpic/samsung-galaxy-s24-5g-sm-s921.jpg',
    'Galaxy S23+': 'https://fdn2.gsmarena.com/vv/bigpic/samsung-galaxy-s23-plus-5g.jpg',
    'Galaxy S23': 'https://fdn2.gsmarena.com/vv/bigpic/samsung-galaxy-s23-5g.jpg',
    'Galaxy S23 Ultra': 'https://fdn2.gsmarena.com/vv/bigpic/samsung-galaxy-s23-ultra-5g.jpg'
};

// Google Pixel image mapping
const pixelImages = {
    'Pixel 9 Pro': 'https://fdn2.gsmarena.com/vv/bigpic/google-pixel-9-pro-.jpg',
    'Pixel 9': 'https://fdn2.gsmarena.com/vv/bigpic/google-pixel-9-.jpg',
    'Pixel 8 Pro': 'https://fdn2.gsmarena.com/vv/bigpic/google-pixel-8-pro.jpg',
    'Pixel 8': 'https://fdn2.gsmarena.com/vv/bigpic/google-pixel-8.jpg',
    'Pixel 7a': 'https://fdn2.gsmarena.com/vv/bigpic/google-pixel-7a.jpg',
    'Pixel 7 Pro': 'https://fdn2.gsmarena.com/vv/bigpic/google-pixel7-pro-new.jpg'
};

// Updated getDeviceImage function to handle all brands
const getDeviceImage = (device, brand) => {
    let brandImages;
    switch (brand) {
        case 'samsung':
            brandImages = samsungImages;
            break;
        case 'pixel':
            brandImages = pixelImages;
            break;
        case 'oneplus':
            brandImages = oneplusImages;
            break;
        default:
            return deviceConfig[brand].defaultImage;
    }

    // Try to get image by exact device name
    if (brandImages[device.name]) {
        return brandImages[device.name];
    }

    // If device has its own image_url
    if (device.image_url) {
        return device.image_url;
    }

    // Fallback to default image for the brand
    return deviceConfig[brand].defaultImage;
};

// Add iPhone image mapping
const iphoneImages = {
    'iPhone 15 Pro Max': 'https://fdn2.gsmarena.com/vv/bigpic/apple-iphone-15-pro-max.jpg',
    'iPhone 15 Pro': 'https://fdn2.gsmarena.com/vv/bigpic/apple-iphone-15-pro.jpg',
    'iPhone 15 Plus': 'https://fdn2.gsmarena.com/vv/bigpic/apple-iphone-15-plus-.jpg',
    'iPhone 15': 'https://fdn2.gsmarena.com/vv/bigpic/apple-iphone-15.jpg',
    'iPhone 14 Pro Max': 'https://fdn2.gsmarena.com/vv/bigpic/apple-iphone-14-pro-max-.jpg',
    'iPhone 14 Pro': 'https://fdn2.gsmarena.com/vv/bigpic/apple-iphone-14-pro.jpg',
};

// Updated image getter function
const getIphoneImage = (device, index) => {
    // Try to get image by exact device name
    if (iphoneImages[device.name]) {
        return iphoneImages[device.name];
    }

    // If device has its own image_url
    if (device.image_url) {
        return device.image_url;
    }

    // Fallback to default iPhone image
    return deviceConfig.iphone.defaultImage;
};

// Add error handling for image loading
const handleImageError = (e, defaultImage) => {
    e.target.src = defaultImage;
    console.error('Failed to load image:', e.target.src);
};

// Add lazy loading for below-fold content
const lazyLoadSection = (entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
        }
    });
};

onMounted(() => {
    const observer = new IntersectionObserver(lazyLoadSection, {
        root: null,
        threshold: 0.1
    });

    document.querySelectorAll('.phone-section').forEach(section => {
        observer.observe(section);
    });
});

defineOptions({
    layout: Default,
});

defineProps({
    iphoneDevices: {
        type: Array,
        required: true
    },
    samsungDevices: {
        type: Array,
        required: true
    },
    pixelDevices: {
        type: Array,
        required: true
    },
    oneplusDevices: {
        type: Array,
        required: true
    }
});
</script>

<style scoped>
/* Enhanced animations and transitions */
.phone-section {
    @apply opacity-0;
    transform: translateY(20px);
}

.phone-section.is-visible {
    @apply opacity-100 transform-none transition-all duration-700;
}

/* Improved hover effects */
.phone-card {
    @apply transition-transform duration-300 will-change-transform;
}

/* Consistent button styling */
button {
    @apply transition-all duration-300 transform hover:scale-105 active:scale-95;
}

/* Add smooth scrolling */
html {
    scroll-behavior: smooth;
    @apply bg-gray-50;
}

/* Add loading skeleton styles */
.skeleton {
    @apply animate-pulse bg-gray-200;
}

/* Improved accessibility focus styles */
button:focus-visible,
a:focus-visible {
    @apply ring-2 ring-offset-2 ring-indigo-500 outline-none;
}
</style>
