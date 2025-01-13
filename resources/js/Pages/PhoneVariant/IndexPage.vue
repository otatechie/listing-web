<template>
    <div class="max-w-7xl md:w-full mx-auto p-4 space-y-6">
        <!-- Simplified Header -->
        <div class="bg-white rounded-lg p-6 shadow-sm">
            <div class="flex items-center gap-6">
                <div class="w-24 h-24 bg-gray-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-mobile-alt text-3xl text-gray-400"></i>
                </div>
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-gray-800">{{ mobileDevices[0].phone_brand.name }} {{ mobileDevices[0].phone_variant.name }}</h1>
                    <div class="flex items-center gap-4 mt-3">
                        <span class="text-2xl font-bold text-green-600">$259</span>
                        <span class="text-sm text-gray-500">Starting price</span>
                    </div>
                    <div class="flex mt-4 gap-8">
                        <button class="text-sm font-medium text-gray-700 hover:text-gray-900 flex items-center gap-2">
                            <i class="fas fa-book"></i>
                            Buyer Guide
                        </button>
                        <button class="text-sm font-medium text-gray-700 hover:text-gray-900 flex items-center gap-2">
                            <i class="fas fa-chart-line"></i>
                            Price Trends
                        </button>
                        <button class="text-sm font-medium text-gray-700 hover:text-gray-900 flex items-center gap-2">
                            <i class="fas fa-history"></i>
                            Recent Sales
                        </button>
                        <button class="text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center gap-2">
                            <i class="fas fa-bell"></i>
                            Subscribe
                        </button>
                        <button class="text-sm font-medium text-green-600 hover:text-green-700 flex items-center gap-2">
                            <i class="fas fa-tag"></i>
                            Sell This
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Simplified Filters -->
        <div class="bg-white rounded-lg p-4 shadow-sm">
            <div class="flex gap-4">
                <select v-model="selectedStorage"
                        @change="applyFilters"
                        class="flex-1 px-4 py-2 border rounded-lg text-sm">
                    <option value="">Storage</option>
                    <option v-for="storage in storageOptions"
                            :key="storage"
                            :value="storage">
                        {{ storage >= 1000 ? `${storage/1000}TB` : `${storage}GB` }}
                    </option>
                </select>
                <select v-model="selectedColor"
                        @change="applyFilters"
                        class="flex-1 px-4 py-2 border rounded-lg text-sm">
                    <option value="">Color</option>
                    <option v-for="color in colorOptions"
                            :key="color"
                            :value="color"
                            class="flex items-center">
                        <span class="capitalize">{{ color }}</span>
                    </option>
                </select>
                <select v-model="selectedCondition"
                        @change="applyFilters"
                        class="flex-1 px-4 py-2 border rounded-lg text-sm">
                    <option value="">Condition</option>
                    <option v-for="condition in conditionOptions"
                            :key="condition"
                            :value="condition">
                        {{ condition.charAt(0).toUpperCase() + condition.slice(1) }}
                    </option>
                </select>
            </div>
        </div>

        <!-- Simplified Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <DataTable :value="mobileDevices" stripedRows
                       v-model:filters="filters"
                       :paginator="true"
                       :rows="10"
                       :loading="isLoading"
                       striped
                       class="p-datatable-sm hover:cursor-pointer [&_tr:hover]:bg-gray-50"
                       scrollable
                       scrollHeight="600px"
                       sortMode="multiple"
                       removableSort
                       :rowsPerPageOptions="[10, 20, 30, 50]"
                       dataKey="id"
                       @row-click="handleRowClick">

                <!-- Price (Most important info first) -->
                <Column field="price"
                        header="Price"
                        sortable>
                    <template #body="{ data }">
                        <span class="font-bold text-gray-900 hover:cursor-pointer">${{ data.price }}</span>
                    </template>
                </Column>

                <!-- Condition (Important quality indicator) -->
                <Column field="condition"
                        header="Condition"
                        sortable>
                    <template #body="{ data }">
                        <span class="px-3 py-1.5 rounded-full text-sm font-medium capitalize"
                              :class="{
                                  'bg-green-50 text-green-700': data.condition === 'Mint',
                                  'bg-blue-50 text-blue-700': data.condition === 'Good',
                                  'bg-yellow-50 text-yellow-700': data.condition === 'Fair'
                              }">
                            {{ data.condition }}
                        </span>
                    </template>
                </Column>

                <!-- Storage (Key spec) -->
                <Column field="storage_capacity"
                        header="Storage"
                        sortable>
                    <template #body="{ data }">
                        <span class="text-gray-700">
                            {{ data.storage_capacity }}{{ data.storage_capacity >= 1000 ? 'TB' : 'GB' }}
                        </span>
                    </template>
                </Column>

                <!-- Color (Visual spec) -->
                <Column field="color"
                        header="Color"
                        sortable>
                    <template #body="{ data }">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full"
                                 :style="{ backgroundColor: data.color.toLowerCase() }">
                            </div>
                            <span class="text-gray-700 capitalize">{{ data.color }}</span>
                        </div>
                    </template>
                </Column>

                <!-- Carrier (Network info) -->
                <Column field="carrier"
                        header="Carrier"
                        sortable>
                    <template #body="{ data }">
                        <span class="text-gray-700 font-medium">{{ data.carrier }}</span>
                    </template>
                </Column>

                <!-- Model (Technical info) -->
                <Column field="phone_model.model_number"
                        header="Model"
                        sortable>
                    <template #body="{ data }">
                        <span class="text-gray-700 font-medium">{{ data.phone_model?.model_number || 'N/A' }}</span>
                    </template>
                </Column>

                <!-- Seller (Secondary info) -->
                <Column field="user.username"
                        header="Seller"
                        sortable>
                    <template #body="{ data }">
                        <div class="flex items-center hover:cursor-pointer">
                            <i class="fas fa-user text-gray-400"></i>
                            <span class="text-gray-700">{{ data.user?.name || 'Anonymous' }}</span>
                        </div>
                    </template>
                </Column>

                <!-- Location (Secondary info) -->
                <Column field="location"
                        header="Location">
                    <template #body="{ data }">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-map-marker-alt text-gray-400"></i>
                            <span class="text-sm text-gray-600">{{ data.location }}</span>
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
    mobileDevices: {
        type: Array,
        required: true,
        default: () => []
    },
    selectedmobileDevice: {
        type: String,
        default: ''
    }
});

// Add filter states
const selectedStorage = ref('');
const selectedColor = ref('');
const selectedCondition = ref('');

// Compute unique options from mobileDevices
const storageOptions = computed(() => {
    const uniqueStorage = new Set(props.mobileDevices.map(device => device.storage_capacity));
    return Array.from(uniqueStorage).sort((a, b) => a - b);
});

const conditionOptions = computed(() => {
    const uniqueConditions = new Set(props.mobileDevices.map(device => device.condition));
    return Array.from(uniqueConditions).sort();
});

const colorOptions = computed(() => {
    const uniqueColors = new Set(props.mobileDevices.map(device => device.color));
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
</script>

<style scoped>
:deep(.p-datatable) :deep(.p-datatable-thead) :deep(th) {
    font-weight: 500 !important;
}
</style>
