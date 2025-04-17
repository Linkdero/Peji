<template>
    <section id="call-to-action" class="call-to-action section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4 justify-content-between align-items-center">
                <div class="col-lg-6">
                    <div class="cta-content" data-aos="fade-up" data-aos-delay="200">
                        <h2>SIGUENOS EN NUESTRAS REDES SOCIALES</h2>
                        <p>Siguenos para estar al tanto de los eventos que realizamos.
                        </p>
                        <div class="php-email-form cta-form" data-aos="fade-up" data-aos-delay="300">
                            <div class="d-flex align-items-center">
                            </div>

                            <!-- Redes Sociales -->
                            <div class="social-links text-center mt-4 h2">
                                <a href="https://www.instagram.com/dventusgt" class="twitter mx-3" target="_blank"><i
                                        class="bi bi-twitter"></i></a>
                                <a href="https://www.instagram.com/dventusgt" class="facebook mx-3" target="_blank"><i
                                        class="bi bi-facebook"></i></a>
                                <a href="https://www.instagram.com/dventusgt" class="instagram mx-3" target="_blank"><i
                                        class="bi bi-instagram"></i></a>
                                <a href="https://www.instagram.com/dventusgt" class="linkedin mx-3" target="_blank"><i
                                        class="bi bi-linkedin"></i></a>
                                <a href="https://www.instagram.com/dventusgt" class="youtube mx-3" target="_blank"><i
                                        class="bi bi-youtube"></i></a>
                                <a href="https://www.instagram.com/dventusgt" class="tiktok mx-3" target="_blank"><i
                                        class="bi bi-tiktok"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cta-image" data-aos="zoom-out" data-aos-delay="200">
                        <img src="/assets/cta-1.webp" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { Link, Head } from '@inertiajs/vue3';
export default {
    props: ['informacion', 'categorias'],
    components: {
        Head,
        Link,
    },
    data() {
        return {
            titulo: 'SECCIÓN DE CATÁLOGO',
            subTitulo: 'CATALOGO DE EVENTOS',
            redSocial: [],
        }
    },
    created() {
        console.log('HOLA XD', this.informacion)
        this.redSocial = this.informacion.redes_sociales
    },
    computed: {
    },
    whatch: {
    },
    methods: {

    }
}
</script>