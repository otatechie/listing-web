<template>
    <form @submit.prevent="submitBeatFileForm" class="bg-white border border-gray-200 rounded-xl md:col-span-2">
        <div class="p-5">
            <div>
                <label for="cover_art" class="text-gray-500 font-medium text-sm">Cover art <span
                        class="text-red-500">*</span></label>
                <div class="mt-3">
                    <media-library-attachment name="cover_art" :initial-value="beat.media.cover_art" :validation-rules="{
                        accept: ['image/jpeg', 'image/png', 'image/jpg'],
                        maxSizeInKB: 5048,
                    }" @change="handleCoverArtChange" :validation-errors="validationErrorsCoverArt" />
                </div>
            </div>

            <div class="pt-6">
                <label for="audio" class="text-gray-500 font-medium text-sm">Beat file <span
                        class="text-red-500">*</span></label>
                <div class="mt-3 flex items-center gap-3">
                    <media-library-attachment name="audio" :initial-value="beat.media.audio" :validation-rules="{
                        accept: ['audio/mpeg', 'audio/wav'],
                        maxSizeInKB: 5048,
                    }" @change="handleAudioChange" :validation-errors="validationErrorsAudio" />
                    <div v-if="beat.media.audio">
                        <button @click="playBeat" type="button" title="Play beat"
                            class="w-8 h-8 flex items-center justify-center bg-[#444444] hover:bg-[#555555] rounded-full">
                            <i class="pi text-white"
                                :class="audioStore.isCurrentBeat(beat.id) ? (audioStore.isPlaying ? 'pi-pause' : 'pi-play') : 'pi-play'">
                            </i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
            <Button label="Upload now" @click="submitBeatFileForm" class="btn-primary" size="small" />
        </div>
    </form>
</template>

<script setup>
import { Head, useForm, usePage } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import Button from "primevue/button";
import { useAudioStore } from "@/stores/audioStore";

const props = defineProps({
    beat: {
        type: Object,
        required: true,
    },
});

const page = usePage();

const validationErrorsCoverArt = ref({
    cover_art: page.props.errors.cover_art ? [page.props.errors.cover_art] : [],
});

const validationErrorsAudio = ref({
    audio: page.props.errors.audio ? [page.props.errors.audio] : []
});

const audioStore = useAudioStore();

const createBeatFileForm = useForm({
    cover_art: null,
    audio: null,
    _method: 'PUT',
});

const removedCoverArt = ref(false);
const removedAudio = ref(false);

const handleCoverArtChange = (media) => {
    const isEmpty = !media || Object.keys(media).length === 0;
    createBeatFileForm.cover_art = isEmpty ? null : media[Object.keys(media)[0]];
    removedCoverArt.value = isEmpty;
};

const handleAudioChange = (media) => {
    const isEmpty = !media || Object.keys(media).length === 0;
    createBeatFileForm.audio = isEmpty ? null : media[Object.keys(media)[0]];
    removedAudio.value = isEmpty;
};

const submitBeatFileForm = () => {
    const hasCoverArt = createBeatFileForm.cover_art !== null ? createBeatFileForm.cover_art :
        (!removedCoverArt.value && Array.isArray(props.beat.media.cover_art) && props.beat.media.cover_art.length > 0);
    const hasAudio = createBeatFileForm.audio !== null ? createBeatFileForm.audio :
        (!removedAudio.value && Array.isArray(props.beat.media.audio) && props.beat.media.audio.length > 0);

    let message = '';
    switch (true) {
        case !hasCoverArt && !hasAudio:
            message = 'both cover art and audio file';
            break;
        case !hasCoverArt:
            message = 'cover art';
            break;
        case !hasAudio:
            message = 'audio file';
            break;
    }

    if (message) {
        alert(`Please select ${message} before uploading`);
        return;
    }

    createBeatFileForm.post(route("upload-beat.update", {
        upload_beat: props.beat.beatFile.id
    }), {
        forceFormData: true,
        preserveScroll: true,
        headers: {
            'Content-Type': 'multipart/form-data'
        },
    });
};

const playBeat = () => {
    const beatData = {
        id: props.beat.id,
        title: props.beat.title,
        user: {
            username: page.props.auth.user.username
        },
        media: {
            audio: props.beat.media.audio,
            cover_art: props.beat.media.cover_art
        }
    };
    audioStore.playBeat(beatData);
};
</script>

<style scoped>
.relative.group {
    padding: 2px;
}
</style>
