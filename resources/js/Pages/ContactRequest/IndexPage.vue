<template>
    <div class="max-w-7xl md:w-full mx-auto">
        <h2 class="text-2xl font-heading font-semibold leading-7 text-gray-800 mb-5">Your Contact Requests</h2>

        <div class="overflow-hidden mt-8 container-border">
            <DataTable :value="contactRequests.data" stripedRows v-model:filters="filters" :paginator="true"
                :rows="contactRequests.per_page" :totalRecords="contactRequests.total" :loading="isLoading" striped
                class="p-datatable-sm hover:cursor-pointer [&_tr:hover]:bg-gray-50" scrollable scrollHeight="600px"
                sortMode="multiple" removableSort :rowsPerPageOptions="[10, 20, 30, 50]" dataKey="id"
                @row-click="handleRowClick">
                <!-- Add search header -->
                <template #header>
                    <div class="flex justify-end">
                        <span class="p-input-icon-left">
                            <i class="pi pi-search" />
                            <InputText v-model="filters['global'].value" placeholder="Search..." class="p-inputtext-sm" />
                        </span>
                    </div>
                </template>

                <!-- Add empty message template -->
                <template #empty>
                    <div class="flex flex-col items-center justify-center py-4">
                        <p class="text-gray-500 text-lg">Sorry, no contact requests found.</p>
                    </div>
                </template>

                <Column field="mobile_device.phone_model.model_number" header="Device" sortable>
                    <template #body="{ data }">
                        <span class="text-gray-600">
                            {{ data.mobile_device?.phone_brand?.name }} {{ data.mobile_device?.phone_variant?.name }}
                        </span>
                    </template>
                </Column>

                <Column field="status" header="Status" sortable>
                    <template #body="{ data }">
                        <span class="px-2 py-1 rounded-full text-sm font-medium capitalize" :class="{
                            'bg-yellow-50 text-yellow-700': data.status === 'pending',
                            'bg-green-50 text-green-700': data.status === 'approved',
                            'bg-red-50 text-red-700': data.status === 'rejected'
                        }">
                            {{ data.status }}
                        </span>
                    </template>
                </Column>

                <Column field="buyer.name" header="Buyer" sortable>
                    <template #body="{ data }">
                        <span class="text-gray-600">{{ data.buyer?.name }}</span>
                    </template>
                </Column>

                <Column field="seller.name" header="Seller" sortable>
                    <template #body="{ data }">
                        <span class="text-gray-600">{{ data.seller?.name }}</span>
                    </template>
                </Column>

                <Column field="approved_at" header="Approved" sortable>
                    <template #body="{ data }">
                        <span class="text-gray-600">
                            {{ data.approved_at ? new Date(data.approved_at).toLocaleDateString() : '-' }}
                        </span>
                    </template>
                </Column>

                <Column field="rejected_at" header="Rejected" sortable>
                    <template #body="{ data }">
                        <span class="text-gray-600">
                            {{ data.rejected_at ? new Date(data.rejected_at).toLocaleDateString() : '-' }}
                        </span>
                    </template>
                </Column>

                <Column field="created_at" header="Created" sortable>
                    <template #body="{ data }">
                        <span class="text-gray-600">{{ data.created_at_formatted }}</span>
                    </template>
                </Column>

                <template #footer>
                    <span class="text-gray-500 text-xs">Total devices: {{ contactRequests.length }}</span>
                </template>
            </DataTable>
        </div>
    </div>
</template>

<script setup>
import Default from '../../Layouts/Default.vue';
import { ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';
import { FilterMatchMode } from '@primevue/core/api';
import InputText from 'primevue/inputtext';

const emit = defineEmits(['filter-changed']);

defineOptions({
    layout: Default,
});

const props = defineProps({
    contactRequests: {
        type: Object,
        required: true,
    },
});

const isLoading = ref(false);
const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    status: { value: null, matchMode: FilterMatchMode.EQUALS },
    'mobile_device.phone_model.model_number': { value: null, matchMode: FilterMatchMode.EQUALS },
});

const handleRowClick = (event) => {
    const requestId = event.data.id;
    window.location.href = `/contact-request/${requestId}`;
};
</script>

<style scoped>
:deep(.p-datatable) :deep(.p-datatable-thead) :deep(th) {
    font-weight: 500 !important;
}
</style>
