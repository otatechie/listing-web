<template>

    <Head title="Users" />

    <slot>
        <h2 class="text-xl font-heading font-semibold leading-7 text-gray-800 ml-5 mb-5">Listings</h2>
        <div class="container-border-table mx-5" style="padding:0.5px">
            <DataTable :size="size.value" v-if="userListings" :value="userListings" class="text-xs" ref="dt"
                dataKey="id" v-model:selection="selectedListing" scrollable scrollHeight="600px" paginator :rows="10"
                :rowsPerPageOptions="[10, 20, 30, 50]" sortMode="multiple" removableSort stripedRows
                tableStyle="min-width: 50rem" :filters="filters">
                <template #empty>
                    <div class="flex flex-col items-center justify-center py-4">
                        <p class="text-gray-500 text-lg">No listings found.</p>
                    </div>
                </template>
                <template #header>
                    <div class="flex justify-between w-full">
                        <div>
                            <Button size="small" icon="pi pi-external-link" severity="secondary" label="Export" outlined
                                @click="exportCSV($event)" />
                        </div>
                        <div>
                            <IconField>
                                <InputIcon>
                                    <i class="pi pi-search" />
                                </InputIcon>
                                <InputText v-model="filters['global'].value" size="small" placeholder="Search" />
                            </IconField>
                        </div>
                    </div>
                </template>
                <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
                <Column field="listing_title" header="Title" sortable></Column>
                <Column field="price" header="Price" sortable>
                    <template #body="slotProps">
                        ${{ slotProps.data.price.toFixed(2) }}
                    </template>
                </Column>
                <Column field="condition" header="Condition" sortable>
                    <template #body="slotProps">
                        {{ slotProps.data.condition.charAt(0).toUpperCase() + slotProps.data.condition.slice(1) }}
                    </template>
                </Column>
                <Column field="is_active" header="Status" sortable>
                    <template #body="slotProps">
                        <span :class="slotProps.data.is_active ? 'text-green-600' : 'text-red-600'">
                            {{ slotProps.data.is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </template>
                </Column>
                <Column field="created_at" header="Created" sortable>
                    <template #body="slotProps">
                        {{ new Date(slotProps.data.created_at).toLocaleDateString() }}
                    </template>
                </Column>
                <template #footer> <span class="text-xs text-gray-500">In total there are {{ userListings ?
                    userListings.length : 0 }}
                     listings</span> </template>
            </DataTable>
        </div>

    </slot>

</template>

<script setup>
import { ref, watch, computed } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import Default from '../../Layouts/Default.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import { FilterMatchMode } from '@primevue/core/api';
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';


defineOptions({
    layout: Default,
})

const props = defineProps({
    userListings: {
        type: Array,
        required: true,
        default: () => []
    }
});

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

const selectedListing = ref();

const dt = ref();

const exportCSV = () => {
    dt.value.exportCSV();
};

const size = ref({ label: 'Normal', value: 'small' });
</script>
