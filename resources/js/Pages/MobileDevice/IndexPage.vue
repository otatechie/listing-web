<template>
    <div class="max-w-7xl mx-auto px-4">
        <!-- Top Banner -->
        <div class="bg-white border-b">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-4 divide-x divide-gray-100">
                    <div class="flex items-center justify-center py-4 px-4 hover:bg-gradient-to-b hover:from-gray-50 hover:to-white transition-all duration-300 group cursor-pointer">
                        <div class="flex items-center gap-3">
                            <span class="text-xl bg-green-50 p-2 rounded-lg group-hover:scale-110 group-hover:bg-green-100 transition-all duration-300">👥</span>
                            <div class="flex flex-col">
                                <span class="font-semibold text-gray-900">People Powered</span>
                                <span class="text-xs text-gray-500">By the community</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center py-4 px-4 hover:bg-gradient-to-b hover:from-gray-50 hover:to-white transition-all duration-300 group cursor-pointer">
                        <div class="flex items-center gap-3">
                            <span class="text-xl bg-blue-50 p-2 rounded-lg group-hover:scale-110 group-hover:bg-blue-100 transition-all duration-300">💳</span>
                            <div class="flex flex-col">
                                <span class="font-semibold text-gray-900">PayPal Protection</span>
                                <span class="text-xs text-gray-500">Safe & secure</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center py-4 px-4 hover:bg-gradient-to-b hover:from-gray-50 hover:to-white transition-all duration-300 group cursor-pointer">
                        <div class="flex items-center gap-3">
                            <span class="text-xl bg-indigo-50 p-2 rounded-lg group-hover:scale-110 group-hover:bg-indigo-100 transition-all duration-300">🚚</span>
                            <div class="flex flex-col">
                                <span class="font-semibold text-gray-900">Free Shipping</span>
                                <span class="text-xs text-gray-500">On all orders</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center py-4 px-4 hover:bg-gradient-to-b hover:from-gray-50 hover:to-white transition-all duration-300 group cursor-pointer">
                        <div class="flex items-center gap-3">
                            <span class="text-xl bg-purple-50 p-2 rounded-lg group-hover:scale-110 group-hover:bg-purple-100 transition-all duration-300">🚫</span>
                            <div class="flex flex-col">
                                <span class="font-semibold text-gray-900">No Junk, No Jerks</span>
                                <span class="text-xs text-gray-500">Quality guaranteed</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Breadcrumb -->
        <div class="py-4 text-sm">
            <span class="text-green-600 hover:text-green-700 transition-colors">Swappa</span>
            <span class="text-gray-400 mx-2">/</span>
            <span class="hover:text-green-600 transition-colors">Mobile</span>
            <span class="text-gray-400 mx-2">/</span>
            <span class="text-gray-600">Phones</span>
        </div>

        <!-- Main Content -->
        <div class="space-y-12">
            <!-- Header -->
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
                        <span class="font-medium">Sell Phone</span>
                    </button>
                </div>
            </div>

            <!-- Phone Categories -->
            <div class="space-y-20">
                <!-- Cheap Phones Section -->
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
                        <!-- More phone cards... -->
                    </div>
                </section>

                <!-- Section links updated style -->
                <div class="flex justify-center gap-6 mt-4">
                    <a href="#" class="px-4 py-2 rounded-lg bg-gray-50 hover:bg-gray-100 text-gray-700 transition-colors">iPhone Guide</a>
                    <a href="#" class="px-4 py-2 rounded-lg bg-green-50 hover:bg-green-100 text-green-700 transition-colors">Unlocked</a>
                    <a href="#" class="px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700 transition-colors">Shop iPhones →</a>
                </div>

                <!-- iPhones Section -->
                <section>
                    <h2 class="text-2xl font-bold text-center mb-6">iPhones</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                        <div class="bg-white border rounded-lg p-4 text-center">
                            <img src="/iphone13.png" alt="iPhone 13" class="mx-auto mb-2 h-32">
                            <h3 class="font-medium">Apple iPhone 13</h3>
                            <div class="flex justify-center my-1">
                                <span class="text-yellow-400">★★★★★</span>
                            </div>
                            <p class="text-green-600 font-bold">$269</p>
                            <img src="/apple-icon.png" alt="Apple" class="h-4 mx-auto mt-1">
                        </div>
                        <div class="bg-white border rounded-lg p-4 text-center">
                            <img src="/iphone12.png" alt="iPhone 12" class="mx-auto mb-2 h-32">
                            <h3 class="font-medium">Apple iPhone 12</h3>
                            <div class="flex justify-center my-1">
                                <span class="text-yellow-400">★★★★★</span>
                            </div>
                            <p class="text-green-600 font-bold">$159</p>
                            <img src="/apple-icon.png" alt="Apple" class="h-4 mx-auto mt-1">
                        </div>
                        <!-- Add more iPhone cards -->
                    </div>
                    <div class="flex justify-center gap-4 mt-4">
                        <a href="#" class="text-blue-600 hover:underline">iPhone Guide</a>
                        <a href="#" class="text-green-600 hover:underline">Unlocked</a>
                        <a href="#" class="text-green-600 hover:underline">Shop iPhones →</a>
                    </div>
                </section>

                <!-- Samsung Phones Section -->
                <section class="mt-12">
                    <h2 class="text-2xl font-bold text-center mb-6">Samsung Phones</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                        <div class="bg-white border rounded-lg p-4 text-center">
                            <img src="/s24-ultra.png" alt="Samsung Galaxy S24 Ultra" class="mx-auto mb-2 h-32">
                            <h3 class="font-medium">Samsung Galaxy S24 Ultra</h3>
                            <div class="flex justify-center my-1">
                                <span class="text-yellow-400">★★★★★</span>
                            </div>
                            <p class="text-green-600 font-bold">$618</p>
                            <img src="/samsung-icon.png" alt="Samsung" class="h-4 mx-auto mt-1">
                        </div>
                        <!-- Add more Samsung phone cards -->
                    </div>
                    <div class="flex justify-center gap-4 mt-4">
                        <a href="#" class="text-green-600 hover:underline">Unlocked</a>
                        <a href="#" class="text-green-600 hover:underline">Shop Samsung Phones →</a>
                    </div>
                </section>

                <!-- Google Pixels Section -->
                <section class="mt-12">
                    <h2 class="text-2xl font-bold text-center mb-6">Google Pixels</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                        <div class="bg-white border rounded-lg p-4 text-center">
                            <img src="/pixel-6.png" alt="Google Pixel 6" class="mx-auto mb-2 h-32">
                            <h3 class="font-medium">Google Pixel 6</h3>
                            <div class="flex justify-center my-1">
                                <span class="text-yellow-400">★★★★★</span>
                            </div>
                            <p class="text-green-600 font-bold">$121</p>
                            <img src="/google-icon.png" alt="Google" class="h-4 mx-auto mt-1">
                        </div>
                        <!-- Add more Pixel phone cards -->
                    </div>
                    <div class="flex justify-center gap-4 mt-4">
                        <a href="#" class="text-blue-600 hover:underline">Pixel Guide</a>
                        <a href="#" class="text-green-600 hover:underline">Unlocked</a>
                        <a href="#" class="text-green-600 hover:underline">Shop Pixel Phones →</a>
                    </div>
                </section>

                <!-- OnePlus Phones Section -->
                <section class="mt-12">
                    <h2 class="text-2xl font-bold text-center mb-6">OnePlus Phones</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                        <div class="bg-white border rounded-lg p-4 text-center">
                            <img src="/oneplus-8.png" alt="OnePlus 8" class="mx-auto mb-2 h-32">
                            <h3 class="font-medium">OnePlus 8</h3>
                            <div class="flex justify-center my-1">
                                <span class="text-yellow-400">★★★★★</span>
                            </div>
                            <p class="text-green-600 font-bold">$125</p>
                            <img src="/oneplus-icon.png" alt="OnePlus" class="h-4 mx-auto mt-1">
                        </div>
                        <!-- Add more OnePlus phone cards -->
                    </div>
                    <div class="flex justify-center gap-4 mt-4">
                        <a href="#" class="text-green-600 hover:underline">Unlocked</a>
                        <a href="#" class="text-green-600 hover:underline">Shop OnePlus →</a>
                    </div>
                </section>

                <!-- Quick Links -->
                <div class="flex justify-center gap-4">
                    <a href="#" class="text-green-600 hover:underline flex items-center gap-1">
                        <span>🍎</span> Apple Phones
                    </a>
                    <a href="#" class="text-green-600 hover:underline flex items-center gap-1">
                        <span>📱</span> Samsung Phones
                    </a>
                    <a href="#" class="text-green-600 hover:underline flex items-center gap-1">
                        <span>🔍</span> Google Pixels
                    </a>
                    <a href="#" class="text-green-600 hover:underline flex items-center gap-1">
                        <span>📱</span> OnePlus Phones
                    </a>
                </div>

                <!-- Similar sections for iPhones, Samsung, Google Pixels, OnePlus... -->
            </div>

            <!-- Final Shop All Phones Button -->
            <div class="text-center py-12">
                <button class="bg-gradient-to-r from-green-600 to-green-500 text-white px-10 py-4 rounded-xl text-lg font-medium hover:shadow-lg hover:scale-105 transition-all">
                    Shop All Phones →
                </button>
            </div>
        </div>
    </div>
</template>

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
