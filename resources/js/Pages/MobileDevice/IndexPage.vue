<template>
    <div class="max-w-7xl mx-auto px-4">
        <div class="bg-white border-b">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-gray-100">
                    <div class="flex items-center justify-center py-4 px-4 hover:bg-gradient-to-b hover:from-gray-50 hover:to-white transition-all duration-300 group cursor-pointer">
                        <div class="flex items-center gap-3">
                            <span class="text-xl bg-green-50 p-2 rounded group-hover:scale-110 group-hover:bg-green-100 transition-all duration-300">👥</span>
                            <div class="flex flex-col">
                                <span class="font-semibold text-gray-900">People Powered</span>
                                <span class="text-xs text-gray-500">By the community</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center py-4 px-4 hover:bg-gradient-to-b hover:from-gray-50 hover:to-white transition-all duration-300 group cursor-pointer">
                        <div class="flex items-center gap-3">
                            <span class="text-xl bg-blue-50 p-2 rounded group-hover:scale-110 group-hover:bg-blue-100 transition-all duration-300">💳</span>
                            <div class="flex flex-col">
                                <span class="font-semibold text-gray-900">PayPal Protection</span>
                                <span class="text-xs text-gray-500">Safe & secure</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center py-4 px-4 hover:bg-gradient-to-b hover:from-gray-50 hover:to-white transition-all duration-300 group cursor-pointer">
                        <div class="flex items-center gap-3">
                            <span class="text-xl bg-indigo-50 p-2 rounded group-hover:scale-110 group-hover:bg-indigo-100 transition-all duration-300">🚚</span>
                            <div class="flex flex-col">
                                <span class="font-semibold text-gray-900">Free Shipping</span>
                                <span class="text-xs text-gray-500">On all orders</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center py-4 px-4 hover:bg-gradient-to-b hover:from-gray-50 hover:to-white transition-all duration-300 group cursor-pointer">
                        <div class="flex items-center gap-3">
                            <span class="text-xl bg-purple-50 p-2 rounded group-hover:scale-110 group-hover:bg-purple-100 transition-all duration-300">🚫</span>
                            <div class="flex flex-col">
                                <span class="font-semibold text-gray-900">No Junk, No Jerks</span>
                                <span class="text-xs text-gray-500">Quality guaranteed</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-4 text-sm">
            <span class="text-green-600 hover:text-green-700 transition-colors">Swappa</span>
            <span class="text-gray-400 mx-2">/</span>
            <span class="hover:text-green-600 transition-colors">Mobile</span>
            <span class="text-gray-400 mx-2">/</span>
            <span class="text-gray-600">Phones</span>
        </div>

        <div class="space-y-12">
            <div class="text-center py-12 bg-gradient-to-b from-white to-gray-50">
                <h1 class="text-5xl font-bold mb-4 bg-gradient-to-r from-green-600 to-blue-600 inline-block text-transparent bg-clip-text">Phones For Sale</h1>
                <p class="text-gray-600 mb-8 text-lg">Best deals on cheap phones and used phones.</p>
                <div class="flex justify-center gap-6">
                    <button class="flex items-center gap-2 px-8 py-4 border-2 rounded-xl hover:bg-gray-50 transition-all hover:scale-105 hover:shadow-md">
                        <span class="text-green-600">🍎</span>
                        <span class="font-medium">iPhones</span>
                    </button>
                    <button class="flex items-center gap-2 px-8 py-4 border-2 rounded-xl hover:bg-gray-50 transition-all hover:scale-105 hover:shadow-md">
                        <span class="text-green-600">🤖</span>
                        <span class="font-medium">Android</span>
                    </button>
                    <button class="flex items-center gap-2 px-8 py-4 bg-green-600 text-white rounded-xl hover:bg-green-700 transition-all hover:scale-105 hover:shadow-md">
                        <span>💰</span>
                        <span class="font-medium"><Link :href="route('mobile-device.create')">Sell Phone</Link></span>
                    </button>
                </div>
            </div>

            <div class="space-y-20">
                <section>
                    <div class="text-center space-y-2 mb-8">
                        <h2 class="text-3xl font-bold bg-gradient-to-r from-green-600 to-blue-600 inline-block text-transparent bg-clip-text">Cheap Phones</h2>
                        <p class="text-gray-600">Swappa always has cheap cell phones on sale.</p>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                        <div class="bg-white rounded-2xl p-6 text-center transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border border-gray-100 group">
                            <div class="relative mb-6">
                                <img src="/iphone13.png" alt="iPhone 13" class="mx-auto h-36 group-hover:scale-110 transition-transform duration-300">
                                <span class="absolute top-0 right-0 bg-green-500 text-white text-xs px-2 py-1 rounded-full">-15%</span>
                            </div>
                            <h3 class="font-semibold text-lg mb-2">Apple iPhone 13</h3>
                            <div class="flex justify-center items-center gap-1 my-2">
                                <div class="flex gap-0.5 text-yellow-400">
                                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                </div>
                                <span class="text-sm text-gray-500">(243)</span>
                            </div>
                            <div class="space-y-1">
                                <p class="text-green-600 font-bold text-2xl">$269</p>
                                <p class="text-gray-400 text-sm line-through">$319</p>
                            </div>
                            <img src="/apple-icon.png" alt="Apple" class="h-5 mx-auto mt-4 opacity-70">
                        </div>
                    </div>
                </section>

                <div class="flex justify-center gap-6 mt-4">
                    <a href="#" class="px-4 py-2 rounded bg-gray-50 hover:bg-gray-100 text-gray-700 transition-colors">iPhone Guide</a>
                    <a href="#" class="px-4 py-2 rounded bg-green-50 hover:bg-green-100 text-green-700 transition-colors">Unlocked</a>
                    <a href="#" class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700 transition-colors">Shop iPhones →</a>
                </div>

                <section>
                    <h2 class="text-2xl font-bold text-center mb-6">{{ deviceConfig.iphone.title }}</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                        <div v-for="(device, index) in iphoneDevices"
                             :key="device.id"
                             class="bg-white border rounded p-4 text-center hover:shadow-sm transition-all duration-50 hover:-translate-y-1">
                            <img :src="getIphoneImage(device, index)"
                                 :alt="device.name"
                                 @error="(e) => e.target.src = deviceConfig.iphone.defaultImage"
                                 class="mx-auto mb-2 h-32 object-contain">
                            <h3 class="font-medium  text-gray-500 text-sm py-2">
                                {{ device.phone_brand.name }}
                                {{ device.name }}
                            </h3>
                            <Link :href="route('phone.variant.index', device.slug)">
                                <Button size="small" class="mt-3 text-xs" outlined>
                                    View listings
                                </Button>
                            </Link>
                        </div>
                    </div>
                    <div class="flex justify-center gap-4 mt-4">
                        <a href="#" class="text-blue-600 hover:underline">iPhone Guide</a>
                        <a href="#" class="text-green-600 hover:underline">Unlocked</a>
                        <a href="#" class="text-green-600 hover:underline">Shop iPhones →</a>
                    </div>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-center mb-6">{{ deviceConfig.samsung.title }}</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                        <div v-for="device in samsungDevices"
                             :key="device.id"
                             class="bg-white border rounded p-4 text-center hover:shadow-sm transition-all duration-50 hover:-translate-y-1">
                            <img :src="getDeviceImage(device, 'samsung')"
                                 :alt="device.name"
                                 @error="(e) => e.target.src = deviceConfig.samsung.defaultImage"
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
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-center mb-6">{{ deviceConfig.pixel.title }}</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                        <div v-for="device in pixelDevices"
                             :key="device.id"
                             class="bg-white border rounded p-4 text-center hover:shadow-sm transition-all duration-50 hover:-translate-y-1">
                            <img :src="getDeviceImage(device, 'pixel')"
                                 :alt="device.name"
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
                </section>
            </div>

            <div class="text-center py-12">
                <button class="bg-gradient-to-r from-green-600 to-green-500 text-white px-10 py-4 rounded-xl text-lg font-medium hover:shadow-lg hover:scale-105 transition-all">
                    Shop All Phones →
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import Default from '../../Layouts/Default.vue';
import Button from 'primevue/button';


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
    oneplus: {
        defaultImage: '/images/phones/oneplus-8.png',
        brandIcon: '/images/brands/oneplus-icon.png',
        title: 'OnePlus Phones'
    }
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
    switch(brand) {
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
.phone-card {
    @apply transition-all duration-300 hover:-translate-y-1 hover:shadow-xl;
}

/* Smooth transitions */
* {
    @apply transition-all duration-300;
}

/* Add smooth scrolling */
html {
    scroll-behavior: smooth;
}
</style>
