<template>
      <div class="px-5">
            <div class="space-y-10 divide-y divide-gray-900/10">
                <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
                    <div class="px-4 sm:px-0">
                        <h2 class="text-xl font-heading font-semibold leading-7 text-gray-800">
                            Edit Beat
                        </h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">
                            Edit your beat details. Your name will be displayed
                            for beat-related communications and credits.
                        </p>
                    </div>

                    <form @submit.prevent="submitBeatForm"
                        class="bg-white border border-gray-300 rounded-xl md:col-span-2">
                        <div class="px-4 py-6 sm:p-8">
                            <div class="md:max-w-lg w-full grid gap-6">
                                <div class="pt-2">
                                    <FloatLabel variant="on">
                                        <InputText id="username" v-model="createBeatForm.title" required :invalid="!!createBeatForm.errors.title
                                            " class="w-full" />
                                        <label for="title">Title</label>
                                        <p v-if="createBeatForm.errors.title" class="text-xs mt-2 text-red-600">
                                            {{ createBeatForm.errors.title }}
                                        </p>
                                    </FloatLabel>
                                </div>
                            </div>
                            <div class="md:max-w-lg w-full grid grid-cols-3 gap-6 mt-6">
                                <div class="pt-2">
                                    <FloatLabel variant="on">
                                        <Select v-model="createBeatForm.type" :options="types" showClear class="w-full"
                                            :invalid="!!createBeatForm.errors.type
                                                " />
                                        <label for="type">Type</label>
                                    </FloatLabel>
                                    <p v-if="createBeatForm.errors.type" class="mt-2 text-xs text-red-600">
                                        {{ createBeatForm.errors.type }}
                                    </p>
                                </div>
                                <div class="pt-2">
                                    <FloatLabel variant="on">
                                        <Select v-model="createBeatForm.genre" :options="genres" showClear
                                            class="w-full" :invalid="!!createBeatForm.errors.genre
                                                " />
                                        <label for="genre">Genre</label>
                                    </FloatLabel>
                                    <p v-if="createBeatForm.errors.genre" class="mt-2 text-xs text-red-600">
                                        {{ createBeatForm.errors.genre }}
                                    </p>
                                </div>
                                <div class="pt-2">
                                    <FloatLabel variant="on">
                                        <InputText id="bpm" v-model="createBeatForm.bpm" required :invalid="!!createBeatForm.errors.bpm
                                            " class="w-full" />
                                        <label for="bpm">BPM</label>
                                        <p v-if="createBeatForm.errors.bpm" class="text-xs mt-2 text-red-600">
                                            {{ createBeatForm.errors.bpm }}
                                        </p>
                                    </FloatLabel>
                                </div>
                            </div>

                            <div class="md:max-w-md w-full pt-8">
                                <FloatLabel>
                                    <Textarea style="resize: none; height: 160px" id="description"
                                        v-model="createBeatForm.description" required :invalid="!!createBeatForm.errors.description
                                            " class="w-full" :placeholder="placeholder" />
                                    <p v-if="createBeatForm.errors.description" class="text-xs mt-2 text-red-600">
                                        {{ createBeatForm.errors.description }}
                                    </p>
                                </FloatLabel>
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                            <Button @click="submitBeatForm" :loading="createBeatForm.processing" label="Save changes"
                                class="btn-primary"
                                size="small" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
</template>

<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import InputText from "primevue/inputtext";
import FloatLabel from "primevue/floatlabel";
import Button from "primevue/button";
import Textarea from "primevue/textarea";
import Select from "primevue/select";

const props = defineProps({
    beat: {
        type: Object,
        required: true,
    },
});

const createBeatForm = useForm({
    title: props.beat.title,
    type: props.beat.type,
    genre: props.beat.genre,
    bpm: props.beat.bpm,
    license_id: props.beat.license_id,
    description: props.beat.description,
});

const genres = ref([
    "Afrobeat",
    "Amapiano",
    "Dancehall",
    "Drill",
    "Hip Hop",
    "Pop",
    "R&B",
    "Trap",
]);

const types = ref([
    "Chill",
    "Club",
    "Dark",
    "Happy",
    "Hard",
    "Melodic",
    "Sad",
    "Smooth",
]);

const placeholder = `Beat description:
- Style (trap, boom bap, etc)
- Key sounds used
- Perfect for
- Inspired by`;


const submitBeatForm = () => {
    createBeatForm.put(route("beat.update", props.beat.id), {
        preserveScroll: true,
    });
};
</script>
