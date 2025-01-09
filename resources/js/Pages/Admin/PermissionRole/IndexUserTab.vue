<template>

    <Head title="Users" />

    <slot>
        <DataTable :size="size.value" v-model:filters="filters" v-if="users && users.length > 0" :value="users"
            class="text-xs" ref="dt" dataKey="id" v-model:selection="selectedUsers" scrollable scrollHeight="600px"
            paginator :rows="10" :rowsPerPageOptions="[10, 20, 30, 50]" sortMode="multiple" removableSort stripedRows
            tableStyle="min-width: 50rem">
            <template #header>
                <div class="flex flex-wrap items-center justify-between gap-2 mb-5">
                    <span class="text-xl font-heading"></span>
                    <Link :href="route('home')">
                    <Button icon="pi pi-plus" rounded title="Add User" />
                    </Link>
                </div>
                <div style="text-align: left">
                    <Button size="small" icon="pi pi-external-link" severity="contrast" label="Export" @click="exportCSVc($event)" />
                </div>
                <div class="flex justify-end">
                    <IconField>
                        <InputIcon>
                            <i class="pi pi-search" />
                        </InputIcon>
                        <InputText size="small" v-model="filters['global'].value" placeholder="Search" />
                    </IconField>
                </div>
            </template>
            <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
            <Column field="name" sortable header="Name"></Column>
            <Column field="email" sortable header="Email"></Column>
            <Column field="created_at" header="Joined"></Column>
            <Column header="Actions" :exportable="false" style="min-width:8rem">
                <template #body="slotProps">
                    <Button icon="pi pi-pencil" size="small" rounded severity="contrast" @click="editUser(slotProps.data)" />
                </template>
            </Column>
        </DataTable>

        <div v-else class="flex items-center justify-center">
            <div class="w-full max-w-lg my-4">
                <Message severity="secondary" variant="outlined" class="text-center">
                    No users found.
                </Message>
            </div>
        </div>
    </slot>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import { FilterMatchMode } from '@primevue/core/api';
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Message from 'primevue/message';

const props = defineProps({
    users: {
        type: Array,
        required: true
    }
});

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

const size = ref({ label: 'Normal', value: 'small' });

const dt = ref(null);

const exportCSVc = () => {
    dt.value.exportCSV();
};

const editUser = (user) => {
    const url = route('users.edit', { id: user.id });
    window.open(url, '_blank');
};

const selectedUsers = ref();

</script>
