<template>
    <header class="sticky inset-0 z-50 border-b border-slate-100 bg-white">
        <nav class="mx-auto flex max-w-6xl gap-8 px-6 transition-all duration-200 ease-in-out">
            <div class="relative flex items-center">
                <Link :href="route('public.welcome')">
                <img src="/images/afropulse-logo.svg" alt="Afropulse logo" class="h-12 w-auto">
                </Link>
            </div>
            <ul class="hidden items-center justify-center gap-6 md:flex">
                <li class="pt-1.5 font-dm text-sm font-medium text-slate-700">
                    <Link :href="route('public.welcome')">Home</Link>
                </li>
                <li class="pt-1.5 font-dm text-sm font-medium text-slate-700">
                    <Link href="#">Library</Link>
                </li>
                <li class="pt-1.5 font-dm text-sm font-medium text-slate-700">
                    <Link href="#">For Producers</Link>
                </li>
            </ul>
            <div class="flex-grow"></div>
            <div class="hidden items-center justify-center gap-6 md:flex">
                <!-- Debug this section -->
                <template v-if="!page.props.auth">
                    <Link :href="route('login')" class="text-sm font-medium text-slate-700">Sign in</Link>
                    <Link :href="route('register')"
                        class="px-4 py-2 text-sm font-medium text-gray-800 underline font-heading">
                    Sign up for free
                    </Link>
                </template>

                <template v-else>
                    <Link href="#" class="text-sm font-medium text-gray-800 underline font-heading">
                    Try Producer Pro
                    </Link>
                    <Link :href="route('beat.create')"
                        class="text-sm font-medium hover:text-gray-800 transition-colors text-gray-700">
                    Upload
                    </Link>
                    <button type="button"
                        class="relative p-2 text-gray-700 hover:text-gray-800 rounded-full hover:bg-gray-100 transition-colors">
                        <span class="sr-only">View notifications</span>
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>

                    </button>
                </template>
            </div>

            <div class="flex items-center gap-4">
                <div class="relative" ref="menuWrapper" v-if="page.props.auth">
                    <button type="button"
                        class="relative flex max-w-xs items-center rounded-full bg-white text-sm lg:rounded-md lg:p-2 hover:bg-gray-50 transition-colors"
                        id="user-menu-button"
                        :aria-expanded="menuOpen.toString()"
                        aria-haspopup="true"
                        @click="toggleMenu">
                        <img class="h-6 w-6 rounded-full" :src="avatarUrl" alt="User Avatar" />
                        <svg class="ml-1 hidden h-5 w-5 flex-shrink-0 text-gray-400 lg:block" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div v-show="menuOpen"
                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        <Link :href="route('user.index')" @click="closeMenu"
                            class="px-4 py-1.5 text-sm text-gray-700 flex items-center hover:text-cyan-600" role="menuitem"
                            tabindex="-1" id="user-menu-item-0">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                        </svg>
                        Your account
                        </Link>
                        <Link :href="route('profile.index')" @click="closeMenu"
                            class="px-4 py-1.5 text-sm text-gray-700 flex items-center hover:text-cyan-600" role="menuitem"
                            tabindex="-1" id="user-menu-item-0">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Your profile
                        </Link>
                        <div class="border-t border-gray-200 w-10/12 mx-auto"></div>
                        <Link :href="route('user.two.factor')" @click="closeMenu"
                            class="px-4 py-1.5 text-sm text-gray-700 flex items-center hover:text-cyan-600" role="menuitem"
                            tabindex="-1" id="user-menu-item-0">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Security
                        </Link>
                        <div class="border-t border-gray-200 w-10/12 mx-auto"></div>
                        <Link :href="route('user.index')" @click="closeMenu"
                            class="px-4 py-1.5 text-sm text-gray-700 flex items-center hover:text-cyan-600" role="menuitem"
                            tabindex="-1" id="user-menu-item-0">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                        </svg>
                        Your saved beats
                        </Link>
                        <Link :href="route('beats.followers')" @click="closeMenu"
                            class="px-4 py-1.5 text-sm text-gray-700 flex items-center hover:text-cyan-600" role="menuitem"
                            tabindex="-1" id="user-menu-item-0">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        Your favorites
                        </Link>
                        <div class="border-t border-gray-200 w-10/12 mx-auto"></div>
                        <Link :href="route('profile.index')" @click="closeMenu"
                            class="px-4 py-1.5 text-sm text-gray-700 flex items-center hover:text-cyan-600" role="menuitem"
                            tabindex="-1" id="user-menu-item-0">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                        </svg>
                        Earnings & Payouts
                        </Link>
                        <div class="border-t border-gray-200 w-10/12 mx-auto"></div>
                        <Link :href="route('admin.setting.index')" @click="closeMenu"
                            class="px-4 py-1.5 text-sm text-gray-700 flex items-center hover:text-cyan-600" role="menuitem"
                            tabindex="-1" id="user-menu-item-1">

                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Settings
                        </Link>
                        <div class="border-t border-gray-200 w-10/12 mx-auto"></div>
                        <Link :href="route('logout')" method="post" as="button" @click="closeMenu"
                            class="w-full text-left font-medium px-4 py-1.5 text-sm text-red-500 flex items-center"
                            role="menuitem" tabindex="-1" id="user-menu-item-2">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                        </Link>
                    </div>
                </div>

                <button type="button" @click="mobileMenuOpen = true" class="md:hidden pl-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true" class="h-6 w-auto text-slate-900">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5">
                        </path>
                    </svg>
                </button>
            </div>
        </nav>
    </header>

    <div class="fixed bottom-0 left-0 right-0 z-50">
        <GlobalAudioPlayer />
    </div>

    <!-- Add mobile menu -->
    <div
        v-show="mobileMenuOpen"
        class="fixed inset-0 z-50 bg-white md:hidden transition-all duration-300 ease-in-out"
        :class="[mobileMenuOpen ? 'opacity-100' : 'opacity-0 pointer-events-none']"
    >
        <div class="flex h-full flex-col">
            <!-- Mobile menu header -->
            <div class="flex items-center justify-between px-6 py-4 border-b">
                <Link :href="route('public.welcome')">
                <img src="/images/afropulse-logo.svg" alt="Afropulse logo" class="h-12 w-auto">
                </Link>
                <button type="button" @click="mobileMenuOpen = false">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Mobile menu items -->
            <nav class="flex-1 px-6 py-8">
                <ul class="space-y-4">
                    <li>
                        <Link :href="route('public.welcome')" @click="mobileMenuOpen = false"
                            class="text-lg font-medium text-slate-700">Home</Link>
                    </li>
                    <li>
                        <Link href="#" @click="mobileMenuOpen = false" class="text-lg font-medium text-slate-700">
                        Library
                        </Link>
                    </li>
                    <li>
                        <Link href="#" @click="mobileMenuOpen = false" class="text-lg font-medium text-slate-700">For
                        Artists</Link>
                    </li>
                </ul>

                <div class="mt-12 space-y-4">
                    <template v-if="!page.props.auth">
                        <Link :href="route('login')" class="block w-full text-center font-medium text-slate-700">
                        Sign in
                        </Link>
                        <Link :href="route('register')"
                            class="block w-full rounded-md bg-gradient-to-br from-green-600 to-emerald-400 px-3 py-2 text-center font-medium text-white shadow-md shadow-green-400/50">
                        Sign up for free
                        </Link>
                    </template>
                    <template v-else>
                        <Link :href="route('user.index')" @click="mobileMenuOpen = false"
                            class="block w-full text-center font-medium text-slate-700">
                        Your Account
                        </Link>
                        <Link :href="route('logout')" method="post" as="button" @click="mobileMenuOpen = false"
                            class="block w-full text-center font-medium text-red-500">
                        Logout
                        </Link>
                    </template>
                </div>
            </nav>
        </div>
    </div>

    <slot></slot>

    <Footer />

