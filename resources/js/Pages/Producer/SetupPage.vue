<template>

    <Head title="Profile" />

    <slot>
        <div class="px-5">
            <div v-if="!user.two_factor_secret" class="mb-5">
                <Message severity="info" closable>
                    <p class="text-sm">
                        Enable
                        <Link :href="route('user.two.factor')" class="underline">
                        two-factor authentication (2FA)
                        </Link> for additional account security
                    </p>
                </Message>
            </div>

            <div class="space-y-10 divide-y divide-gray-900/10">
                <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
                    <div class="px-4 sm:px-0">
                        <h2 class="text-xl font-heading font-semibold leading-7 text-amber-900">
                            Account
                        </h2>
                        <p class="mt-1 text-sm leading-6 text-amber-800">
                            Your name is visible to others. Email address stays private.
                        </p>
                    </div>

                    <form @submit.prevent="submitProfileForm"
                        class="bg-white border-2 border-amber-800 rounded-none shadow-[2px_2px_0px_0px_rgba(146,64,14,1)] md:col-span-2">
                        <div class="px-4 py-6 sm:p-8">
                            <div class="md:max-w-md w-full grid grid-cols-1 gap-3">
                                <div>
                                    <FloatLabel variant="on">
                                        <InputText id="name" v-model="profileForm.name" required
                                            :invalid="!!profileForm.errors.name" class="w-full" />
                                        <label for="name">Legal name</label>
                                        <p v-if="profileForm.errors.name" class="text-xs mt-2 text-red-600">
                                            {{ profileForm.errors.name }}
                                        </p>
                                    </FloatLabel>
                                </div>

                                <div class="pt-6">
                                    <FloatLabel variant="on">
                                        <InputText id="email" v-model="profileForm.email" required type="email"
                                            :invalid="!!profileForm.errors.email" class="w-full" />
                                        <label for="email">Email</label>
                                    </FloatLabel>
                                    <p v-if="profileForm.errors.email" class="text-xs mt-2 text-red-600">
                                        {{ profileForm.errors.email }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-x-6 border-t border-gray-200 px-4 py-4 sm:px-8">
                            <Button type="submit" :loading="profileForm.processing" label="Save changes" size="small"
                                class="font-mono bg-amber-800 hover:bg-amber-700 border-2 border-amber-950
                    shadow-[2px_2px_0px_0px_rgba(120,53,15,1)] active:shadow-none active:translate-x-[2px] active:translate-y-[2px]" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </slot>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import Default from '../../Layouts/Default.vue';
import InputText from 'primevue/inputtext';
import FloatLabel from 'primevue/floatlabel';
import Password from 'primevue/password';
import Message from 'primevue/message';
import Button from 'primevue/button';

const props = defineProps({
    user: {
        type: Object,
        required: true
    }
});

defineOptions({
    layout: Default
});

const profileForm = useForm({
    name: props.user.name,
    email: props.user.email,
});

const submitProfileForm = () => {
    profileForm.put('/user/profile-information', {
        preserveScroll: true,
    });
};

const passwordForm = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const submitPasswordForm = () => {
    passwordForm.put('/user/password', {
        preserveScroll: true,
    });
};
</script>
