<template>

    <Head title="Home" />

    <slot>

        <div class="px-4 sm:px-6 lg:mx-auto lg:max-w-6xl lg:px-8 font-mono">
            <div class="py-5 md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <div class="flex items-center">
                        <div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </slot>

</template>

<script setup>
import { Head, usePage } from '@inertiajs/vue3'
import { computed, ref, onMounted } from 'vue'
import Default from '../Layouts/Default.vue'
import Button from 'primevue/button'
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';
import TabPanels from 'primevue/tabpanels';
import TabPanel from 'primevue/tabpanel';

defineProps({

})

defineOptions({
    layout: Default
})

const page = usePage()

</script>

