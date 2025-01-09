<template>

    <Head title="Categories" />

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
                                                                v-model="createPhoneMobileDeviceForm.storage_capacity"
                                                                :options="storage" showClear class="w-full"
                                                                optionLabel="label" optionValue="value"
                                                                :invalid="!!createPhoneMobileDeviceForm.errors.storage_capacity" />
                                                            <label for="storage_capacity">Storage</label>
                                                        </FloatLabel>
                                                        <p v-if="createPhoneMobileDeviceForm.errors.storage_capacity"
                                                            class="mt-2 text-xs text-red-600">{{
                                                                createPhoneMobileDeviceForm.errors.storage_capacity }}</p>
                                                    </div>
                                                    <div>
                                                        <FloatLabel variant="on">
                                                            <Select v-model="createPhoneMobileDeviceForm.condition"
                                                                :options="conditions" showClear class="w-full"
                                                                optionLabel="label" optionValue="value"
                                                                :invalid="!!createPhoneMobileDeviceForm.errors.condition" />
                                                            <label for="condition">Condition</label>
                                                        </FloatLabel>
                                                        <p v-if="createPhoneMobileDeviceForm.errors.condition"
                                                            class="mt-2 text-xs text-red-600">{{
                                                                createPhoneMobileDeviceForm.errors.condition }}</p>
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
                                                                v-model="createPhoneMobileDeviceForm.listing_title"
                                                                class="w-full"
                                                                :invalid="!!createPhoneMobileDeviceForm.errors.listing_title" />
                                                            <label>Listing Title</label>
                                                        </FloatLabel>
                                                        <p class="text-xs text-gray-500">Short, unique title for your
                                                            product listing. (max 100 characters)</p>
                                                        <p v-if="createPhoneMobileDeviceForm.errors.listing_title"
                                                            class="mt-2 text-xs text-red-600">
                                                            {{ createPhoneMobileDeviceForm.errors.listing_title }}
                                                        </p>
                                                    </div>

                                                    <div>
                                                        <FloatLabel variant="on">
                                                            <InputText
                                                                v-model="createPhoneMobileDeviceForm.price"
                                                                class="w-full"
                                                                :invalid="!!createPhoneMobileDeviceForm.errors.price" />
                                                            <label>Price</label>
                                                        </FloatLabel>
                                                        <p class="text-xs text-gray-500">Price of the product</p>
                                                        <p v-if="createPhoneMobileDeviceForm.errors.price"
                                                            class="mt-2 text-xs text-red-600">
                                                            {{ createPhoneMobileDeviceForm.errors.price }}
                                                        </p>
                                                    </div>

                                                    <div>
                                                        <FloatLabel variant="on">
                                                            <Textarea
                                                                v-model="createPhoneMobileDeviceForm.listing_description"
                                                                rows="4" class="w-full"
                                                                :invalid="!!createPhoneMobileDeviceForm.errors.listing_description" />
                                                            <label>Listing Description</label>
                                                        </FloatLabel>
                                                        <p class="text-xs text-gray-500">Describe in detail your listing
                                                            and
                                                            what is included for the buyer. (max 1000 characters)</p>
                                                        <p v-if="createPhoneMobileDeviceForm.errors.listing_description"
                                                            class="mt-2 text-xs text-red-600">
                                                            {{ createPhoneMobileDeviceForm.errors.listing_description }}
                                                        </p>
                                                    </div>

                                                    <div>
                                                        <FloatLabel variant="on">
                                                            <Textarea
                                                                v-model="createPhoneMobileDeviceForm.damage_wear_description"
                                                                rows="4" class="w-full"
                                                                :invalid="!!createPhoneMobileDeviceForm.errors.damage_wear_description" />
                                                            <label>Damage/Wear Description</label>
                                                        </FloatLabel>
                                                        <p class="text-xs text-gray-500">Describe any imperfections,
                                                            damage
                                                            the product has sustained, and/or repairs made. (max 1000
                                                            characters)</p>
                                                        <p v-if="createPhoneMobileDeviceForm.errors.damage_wear_description"
                                                            class="mt-2 text-xs text-red-600">
                                                            {{
                                                                createPhoneMobileDeviceForm.errors.damage_wear_description
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
                                                    :initial-value="createPhoneMobileDeviceForm.images"
                                                    :validation-rules="{
                                                        accept: ['image/jpeg', 'image/png', 'image/jpg'],
                                                        maxSizeInKB: 5048
                                                    }" @change="handleCoverArtChange"
                                                    :validation-errors="validationErrorsCoverArt" />
                                            </div>
                                        </div>
                                        <div
                                            class="flex flex-col sm:flex-row pt-6 justify-between space-y-4 sm:space-y-0">
                                            <Button label="Back" severity="secondary" icon="pi pi-arrow-left"
                                                @click="activateCallback('2')" />
                                            <Button label="Next" icon="pi pi-arrow-right" iconPos="right"
                                                @click="submitPhoneMobileDeviceForm" />
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
import Stepper from 'primevue/stepper';
import StepList from 'primevue/steplist';
import StepPanels from 'primevue/steppanels';
import StepItem from 'primevue/stepitem';
import Step from 'primevue/step';
import StepPanel from 'primevue/steppanel';
import Button from 'primevue/button';
import Dropdown from 'primevue/dropdown';
import FloatLabel from 'primevue/floatlabel';
import Select from 'primevue/select';
import { ref, onMounted, watch } from 'vue';
import Breadcrumb from 'primevue/breadcrumb';
import { Head, useForm } from '@inertiajs/vue3';
import Textarea from 'primevue/textarea';
import InputText from 'primevue/inputtext';

defineOptions({
    layout: Default,
})

const createPhoneMobileDeviceForm = useForm({
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

const submitPhoneMobileDeviceForm = () => {
    console.log('Submitting form with data:', createPhoneMobileDeviceForm.data());

    createPhoneMobileDeviceForm.post(route("mobile-device.store"), {
        preserveScroll: true,
        onSuccess: (response) => {
            console.log('Form submission successful:', response);
            toast.add({
                severity: 'success',
                summary: 'Success',
                detail: 'Device added successfully',
                life: 3000
            });
            router.visit(route('phone-mobile-device.index'));
        },
        onError: (errors) => {
            console.error('Form submission failed:', errors);
            toast.add({
                severity: 'error',
                summary: 'Error',
                detail: 'There was an error saving your device. Please check the form and try again.',
                life: 3000
            });

            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
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
    // Send only the fields relevant to the current step
    const stepData = {};
    switch (fromStep) {
        case '1':
            stepData.storage_capacity = createPhoneMobileDeviceForm.storage_capacity;
            stepData.condition = createPhoneMobileDeviceForm.condition;
            break;
        case '2':
            stepData.listing_title = createPhoneMobileDeviceForm.listing_title;
            stepData.listing_description = createPhoneMobileDeviceForm.listing_description;
            stepData.damage_wear_description = createPhoneMobileDeviceForm.damage_wear_description;
            break;
        case '3':
            stepData.images = createPhoneMobileDeviceForm.images;
            break;
    }

    const validationForm = useForm(stepData);
    await validationForm.post(route('mobile-device.validate-step', fromStep), {
        preserveScroll: true,
        onSuccess: () => {
            createPhoneMobileDeviceForm.clearErrors();
            activateCallback(String(Number(fromStep) + 1));
        },
        onError: (errors) => {
            // The validation errors will be automatically set on the form
            Object.keys(errors).forEach(key => {
                createPhoneMobileDeviceForm.setError(key, errors[key]);
            });
        }
    });
};

const handleCoverArtChange = (media) => {
    createPhoneMobileDeviceForm.images = media;
};


</script>
