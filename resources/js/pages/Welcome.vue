<script>
import { Head, Link, usePage } from '@inertiajs/vue3';
import Navbar from '@/components/Semantic-HTML/Navbar.vue';
import Footer from '@/components/Semantic-HTML/Footer.vue';
import Home from '../components/Peji-Page/views/Home.vue';
import About from '../components/Peji-Page/views/About.vue';
import Contact from '../components/Peji-Page/views/Contact.vue';
import Category from '../components/Peji-Page/views/Category.vue';
import Noticia from '../components/Peji-Page/views/Noticia.vue';
import 'aos/dist/aos.css';
import axios from 'axios';
import { useUsuarioStore } from '@/store/usuarioStore';

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
            informacionEmpresa: [],
            categorias: [],
            informacionUsuario: [],
        }
    },
    created() {
        this.getInformacionUsuarioPagina();
        this.getInformacionEmpresa();
        this.getCategorias();
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
                case 'Category':
                    this.componenteActual = Category;
                    break;
                case 'Noticia':
                    this.componenteActual = Noticia;
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
                this.setCurrentComponent();
            } catch (error) {
                console.error('Error al obtener la información de la Empresa:', error);
                this.error = 'Error al cargar la información de la Empresa';
            } finally {
            }
        },
        async getCategorias() {
            try {
                const response = await axios.get('/apiCategoria/categorias/getCategoriasActivas');
                this.categorias = response.data.data;
                console.log(this.categorias);

            } catch (error) {
                console.error('Error al obtener categorias:', error);
            }
        },
        async getInformacionUsuarioPagina() {
            try {
                this.informacionUsuario = useUsuarioStore().$state;
                console.log('Información del usuario:', this.informacionUsuario);
            } catch (error) {
                console.error('Error al obtener información del usuario:', error);
            }
        },

    }
}
</script>

<template>
    <div
        class="index-page flex min-h-screen flex-col bg-[#FDFDFC] p-6 text-[#1b1b18] white:bg-[#0a0a0a] lg:justify-center lg:p-8">
        <Navbar :nombre="informacionEmpresa.empresa_nombre" :redSocial="informacionEmpresa.redes_sociales"
            :logo="informacionEmpresa.empresa_logo" />
        <div
            class="duration-750 starting:opacity-0 flex w-full items-center justify-center opacity-100 transition-opacity lg:grow">
            <div class="main">
                <component :is="componenteActual || Home" :informacion="informacionEmpresa" :categorias="categorias"
                    :noticia="$page.props.noticia || null" :informacionUsuario="informacionUsuario" />
            </div>
        </div>
        <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
            <i class="bi bi-arrow-up-short"></i>
        </a>
        <div class="h-14.5 hidden lg:block"></div>
        <Footer :nombre="informacionEmpresa.empresa_nombre" :redSocial="informacionEmpresa.redes_sociales || []"
            :telefono="informacionEmpresa.telefonos || []" :correo="informacionEmpresa.correos || []"
            :logo="informacionEmpresa.empresa_logo" :direccion="informacionEmpresa.direcciones || []"
            :categorias="categorias || []" />
    </div>
</template>