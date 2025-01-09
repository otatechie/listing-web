<template>

    <Head title="Profile" />

    <slot>
        <div class="px-5">
            <div v-if="!user.is_setup_complete" class="mb-5">
                <Message severity="info">
                    <p class="text-sm">
                        To become a producer, please complete your profile by providing a username, country, and city.
                    </p>
                </Message>
            </div>

            <div class="space-y-10 divide-y divide-gray-900/10">
                <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
                    <div class="px-4 sm:px-0">
                        <h2 class="sub-heading">
                            Account
                        </h2>
                        <p class="mt-1 text-sm leading-6 text-gray-700">
                            Your name and other information is visible to others. Email address stays private.
                        </p>
                    </div>

                    <form @submit.prevent="submitProfileForm"
                        class="container-border md:col-span-2">
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

                                <div class="pt-6">
                                    <FloatLabel variant="on">
                                        <InputText id="username" v-model="profileForm.username" required
                                            :invalid="!!profileForm.errors.username" class="w-full"
                                            v-tooltip.focus.top="'Choose your unique artist name. Impersonating others is not allowed and may result in account termination.'" />
                                        <label for="username">Artist name</label>
                                    </FloatLabel>
                                    <p v-if="profileForm.errors.username" class="text-xs mt-2 text-red-600">
                                        {{ profileForm.errors.username }}
                                    </p>
                                </div>

                                <div class="pt-6 grid grid-cols-2 gap-4">
                                    <div>
                                        <FloatLabel variant="on">
                                            <InputText id="city" v-model="profileForm.city" required type="text"
                                                :invalid="!!profileForm.errors.city" class="w-full" />
                                            <label for="city">City</label>
                                        </FloatLabel>
                                        <p v-if="profileForm.errors.city" class="text-xs mt-2 text-red-600">
                                            {{ profileForm.errors.city }}
                                        </p>
                                    </div>
                                    <div>
                                        <FloatLabel variant="on">
                                            <Select v-model="profileForm.country" :options="countryOptions"
                                                optionLabel="label" :option-value="'value'" showClear class="w-full"
                                                :invalid="!!profileForm.errors.country">
                                                <template #option="slotProps">
                                                    {{ slotProps.option.flag }} {{ slotProps.option.label }}
                                                </template>
                                            </Select>
                                            <label for="country">Country</label>
                                        </FloatLabel>
                                        <p v-if="profileForm.errors.country" class="mt-2 text-xs text-red-600">
                                            {{ profileForm.errors.country }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-x-6 border-t border-gray-200 px-4 py-4 sm:px-8">
                            <Button type="submit" :loading="profileForm.processing" label="Save changes" size="small"
                                class="btn-primary" />
                        </div>
                    </form>
                </div>

                <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-10 md:grid-cols-3" v-if="user.is_setup_complete">
                    <div class="px-4 sm:px-0">
                        <h2 class="sub-heading">
                            Change Password
                        </h2>
                        <p class="mt-1 text-sm leading-6 text-gray-700">
                            Choose a strong password that's hard to guess and avoid common phrases.
                        </p>
                    </div>

                    <form @submit.prevent="submitPasswordForm"
                        class="container-border md:col-span-2">
                        <div class="px-4 py-6 sm:p-8">
                            <div class="md:max-w-md w-full grid grid-cols-1 gap-3">

                                <div class="pt-2">
                                    <FloatLabel variant="on">
                                        <Password id="current_password" v-model="passwordForm.current_password" required
                                            fluid :invalid="!!passwordForm.errors.current_password" :feedback="false"
                                            toggleMask />
                                        <label for="current_password">Current password</label>
                                    </FloatLabel>
                                    <p v-if="passwordForm.errors.current_password" class="text-xs mt-2 text-red-600">
                                        {{ passwordForm.errors.current_password }}
                                    </p>
                                </div>

                                <div class="pt-6">
                                    <FloatLabel variant="on">
                                        <Password id="password" v-model="passwordForm.password" required fluid
                                            :invalid="!!passwordForm.errors.password" :feedback="false" toggleMask />
                                        <label for="password">Password</label>
                                    </FloatLabel>
                                    <p v-if="passwordForm.errors.password" class="text-xs mt-2 text-red-600">
                                        {{ passwordForm.errors.password }}
                                    </p>
                                </div>

                                <div class="pt-6">
                                    <FloatLabel variant="on">
                                        <Password id="password_confirmation"
                                            v-model="passwordForm.password_confirmation" required fluid
                                            :invalid="!!passwordForm.errors.password_confirmation" :feedback="false"
                                            toggleMask />
                                        <label for="password_confirmation">Confirm password</label>
                                    </FloatLabel>
                                    <p v-if="passwordForm.errors.password_confirmation"
                                        class="text-xs mt-2 text-red-600">
                                        {{ passwordForm.errors.password_confirmation }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-x-6 border-t border-gray-200 px-4 py-4 sm:px-8">
                            <Button type="submit" :loading="passwordForm.processing" label="Save changes" size="small"
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
import { computed } from 'vue';
import Default from '../../Layouts/Default.vue';
import InputText from 'primevue/inputtext';
import FloatLabel from 'primevue/floatlabel';
import Password from 'primevue/password';
import Message from 'primevue/message';
import Button from 'primevue/button';
import Select from 'primevue/select';
import Tooltip from 'primevue/tooltip';

const props = defineProps({
    user: {
        type: Object,
        required: true
    },
    countries: {
        type: Object,
        required: true
    },
});

defineOptions({
    layout: Default
});

const profileForm = useForm({
    name: props.user.name,
    email: props.user.email,
    username: props.user.username,
    city: props.user.city,
    country: props.user.country,
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

const countryOptions = computed(() => {
    return Object.entries(props.countries).map(([value, countryData]) => ({
        value,
        label: countryData.name,
        flag: countryData.flag
    }));
});
</script>
