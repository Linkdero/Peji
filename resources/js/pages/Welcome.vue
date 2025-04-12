<script>
import { Head, Link, usePage } from '@inertiajs/vue3';
import Navbar from '@/components/Semantic-HTML/Navbar.vue';
import Footer from '@/components/Semantic-HTML/Footer.vue';
import Home from '../layouts/pages/Home.vue';
import About from '../layouts/pages/About.vue';
import Contact from '../layouts/pages/Contact.vue';
import 'aos/dist/aos.css';

export default {
    components: {
        Head,
        Link,
        Navbar,
        Footer
    },
    data() {
        return {
            componenteActual: null
        }
    },
    created() {
        this.setCurrentComponent();
    },
    methods: {
        setCurrentComponent() {
            const page = usePage();
            const component = page.props.component;

            switch (component) {
                case 'About':
                    this.componenteActual = About;
                    break;
                case 'Contact':
                    this.componenteActual = Contact;
                    break;
                default:
                    this.componenteActual = Home;
            }
        }
    }
}
</script>

<template>
    <div
        class="index-page flex min-h-screen flex-col bg-[#FDFDFC] p-6 text-[#1b1b18] white:bg-[#0a0a0a] lg:justify-center lg:p-8">
        <Navbar siteName="Mi Blog Personal" />
        <div
            class="duration-750 starting:opacity-0 flex w-full items-center justify-center opacity-100 transition-opacity lg:grow">
            <div class="main">
                <component :is="componenteActual || Home" />
            </div>
        </div>
        <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
            <i class="bi bi-arrow-up-short"></i>
        </a>
        <div class="h-14.5 hidden lg:block"></div>
        <Footer siteName="Mi Blog Personal" />
    </div>
</template>