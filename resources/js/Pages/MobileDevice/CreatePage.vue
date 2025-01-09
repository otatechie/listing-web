<template>

    <Head title="Add Mobile Device" />

    <slot>
        <div class="px-5">
            <Breadcrumb :home="home" :model="items" />
            <div class="space-y-10 divide-y divide-gray-900/10">
                <div class="grid grid-cols-1 gap-x-8 gap-y-8 place-items-center">
                    <div class="w-full max-w-3xl px-4 sm:px-6 lg:px-8">
                        <div class="container-border flex justify-center bg-white p-4 sm:p-6 lg:p-8">
                            <Stepper value="1" class="w-full">
                                <StepItem value="1">
                                    <Step>Product Details</Step>
                                    <StepPanel v-slot="{ activateCallback }">
                                        <div class="flex flex-col space-y-4 sm:space-y-6">
                                            <div
                                                class="border-2 border-dashed border-gray-300 bg-gray-50 rounded-md p-6">
                                                <h2 class="text-xl sm:text-2xl font-semibold">Select Product Details
                                                </h2>
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 mt-6">
                                                    <div>
                                                        <FloatLabel variant="on">
                                                            <Select
                                                                v-model="createMobileDeviceForm.storage_capacity"
                                                                :options="storage" showClear class="w-full"
                                                                optionLabel="label" optionValue="value"
                                                                :invalid="!!createMobileDeviceForm.errors.storage_capacity" />
                                                            <label for="storage_capacity">Storage</label>
                                                        </FloatLabel>
                                                        <p v-if="createMobileDeviceForm.errors.storage_capacity"
                                                            class="mt-2 text-xs text-red-600">{{
                                                                createMobileDeviceForm.errors.storage_capacity }}</p>
                                                    </div>
                                                    <div>
                                                        <FloatLabel variant="on">
                                                            <Select v-model="createMobileDeviceForm.condition"
                                                                :options="conditions" showClear class="w-full"
                                                                optionLabel="label" optionValue="value"
                                                                :invalid="!!createMobileDeviceForm.errors.condition" />
                                                            <label for="condition">Condition</label>
                                                        </FloatLabel>
                                                        <p v-if="createMobileDeviceForm.errors.condition"
                                                            class="mt-2 text-xs text-red-600">{{
                                                                createMobileDeviceForm.errors.condition }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex justify-between pt-6">
                                                <div></div>
                                                <Button label="Next" icon="pi pi-arrow-right" iconPos="right"
                                                    @click="validateAndProceed(activateCallback, '1')" />
                                            </div>
                                        </div>
                                    </StepPanel>
                                </StepItem>

                                <StepItem value="2">
                                    <Step>Listing Information</Step>
                                    <StepPanel v-slot="{ activateCallback }">
                                        <div class="flex flex-col space-y-4 sm:space-y-6">
                                            <div
                                                class="border-2 border-dashed border-gray-300 bg-gray-50 rounded-md p-6">
                                                <h2 class="text-xl sm:text-2xl font-semibold ">Listing Information</h2>
                                                <div class="space-y-4 sm:space-y-6 mt-6">
                                                    <div>
                                                        <FloatLabel variant="on">
                                                            <InputText
                                                                v-model="createMobileDeviceForm.listing_title"
                                                                class="w-full"
                                                                :invalid="!!createMobileDeviceForm.errors.listing_title" />
                                                            <label>Listing Title</label>
                                                        </FloatLabel>
                                                        <p class="text-xs text-gray-500">Short, unique title for your
                                                            product listing. (max 100 characters)</p>
                                                        <p v-if="createMobileDeviceForm.errors.listing_title"
                                                            class="mt-2 text-xs text-red-600">
                                                            {{ createMobileDeviceForm.errors.listing_title }}
                                                        </p>
                                                    </div>

                                                    <div>
                                                        <FloatLabel variant="on">
                                                            <InputText v-model="createMobileDeviceForm.price"
                                                                class="w-full"
                                                                :invalid="!!createMobileDeviceForm.errors.price" />
                                                            <label>Price</label>
                                                        </FloatLabel>
                                                        <p class="text-xs text-gray-500">Price of the product</p>
                                                        <p v-if="createMobileDeviceForm.errors.price"
                                                            class="mt-2 text-xs text-red-600">
                                                            {{ createMobileDeviceForm.errors.price }}
                                                        </p>
                                                    </div>

                                                    <div>
                                                        <FloatLabel variant="on">
                                                            <Textarea
                                                                v-model="createMobileDeviceForm.listing_description"
                                                                rows="4" class="w-full"
                                                                :invalid="!!createMobileDeviceForm.errors.listing_description" />
                                                            <label>Listing Description</label>
                                                        </FloatLabel>
                                                        <p class="text-xs text-gray-500">Describe in detail your listing
                                                            and
                                                            what is included for the buyer. (max 1000 characters)</p>
                                                        <p v-if="createMobileDeviceForm.errors.listing_description"
                                                            class="mt-2 text-xs text-red-600">
                                                            {{ createMobileDeviceForm.errors.listing_description }}
                                                        </p>
                                                    </div>

                                                    <div>
                                                        <FloatLabel variant="on">
                                                            <Textarea
                                                                v-model="createMobileDeviceForm.damage_wear_description"
                                                                rows="4" class="w-full"
                                                                        :invalid="!!createMobileDeviceForm.errors.damage_wear_description" />
                                                            <label>Damage/Wear Description</label>
                                                        </FloatLabel>
                                                        <p class="text-xs text-gray-500">Describe any imperfections,
                                                            damage
                                                            the product has sustained, and/or repairs made. (max 1000
                                                            characters)</p>
                                                            <p v-if="createMobileDeviceForm.errors.damage_wear_description"
                                                            class="mt-2 text-xs text-red-600">
                                                            {{
                                                                createMobileDeviceForm.errors.damage_wear_description
                                                            }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="flex flex-col sm:flex-row pt-6 justify-between space-y-4 sm:space-y-0">
                                                <Button label="Back" severity="secondary" icon="pi pi-arrow-left"
                                                    @click="activateCallback('1')" />
                                                <Button label="Next" icon="pi pi-arrow-right" iconPos="right"
                                                    @click="validateAndProceed(activateCallback, '2')" />
                                            </div>
                                        </div>
                                    </StepPanel>
                                </StepItem>

                                <StepItem value="3">
                                    <Step>Upload Images</Step>
                                    <StepPanel v-slot="{ activateCallback }">
                                        <div class="pt-6">
                                            <label for="cover_art" class="text-gray-500 font-medium text-sm">Cover
                                                art</label>
                                            <div class="mt-3">
                                                <media-library-collection name="images"
                                                    :initial-value="createMobileDeviceForm.images"
                                                    :validation-rules="{
                                                        accept: ['image/jpeg', 'image/png', 'image/jpg'],
                                                        maxSizeInKB: 5048
                                                    }"
                                                    :max-items="5"
                                                    multiple
                                                    @change="handleImagesChange"
                                                    :validation-errors="validationErrorsImages" />
                                            </div>
                                        </div>
                                        <div
                                            class="flex flex-col sm:flex-row pt-6 justify-between space-y-4 sm:space-y-0">
                                            <Button label="Back" severity="secondary" icon="pi pi-arrow-left"
                                                @click="activateCallback('2')" />
                                            <Button label="Next" icon="pi pi-arrow-right" iconPos="right"
                                                @click="submitMobileDeviceForm" />
                                        </div>
                                    </StepPanel>
                                </StepItem>
                            </Stepper>
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

const page = usePage();

const createMobileDeviceForm = useForm({
    brand_id: null,
    model_id: null,
    category_id: null,
    storage_capacity: null,
    color: null,
    condition: null,
    price: null,
    listing_title: null,
    listing_description: null,
    damage_wear_description: null,
    images: [],
});

const validationErrorsImages = computed(() => ({
    images: page.props.errors.images ? [page.props.errors.images] : []
}));

const handleImagesChange = (media) => {
    createMobileDeviceForm.images = media;
};

const submitMobileDeviceForm = () => {
    createMobileDeviceForm.post(route("mobile-device.store"), {
        preserveScroll: true,
        onSuccess: () => {
            // Add success notification/redirect logic here
        },
        onError: (errors) => {
            console.error('Form submission failed:', errors);
            // Add error notification logic here
        }
    });
};

const home = ref({
    icon: 'pi pi-home'
});
const items = ref([
    { label: 'Categories' }
]);

const storage = ref([
    { label: '64GB', value: '64' },
    { label: '128GB', value: '128' },
    { label: '256GB', value: '256' },
    { label: '512GB', value: '512' }
]);

const conditions = ref([
    { label: 'New', value: 'new' },
    { label: 'Mint', value: 'mint' },
    { label: 'Good', value: 'good' },
    { label: 'Fair', value: 'fair' },
]);

const validateAndProceed = async (activateCallback, fromStep) => {
    const stepValidationMap = {
        '1': ['storage_capacity', 'condition'],
        '2': ['listing_title', 'listing_description', 'damage_wear_description'],
        '3': ['images']
    };

    const stepData = {};
    stepValidationMap[fromStep]?.forEach(field => {
        stepData[field] = createMobileDeviceForm[field];
    });

    const validationForm = useForm(stepData);
    await validationForm.post(route('mobile-device.validate-step', fromStep), {
        preserveScroll: true,
        onSuccess: () => {
            createMobileDeviceForm.clearErrors();
            activateCallback(String(Number(fromStep) + 1));
        },
        onError: (errors) => {
            Object.entries(errors).forEach(([key, value]) => {
                createMobileDeviceForm.setError(key, value);
            });
        }
    });
};

const handleCoverArtChange = (media) => {
    createMobileDeviceForm.images = media;
};

</script>
