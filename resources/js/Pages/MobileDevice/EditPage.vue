<template>

    <Head title="Edit Mobile Device" />

    <slot>
        <div class="card flex justify-center">
            <Stepper value="1" linear class="basis-[50rem] container-border">
                <StepList>
                    <Step value="1">Product Details</Step>
                    <Step value="2">Device Details</Step>
                    <Step value="3">Listing Information</Step>
                    <Step value="4">Upload Images</Step>
                </StepList>
                <StepPanels>
                    <!-- Product Details Panel -->
                    <StepPanel v-slot="{ activateCallback }" value="1">
                        <div class="flex flex-col p-4">
                            <div
                                class="border-2 border-dashed border-surface-200 dark:border-surface-700 rounded bg-surface-50 dark:bg-surface-950 p-6">
                                <h2 class="text-xl sm:text-2xl font-semibold">Device Specifications</h2>
                                <div class="flex items-center mt-2 mb-4">
                                    <span class="text-sm text-gray-700">Need a different brand, variant, or
                                        model?</span>
                                    <span class="group relative inline-block ml-2">
                                        <i class="pi pi-info-circle text-yellow-600 cursor-pointer" />
                                        <span
                                            class="invisible group-hover:visible hover:visible absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-3 py-1 text-xs text-white bg-gray-900 rounded-md whitespace-nowrap">
                                            If your desired option is not available, please contact support to add
                                            new items.
                                        </span>
                                    </span>
                                </div>
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 sm:gap-6 mt-6">
                                    <div>
                                        <FloatLabel variant="on">
                                            <Select v-model="editMobileDeviceForm.phone_brand_id"
                                                :options="phoneBrands" showClear class="w-full" optionLabel="name"
                                                optionValue="id"
                                                :invalid="!!editMobileDeviceForm.errors.phone_brand_id" />
                                            <label for="phone_brand_id">Brand *</label>
                                        </FloatLabel>
                                        <p v-if="editMobileDeviceForm.errors.phone_brand_id"
                                            class="mt-2 text-xs text-red-600">
                                            {{ editMobileDeviceForm.errors.phone_brand_id }}
                                        </p>
                                    </div>
                                    <div>
                                        <FloatLabel variant="on">
                                            <Select v-model="editMobileDeviceForm.phone_variant_id"
                                                :options="filteredVariants" showClear class="w-full" optionLabel="name"
                                                optionValue="id"
                                                :invalid="!!editMobileDeviceForm.errors.phone_variant_id"
                                                :disabled="!editMobileDeviceForm.phone_brand_id || filteredVariants.length === 0" />
                                            <label for="phone_variant_id">Model Series *</label>
                                        </FloatLabel>
                                        <p v-if="editMobileDeviceForm.errors.phone_variant_id"
                                            class="mt-2 text-xs text-red-600">
                                            {{ editMobileDeviceForm.errors.phone_variant_id }}
                                        </p>
                                    </div>
                                    <div>
                                        <FloatLabel variant="on">
                                            <Select v-model="editMobileDeviceForm.phone_model_id"
                                                :options="filteredModels" showClear class="w-full"
                                                optionLabel="model_number" optionValue="id"
                                                :invalid="!!editMobileDeviceForm.errors.phone_model_id"
                                                :disabled="!editMobileDeviceForm.phone_variant_id || filteredModels.length === 0" />
                                            <label for="phone_model_id">Model Number *</label>
                                        </FloatLabel>
                                        <p v-if="editMobileDeviceForm.errors.phone_model_id"
                                            class="mt-2 text-xs text-red-600">
                                            {{ editMobileDeviceForm.errors.phone_model_id }}
                                        </p>
                                    </div>
                                    <div>
                                        <FloatLabel variant="on">
                                            <Select v-model="editMobileDeviceForm.storage_capacity" :options="storage"
                                                showClear class="w-full" optionLabel="label" optionValue="value"
                                                :invalid="!!editMobileDeviceForm.errors.storage_capacity" />
                                            <label for="storage_capacity">Storage</label>
                                        </FloatLabel>
                                        <p v-if="editMobileDeviceForm.errors.storage_capacity"
                                            class="mt-2 text-xs text-red-600">{{
                                                editMobileDeviceForm.errors.storage_capacity }}</p>
                                    </div>
                                    <div>
                                        <FloatLabel variant="on">
                                            <Select v-model="editMobileDeviceForm.condition" :options="conditions"
                                                showClear class="w-full" optionLabel="label" optionValue="value"
                                                :invalid="!!editMobileDeviceForm.errors.condition" />
                                            <label for="condition">Condition</label>
                                        </FloatLabel>
                                        <p v-if="editMobileDeviceForm.errors.condition"
                                            class="mt-2 text-xs text-red-600">{{
                                                editMobileDeviceForm.errors.condition }}</p>
                                    </div>
                                    <div>
                                        <FloatLabel variant="on">
                                            <Select v-model="editMobileDeviceForm.color" :options="colors" showClear
                                                class="w-full" optionLabel="label" optionValue="value"
                                                :invalid="!!editMobileDeviceForm.errors.color" />
                                            <label for="color">Color</label>
                                        </FloatLabel>
                                        <p v-if="editMobileDeviceForm.errors.color" class="mt-2 text-xs text-red-600">
                                            {{ editMobileDeviceForm.errors.color }}
                                        </p>
                                    </div>
                                    <div v-if="editMobileDeviceForm.phone_brand_id && !isAppleBrand">
                                        <FloatLabel variant="on">
                                            <Select v-model="editMobileDeviceForm.ram" :options="ram" showClear
                                                class="w-full" optionLabel="label" optionValue="value"
                                                :invalid="!!editMobileDeviceForm.errors.ram" />
                                            <label for="ram">RAM</label>
                                        </FloatLabel>
                                        <p v-if="editMobileDeviceForm.errors.ram" class="mt-2 text-xs text-red-600">
                                            {{ editMobileDeviceForm.errors.ram }}
                                        </p>
                                    </div>
                                    <div v-if="editMobileDeviceForm.phone_brand_id && isAppleBrand">
                                        <FloatLabel variant="on">
                                            <InputNumber v-model="editMobileDeviceForm.battery_health" class="w-full"
                                                :min="0" :max="100" suffix="%"
                                                :invalid="!!editMobileDeviceForm.errors.battery_health" />
                                            <label for="battery_health">Battery Health</label>
                                        </FloatLabel>
                                        <p class="text-xs text-gray-500 mt-1">Enter battery health %
                                            (0-100)</p>
                                        <p v-if="editMobileDeviceForm.errors.battery_health"
                                            class="mt-2 text-xs text-red-600">
                                            {{ editMobileDeviceForm.errors.battery_health }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex pt-6 justify-end">
                                <Button label="Next" icon="pi pi-arrow-right"
                                    @click="validateAndProceed(activateCallback, '1')" />
                            </div>
                        </div>
                    </StepPanel>

                    <!-- New Device Details Panel -->
                    <StepPanel v-slot="{ activateCallback }" value="2">
                        <div class="flex flex-col p-4">
                            <div
                                class="border-2 border-dashed border-surface-200 dark:border-surface-700 rounded bg-surface-50 dark:bg-surface-950 p-6">
                                <h2 class="text-xl sm:text-2xl font-semibold mb-4">Device Details</h2>
                                <div class="space-y-4">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <FloatLabel variant="on">
                                                <InputText v-model="editMobileDeviceForm.imei_number" class="w-full"
                                                    :invalid="!!editMobileDeviceForm.errors.imei_number" />
                                                <label>IMEI Number *</label>
                                            </FloatLabel>
                                            <div class="mt-2 flex items-start gap-3">
                                                <div class="text-xs flex-1">
                                                    <!-- IMEI Security Info -->
                                                    <div
                                                        class="bg-blue-50/70 border border-blue-200 rounded-lg p-4 mb-3 shadow-sm">
                                                        <div
                                                            class="text-blue-800 font-semibold mb-2 flex items-center gap-2">
                                                            <i class="pi pi-shield text-blue-600 text-base"></i>
                                                            <span>Why do we need your IMEI?</span>
                                                        </div>
                                                        <div class="space-y-2.5 text-gray-600">
                                                            <div class="flex items-start gap-2.5">
                                                                <i class="pi pi-check-circle text-green-600 mt-0.5"></i>
                                                                <span>Verify device authenticity</span>
                                                            </div>
                                                            <div class="flex items-start gap-2.5">
                                                                <i class="pi pi-shield text-blue-600 mt-0.5"></i>
                                                                <span>Prevent stolen device listings</span>
                                                            </div>
                                                            <div class="flex items-start gap-2.5">
                                                                <i class="pi pi-lock text-blue-600 mt-0.5"></i>
                                                                <span>Securely hashed - never stored as
                                                                    plaintext</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- IMEI Location Instructions -->
                                                    <div
                                                        class="bg-gray-50/80 border border-gray-200 rounded-lg p-4 shadow-sm">
                                                        <div
                                                            class="text-gray-800 font-semibold mb-2 flex items-center gap-2">
                                                            <i class="pi pi-search text-gray-700 text-base"></i>
                                                            <span>How to find your IMEI:</span>
                                                        </div>
                                                        <div class="space-y-3 text-gray-600">
                                                            <div class="flex items-center gap-2.5">
                                                                <span
                                                                    class="font-mono bg-white px-2.5 py-1 rounded border border-gray-200 text-gray-700 shadow-sm">*#06#</span>
                                                                <span>Dial this code on your device</span>
                                                            </div>
                                                            <div class="flex items-center gap-2.5">
                                                                <i class="pi pi-apple text-gray-800"></i>
                                                                <span>iPhone: Settings → General → About</span>
                                                            </div>
                                                            <div class="flex items-center gap-2.5">
                                                                <i class="pi pi-android text-green-600"></i>
                                                                <span>Android: Settings → About Phone → IMEI</span>
                                                            </div>
                                                            <div class="flex items-center gap-2.5">
                                                                <i class="pi pi-box text-gray-700"></i>
                                                                <span>Check device box or original receipt</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p v-if="editMobileDeviceForm.errors.imei_number"
                                                class="mt-2 text-xs text-red-600">
                                                {{ editMobileDeviceForm.errors.imei_number }}
                                            </p>
                                        </div>
                                        <div>
                                            <FloatLabel variant="on">
                                                <InputText v-model="editMobileDeviceForm.carrier" class="w-full"
                                                    :invalid="!!editMobileDeviceForm.errors.carrier" />
                                                <label>Carrier</label>
                                            </FloatLabel>
                                            <p class="text-xs text-gray-500">Enter the carrier (e.g., Unlocked,
                                                AT&T, Verizon)</p>
                                            <p v-if="editMobileDeviceForm.errors.carrier"
                                                class="mt-2 text-xs text-red-600">
                                                {{ editMobileDeviceForm.errors.carrier }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <FloatLabel variant="on">
                                                <InputText v-model="editMobileDeviceForm.town" class="w-full"
                                                    :invalid="!!editMobileDeviceForm.errors.town" />
                                                <label>Location</label>
                                            </FloatLabel>
                                            <p v-if="editMobileDeviceForm.errors.town"
                                                class="mt-2 text-xs text-red-600">
                                                {{ editMobileDeviceForm.errors.town }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex pt-6 justify-between">
                                <Button label="Back" severity="secondary" icon="pi pi-arrow-left"
                                    @click="activateCallback('1')" />
                                <Button label="Next" icon="pi pi-arrow-right"
                                    @click="validateAndProceed(activateCallback, '2')" />
                            </div>
                        </div>
                    </StepPanel>

                    <!-- Listing Information Panel (now step 3) -->
                    <StepPanel v-slot="{ activateCallback }" value="3">
                        <div class="flex flex-col p-4">
                            <div
                                class="border-2 border-dashed border-surface-200 dark:border-surface-700 rounded bg-surface-50 dark:bg-surface-950 p-6">
                                <h2 class="text-xl sm:text-2xl font-semibold mb-4">Listing Details</h2>
                                <div class="space-y-4">
                                    <div>
                                        <FloatLabel variant="on">
                                            <InputText v-model="editMobileDeviceForm.listing_title" class="w-full"
                                                :invalid="!!editMobileDeviceForm.errors.listing_title" />
                                            <label>Listing Title *</label>
                                        </FloatLabel>
                                        <p class="text-xs text-gray-500">Create a clear, descriptive title (max 100
                                            characters)</p>
                                    </div>
                                    <div>
                                        <FloatLabel variant="on">
                                            <Textarea v-model="editMobileDeviceForm.listing_description" rows="4"
                                                class="w-full"
                                                :invalid="!!editMobileDeviceForm.errors.listing_description" />
                                            <label>Listing Description</label>
                                        </FloatLabel>
                                        <p class="text-xs text-gray-500">Describe in detail your listing and what is
                                            included for the buyer. (max 1000 characters)</p>
                                        <p v-if="editMobileDeviceForm.errors.listing_description"
                                            class="mt-2 text-xs text-red-600">
                                            {{ editMobileDeviceForm.errors.listing_description }}
                                        </p>
                                    </div>
                                    <div>
                                        <FloatLabel variant="on">
                                            <Textarea v-model="editMobileDeviceForm.damage_wear_description" rows="4"
                                                class="w-full"
                                                :invalid="!!editMobileDeviceForm.errors.damage_wear_description" />
                                            <label>Damage/Wear Description</label>
                                        </FloatLabel>
                                        <p class="text-xs text-gray-500">Describe any imperfections, damage the
                                            product has sustained, and/or repairs made. (max 1000 characters)</p>
                                        <p v-if="editMobileDeviceForm.errors.damage_wear_description"
                                            class="mt-2 text-xs text-red-600">
                                            {{ editMobileDeviceForm.errors.damage_wear_description }}
                                        </p>
                                    </div>
                                    <div>
                                        <FloatLabel variant="on">
                                            <InputNumber v-model="editMobileDeviceForm.price" :min="0" class="w-full"
                                                :invalid="!!editMobileDeviceForm.errors.price" />
                                            <label>Price (₹) *</label>
                                        </FloatLabel>
                                        <p v-if="editMobileDeviceForm.errors.price" class="mt-2 text-xs text-red-600">
                                            {{ editMobileDeviceForm.errors.price }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex pt-6 justify-between">
                                <Button label="Back" severity="secondary" icon="pi pi-arrow-left"
                                    @click="activateCallback('2')" />
                                <Button label="Next" icon="pi pi-arrow-right"
                                    @click="validateAndProceed(activateCallback, '3')" />
                            </div>
                        </div>
                    </StepPanel>

                    <!-- Upload Images Panel (now step 4) -->
                    <StepPanel v-slot="{ activateCallback }" value="4">
                        <div class="flex flex-col p-4">
                            <div class="border-2 border-dashed border-surface-200 dark:border-surface-700 rounded bg-surface-50 dark:bg-surface-950 p-6">
                                <div class="mb-4">
                                    <h2 class="text-xl sm:text-2xl font-semibold">Upload Images</h2>
                                    <p class="text-sm text-gray-600 mt-1">Upload up to 5 high-quality images of your device</p>
                                </div>

                                <!-- Image Upload Section -->
                                <label for="images" class="text-gray-500 font-medium text-sm">Device Images</label>
                                <div class="mt-3">
                                    <media-library-collection
                                        name="images"
                                        :initial-value="mobileDevice.media.images"
                                        :validation-rules="{
                                            accept: ['image/jpeg', 'image/png', 'image/jpg'],
                                            maxSizeInKB: 5048
                                        }"
                                        :max-items="5"
                                        multiple
                                        @change="handleImagesChange"
                                    />
                                </div>
                            </div>
                            <div class="flex pt-6 justify-between">
                                <Button label="Back" severity="secondary" icon="pi pi-arrow-left" @click="activateCallback('3')" />
                                <Button label="Submit" icon="pi pi-check" iconPos="right" @click="submitMobileDeviceForm" />
                            </div>
                        </div>
                    </StepPanel>
                </StepPanels>
            </Stepper>
        </div>
    </slot>

</template>

<script setup>
import Default from '../../Layouts/Default.vue';
import { computed, ref, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';
import Stepper from 'primevue/stepper';
import StepList from 'primevue/steplist';
import Step from 'primevue/step';
import StepPanels from 'primevue/steppanels';
import StepPanel from 'primevue/steppanel';
import Button from 'primevue/button';
import FloatLabel from 'primevue/floatlabel';
import Select from 'primevue/select';
import Breadcrumb from 'primevue/breadcrumb';
import { Head, useForm } from '@inertiajs/vue3';
import Textarea from 'primevue/textarea';
import InputText from 'primevue/inputtext';
import InputNumber from 'primevue/inputnumber';
import axios from 'axios';


defineOptions({
    layout: Default,
})

const props = defineProps({
    phoneBrands: Array,
    phoneModels: Array,
    phoneVariants: Array,
    mobileDevice: Object,
});

const page = usePage();

const editMobileDeviceForm = useForm({
    phone_brand_id: props.mobileDevice.phone_brand_id,
    phone_model_id: props.mobileDevice.phone_model_id,
    phone_variant_id: props.mobileDevice.phone_variant_id,
    storage_capacity: props.mobileDevice.storage_capacity,
    ram: props.mobileDevice.ram,
    color: props.mobileDevice.color,
    condition: props.mobileDevice.condition,
    price: props.mobileDevice.price,
    listing_title: props.mobileDevice.listing_title,
    listing_description: props.mobileDevice.listing_description,
    damage_wear_description: props.mobileDevice.damage_wear_description,
    images:  [],
    battery_health: props.mobileDevice.battery_health,
    carrier: props.mobileDevice.carrier,
    city: props.mobileDevice.city,
    address: props.mobileDevice.address,
    imei_number: props.mobileDevice.imei_number,
    is_active: props.mobileDevice.is_active,
    town: props.mobileDevice.town,
});

const validationErrorsImages = computed(() => ({
    images: page.props.errors.images ? [page.props.errors.images] : []
}));

const handleImagesChange = (media) => {
    editMobileDeviceForm.images = media;
};

const submitMobileDeviceForm = () => {
    editMobileDeviceForm.patch(route("mobile-device.update", props.mobileDevice.id), {
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
    { label: '512GB', value: '512' },
    { label: '1TB', value: '1024' }
]);

const conditions = ref([
    { label: 'New', value: 'new' },
    { label: 'Mint', value: 'mint' },
    { label: 'Good', value: 'good' },
    { label: 'Fair', value: 'fair' },
]);

const ram = ref([
    { label: '2GB', value: '2' },
    { label: '4GB', value: '4' },
    { label: '6GB', value: '6' },
    { label: '8GB', value: '8' },
    { label: '12GB', value: '12' },
    { label: '16GB', value: '16' },
    { label: '32GB', value: '32' },
]);

const unsortedColors = [
    { label: 'Black', value: 'black' },
    { label: 'White', value: 'white' },
    { label: 'Gold', value: 'gold' },
    { label: 'Pacific Blue', value: 'pacific_blue' },
    { label: 'Deep Purple', value: 'deep_purple' },
    { label: 'Sierra Blue', value: 'sierra_blue' },
    { label: 'Midnight', value: 'midnight' },
    { label: 'Starlight', value: 'starlight' },
    { label: 'Space Gray', value: 'space_gray' },
    { label: 'Silver', value: 'silver' },
    { label: 'Rose Gold', value: 'rose_gold' },
    { label: 'Purple', value: 'purple' },
    { label: 'Pink', value: 'pink' },
    { label: 'Mint', value: 'mint' },
    { label: 'Lavender', value: 'lavender' },
    { label: 'Green', value: 'green' },
    { label: 'Gray', value: 'gray' },
    { label: 'Graphite', value: 'graphite' },
    { label: 'Cream', value: 'cream' },
    { label: 'Coral', value: 'coral' },
    { label: 'Burgundy', value: 'burgundy' },
    { label: 'Blue', value: 'blue' },
    { label: 'Alpine Green', value: 'alpine_green' },
    { label: 'Titanium', value: 'titanium' },
    { label: 'Yellow', value: 'yellow' }
];

const colors = ref(unsortedColors.sort((a, b) => a.label.localeCompare(b.label)));

const filteredVariants = computed(() => {
    if (!editMobileDeviceForm.phone_brand_id) {
        return [];
    }
    return props.phoneVariants.filter(variant =>
        variant.phone_brand_id === editMobileDeviceForm.phone_brand_id
    );
});

const filteredModels = computed(() => {
    if (!editMobileDeviceForm.phone_variant_id) {
        return [];
    }
    return props.phoneModels.filter(model =>
        model.phone_variant_id === editMobileDeviceForm.phone_variant_id
    );
});

const isAppleBrand = computed(() => {
    if (!props.phoneBrands) return false;

    const appleBrandId = props.phoneBrands.find(brand =>
        brand.name.toLowerCase() === 'apple'
    )?.id;
    return editMobileDeviceForm.phone_brand_id === appleBrandId;
});

const validateAndProceed = async (activateCallback, fromStep) => {
    const stepValidationMap = {
        '1': {
            storage_capacity: editMobileDeviceForm.storage_capacity,
            condition: editMobileDeviceForm.condition,
            phone_brand_id: editMobileDeviceForm.phone_brand_id,
            phone_variant_id: editMobileDeviceForm.phone_variant_id,
            phone_model_id: editMobileDeviceForm.phone_model_id,
            color: editMobileDeviceForm.color,
            is_apple: isAppleBrand.value,
            ...(isAppleBrand.value
                ? { battery_health: editMobileDeviceForm.battery_health }
                : { ram: editMobileDeviceForm.ram }
            )
        },
        '2': {
            imei_number: editMobileDeviceForm.imei_number,
            carrier: editMobileDeviceForm.carrier
        },
        '3': {
            listing_title: editMobileDeviceForm.listing_title,
            listing_description: editMobileDeviceForm.listing_description,
            damage_wear_description: editMobileDeviceForm.damage_wear_description,
            price: editMobileDeviceForm.price
        },
        '4': {
            images: editMobileDeviceForm.images
        }
    };

    if (!stepValidationMap[fromStep]) {
        return;
    }

    try {
        const response = await axios.post(
            route('mobile-device.validate-step', { step: fromStep }),
            stepValidationMap[fromStep]
        );

        // If validation passes, clear errors for this step's fields
        Object.keys(stepValidationMap[fromStep]).forEach(field => {
            editMobileDeviceForm.clearErrors(field);
        });

        // Proceed to next step
        activateCallback(String(Number(fromStep) + 1));

    } catch (error) {
        if (error.response?.data?.errors) {
            // Clear previous errors first
            editMobileDeviceForm.clearErrors();

            // Set new validation errors
            Object.entries(error.response.data.errors).forEach(([field, messages]) => {
                const errorMessage = Array.isArray(messages) ? messages[0] : messages;
                editMobileDeviceForm.setError(field, errorMessage);
            });
        }
    }
};
</script>
