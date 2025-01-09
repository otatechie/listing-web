<template>

    <Head title="Add beat details" />

    <slot>

        <div class="px-5">
            <div class="space-y-10 divide-y divide-gray-900/10">
                <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
                    <div class="px-4 sm:px-0">
                        <h2 class="sub-heading">
                            Add Beat Info
                        </h2>
                        <p class="mt-1 text-sm leading-6 text-gray-700">
                            Add your new beat details. Your name will be displayed for beat-related communications
                            and credits.
                        </p>
                    </div>

                    <form @submit.prevent="submitBeatForm"
                        class="container-border md:col-span-2">
                        <div class="px-4 py-6 sm:p-8">
                            <div class="md:max-w-lg w-full grid gap-6">
                                <div class="pt-2">
                                    <FloatLabel variant="on">
                                        <InputText id="title" v-model="createBeatForm.title" required :invalid="!!createBeatForm.errors.title
                                            " class="w-full" />
                                        <label for="title">Title</label>
                                    </FloatLabel>
                                    <p v-if="createBeatForm.errors.title" class="text-xs mt-2 text-red-600">
                                        {{ createBeatForm.errors.title }}
                                    </p>
                                </div>
                            </div>
                            <div class="md:max-w-lg w-full grid grid-cols-3 gap-6 mt-6">
                                <div>
                                    <FloatLabel variant="on">
                                        <Select v-model="createBeatForm.type" :options="types" showClear class="w-full"
                                            :invalid="!!createBeatForm.errors.type" />
                                        <label for="type">Type</label>
                                    </FloatLabel>
                                    <p v-if="createBeatForm.errors.type" class="mt-2 text-xs text-red-600">{{
                                        createBeatForm.errors.type }}</p>
                                </div>
                                <div>
                                    <FloatLabel variant="on">
                                        <Select v-model="createBeatForm.genre" :options="genres" showClear
                                            class="w-full" :invalid="!!createBeatForm.errors.genre" />
                                        <label for="genre">Genre</label>
                                    </FloatLabel>
                                    <p v-if="createBeatForm.errors.genre" class="mt-2 text-xs text-red-600">{{
                                        createBeatForm.errors.genre }}</p>
                                </div>
                                <div>
                                    <FloatLabel variant="on">
                                        <InputText id="bpm" v-model="createBeatForm.bpm" required
                                            :invalid="!!createBeatForm.errors.bpm" class="w-full" />
                                        <label for="bpm">BPM</label>
                                    </FloatLabel>
                                    <p v-if="createBeatForm.errors.bpm" class="text-xs mt-2 text-red-600">
                                        {{ createBeatForm.errors.bpm }}
                                    </p>
                                </div>
                            </div>

                            <div class="md:max-w-md w-full pt-6">
                                <FloatLabel>
                                    <Textarea style="resize: none;height: 160px;" id="description"
                                        v-model="createBeatForm.description" required
                                        :invalid="!!createBeatForm.errors.description" class="w-full"
                                        :placeholder="placeholder" />
                                    <p v-if="createBeatForm.errors.description" class="text-xs mt-2 text-red-600">
                                        {{ createBeatForm.errors.description }}
                                    </p>
                                </FloatLabel>
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                            <Button label="Add beat details" @click="submitBeatForm" size="small"
                                class="btn-primary" />
                            <Link :href="route('upload-beat.index')">
                            <Button label="Upload beat" severity="secondary" class="btn-dark" size="small" />
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </slot>
</template>

<script setup>
import { Head, useForm, Link } from "@inertiajs/vue3";
import { ref } from "vue";
import Default from "../../Layouts/Default.vue";
import InputText from "primevue/inputtext";
import FloatLabel from "primevue/floatlabel";
import Button from "primevue/button";
import Textarea from "primevue/textarea";
import Select from 'primevue/select';

defineOptions({
    layout: Default,
});

const props = defineProps({
    licenses: {
        type: Array,
        required: true
    }
});

const createBeatForm = useForm({
    title: null,
    type: null,
    genre: null,
    bpm: null,
    cover_art: [],
    license_id: null,
    description: null,
});

const genres = ref([
    'Afrobeat',
    'Amapiano',
    'Dancehall',
    'Drill',
    'Hip Hop',
    'Pop',
    'R&B',
    'Trap',
]);

const types = ref([
    'Chill',
    'Club',
    'Dark',
    'Happy',
    'Hard',
    'Melodic',
    'Sad',
    'Smooth',
]);

const placeholder = `Beat description:
- Style (trap, boom bap, etc)
- Key sounds used
- Perfect for
- Inspired by`;

const submitBeatForm = () => {
    createBeatForm.post(route("beat.store"), {
        forceFormData: true,
        preserveScroll: true,
    });
};
</script>
