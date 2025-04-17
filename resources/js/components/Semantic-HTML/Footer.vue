<template>
    <footer id="footer" class="footer" v-if="datosValidos">
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="/" class="logo d-flex align-items-center">
                        <span class="sitename">
                            <a href="#" class="logo d-flex align-items-end">
                                <div class="author-image" v-if="logo">
                                    <img :src="asset('@@/logo/logo.webp')" alt="Logotipo" class="img-fluid rounded">
                                </div>
                            </a>
                        </span>
                    </a>
                    <div class="footer-contact">
                        <p v-if="direccionPrincipal">{{ direccionPrincipal }}</p>
                        <p class="" v-if="telefonoPrincipal">
                            <strong>Télefono:</strong> <span>{{ telefonoPrincipal }}</span>
                        </p>
                        <p v-if="correoPrincipal">
                            <strong>Correos:</strong> <span>{{ correoPrincipal }}</span>
                        </p>
                    </div>
                    <div class="social-links d-flex mt-4" v-if="redSocial.length > 0">
                        <a target="_blank" rel="noopener" v-for="(red, index) in redSocial" :key="index"
                            :href="red.link">
                            <i :class="red.red_social?.icon || 'bi bi-link'"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Enlaces Útiles</h4>
                    <ul>
                        <li><a href="/">Inicio</a></li>
                        <li><a href="/about">Nosotros</a></li>
                        <li><a href="#">Servicios</a></li>
                        <li><a href="#">Términos de servicio</a></li>
                        <li><a href="#">Política de privacidad</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Nuestros Servicios</h4>
                    <ul>
                        <li v-for="c in categorias" :value="c.id_categoria" :key="c.id_categoria">
                            <a href="#">{{ c.categoria_detalle }}</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Recursos</h4>
                    <ul>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Documentación</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Soporte</a></li>
                        <li><a href="#">Contacto</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Legal</h4>
                    <ul>
                        <li><a href="#">Aviso Legal</a></li>
                        <li><a href="#">Cookies</a></li>
                        <li><a href="#">Condiciones</a></li>
                        <li><a href="#">Licencias</a></li>
                        <li><a href="#">Garantías</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© 2025 - {{ new Date().getFullYear() }} <span>Copyright</span><strong class="px-1 sitename">{{ nombre || 'Mi Empresa'
                    }}</strong>
                <span>Todos los Derechos Reservados</span>
            </p>
            <div class="credits">
                Diseñado por <a href="https://github.com/Linkdero/" target="_blank" rel="noopener">Linkdero</a>
            </div>
        </div>
    </footer>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
    props: {
        nombre: {
            type: String,
            default: ''
        },
        redSocial: {
            type: Array,
            default: () => [],
            validator: valor => valor.every(red => red?.enlace && red?.red_social?.icono)
        },
        telefono: {
            type: Array,
            default: () => [],
            validator: valor => valor.every(tel => tel?.detalle)
        },
        correo: {
            type: Array,
            default: () => [],
            validator: valor => valor.every(correo => correo?.detalle)
        },
        logo: {
            type: String,
            default: ''
        },
        direccion: {
            type: Array,
            default: () => [],
            validator: valor => valor.every(dir => dir?.detalle)
        },
        categorias: {
            type: Array,
            default: () => [],
        },
    },
    components: {
        Link
    },
    computed: {
        datosValidos() {
            return this.logo || this.nombre || this.direccion.length > 0;
        },
        direccionPrincipal() {
            return this.direccion[0]?.direccion_detalle || 'Dirección no disponible';
        },
        telefonoPrincipal() {
            return this.telefono[0]?.telefono_detalle || 'Teléfono no disponible';
        },
        correoPrincipal() {
            return this.correo[0]?.correo_detalle || 'Email no disponible';
        }
    },
    methods: {
        asset(path) {
            return `/` + path.replace(/^@@\//, '');
        }
    }

};
</script>