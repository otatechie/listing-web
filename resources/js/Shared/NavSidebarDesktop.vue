<template>
    <div class="sidebar-selector h-full flex flex-col bg-white shadow-xl">
        <!-- Close button header -->
        <div class="p-4 border-b flex justify-between items-center">
            <h2 class="text-lg font-semibold">Menu</h2>
            <button @click="$emit('close')" class="text-gray-500 hover:text-gray-700">
                <span class="sr-only">Close sidebar</span>
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Navigation items -->
        <nav class="flex-1 overflow-y-auto">
            <div class="px-4 py-2 space-y-1">
                <!-- Main navigation links -->
                <Link v-for="(item, index) in mainNavItems"
                      :key="index"
                      :href="item.href"
                      class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-100"
                      @click="$emit('close')">
                    {{ item.name }}
                </Link>

                <!-- Categories section -->
                <div class="pt-4">
                    <h3 class="px-3 text-sm font-semibold text-gray-500 uppercase">Categories</h3>
                    <div class="mt-2 space-y-1">
                        <Link v-for="(category, index) in categories"
                              :key="index"
                              :href="category.href"
                              class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-100"
                              @click="$emit('close')">
                            {{ category.name }}
                        </Link>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

// Main navigation items
const mainNavItems = [
    { name: 'Home', href: '/' },
    { name: 'Buy', href: '/buy' },
    { name: 'Sell', href: '/sell' },
    { name: 'About', href: '/about' },
    { name: 'Contact', href: '/contact' },
];

// Categories
const categories = [
    { name: 'Phones', href: '/category/phones' },
    { name: 'Tablets', href: '/category/tablets' },
    { name: 'Laptops', href: '/category/laptops' },
    { name: 'Watches', href: '/category/watches' },
    { name: 'Accessories', href: '/category/accessories' },
    // Add more categories as needed
];
</script>
