<template>
    <div class="max-w-7xl md:w-full mx-auto">
        <h2 class="text-2xl font-heading font-semibold leading-7 text-gray-800 mb-5">Your favorites</h2>

        <!-- Simplified Filters -->
        <div class="bg-white rounded-lg p-4 shadow-sm">
            <div class="flex gap-4">
                <select v-model="selectedStorage" @change="applyFilters"
                    class="flex-1 px-4 py-2 border rounded-lg text-sm">
                    <option value="">Storage</option>
                    <option v-for="storage in storageOptions" :key="storage" :value="storage">
                        {{ storage >= 1000 ? `${storage / 1000}TB` : `${storage}GB` }}
                    </option>
                </select>
                <select v-model="selectedColor" @change="applyFilters"
                    class="flex-1 px-4 py-2 border rounded-lg text-sm">
                    <option value="">Color</option>
                    <option v-for="color in colorOptions" :key="color" :value="color" class="capitalize">
                        {{ color }}
                    </option>
                </select>
                <select v-model="selectedCondition" @change="applyFilters"
                    class="flex-1 px-4 py-2 border rounded-lg text-sm">
                    <option value="">Condition</option>
                    <option v-for="condition in conditionOptions" :key="condition" :value="condition">
                        {{ condition?.charAt(0).toUpperCase() + condition?.slice(1) || condition }}
                    </option>
                </select>
            </div>
        </div>

        <div class="overflow-hidden mt-8 container-border">
            <DataTable :value="mobileDevices" stripedRows v-model:filters="filters" :paginator="true" :rows="10"
                :loading="isLoading" striped class="p-datatable-sm hover:cursor-pointer [&_tr:hover]:bg-gray-50"
                scrollable scrollHeight="600px" sortMode="multiple" removableSort :rowsPerPageOptions="[10, 20, 30, 50]"
                dataKey="id" @row-click="handleRowClick">
                <!-- Add empty message template -->
                <template #empty>
                    <div class="flex flex-col items-center justify-center py-4">
                        <p class="text-gray-500 text-lg">Sorry, no listings found.</p>
                    </div>
                </template>

                <Column field="phone_model.model_number" header="Brand" sortable>
                    <template #body="{ data }">
                        <span class="text-gray-600 font-medium">{{ data.phone_brand?.name }} {{ data.phone_variant?.name
                            }}</span>
                    </template>
                </Column>

                <!-- Model (Technical info) -->
                <Column field="phone_model.model_number" header="Model" sortable>
                    <template #body="{ data }">
                        <span class="text-gray-600 font-medium">{{ data.phone_model?.model_number || 'N/A' }}</span>
                    </template>
                </Column>


                <!-- Price (Most important info first) -->
                <Column field="price" header="Price" sortable>
                    <template #body="{ data }">
                        <span class="font-bold text-gray-800 hover:cursor-pointer">${{ data.price }}</span>
                    </template>
                </Column>

                <!-- Condition (Important quality indicator) -->
                <Column field="condition" header="Condition" sortable>
                    <template #body="{ data }">
                        <span class="px-2 py-1 rounded-full text-sm font-medium capitalize" :class="{
                            'bg-green-50 text-green-700': data.condition.toLowerCase() === 'mint',
                            'bg-blue-50 text-blue-700': data.condition.toLowerCase() === 'good',
                            'bg-yellow-50 text-yellow-700': data.condition.toLowerCase() === 'fair'
                        }">
                            {{ data.condition }}
                        </span>
                    </template>
                </Column>

                <!-- Storage (Key spec) -->
                <Column field="storage_capacity" header="Storage" sortable>
                    <template #body="{ data }">
                        <span class="text-gray-700">
                            {{ data.storage_capacity }}{{ data.storage_capacity >= 1000 ? 'TB' : 'GB' }}
                        </span>
                    </template>
                </Column>

                <!-- Color (Visual spec) -->
                <Column field="color" header="Color" sortable>
                    <template #body="{ data }">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full" :style="{ backgroundColor: data.color.toLowerCase() }">
                            </div>
                            <span class="text-gray-600 capitalize">{{ data.color }}</span>
                        </div>
                    </template>
                </Column>

                <!-- Location (Secondary info) -->
                <Column field="listing_code" header="Reference code">
                    <template #body="{ data }">
                        <div class="flex items-center">
                            <span class="text-sm text-gray-600">{{ data.listing_code }}</span>
                        </div>
                    </template>
                </Column>

                <!-- Battery Health or RAM -->
                <Column :header="healthOrRamHeader" sortable>
                    <template #body="{ data }">
                        <div v-if="data.phone_brand?.name?.toLowerCase() === 'apple'" class="flex items-center gap-2">
                            <i class="pi pi-battery text-gray-400"></i>
                            <span class="text-sm font-medium" :class="{
                                'text-green-600': data.battery_health >= 90,
                                'text-yellow-600': data.battery_health >= 80 && data.battery_health < 90,
                                'text-red-600': data.battery_health < 80
                            }">
                                {{ data.battery_health }}%
                            </span>
                        </div>
                        <div v-else class="flex items-center gap-2">
                            <i class="pi pi-memory text-gray-400"></i>
                            <span class="text-sm font-medium text-gray-700">
                                {{ data.ram }}GB
                            </span>
                        </div>
                    </template>
                </Column>

                <template #footer>
                    <span class="text-gray-500 text-xs">Total devices: {{ mobileDevices.length }}</span>
                </template>
            </DataTable>
        </div>
    </div>
