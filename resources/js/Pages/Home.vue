<template>

    <Head title="Home" />

    <slot>

        <div class="lg:mx-auto lg:max-w-7xl">
            <!-- Main Container -->
            <div class="max-w-7xl mx-auto px-4">
                <!-- Hero Section -->
                <div class="text-center mb-16 py-16 bg-gradient-to-b from-indigo-50 to-white rounded-2xl">
                    <h1 class="text-5xl md:text-6xl font-bold text-gray-800 mb-8">
                        Buy + Sell + <span class="text-indigo-600 relative">
                            Save
                            <span class="absolute -bottom-2 left-0 w-full h-2 bg-indigo-200/60 -rotate-2"></span>
                        </span>
                    </h1>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto mb-4">
                        Ghana's smartest way to trade phones, laptops, and more
                    </p>
                    <p class="text-lg text-indigo-600 font-semibold mb-8">
                        With confidence
                    </p>
                    <div class="flex justify-center gap-4">
                        <Button class="primary" label="Post Your Ad">
                        </Button>
                        <Button severity="secondary" label="Find Great Deals">
                        </Button>
                    </div>
                </div>

                <!-- Trust Features -->
                <div class="mb-20">
                    <h2 class="text-3xl font-bold text-center mb-16">The Smart Way to Trade</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3">
                        <!-- Feature 1 -->
                        <div class="relative group overflow-hidden">
                            <div class="aspect-[3/4]">
                                <img
                                    src="https://images.unsplash.com/photo-1580048915913-4f8f5cb481c4?q=80&w=800&auto=format&fit=crop"
                                    alt="Save Money"
                                    class="w-full h-full object-cover brightness-[0.85] group-hover:scale-105 transition-transform duration-500"
                                />
                            </div>
                            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-b from-black/20 to-black/60 p-8 flex flex-col justify-between">
                                <div>
                                    <span class="px-4 py-2 bg-white/90 rounded-full text-sm font-medium">
                                        Save Money
                                    </span>
                                </div>
                                <div class="text-white">
                                    <h3 class="text-2xl font-semibold mb-3">
                                        Find Amazing Deals
                                    </h3>
                                    <p class="text-white/80 text-sm mb-4">
                                        Find amazing deals on quality items from trusted sellers across Ghana
                                    </p>
                                    <Button severity="secondary" class="text-white" label="Get help now →" size="small">
                                    </Button>
                                </div>
                            </div>
                        </div>

                        <!-- Feature 2 -->
                        <div class="relative group overflow-hidden">
                            <div class="aspect-[3/4]">
                                <img
                                    src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=800&auto=format&fit=crop"
                                    alt="Quick & Easy"
                                    class="w-full h-full object-cover brightness-[0.85] group-hover:scale-105 transition-transform duration-500"
                                />
                            </div>
                            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-b from-black/20 to-black/60 p-8 flex flex-col justify-between">
                                <div>
                                    <span class="px-4 py-2 bg-white/90 rounded-full text-sm font-medium">
                                        Quick & Easy
                                    </span>
                                </div>
                                <div class="text-white">
                                    <h3 class="text-2xl font-semibold mb-3">
                                        List in Minutes
                                    </h3>
                                    <p class="text-white/80 text-sm mb-4">
                                        List your items in minutes and connect with buyers instantly
                                    </p>
                                    <Button severity="secondary" label="Get help now →" size="small">
                                    </Button>
                                </div>
                            </div>
                        </div>

                        <!-- Feature 3 -->
                        <div class="relative group overflow-hidden">
                            <div class="aspect-[3/4]">
                                <img
                                    src="https://images.unsplash.com/photo-1560472355-536de3962603?q=80&w=800&auto=format&fit=crop"
                                    alt="Trade Safely"
                                    class="w-full h-full object-cover brightness-[0.85] group-hover:scale-105 transition-transform duration-500"
                                />
                            </div>
                            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-b from-black/20 to-black/60 p-8 flex flex-col justify-between">
                                <div>
                                    <span class="px-4 py-2 bg-white/90 rounded-full text-sm font-medium">
                                        Trade Safely
                                    </span>
                                </div>
                                <div class="text-white">
                                    <h3 class="text-2xl font-semibold mb-3">
                                        Secure Trading
                                    </h3>
                                    <p class="text-white/80 text-sm mb-4">
                                        Every transaction is protected with our secure trading system
                                    </p>
                                    <Button severity="secondary" label="Get help now →" size="small">
                                    </Button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Popular Categories -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-center mb-12">Popular Categories</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        <div class="bg-white p-8 rounded shadow-sm hover:shadow-md transition">
                            <div class="bg-indigo-50 rounded p-6 mb-6">
                                <img src="/icons/phones.svg" alt="Phones" class="w-16 h-16 mx-auto"/>
                            </div>
                            <h3 class="text-center font-semibold">Phones</h3>
                            <p class="text-center text-gray-600 text-sm">1,234+ ads</p>
                        </div>
                        <div class="bg-white p-8 rounded shadow-sm hover:shadow-md transition">
                            <div class="bg-indigo-50 rounded p-6 mb-6">
                                <img src="/icons/laptops.svg" alt="Laptops" class="w-16 h-16 mx-auto"/>
                            </div>
                            <h3 class="text-center font-semibold">Laptops</h3>
                            <p class="text-center text-gray-600 text-sm">890+ ads</p>
                        </div>
                        <div class="bg-white p-8 rounded shadow-sm hover:shadow-md transition">
                            <div class="bg-indigo-50 rounded p-6 mb-6">
                                <img src="/icons/tablets.svg" alt="Tablets" class="w-16 h-16 mx-auto"/>
                            </div>
                            <h3 class="text-center font-semibold">Tablets</h3>
                            <p class="text-center text-gray-600 text-sm">567+ ads</p>
                        </div>
                        <div class="bg-white p-8 rounded shadow-sm hover:shadow-md transition">
                            <div class="bg-indigo-50 rounded p-6 mb-6">
                                <img src="/icons/accessories.svg" alt="Accessories" class="w-16 h-16 mx-auto"/>
                            </div>
                            <h3 class="text-center font-semibold">Accessories</h3>
                            <p class="text-center text-gray-600 text-sm">2,345+ ads</p>
                        </div>
                    </div>
                </div>

                <!-- How It Works - Redesigned with modern flow -->
                <div class="mb-20 py-16">
                    <h2 class="text-3xl font-bold text-center mb-16">How It Works</h2>
                    <div class="relative">
                        <!-- Connecting Line -->
                        <div class="hidden md:block absolute top-1/2 left-0 w-full h-1 bg-indigo-100 -translate-y-1/2 z-0"></div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative z-10">
                            <!-- Step 1 -->
                            <div class="relative group">
                                <div class="bg-white p-8 rounded shadow-sm hover:shadow-md transition-all duration-300">
                                    <div class="flex flex-col items-center">
                                        <div class="bg-indigo-600 w-16 h-16 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                            <span class="text-2xl font-bold text-white">1</span>
                                        </div>
                                        <h3 class="text-xl font-semibold mb-4">Create Your Ad</h3>
                                        <p class="text-gray-600 text-center">Post your item in minutes with our easy-to-use form. Add photos and details to attract buyers.</p>
                                        <div class="mt-6 flex justify-center">
                                            <svg class="w-12 h-12 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 2 -->
                            <div class="relative group">
                                <div class="bg-white p-8 rounded shadow-sm hover:shadow-md transition-all duration-300">
                                    <div class="flex flex-col items-center">
                                        <div class="bg-indigo-600 w-16 h-16 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                            <span class="text-2xl font-bold text-white">2</span>
                                        </div>
                                        <h3 class="text-xl font-semibold mb-4">Connect with Buyers</h3>
                                        <p class="text-gray-600 text-center">Chat securely with verified buyers through our messaging system. Negotiate with confidence.</p>
                                        <div class="mt-6 flex justify-center">
                                            <svg class="w-12 h-12 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 3 -->
                            <div class="relative group">
                                <div class="bg-white p-8 rounded shadow-sm hover:shadow-md transition-all duration-300">
                                    <div class="flex flex-col items-center">
                                        <div class="bg-indigo-600 w-16 h-16 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                            <span class="text-2xl font-bold text-white">3</span>
                                        </div>
                                        <h3 class="text-xl font-semibold mb-4">Complete the Deal</h3>
                                        <p class="text-gray-600 text-center">Meet safely and complete your transaction. Rate your experience to help build trust.</p>
                                        <div class="mt-6 flex justify-center">
                                            <svg class="w-12 h-12 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Call to Action -->
                    <div class="mt-12 text-center">
                        <Button severity="primary" label="Start Selling Now" icon="pi pi-chevron-right" iconPos="right">
                        </Button>
                    </div>
                </div>

                <!-- MAcbooks Listings -->
                <div class="mb-20">
                    <div class="flex justify-between items-center mb-10">
                        <h2 class="text-3xl font-bold">Macbooks & Laptops</h2>
                        <a href="#" class="text-indigo-600 hover:text-indigo-700 font-medium flex items-center">
                            View all
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <!-- Phone Card 1 -->
                        <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <img src="/sample/phone1.jpg" alt="iPhone" class="w-full h-56 object-cover rounded-t-2xl"/>
                            <div class="p-6">
                                <h3 class="font-semibold text-lg mb-2">iPhone 14 Pro Max</h3>
                                <p class="text-indigo-600 font-bold text-xl">GH₵ 8,500</p>
                                <p class="text-gray-500 text-sm mt-3">Posted 2 days ago</p>
                            </div>
                        </div>

                        <!-- Phone Card 2 -->
                        <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <img src="/sample/phone2.jpg" alt="Samsung" class="w-full h-56 object-cover rounded-t-2xl"/>
                            <div class="p-6">
                                <h3 class="font-semibold text-lg mb-2">Samsung S23 Ultra</h3>
                                <p class="text-indigo-600 font-bold text-xl">GH₵ 7,800</p>
                                <p class="text-gray-500 text-sm mt-3">Posted 1 day ago</p>
                            </div>
                        </div>

                        <!-- Laptop Card 1 -->
                        <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <img src="/sample/macbook.jpg" alt="MacBook" class="w-full h-56 object-cover rounded-t-2xl"/>
                            <div class="p-6">
                                <h3 class="font-semibold text-lg mb-2">MacBook Pro M2</h3>
                                <p class="text-indigo-600 font-bold text-xl">GH₵ 12,500</p>
                                <p class="text-gray-500 text-sm mt-3">Posted 3 days ago</p>
                            </div>
                        </div>

                        <!-- Laptop Card 2 -->
                        <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <img src="/sample/laptop.jpg" alt="Dell XPS" class="w-full h-56 object-cover rounded-t-2xl"/>
                            <div class="p-6">
                                <h3 class="font-semibold text-lg mb-2">Dell XPS 15</h3>
                                <p class="text-indigo-600 font-bold text-xl">GH₵ 9,200</p>
                                <p class="text-gray-500 text-sm mt-3">Posted 4 days ago</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-16">
                    <div class="flex justify-between items-center mb-8">
                        <h2 class="text-3xl font-bold">Phones & Iphones</h2>
                        <a href="#" class="text-indigo-600 hover:text-indigo-700">View all →</a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <!-- Phone Card 1 -->
                        <div class="bg-white rounded shadow-sm hover:shadow-md transition">
                            <img src="/sample/phone1.jpg" alt="iPhone" class="w-full h-48 object-cover rounded-t-xl"/>
                            <div class="p-4">
                                <h3 class="font-semibold mb-2">iPhone 14 Pro Max</h3>
                                <p class="text-indigo-600 font-bold">GH₵ 8,500</p>
                                <p class="text-gray-600 text-sm mt-2">Posted 2 days ago</p>
                            </div>
                        </div>

                        <!-- Phone Card 2 -->
                        <div class="bg-white rounded shadow-sm hover:shadow-md transition">
                            <img src="/sample/phone2.jpg" alt="Samsung" class="w-full h-48 object-cover rounded-t-xl"/>
                            <div class="p-4">
                                <h3 class="font-semibold mb-2">Samsung S23 Ultra</h3>
                                <p class="text-indigo-600 font-bold">GH₵ 7,800</p>
                                <p class="text-gray-600 text-sm mt-2">Posted 1 day ago</p>
                            </div>
                        </div>

                        <!-- Laptop Card 1 -->
                        <div class="bg-white rounded shadow-sm hover:shadow-md transition">
                            <img src="/sample/macbook.jpg" alt="MacBook" class="w-full h-48 object-cover rounded-t-xl"/>
                            <div class="p-4">
                                <h3 class="font-semibold mb-2">MacBook Pro M2</h3>
                                <p class="text-indigo-600 font-bold">GH₵ 12,500</p>
                                <p class="text-gray-600 text-sm mt-2">Posted 3 days ago</p>
                            </div>
                        </div>

                        <!-- Laptop Card 2 -->
                        <div class="bg-white rounded shadow-sm hover:shadow-md transition">
                            <img src="/sample/laptop.jpg" alt="Dell XPS" class="w-full h-48 object-cover rounded-t-xl"/>
                            <div class="p-4">
                                <h3 class="font-semibold mb-2">Dell XPS 15</h3>
                                <p class="text-indigo-600 font-bold">GH₵ 9,200</p>
                                <p class="text-gray-600 text-sm mt-2">Posted 4 days ago</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Community Section -->
                <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 rounded-2xl p-12 mb-20 text-white">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                        <div>
                            <h2 class="text-3xl font-bold mb-4">Join Our Growing Community</h2>
                            <p class="mb-6">Connect with thousands of trusted buyers and sellers across Ghana.</p>
                            <ul class="space-y-4">
                                <li class="flex items-center">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <!-- Checkmark icon -->
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Verified user profiles
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Direct messaging system
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Quick response times
                                </li>
                            </ul>
                        </div>
                        <div class="flex justify-center">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-white p-4 rounded-lg text-gray-800">
                                    <p class="text-3xl font-bold text-indigo-600">5k+</p>
                                    <p class="text-sm">Active Users</p>
                                </div>
                                <div class="bg-white p-4 rounded-lg text-gray-800">
                                    <p class="text-3xl font-bold text-indigo-600">1k+</p>
                                    <p class="text-sm">Daily Listings</p>
                                </div>
                                <div class="bg-white p-4 rounded-lg text-gray-800">
                                    <p class="text-3xl font-bold text-indigo-600">98%</p>
                                    <p class="text-sm">Success Rate</p>
                                </div>
                                <div class="bg-white p-4 rounded-lg text-gray-800">
                                    <p class="text-3xl font-bold text-indigo-600">24/7</p>
                                    <p class="text-sm">Support</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Safety Tips -->
                <div class="mb-16">
                    <h2 class="text-3xl font-bold text-center mb-8">Stay Safe While Trading</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Safe Meeting -->
                        <div class="bg-white p-6 rounded shadow-sm hover:shadow-md transition">
                            <div class="bg-emerald-50 p-4 rounded-full w-16 h-16 flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-lg mb-2">Meet Safely</h3>
                            <p class="text-gray-600">Choose public places like malls or coffee shops. Avoid private locations and meeting after dark.</p>
                        </div>

                        <!-- Verify Identity -->
                        <div class="bg-white p-6 rounded shadow-sm hover:shadow-md transition">
                            <div class="bg-blue-50 p-4 rounded-full w-16 h-16 flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-lg mb-2">Verify First</h3>
                            <p class="text-gray-600">Check seller profiles, ratings, and reviews. Be wary of deals that seem too good to be true.</p>
                        </div>

                        <!-- Secure Payment -->
                        <div class="bg-white p-6 rounded shadow-sm hover:shadow-md transition">
                            <div class="bg-purple-50 p-4 rounded-full w-16 h-16 flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-lg mb-2">Secure Payments</h3>
                            <p class="text-gray-600">Use secure payment methods. Test electronics and verify items before making payment.</p>
                        </div>

                        <!-- Report Issues -->
                        <div class="bg-white p-6 rounded shadow-sm hover:shadow-md transition">
                            <div class="bg-amber-50 p-4 rounded-full w-16 h-16 flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-lg mb-2">Report Problems</h3>
                            <p class="text-gray-600">Report suspicious behavior immediately. Our support team is here to help 24/7.</p>
                        </div>
                    </div>

                    <!-- Safety Call-to-Action -->
                    <div class="mt-8 text-center">
                        <a href="#" class="inline-flex items-center text-gray-700 link-hover font-medium underline">
                            Learn more about safe trading
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </slot>

</template>

<script setup>
import { Head, usePage } from '@inertiajs/vue3'
import { computed, ref, onMounted } from 'vue'
import Default from '../Layouts/Default.vue'
import Button from 'primevue/button'

defineProps({

})

defineOptions({
    layout: Default
})

const page = usePage()

</script>

<style>
/* Add any additional styling if needed */
</style>
