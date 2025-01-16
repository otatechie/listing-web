<template>
    <div class="relative">
        <button
            @click="toggleSearch"
            class="md:hidden text-gray-400 hover:text-gray-600 transition"
            aria-label="Toggle search"
        >
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" />
            </svg>
        </button>

        <Transition
            enter-active-class="transition duration-100 ease-out"
            enter-from-class="transform scale-95 opacity-0"
            enter-to-class="transform scale-100 opacity-100"
            leave-active-class="transition duration-75 ease-in"
            leave-from-class="transform scale-100 opacity-100"
            leave-to-class="transform scale-95 opacity-0"
        >
            <form
                v-show="isOpen"
                @submit.prevent="handleSearch"
                class="absolute md:relative right-0 top-full md:top-0 mt-2 md:mt-0 z-50"
                v-click-outside="closeSearch"
            >
                <div class="relative w-60 md:w-80 lg:w-96">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" />
                        </svg>
                    </span>
                    <input
                        v-model="query"
                        type="search"
                        placeholder="Search..."
                        class="w-full rounded-md border-gray-200 pl-10 text-sm focus:border-primary-500 focus:ring-primary-500 bg-white shadow-sm"
                        @keydown.esc="closeSearch"
                        ref="searchInput"
                    >
                </div>
            </form>
        </Transition>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const query = ref('')
const isOpen = ref(false)
const searchInput = ref(null)

const toggleSearch = () => {
    isOpen.value = !isOpen.value
    if (isOpen.value) {
        // Focus input after opening
        nextTick(() => searchInput.value?.focus())
    }
}

const closeSearch = () => {
    isOpen.value = false
    query.value = ''
}

const handleSearch = () => {
    if (!query.value.trim()) return
    console.log('Searching for:', query.value)
    closeSearch()
}
</script>
