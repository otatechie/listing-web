<template>

    <Head title="Audits" />

    <slot>
        <div class="px-5">
            <div class="container-border">
                <div class="m-4">
                    <h2 class="text-xl font-heading font-semibold leading-7 text-gray-800 mb-5">Activity</h2>
                    <DataTable :size="size.value" v-if="audits && audits.length > 0" :value="audits" class="text-xs"
                        ref="dt" dataKey="id" v-model:selection="selectedAudit" scrollable scrollHeight="600px"
                        paginator :rows="10" :rowsPerPageOptions="[10, 20, 30, 50]" sortMode="multiple" removableSort
                        stripedRows tableStyle="min-width: 50rem" :filters="filters">
                        <template #header>
                            <div style="text-align: left">
                                <Button size="small" icon="pi pi-external-link" severity="contrast" label="Export"
                                    @click="exportCSV($event)" />
                            </div>
                            <div class="flex justify-end">
                                <IconField>
                                    <InputIcon>
                                        <i class="pi pi-search" />
                                    </InputIcon>
                                    <InputText v-model="filters['global'].value" size="small" placeholder="Search" />
                                </IconField>
                            </div>
                        </template>
                        <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
                        <Column field="event" header="Event">
                            <template #body="{ data }">
                                <span :class="[
                                    'px-1.5 py-1 text-xs font-medium rounded-sm',
                                    {
                                        'bg-green-100 text-green-800': data.event === 'created',
                                        'bg-blue-100 text-blue-800': data.event === 'updated',
                                        'bg-red-100 text-red-800': data.event === 'deleted',
                                    }
                                ]">
                                    {{ data.event }}
                                </span>
                            </template>
                        </Column>
                        <Column field="auditable_type" header="Auditable model"></Column>
                        <Column field="name" header="User">
                            <template #body="slotProps">
                                {{ slotProps.data.name || 'System' }}
                            </template>
                        </Column>
                        <Column field="email" header="Email">
                            <template #body="slotProps">
                                {{ slotProps.data.email || 'System' }}
                            </template>
                        </Column>
                        <Column field="browser" header="Browser, OS"></Column>
                        <Column field="created_at" header="Created"></Column>
                        <template #footer> <span class="text-xs text-gray-500">In total there are {{ audits ?
                            audits.length : 0 }}
                                audits</span> </template>
                    </DataTable>

                    <div v-else class="w-full md:w-9/12 mx-auto ">
                        <Message severity="secondary" icon="pi pi-send" class="p-2">Bummer, apparently no
                            records found.
                        </Message>
                    </div>
                </div>
            </div>
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
import Message from 'primevue/message';

defineOptions({
    layout: Default,
})

const props = defineProps({
    audits: {
        type: Object,
        required: true
    }
});

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

const selectedAudit = ref();

const dt = ref();

const exportCSV = () => {
    dt.value.exportCSV();
};

const size = ref({ label: 'Normal', value: 'small' });
</script>
