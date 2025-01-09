<template>

    <Head title="Create account" />

    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="main-heading">
            Create account
        </h2>
    </div>

    <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-[384px] px-8">
        <div class="container-border p-5">
            <form @submit.prevent="submit" class="space-y-4 mt-2">
                <div>
                    <FloatLabel variant="on">
                        <InputText id="name" v-model="form.name" required :invalid="!!form.errors.name"
                            class="w-full" />
                        <label for="name">Legal name</label>
                    </FloatLabel>
                    <p v-if="form.errors.name" class="text-xs mt-2 text-red-600">
                        {{ form.errors.name }}
                    </p>
                </div>

                <div class="pt-2">
                    <FloatLabel variant="on">
                        <InputText id="email" v-model="form.email" required type="email" :invalid="!!form.errors.email"
                            class="w-full" />
                        <label for="email">Email</label>
                    </FloatLabel>
                    <p v-if="form.errors.email" class="text-xs mt-2 text-red-600">
                        {{ form.errors.email }}
                    </p>
                </div>

                <div class="pt-2">
                    <FloatLabel variant="on">
                        <Password id="password" v-model="form.password" required fluid :invalid="!!form.errors.password"
                            :feedback="false" toggleMask />
                        <label for="password">Password</label>
                    </FloatLabel>
                    <p v-if="form.errors.password" class="text-xs mt-2 text-red-600">
                        {{ form.errors.password }}
                    </p>
                </div>

                <div class="pt-2">
                    <FloatLabel variant="on">
                        <Password id="password_confirmation" v-model="form.password_confirmation" required fluid
                            :invalid="!!form.errors.password_confirmation" :feedback="false" toggleMask />
                        <label for="password_confirmation">Confirm password</label>
                    </FloatLabel>
                    <p v-if="form.errors.password_confirmation" class="text-xs mt-2 text-red-600">
                        {{ form.errors.password_confirmation }}
                    </p>
                </div>

                <p class="text-sm text-gray-700">
                    By creating an account, you agree to our <span class="underline font-medium">Terms</span> and have read and
                    acknowledge the <span class="underline font-medium">Global Privacy</span> Statement.
                </p>

                <Button @click="submit" :disabled="form.processing" label="Create account" size="small"
                    class="w-full btn-primary" />
            </form>

            <div class="relative mt-5">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm font-medium leading-6">
                    <span class="bg-white px-6 text-gray-700 text-xs">Or continue with</span>
                </div>
            </div>

            <div class="mt-5">
                <a href="#"
                    class="flex w-full items-center justify-center gap-3 bg-white px-3 py-2 text-sm font-semibold text-gray-800 shadow-sm ring-1 ring-inset ring-gray-800 hover:bg-amber-50 focus-visible:ring-transparent">
                    <svg class="h-5 w-5" aria-hidden="true" viewBox="0 0 24 24">
                        <path
                            d="M12.0003 4.75C13.7703 4.75 15.3553 5.36002 16.6053 6.54998L20.0303 3.125C17.9502 1.19 15.2353 0 12.0003 0C7.31028 0 3.25527 2.69 1.28027 6.60998L5.27028 9.70498C6.21525 6.86002 8.87028 4.75 12.0003 4.75Z"
                            fill="#EA4335" />
                        <path
                            d="M23.49 12.275C23.49 11.49 23.415 10.73 23.3 10H12V14.51H18.47C18.18 15.99 17.34 17.25 16.08 18.1L19.945 21.1C22.2 19.01 23.49 15.92 23.49 12.275Z"
                            fill="#4285F4" />
                        <path
                            d="M5.26498 14.2949C5.02498 13.5699 4.88501 12.7999 4.88501 11.9999C4.88501 11.1999 5.01998 10.4299 5.26498 9.7049L1.275 6.60986C0.46 8.22986 0 10.0599 0 11.9999C0 13.9399 0.46 15.7699 1.28 17.3899L5.26498 14.2949Z"
                            fill="#FBBC05" />
                        <path
                            d="M12.0004 24.0001C15.2404 24.0001 17.9654 22.935 19.9454 21.095L16.0804 18.095C15.0054 18.82 13.6204 19.245 12.0004 19.245C8.8704 19.245 6.21537 17.135 5.2654 14.29L1.27539 17.385C3.25539 21.31 7.3104 24.0001 12.0004 24.0001Z"
                            fill="#34A853" />
                    </svg>
                    <span class="text-sm font-semibold leading-6">Google</span>
                </a>
            </div>
        </div>

        <p class="py-10 text-center text-sm text-gray-800">
            Already a member?
            <Link :href="route('login')" class="font-medium leading-6 text-gray-800 hover:text-gray-700 underline underline-offset-2">
            Login
            </Link>
        </p>
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'
import Auth from '../../Layouts/Auth.vue'
import InputText from 'primevue/inputtext'
import FloatLabel from 'primevue/floatlabel'
import Password from 'primevue/password'
import Button from 'primevue/button'
import Tooltip from 'primevue/tooltip';

defineOptions({
    layout: Auth
})

const form = useForm({
    name: '',
    email: '',
    username: '',
    password: '',
    password_confirmation: '',
})

const submit = () => {
    form.post('/register')
}
</script>