</template>

<script setup>
import Default from '../../Layouts/Default.vue';
import { ref, computed } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';
import { FilterMatchMode } from '@primevue/core/api';

const emit = defineEmits(['filter-changed']);

defineOptions({
    layout: Default,
});

const props = defineProps({
    favorites: {
        type: Array,
        required: true,
    },
    phone_brand: {
        type: Object,
    },
    phone_variant: {
        type: Object,
    }
});

// Add this after props definition
const mobileDevices = ref(props.favorites);

// Add filter states
const selectedStorage = ref('');
const selectedColor = ref('');
const selectedCondition = ref('');

// Compute unique options from mobileDevices
const storageOptions = computed(() => {
    const uniqueStorage = new Set(props.favorites.map(device => device.storage_capacity));
    return Array.from(uniqueStorage).sort((a, b) => a - b);
});

const conditionOptions = computed(() => {
    const uniqueConditions = new Set(props.favorites.map(device => device.condition));
    return Array.from(uniqueConditions).sort();
});

const colorOptions = computed(() => {
    const uniqueColors = new Set(props.favorites.map(device => device.color));
    return Array.from(uniqueColors).sort();
});

// Filter methods
const applyFilters = () => {
    emit('filter-changed', {
        storage: selectedStorage.value,
        color: selectedColor.value,
        condition: selectedCondition.value
    });
};

const clearFilters = () => {
    selectedStorage.value = '';
    selectedColor.value = '';
    selectedCondition.value = '';
    applyFilters();
};

// Add missing data
const isLoading = ref(false);
const filters = ref({
    price: { value: null, matchMode: FilterMatchMode.GREATER_THAN },
    carrier: { value: null, matchMode: FilterMatchMode.EQUALS },
    'phone_model.model_number': { value: null, matchMode: FilterMatchMode.EQUALS },
    color: { value: null, matchMode: FilterMatchMode.EQUALS },
    storage_capacity: { value: null, matchMode: FilterMatchMode.EQUALS },
    condition: { value: null, matchMode: FilterMatchMode.EQUALS }
});

const handleRowClick = (event) => {
    const deviceId = event.data.id;
    window.location.href = `/mobile-device/${deviceId}`;
};

// Computed property to determine the header text
const healthOrRamHeader = computed(() => {
    return props.favorites.some(device => device.phone_brand?.name?.toLowerCase() === 'apple') ? 'Health' : 'RAM';
});
</script>

<style scoped>
:deep(.p-datatable) :deep(.p-datatable-thead) :deep(th) {
    font-weight: 500 !important;
}
</style>
