<template>

    <Head title="Profile" />

    <slot>
        <div class="px-5">
            <div class="space-y-10 divide-y divide-gray-200">
                <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
                    <div class="px-4 sm:px-0">
                        <h2 class="sub-heading">
                            Profile
                        </h2>
                        <p class="mt-1 text-sm leading-6 text-gray-700">
                            Your public profile shows only essential info to protect your privacy while helping artists
                            find you.
                        </p>
                    </div>

                    <form class="container-border md:col-span-2">
                        <div class="px-4 py-6 sm:p-8">
                            <div class="md:max-w-md w-full grid grid-cols-1">
                                <label for="profile_photo" class="text-gray-500 font-medium">Profile photo</label>
                                <div class="my-5">
                                    <media-library-attachment name="profile_photo" :validation-rules="{
                                        accept: ['image/jpeg', 'image/png', 'image/jpg'],
                                        maxSizeInKB: 5048
                                    }" @change="handleProfilePhotoChange" :initial-value="profileForm.profile_photo"
                                        :validation-errors="validationErrorsProfilePhoto" />
                                </div>
                            </div>
                            <div class="md:max-w-md w-full grid grid-cols-2 gap-6">
                                <div class="pt-2">
                                    <FloatLabel variant="on">
                                        <InputText id="phone" v-model="profileForm.phone"
                                            :invalid="!!profileForm.errors.phone" class="w-full" />
                                        <label for="phone">Phone</label>
                                    </FloatLabel>
                                    <p v-if="profileForm.errors.phone" class="text-xs mt-2 text-red-600">
                                        {{ profileForm.errors.phone }}
                                    </p>
                                </div>
                            </div>

                            <div class="md:max-w-md w-full pt-8">
                                <FloatLabel variant="on">
                                    <Textarea v-model="profileForm.bio" rows="5" cols="30" class="w-full" />
                                    <label for="bio">Bio</label>
                                </FloatLabel>
                                <p v-if="profileForm.errors.bio" class="text-xs mt-2 text-red-600">
                                    {{ profileForm.errors.bio }}
                                </p>
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-end gap-x-6 border-t border-gray-200 px-4 py-4 sm:px-8">
                            <Button @click="submitProfileForm" type="button" :loading="profileForm.processing"
                                label="Save changes" class="btn-primary" size="small" />
                        </div>
                    </form>
                </div>

                <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3 pt-10">
                    <div class="px-4 sm:px-0">
                        <h2 class="sub-heading">
                            Social Media
                        </h2>
                        <p class="mt-1 text-sm leading-6 text-gray-700">
                            Your social media links will be visible on your public profile.
                        </p>
                    </div>

                    <form class="container-border md:col-span-2">
                        <div class="px-4 py-6 sm:p-8">
                            <div class="md:max-w-md w-full grid grid-cols-2 gap-6">

                                <div class="pt-2">
                                    <FloatLabel variant="on">
                                        <InputText id="website" v-model="socialForm.website"
                                            :invalid="!!socialForm.errors.website" class="w-full" />
                                        <label for="website">Website</label>
                                        <p v-if="socialForm.errors.website" class="text-xs mt-2 text-red-600">
                                            {{ socialForm.errors.website }}
                                        </p>
                                    </FloatLabel>
                                </div>

                                <div class="pt-2">
                                    <FloatLabel variant="on">
                                        <InputText id="instagram" v-model="socialForm.instagram"
                                            :invalid="!!socialForm.errors.instagram" class="w-full" />
                                        <label for="instagram">Instagram</label>
                                    </FloatLabel>
                                    <p v-if="socialForm.errors.instagram" class="text-xs mt-2 text-red-600">
                                        {{ socialForm.errors.instagram }}
                                    </p>
                                </div>

                                <div class="pt-2">
                                    <FloatLabel variant="on">
                                        <InputText id="twitter" v-model="socialForm.twitter" required
                                            :invalid="!!socialForm.errors.twitter" class="w-full" />
                                        <label for="twitter">Twitter</label>
                                        <p v-if="socialForm.errors.twitter" class="text-xs mt-2 text-red-600">
                                            {{ socialForm.errors.twitter }}
                                        </p>
                                    </FloatLabel>
                                </div>

                                <div class="pt-2">
                                    <FloatLabel variant="on">
                                        <InputText id="facebook" v-model="socialForm.facebook"
                                            :invalid="!!socialForm.errors.facebook" class="w-full" />
                                        <label for="facebook">Facebook</label>
                                    </FloatLabel>
                                    <p v-if="socialForm.errors.facebook" class="text-xs mt-2 text-red-600">
                                        {{ socialForm.errors.facebook }}
                                    </p>
                                </div>

                                <div class="pt-2">
                                    <FloatLabel variant="on">
                                        <InputText id="spotify" v-model="socialForm.spotify"
                                            :invalid="!!socialForm.errors.spotify" class="w-full" />
                                        <label for="spotify">Spotify</label>
                                    </FloatLabel>
                                    <p v-if="socialForm.errors.spotify" class="text-xs mt-2 text-red-600">
                                        {{ socialForm.errors.spotify }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-end gap-x-6 border-t border-gray-200 px-4 py-4 sm:px-8">
                            <Button @click="submitSocialForm" type="button" :loading="socialForm.processing"
                                label="Save changes" class="btn-primary" size="small" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </slot>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import Default from '../../Layouts/Default.vue';
import InputText from 'primevue/inputtext';
import FloatLabel from 'primevue/floatlabel';
import Button from 'primevue/button';
import Textarea from 'primevue/textarea';
import Select from 'primevue/select';

const props = defineProps({
    countries: {
        type: Object,
        required: true
    },
    profile: Object,
});

defineOptions({
    layout: Default
});

const profileForm = useForm({
    _method: 'put',
    phone: props.profile.phone,
    bio: props.profile.bio,
    profile_photo: null,
});

const socialForm = useForm({
    website: props.profile.website,
    instagram: props.profile.instagram,
    twitter: props.profile.twitter,
    facebook: props.profile.facebook,
    spotify: props.profile.spotify,
});

const validationErrorsProfilePhoto = computed(() => ({
    profile_photo: profileForm.errors.profile_photo ? [profileForm.errors.profile_photo] : [],
}));

const handleProfilePhotoChange = (media) => {
    profileForm.profile_photo = media;
};

const submitProfileForm = () => {
    profileForm.post(route('profile.updateProfile', props.profile.id), {
        preserveScroll: true,
    });
};

const submitSocialForm = () => {
    socialForm.put(route('profile.updateSocialMedia', props.profile.id), {
        preserveScroll: true,
    });
};

const countryOptions = computed(() => {
    return Object.entries(props.countries).map(([value, countryData]) => ({
        value,
        label: countryData.name,
        flag: countryData.flag
    }));
});
</script>
