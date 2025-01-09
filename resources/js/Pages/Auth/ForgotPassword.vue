<template>

    <Head title="Forgot password" />

    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="main-heading">
            Forgot password
        </h2>
    </div>

    <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-[384px] px-8">
        <div class="p-5 container-border">
            <p class="text-gray-800 text-sm">
                Enter your email to receive a password reset link
            </p>

            <form @submit.prevent="submit" class="space-y-4 mt-2">
                <div class="pt-2">
                    <FloatLabel variant="on">
                        <InputText id="email" v-model="form.email" required type="email" :invalid="!!form.errors.email"
                            class="w-full font-mono border-2 border-amber-800 bg-amber-50 focus:ring-amber-600" />
                        <label for="email" class="font-mono text-amber-800">Email</label>
                    </FloatLabel>
                </div>
                <p v-if="form.errors.email" class="text-xs mt-2 text-red-700 font-mono">
                    {{ form.errors.email }}
                </p>

                <Button @click="submit" :disabled="form.processing" label="Send reset email"
                    class="w-full btn-primary" />
            </form>
        </div>

        <p class="mt-10 text-center text-sm text-gray-800 font-mono">
            Back to
            <Link :href="route('login')" class="font-medium leading-6 text-gray-800 hover:text-gray-700 underline underline-offset-2">
                login
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
import Button from 'primevue/button'

defineOptions({
    layout: Auth
})

const form = useForm({
    email: ''
})

const submit = () => {
    form.post(route('password.request'))
}
</script>
