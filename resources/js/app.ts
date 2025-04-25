import '../css/app.css';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createPinia } from 'pinia';
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate';
import type { DefineComponent } from 'vue';
import { createApp, h } from 'vue';
import { ZiggyVue } from 'ziggy-js';
import { initializeTheme } from './composables/useAppearance';
// Importamos nuestra función de inicialización
import { initializeUI } from './assets/main.js';

// Extend ImportMeta interface for Vite...
declare module 'vite/client' {
    interface ImportMetaEnv {
        readonly VITE_APP_NAME: string;
        [key: string]: string | boolean | undefined;
    }

    interface ImportMeta {
        readonly env: ImportMetaEnv;
        readonly glob: <T>(pattern: string) => Record<string, () => Promise<T>>;
    }
}

// Declaramos el tipo global para Swiper que podrías estar usando
declare global {
    interface Window {
        Swiper?: any;
        initializeUI: () => void;
    }
}

const pinia = createPinia();
const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
pinia.use(piniaPluginPersistedstate);

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./pages/${name}.vue`, import.meta.glob<DefineComponent>('./pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
        app.use(plugin).use(ZiggyVue).use(pinia).mount(el);

        // This will set light / dark mode on page load...
        initializeTheme();

        // Inicializamos los componentes UI después de que la página se monte completamente
        // Usamos setTimeout con 0ms para asegurarnos de que se ejecute después del ciclo de renderizado
        setTimeout(() => {
            initializeUI();
        }, 0);

        // Escuchamos el evento de navegación de Inertia para reinicializar los componentes
        document.addEventListener('inertia:finish', () => {
            // Reinicializamos los componentes UI después de cada navegación
            setTimeout(() => {
                console.log('Reinicializando componentes UI después de navegación');
                initializeUI();
            }, 0);
        });
    },
    progress: {
        color: '#4B5563',
    },
    
});
