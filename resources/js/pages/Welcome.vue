<script>
import { Head, Link, usePage } from '@inertiajs/vue3';
import Navbar from '@/components/Semantic-HTML/Navbar.vue';
import Footer from '@/components/Semantic-HTML/Footer.vue';
import Home from '../components/Peji-Page/views/Home.vue';
import About from '../components/Peji-Page/views/About.vue';
import Contact from '../components/Peji-Page/views/Contact.vue';
import 'aos/dist/aos.css';
import axios from 'axios';

export default {
    components: {
        Head,
        Link,
        Navbar,
        Footer
    },
    data() {
        return {
            componenteActual: null,
            informacionEmpresa:[]
        }
    },
    created() {
        this.setCurrentComponent();
        this.getInformacionEmpresa();
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
        },
        async getInformacionEmpresa() {
            try {
                const response = await axios.get('/apiEmpresa/empresa/getInformacionEmpresa');
                this.informacionEmpresa = response.data;
                console.log('Información Empresa:', this.informacionEmpresa);
            } catch (error) {
                console.error('Error al obtener la información de la Empresa:', error);
                this.error = 'Error al cargar la información de la Empresa';
            } finally {
            }
        },

    }
}
</script>

<template>
    <div
        class="index-page flex min-h-screen flex-col bg-[#FDFDFC] p-6 text-[#1b1b18] white:bg-[#0a0a0a] lg:justify-center lg:p-8">
        <Navbar :nombre="informacionEmpresa.empresa_nombre" :redSocial="informacionEmpresa.redes_sociales" />
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