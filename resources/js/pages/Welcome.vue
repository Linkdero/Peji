<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Navbar from '@/components/Semantic-HTML/Navbar.vue';
import Footer from '@/components/Semantic-HTML/Footer.vue';
import Home from '../layouts/pages/Home.vue';
import About from '../layouts/pages/About.vue'; // Importa los nuevos componentes
import Contact from '../layouts/pages/Contact.vue'; // Importa los nuevos componentes
import AOS from 'aos';
import 'aos/dist/aos.css';
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true,
});

// Obtener el componente actual de las props
const currentComponent = computed(() => {
    const { component } = usePage().props;
    switch (component) {
        case 'Home': return Home;
        case 'About': return About;
        case 'Contact': return Contact;
        default: return Home;
    }
});
</script>

<template>

    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div
        class="index-page flex min-h-screen flex-col bg-[#FDFDFC] p-6 text-[#1b1b18] white:bg-[#0a0a0a] lg:justify-center lg:p-8">
        <Navbar siteName="Mi Blog Personal" />
        <div
            class="duration-750 starting:opacity-0 flex w-full items-center justify-center opacity-100 transition-opacity lg:grow">
            <div class="main">
                <component :is="currentComponent" />
            </div>
        </div>
        <div class="h-14.5 hidden lg:block"></div>
        <Footer siteName="Mi Blog Personal" />
    </div>
</template>