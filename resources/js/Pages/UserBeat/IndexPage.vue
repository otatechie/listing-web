<template>

    <Head title="Beats" />

    <slot>
        <div class="px-5">
            <div class="container-border">
                <div class="m-4">
                    <DataTable :size="size.value" v-model:filters="filters" v-if="beat && beat.length > 0" :value="beat"
                        class="text-xs" ref="dt" dataKey="id" v-model:selection="selectedBeat" scrollable
                        scrollHeight="600px" paginator :rows="10" :rowsPerPageOptions="[10, 20, 30, 50]"
                        sortMode="multiple" removableSort stripedRows tableStyle="min-width: 50rem">
                        <template #header>
                            <div class="flex flex-wrap items-center justify-between gap-2 mb-5">
                                <span class="text-xl font-heading font-semibold">Beats</span>
                                <Link :href="route('beat.create')">
                                <Button icon="pi pi-plus" rounded title="Add Beat" />
                                </Link>
                            </div>
                            <div style="text-align: left">
                                <Button size="small" severity="contrast" icon="pi pi-external-link" label="Export"
                                    @click="exportCSVc($event)" />
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
                        <Column header="Cover art">
                            <template #body="slotProps">
                                <div v-if="slotProps.data.cover_art" class="relative group w-14 h-14">
                                    <img :src="slotProps.data.cover_art" :alt="slotProps.data.title"
                                        class="w-14 h-14 object-cover rounded shadow-sm transition-transform duration-200 group-hover:scale-[1.02]" />
                                    <div class="absolute inset-0 rounded opacity-0 flex items-center justify-center cursor-pointer transition-all duration-200 group-hover:opacity-100"
                                        @click="() => playBeat(slotProps.data)">
                                        <div class="bg-amber-800 rounded-full p-1.5 shadow-md">
                                            <i class="pi text-sm text-white transition-all duration-200"
                                                :class="audioStore.isCurrentBeat(slotProps.data.id) ? (audioStore.isPlaying ? 'pi-pause' : 'pi-play') : 'pi-play'">
                                            </i>
                                        </div>
                                    </div>
                                </div>
                                <div v-else>
                                    <span class="text-xs text-gray-400">No cover art</span>
                                </div>
                            </template>
                        </Column>
                        <Column field="title" sortable header="Title"></Column>
                        <Column field="genre" sortable header="Genre"></Column>
                        <Column field="bpm" sortable header="BPM"></Column>
                        <Column field="created_at" header="Created"></Column>
                        <Column header="Track length">
                            <template #body="slotProps">
                                <span class="text-gray-400">
                                    <audio v-if="slotProps.data.audio" :src="slotProps.data.audio" preload="metadata"
                                        ref="audioRef" class="hidden"
                                        @loadedmetadata="handleMetadata($event, slotProps.data.id)" />
                                    {{ slotProps.data.audio ? (durations[slotProps.data.id] || '-') : 'No audio' }}
                                </span>
                            </template>
                        </Column>
                        <Column header="Status">
                            <template #body="slotProps">
                                <span v-html="getStatusLabel(slotProps.data.status)"></span> </template>
                        </Column>
                        <Column header="Action" style="width: 10rem">
                            <template #body="slotProps">
                                <Button size="small" icon="pi pi-eye" rounded severity="contrast"
                                    @click="editBeat(slotProps.data)" />
                            </template>
                        </Column>
                        <template #footer> <span class="text-gray-500">In total you have {{ beat ?
                            beat.length : 0 }}
                                beats</span>
                        </template>
                    </DataTable>

                    <div v-else class="flex items-center justify-center">
                        <div class="w-full max-w-lg my-4">
                            <Message severity="info" variant="outlined" class="text-center">
                                <Link :href="route('beat.create')">
                                Ready to share your beats? <span class="underline">Add
                                    beat</span> to get
                                started.
                                </Link>
                            </Message>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </slot>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import Default from '../../Layouts/Default.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import { FilterMatchMode } from '@primevue/core/api';
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Message from 'primevue/message';
import { usePage } from "@inertiajs/vue3";
import { useAudioStore } from "@/stores/audioStore";

const props = defineProps({
    beat: {
        type: Object,
        required: true
    }
});

defineOptions({
    layout: Default
});

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

const getStatusLabel = (status) => {
    switch (status) {
        case 'pending':    // Beat is pending
            return '<span class="rounded-md bg-purple-500/10 px-2 py-1 text-xs font-medium text-purple-400 ring-1 ring-inset ring-purple-500/20">Available</span>';

        case 'published':    // Beat has been published
            return '<span class="rounded-md bg-green-500/10 px-2 py-1 text-xs font-medium text-green-400 ring-1 ring-inset ring-green-500/20">Published</span>';

        case 'draft':      // Beat is not yet draft
            return '<span class="rounded-md bg-gray-500/10 px-2 py-1 text-xs font-medium text-gray-400 ring-1 ring-inset ring-gray-500/20">Draft</span>';

        default:          // Default status
            return '<span class="rounded-md bg-gray-500/10 px-2 py-1 text-xs font-medium text-gray-400 ring-1 ring-inset ring-gray-500/20">Draft</span>';
    }
};

const size = ref({ label: 'Normal', value: 'small' });

const dt = ref(null);

const exportCSV = () => {
    dt.value.exportCSV();
};

const editBeat = (beat) => {
    const url = route('beat.edit', { id: beat.slug });
    window.open(url, '_blank');
};

const selectedBeat = ref();

const durations = ref({});

const formatDuration = (seconds) => {
    const minutes = Math.floor(seconds / 60);
    const remainingSeconds = Math.floor(seconds % 60);
    return `${minutes}:${remainingSeconds.toString().padStart(2, '0')}`;
};

const handleMetadata = (event, beatId) => {
    const duration = formatDuration(event.target.duration);
    durations.value[beatId] = duration;
};

const audioStore = useAudioStore();

const page = usePage();

const playBeat = (beat) => {
    const beatData = {
        id: beat.id,
        title: beat.title,
        user: {
            username: page.props.auth.user.username
        },
        media: {
            audio: beat.audio,
            cover_art: beat.cover_art
        }
    };
    audioStore.playBeat(beatData);
};

</script>
