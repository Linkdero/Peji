<template>
    <section id="about" class="about section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <!-- <span class="section-badge">
                <i class="bi bi-info-circle"></i>
                Acerca de: {{ informacion.empresa_nombre }}
            </span> -->
            <div class="row">
                <div class="col-lg">
                    <h2 class="about-title">{{ informacion.empresa_nombre }}</h2>
                    <p class="about-description">{{ informacion.empresa_detalle }}</p>
                </div>
            </div>

            <div class="row features-boxes gy-4 mt-3">
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-box">
                        <div class="icon-box">
                            <i class="bi bi-bullseye"></i>
                        </div>
                        <h3><a href="#" class="stretched-link">Calidad superior</a></h3>
                        <p>Seleccionamos proveedores y materiales de primer nivel para garantizar excelencia en cada
                            evento.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-box">
                        <div class="icon-box">
                            <i class="bi bi-person-check"></i>
                        </div>
                        <h3><a href="#" class="stretched-link">Elegancia atemporal</a></h3>
                        <p>Diseños sofisticados y ambientes cuidadosamente curados para reflejar distinción.</p>
                    </div>
                </div>

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-box">
                        <div class="icon-box">
                            <i class="bi bi-clipboard-data"></i>
                        </div>
                        <h3><a href="#" class="stretched-link">Servicio personalizado</a></h3>
                        <p>Escuchamos tus necesidades y adaptamos cada aspecto para superar tus expectativas.</p>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-8 mx-auto" data-aos="zoom-in" data-aos-delay="200">
                    <!-- Limita el ancho con col-lg-8 y mx-auto para centrar -->
                    <div class="video-box">
                        <img src="assets/miniatura-video.webp" class="img-fluid w-75 mx-auto d-block"
                            alt="Video Thumbnail"> <!-- w-75 reduce el ancho al 75% -->
                        <a href="https://www.instagram.com/reel/DFJDsj2PS4Q/" class="glightbox pulsating-play-btn"></a>
                    </div>
                </div>
            </div>
        </div>

    </section>
</template>
<script>
import { Head, Link, usePage } from '@inertiajs/vue3';
import axios from 'axios';

export default {
    props: ['informacion', "categorias"],
    components: {
        Head,
        Link,
    },

    data() {
        return {
            titulo: 'Acerca de:',
        }
    },
    created() {
    },
    methods: {
    }
}
</script>
