// import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();

/* ************** */
/* Vue Part Start */
/* ************** */
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

createInertiaApp({
    resolve: (name) => {
        return resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob([
            './Pages/**/*.vue',
            '../images/**',
            '../fonts/**',
        ]));
    },
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .mount(el);
    },
});

/* ************ */
/* Vue Part End */
/* ************ */
