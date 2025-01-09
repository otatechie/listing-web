import { createApp, h } from "vue";
import { createPinia } from 'pinia';
import { createInertiaApp, Link, router } from "@inertiajs/vue3";
import { ZiggyVue } from "ziggy-js";
import NProgress from "nprogress";
import Default from "./Layouts/Default.vue";
import Nav from "./Layouts/Nav.vue";
import BaseLayout from "./Layouts/BaseLayout.vue";
import Auth from "./Layouts/Auth.vue";
import PrimeVue from "primevue/config";
import Lara  from "@primevue/themes/lara";
import "primeicons/primeicons.css";
import ToastService from "primevue/toastservice";
import { definePreset } from "@primevue/themes";
import Tooltip from "primevue/tooltip";
import Toast from "primevue/toast";
import ProgressBar from "primevue/progressbar";
import "@spatie/media-library-pro-styles";
import { MediaLibraryAttachment } from 'media-library-pro-vue3-attachment';
import { MediaLibraryCollection } from 'media-library-pro-vue3-collection';

router.on("start", () => NProgress.start());
router.on("finish", () => NProgress.done());
router.on("error", () => NProgress.done());

const pinia = createPinia();

createInertiaApp({
    progress: {
        delay: 250,
        color: "#ffa500",
        includeCSS: true,
        showSpinner: true,
    },

    title: (title) => `${title} - Paxfund`,

    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        return pages[`./Pages/${name}.vue`];
    },

    setup({ el, App, props, plugin }) {
        const MyPreset = definePreset(Lara, {
            semantic: {
                primary: {
                    50: "{cyan.50}",
                    100: "{cyan.100}",
                    200: "{cyan.200}",
                    300: "{cyan.300}",
                    400: "{cyan.400}",
                    500: "{cyan.500}",
                    600: "{cyan.600}",
                    700: "{cyan.700}",
                    800: "{cyan.800}",
                    900: "{cyan.900}",
                    950: "{cyan.950}",
                },
            },
        });

        const app = createApp({ render: () => h(App, props) });

        app.use(plugin)
            .use(pinia)
            .use(ToastService)
            .use(ZiggyVue)
            .use(PrimeVue, {
                theme: {
                    preset: MyPreset,
                },
                ripple: true
            });

        app.directive("tooltip", Tooltip);

        const globalComponents = {
            Link,
            Default,
            Nav,
            BaseLayout,
            Auth,
            Toast,
            ProgressBar,
            MediaLibraryAttachment,
            MediaLibraryCollection,
        };

        Object.entries(globalComponents).forEach(([name, component]) => {
            app.component(name, component);
        });

        app.mount(el);

        return app;
    },
});
