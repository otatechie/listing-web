<template>
    <div class="sidebar-selector h-full flex flex-col bg-white shadow-xl">
        <!-- Close button header -->
        <div class="p-4 border-b flex justify-between items-center bg-gray-50">
            <h2 class="text-lg font-medium text-gray-700">Menu</h2>
            <button @click="$emit('close')" class="p-2 rounded-full hover:bg-indigo-100 text-indigo-600 transition-colors">
                <span class="sr-only">Close sidebar</span>
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Navigation items -->
        <nav class="flex-1 overflow-y-auto py-2">
            <div class="px-2 space-y-2">
                <!-- Main navigation links -->
                <div class="space-y-1">
                    <template v-for="(item, index) in mainNavItems" :key="index">
                        <div v-if="item.type === 'divider'" class="h-px my-4 px-2">
                            <div class="h-full w-full bg-gray-300"></div>
                        </div>
                        <Link v-else
                              :href="item.href"
                              :class="[
                                  'flex items-center px-1.5 py-1.5 rounded-md group transition-all',
                                  item.name === 'Logout'
                                      ? 'text-red-600 hover:text-red-700'
                                      : 'text-gray-700 hover:text-indigo-600'
                              ]"
                              @click="$emit('close')">
                            <i :class="[
                                item.icon,
                                'text-xl mr-3 transition-colors',
                                item.name === 'Logout'
                                    ? 'text-red-400 group-hover:text-red-600'
                                    : 'text-gray-400 group-hover:text-indigo-600'
                            ]"></i>
                            {{ item.name }}
                        </Link>
                    </template>
                </div>
            </div>
        </nav>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

// Main navigation items
const mainNavItems = [
    // User Actions Group
    { name: 'Search', href: '/search', icon: 'pi pi-search' },
    { name: 'Help', href: '/help', icon: 'pi pi-question-circle' },
    { type: 'divider' },

    // Commerce Group
    { name: 'Sell', href: '/sell', icon: 'pi pi-dollar' },
    { name: 'Trade-In', href: '/trade-in', icon: 'pi pi-sync' },
    { type: 'divider' },

    // Community Group
    { name: 'Forums', href: '/forums', icon: 'pi pi-comments' },
    { type: 'divider' },

    // Product Categories
    { name: 'iPhones', href: '/iphones', icon: 'pi pi-apple' },
    { name: 'Mobile Phones', href: '/phones', icon: 'pi pi-mobile' },
    { name: 'Watches', href: '/watches', icon: 'pi pi-clock' },
    { name: 'Audio', href: '/audio', icon: 'pi pi-volume-up' },
    { type: 'divider' },

    // Logout
    { name: 'Logout', href: '/logout', icon: 'pi pi-sign-out' },
];

</script>
