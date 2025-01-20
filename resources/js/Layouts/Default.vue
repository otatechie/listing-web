<template>
    <div class="min-h-full">
        <!-- Main header -->
        <div class="bg-indigo-900 fixed w-full top-0 z-50">
            <div class="flex items-center h-16 px-4 sm:px-6">
                <!-- Logo and hamburger section -->
                <div class="flex items-center gap-4">
                    <!-- Hamburger menu -->

                    <!-- Logo -->
                    <Link href="/" class="text-white text-xl font-bold">
                    Your Logo
                    </Link>
                    <button type="button" class="text-white hover:text-gray-200" @click="toggleSidebar"
                        data-menu-button>
                        <span class="sr-only">Open sidebar</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>

                <!-- Search bar -->
                <div class="flex-1 px-4">
                    <NavSearch></NavSearch>
                </div>

                <!-- Right side icons -->
                <div class="flex items-center gap-4">
                    <button type="button" class="text-white hover:text-gray-200" title="Help">
                        <span class="sr-only">Help</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                        </svg>
                    </button>

                    <!-- Profile/Login section -->
                    <NavProfile v-if="user" :user="user"></NavProfile>
                    <Link v-else href="/login" class="text-white hover:text-gray-200 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                         viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                        <path fill-rule="evenodd"
                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                    </svg>
                    Login
                    </Link>

                </div>
            </div>
        </div>


        <!-- Main content -->
        <div class="bg-gray-50 pb-8 mt-16">
            <div class="bg-gray-100 text-gray-800 py-3 border-b border-gray-200">
                <div class="container mx-auto flex justify-center space-x-6">
                    <!-- iPhones Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center space-x-1 text-sm font-medium">
                            <span>iPhones</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div
                            class="absolute left-0 mt-2 w-40 bg-white text-black rounded shadow-lg hidden group-hover:block">
                            <a href="#" class="block px-4 py-2 hover:bg-gray-200">Option 1</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-200">Option 2</a>
                        </div>
                    </div>

                    <!-- Phones Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center space-x-1 text-sm font-medium">
                            <span>Phones</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div
                            class="absolute left-0 mt-2 w-40 bg-white text-black rounded shadow-lg hidden group-hover:block">
                            <a href="#" class="block px-4 py-2 hover:bg-gray-200">Option 1</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-200">Option 2</a>
                        </div>
                    </div>

                    <!-- Watches Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center space-x-1 text-sm font-medium">
                            <span>Watches</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div
                            class="absolute left-0 mt-2 w-40 bg-white text-black rounded shadow-lg hidden group-hover:block">
                            <a href="#" class="block px-4 py-2 hover:bg-gray-200">Option 1</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-200">Option 2</a>
                        </div>
                    </div>

                    <!-- Tablets Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center space-x-1 text-sm font-medium">
                            <span>Tablets</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div
                            class="absolute left-0 mt-2 w-40 bg-white text-black rounded shadow-lg hidden group-hover:block">
                            <a href="#" class="block px-4 py-2 hover:bg-gray-200">Option 1</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-200">Option 2</a>
                        </div>
                    </div>

                    <!-- Laptops Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center space-x-1 text-sm font-medium">
                            <span>Laptops</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div
                            class="absolute left-0 mt-2 w-40 bg-white text-black rounded shadow-lg hidden group-hover:block">
                            <a href="#" class="block px-4 py-2 hover:bg-gray-200">Option 1</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-200">Option 2</a>
                        </div>
                    </div>

                    <!-- Audio Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center space-x-1 text-sm font-medium">
                            <span>Audio</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div
                            class="absolute left-0 mt-2 w-40 bg-white text-black rounded shadow-lg hidden group-hover:block">
                            <a href="#" class="block px-4 py-2 hover:bg-gray-200">Option 1</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-200">Option 2</a>
                        </div>
                    </div>

                    <!-- Sell Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center space-x-1 text-sm font-medium">
                            <span>Sell</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div
                            class="absolute left-0 mt-2 w-40 bg-white text-black rounded shadow-lg hidden group-hover:block">
                            <a href="#" class="block px-4 py-2 hover:bg-gray-200">iPhone</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-200">Phones</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-200">Laptop</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-200">MacBook</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-200">Watch</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-200">Sneakers</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-200">Audio</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-200">Video Gaming</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-200">Trade-In</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-200">Sell Used Tech</a>
                        </div>
                    </div>
                </div>
            </div>
            <main class="min-h-screen mt-12">
                <FlashMessage></FlashMessage>
                <slot></slot>
            </main>
        </div>

        <!-- Sidebar overlay -->
        <div v-if="isSidebarOpen" class="fixed inset-0 bg-indigo-900 bg-opacity-60 transition-opacity z-40"
            @click="closeSidebar">
        </div>

        <!-- Sidebar -->
        <NavSidebarDesktop data-sidebar :class="[
            'fixed left-0 top-0 z-50 h-full w-64 transform bg-white transition-transform duration-300 ease-in-out',
            isSidebarOpen ? 'translate-x-0' : '-translate-x-full'
        ]" @close="closeSidebar"></NavSidebarDesktop>

        <!-- Footer -->
        <footer class="relative bg-gradient-to-b from-indigo-900 to-indigo-950 text-gray-300 py-12 overflow-hidden">
            <div class="absolute inset-0 opacity-5">
                <div class="absolute inset-0"
                    style="background-image: url('data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
                </div>
            </div>

            <div class="container mx-auto px-4 max-w-7xl relative">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 gap-x-6 gap-y-6 mb-8">
                    <div class="backdrop-blur-sm p-4 rounded-lg bg-indigo-800/30">
                        <h3 class="mb-6 text-md font-medium text-white tracking-wide flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            Buy
                        </h3>
                        <ul class="space-y-3 text-sm">
                            <li><a href="#" class="text-white underline link-hover">Buyer Guides</a></li>
                            <li><a href="#" class="text-white underline link-hover">Buy Phones</a></li>
                            <li><a href="#" class="text-white underline link-hover">Buy Tablets</a></li>
                            <li><a href="#" class="text-white underline link-hover">Buy MacBooks</a></li>
                            <li><a href="#" class="text-white underline link-hover">Buy Laptops</a></li>
                            <li><a href="#" class="text-white underline link-hover">Buy iPhones</a></li>
                            <li><a href="#" class="text-white underline link-hover">Buy Apple</a></li>
                            <li><a href="#" class="text-white underline link-hover">Unlocked Phones</a></li>
                        </ul>
                    </div>

                    <div class="backdrop-blur-sm p-4 rounded-lg bg-indigo-800/30">
                        <h3 class="mb-6 text-md font-medium text-white tracking-wide flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                            Categories
                        </h3>
                        <ul class="space-y-3 text-sm">
                            <li><a href="#" class="text-white underline link-hover">Sneakers</a></li>
                            <li><a href="#" class="text-white underline link-hover">Watches</a></li>
                            <li><a href="#" class="text-white underline link-hover">Cameras + Lenses</a></li>
                            <li><a href="#" class="text-white underline link-hover">Home Tech</a></li>
                            <li><a href="#" class="text-white underline link-hover">AirPods + Audio</a></li>
                            <li><a href="#" class="text-white underline link-hover">Drones + DJI</a></li>
                            <li><a href="#" class="text-white underline link-hover">Fitness + Cycling</a></li>
                            <li><a href="#" class="text-white underline link-hover">Video Games</a></li>
                        </ul>
                    </div>

                    <div class="backdrop-blur-sm p-4 rounded-lg bg-indigo-800/30">
                        <h3 class="mb-6 text-md font-medium text-white tracking-wide flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Sell
                        </h3>
                        <ul class="space-y-3 text-sm">
                            <li><a href="#" class="text-white underline link-hover">Trade-In</a></li>
                            <li><a href="#" class="text-white underline link-hover">Sell iPhones</a></li>
                            <li><a href="#" class="text-white underline link-hover">Sell Phone</a></li>
                            <li><a href="#" class="text-white underline link-hover">Sell Tablet</a></li>
                            <li><a href="#" class="text-white underline link-hover">Sell Watch</a></li>
                            <li><a href="#" class="text-white underline link-hover">Sell Laptop</a></li>
                            <li><a href="#" class="text-white underline link-hover">Sell Sneakers</a></li>
                            <li><a href="#" class="text-white underline link-hover">Sell Apple</a></li>
                        </ul>
                    </div>

                    <div class="backdrop-blur-sm p-4 rounded-lg bg-indigo-800/30">
                        <h3 class="mb-6 text-md font-medium text-white tracking-wide flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Help
                        </h3>
                        <ul class="space-y-3 text-sm">
                            <li><a href="#" class="text-white underline link-hover">FAQs</a></li>
                            <li><a href="#" class="text-white underline link-hover">Search</a></li>
                            <li><a href="#" class="text-white underline link-hover">ADA Accessibility</a></li>
                            <li><a href="#" class="text-white underline link-hover">Sustainability</a></li>
                            <li><a href="#" class="text-white underline link-hover">Prices</a></li>
                            <li><a href="#" class="text-white underline link-hover">Fees</a></li>
                            <li><a href="#" class="text-white underline link-hover">Returns + Refunds</a></li>
                        </ul>
                    </div>
                </div>
                <div class="p-4">
                    <div class="text-xs text-center flex flex-wrap justify-center gap-6">
                        <a href="#" class="text-white underline link-hover">Blog</a>
                        <a href="#" class="text-white underline link-hover">Forums</a>
                        <a href="#" class="text-white underline link-hover">Contact Us</a>
                        <a href="#" class="text-white underline link-hover">Product Request</a>
                        <a href="#" class="text-white underline link-hover">Press</a>
                        <a href="#" class="text-white underline link-hover">Policies</a>
                        <a href="#" class="text-white underline link-hover">Terms of Use</a>
                    </div>
                </div>

                <div class="border-t border-indigo-700/50 pt-6">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                        <div class="flex items-center space-x-6">
                            <a href="#" class="text-gray-400 hover:text-indigo-400">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="text-gray-400 hover:text-indigo-400 transition-all duration-300 transform hover:scale-110 hover:-translate-y-1 underline">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="text-gray-400 hover:text-indigo-400 transition-all duration-300 transform hover:scale-110 hover:-translate-y-1 underline">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="text-gray-400 hover:text-indigo-400 transition-all duration-300 transform hover:scale-110 hover:-translate-y-1 underline">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="text-gray-400 hover:text-indigo-400 transition-all duration-300 transform hover:scale-110 hover:-translate-y-1 underline">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12.53.02C13.84 0 15.14.01 16.44 0c.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                                </svg>
                            </a>
                        </div>
                        <div
                            class="text-xs font-medium text-gray-500 hover:text-gray-400 transition-colors duration-200">
                            Copyright © 2010-2025 Swappa, LLC
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup>
import { ref, computed, onUnmounted } from 'vue';
import { usePage } from '@inertiajs/vue3';
import NavSidebarDesktop from '../Shared/NavSidebarDesktop.vue';
import NavProfile from '../Shared/NavProfile.vue';
import NavSearch from '../Shared/NavSearch.vue';
import FlashMessage from '../Shared/FlashMessage.vue';

const page = usePage();
const user = computed(() => page.props.auth?.user);

const isSidebarOpen = ref(false);

const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
    if (isSidebarOpen.value) {
        document.addEventListener('click', handleClickAway);
    }
};

const closeSidebar = () => {
    isSidebarOpen.value = false;
    document.removeEventListener('click', handleClickAway);
};

const handleClickAway = (event) => {
    const sidebar = document.querySelector('[data-sidebar]');
    const menuButton = document.querySelector('[data-menu-button]');

    if (!sidebar || !menuButton) return;

    if (!sidebar.contains(event.target) && !menuButton.contains(event.target)) {
        closeSidebar();
    }
};

onUnmounted(() => {
    document.removeEventListener('click', handleClickAway);
});
</script>
