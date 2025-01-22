<template>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Search Form -->
        <form @submit.prevent="submit" class="mb-6 space-y-4">
            <div>
                <input v-model="form.search" type="text" placeholder="Search devices..."
                    class="w-full rounded-lg border px-4 py-2">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <select v-model="form.device_type" class="rounded-lg border px-4 py-2">
                    <option value="">Device Type</option>
                    <option value="smartphone">Smartphone</option>
                    <option value="tablet">Tablet</option>
                </select>

                <select v-model="form.condition" class="rounded-lg border px-4 py-2">
                    <option value="">Condition</option>
                    <option value="new">New</option>
                    <option value="like_new">Like New</option>
                    <option value="good">Good</option>
                    <option value="fair">Fair</option>
                </select>

                <input v-model="form.min_price" type="number" placeholder="Min Price"
                    class="rounded-lg border px-4 py-2">

                <input v-model="form.max_price" type="number" placeholder="Max Price"
                    class="rounded-lg border px-4 py-2">
            </div>
        </form>

        <!-- Results -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <div v-for="device in devices.data" :key="device.id" class="border rounded-lg p-4 shadow-sm">
                <img v-if="device.thumb_url" :src="device.thumb_url" :alt="device.listing_title"
                    class="w-full h-48 object-cover rounded-lg mb-4">
                <h3 class="font-semibold text-lg">{{ device.listing_title }}</h3>
                <p class="text-gray-600">{{ device.brand }} {{ device.model }}</p>
                <p class="font-bold text-lg mt-2">${{ formatPrice(device.price) }}</p>
                <div class="mt-2 flex gap-2">
                    <span class="text-sm px-2 py-1 bg-gray-100 rounded-full">{{ device.condition }}</span>
                    <span class="text-sm px-2 py-1 bg-gray-100 rounded-full">{{ device.storage_capacity }}GB</span>
                </div>
            </div>

            <div v-if="devices.data.length === 0" class="col-span-full text-center py-12">
                <p class="text-gray-500">No devices found matching your criteria.</p>
            </div>
        </div>

        <!-- Pagination -->
        <Pagination :links="devices.links" class="mt-6" />
    </div>
</template>

<script setup>
import { ref, watch } from 'vue'
import { router } from '@inertiajs/vue3'
import debounce from 'lodash/debounce'
import Pagination from '@/Components/Pagination.vue'

const props = defineProps({
    devices: Object,
    filters: Object
})

const form = ref({
    search: props.filters.search || '',
    device_type: props.filters.device_type || '',
    condition: props.filters.condition || '',
    min_price: props.filters.min_price || '',
    max_price: props.filters.max_price || ''
})

const submit = debounce(() => {
    router.get(route('devices.search'), form.value, {
        preserveState: true,
        preserveScroll: true,
        replace: true
    })
}, 300)

watch(form.value, submit)

const formatPrice = (price) => {
    return new Intl.NumberFormat('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(price)
}
</script>
