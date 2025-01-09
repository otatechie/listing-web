<template>

    <Head title="Categories" />

    <slot>
        <div class="px-5">
            <Breadcrumb :home="home" :model="items" />
            <div class="space-y-10 divide-y divide-gray-900/10">
                <div class="grid grid-cols-1 gap-x-8 gap-y-8 place-items-center">
                    <div class="w-full max-w-3xl px-4 sm:px-6 lg:px-8">
                        <div class="container-border flex justify-center bg-white p-4 sm:p-6 lg:p-8">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </slot>

</template>

<script setup>
import Default from '../../Layouts/Default.vue';
import {computed, ref} from 'vue';
import { usePage } from '@inertiajs/vue3';
import Stepper from 'primevue/stepper';
import StepItem from 'primevue/stepitem';
import Step from 'primevue/step';
import StepPanel from 'primevue/steppanel';
import Button from 'primevue/button';
import FloatLabel from 'primevue/floatlabel';
import Select from 'primevue/select';
import Breadcrumb from 'primevue/breadcrumb';
import { Head, useForm } from '@inertiajs/vue3';
import Textarea from 'primevue/textarea';
import InputText from 'primevue/inputtext';

defineOptions({
    layout: Default,
})

const home = ref({
    icon: 'pi pi-home'
});
const items = ref([
    { label: 'Categories' }
]);
</script>