</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { ref, onMounted, onUnmounted, computed } from 'vue'
import Footer from '../Shared/Public/Footer.vue'
import Logo from '../Shared/Logo.vue'
import GlobalAudioPlayer from '@/Components/GlobalAudioPlayer.vue'
import { useAudioStore } from '@/Stores/audioStore'
import Button from 'primevue/button'

const page = usePage()
const audioStore = useAudioStore()

// Menu states
const mobileMenuOpen = ref(false)
const menuOpen = ref(false)
const menuWrapper = ref(null)

const toggleMenu = () => {
    menuOpen.value = !menuOpen.value
    if (menuOpen.value) {
        document.addEventListener('click', handleClickOutside)
    }
}

const closeMenu = () => {
    menuOpen.value = false
}

const handleClickOutside = (event) => {
    if (menuWrapper.value && !menuWrapper.value.contains(event.target)) {
        closeMenu()
    }
}

onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside)
})

const user = computed(() => {
    return page.props.auth || null
})

const isAuthenticated = computed(() => {
    return !!page.props.auth?.name
})

const avatarUrl = computed(() => {
    if (!user.value?.name) return ''
    return `https://api.dicebear.com/9.x/initials/svg?seed=${encodeURIComponent(user.value.name)}&backgroundType=gradientLinear&scale=100&fontSize=50`
})
</script>
