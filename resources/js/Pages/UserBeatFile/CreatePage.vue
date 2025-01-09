<template>

    <Head title="Upload Beat" />

    <slot>
        <div class="px-5">
            <div class="space-y-10 divide-y divide-gray-900/10">
                <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
                    <div class="px-4 sm:px-0">
                        <h2 class="sub-heading">
                            Upload Beat
                        </h2>
                        <p class="mt-1 text-sm leading-6 text-gray-700">
                            Upload your beat file and cover art to complete the process. Ensure your files meet the
                            platform's requirements.
                        </p>
                    </div>

                    <form @submit.prevent="submitBeatForm"
                        class="container-border md:col-span-2">
                        <div class="px-4 py-6 sm:p-8">
                            <div class="md:max-w-md w-full">
                                <div>
                                    <FloatLabel variant="on">
                                        <Select v-model="createBeatForm.beat_id" :options="beat" optionLabel="title"
                                            optionValue="id" @change="handleBeatSelection" showClear
                                            :invalid="!!createBeatForm.errors.beat_id" class="w-full">
                                            <template #option="slotProps">
                                                <div class="flex justify-between items-center">
                                                    <span>{{ slotProps.option.title }}</span>
                                                </div>
                                            </template>
                                        </Select>
                                        <label for="beat">Beat name</label>
                                    </FloatLabel>
                                    <p v-if="createBeatForm.errors.beat_id" class="mt-2 text-xs text-red-600">
                                        {{ createBeatForm.errors.beat_id }}
                                    </p>
                                </div>
                            </div>

                            <div v-if="selectedBeatDetails" class="mt-6 space-y-4">
                                <div class="relative">
                                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                        <div class="w-full border-t border-gray-200"></div>
                                    </div>
                                    <div class="relative flex justify-start">
                                        <span class="bg-white pr-2 text-sm text-gray-400">Beat details</span>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-6">
                                    <div class="flex items-center mb-3">
                                        <div
                                            class="w-8 h-8 mr-3 inline-flex items-center justify-center rounded-full bg-amber-700 text-amber-100 flex-shrink-0">
                                            <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2" class="w-5 h-5"
                                                viewBox="0 0 24 24">
                                                <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-amber-700">BPM</p>
                                            <h2 class="text-amber-800 text-xs font-medium">{{ selectedBeatDetails.bpm }}
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="flex items-center mb-3">
                                        <div
                                            class="w-8 h-8 mr-3 inline-flex items-center justify-center rounded-full bg-amber-700 text-amber-100 flex-shrink-0">
                                            <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2" class="w-5 h-5"
                                                viewBox="0 0 24 24">
                                                <path d="M9 19V6l12-3v13"></path>
                                                <path
                                                    d="M9 19c0 1.105-0.895 2-2 2s-2-0.895-2-2 0.895-2 2-2 2 0.895 2 2z">
                                                </path>
                                                <path
                                                    d="M21 16c0 1.105-0.895 2-2 2s-2-0.895-2-2 0.895-2 2-2 2 0.895 2 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-amber-700">Type</p>
                                            <h2 class="text-amber-800 text-xs font-medium">{{ selectedBeatDetails.type }}
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="flex items-center mb-3">
                                        <div
                                            class="w-8 h-8 mr-3 inline-flex items-center justify-center rounded-full bg-amber-700 text-amber-100 flex-shrink-0">
                                            <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2" class="w-5 h-5"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z">
                                                </path>
                                                <path d="M12 17l5-5-5-5v10z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-amber-700">Genre</p>
                                            <h2 class="text-amber-800 text-xs font-medium">{{ selectedBeatDetails.genre
                                                }}</h2>
                                        </div>
                                    </div>
                                    <div class="flex items-center mb-3">
                                        <div
                                            class="w-8 h-8 mr-3 inline-flex items-center justify-center rounded-full bg-amber-700 text-amber-100 flex-shrink-0">
                                            <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2" class="w-5 h-5"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-amber-700">Added</p>
                                            <h2 class="text-amber-800 text-xs font-medium">{{
                                                selectedBeatDetails.created_at }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-6">
                                <label for="cover_art" class="text-gray-500 font-medium text-sm">Cover art</label>
                                <div class="mt-3">
                                    <media-library-attachment name="cover_art" :initial-value="createBeatForm.cover_art"
                                        :validation-rules="{
                                            accept: ['image/jpeg', 'image/png', 'image/jpg'],
                                            maxSizeInKB: 5048
                                        }" @change="handleCoverArtChange"
                                        :validation-errors="validationErrorsCoverArt" />
                                </div>
                            </div>

                            <div class="pt-6">
                                <label for="audio" class="text-gray-500 font-medium text-sm">Beat file</label>
                                <div class="mt-3">
                                    <media-library-attachment name="audio" :initial-value="createBeatForm.audio"
                                        :validation-rules="{
                                            accept: ['audio/mpeg', 'audio/wav'],
                                            maxSizeInKB: 5048
                                        }" @change="handleAudioChange" :validation-errors="validationErrorsAudio" />
                                </div>
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                            <Button label="Upload now" @click="submitBeatForm"
                                class="btn-primary" size="small" />
                            <Link :href="route('beat.create')">
                            <Button label="Add beat details" severity="secondary"
                                class="btn-dark" size="small" />
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </slot>
</template>

<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import Default from "../../Layouts/Default.vue";
import FloatLabel from "primevue/floatlabel";
import Button from "primevue/button";
import Select from 'primevue/select';

defineOptions({
    layout: Default,
});

const props = defineProps({
    beat: {
        type: Array,
        required: true
    }
});

const page = usePage();

const validationErrorsCoverArt = computed(() => ({
    cover_art: page.props.errors.cover_art ? [page.props.errors.cover_art] : [],
}));

const validationErrorsAudio = computed(() => ({
    audio: page.props.errors.audio ? [page.props.errors.audio] : []
}));

const createBeatForm = useForm({
    cover_art: null,
    audio: null,
    beat_id: null,
});

const handleCoverArtChange = (media) => {
    createBeatForm.cover_art = media;
};

const handleAudioChange = (media) => {
    createBeatForm.audio = media;
};

const selectedBeatDetails = ref(null);

const handleBeatSelection = (event) => {
    const selectedBeatId = event.value;
    createBeatForm.beat_id = selectedBeatId;
    selectedBeatDetails.value = props.beat.find(beat => beat.id === selectedBeatId);
};

const submitBeatForm = () => {
    createBeatForm.post(route("upload-beat.store"), {
        forceFormData: true,
        preserveScroll: true,
    });
};
</script>
