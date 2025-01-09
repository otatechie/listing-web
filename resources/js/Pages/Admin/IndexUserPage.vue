<template>

    <Head title="Users" />

    <slot>

        <div class="px-5">
            <div class="container-border">
                <div class="m-4">
                    <h2 class="text-xl font-heading font-semibold leading-7 text-gray-800 mb-5">Audits</h2>
                    <DataTable :size="size.value" v-if="users && users.length > 0" :value="users" class="text-xs"
                        ref="dt" dataKey="id" v-model:selection="selectedUser" scrollable scrollHeight="600px" paginator
                        :rows="10" :rowsPerPageOptions="[10, 20, 30, 50]" sortMode="multiple" removableSort stripedRows
                        tableStyle="min-width: 50rem" :filters="filters">
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
                        <Column field="created_at" header="Created"></Column>
                        <template #footer> <span class="text-xs text-gray-500">In total there are {{ users ?
                            users.length : 0 }}
                                users</span> </template>
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
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';
import TabPanels from 'primevue/tabpanels';
import TabPanel from 'primevue/tabpanel';

defineOptions({
    layout: Default,
})

const props = defineProps({
    users: {
        type: Object,
        required: true
    }
});

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

const selectedUser = ref();

const dt = ref();

const exportCSV = () => {
    dt.value.exportCSV();
};

const size = ref({ label: 'Normal', value: 'small' });
</script>
