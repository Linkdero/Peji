<template>
    <section id="blog-hero" class="blog-hero section">
        <div class="container section-title" data-aos="fade-up">
            <h2>{{ titulo }}</h2>
            <div><span class="description-title">{{ subTitulo }}</span></div>
        </div>
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div v-if="informacion.galeria_imagenes && informacion.galeria_imagenes.length > 0"
                id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <!-- Indicadores -->
                <div class="carousel-indicators">
                    <button v-for="(imagen, index) in informacion.galeria_imagenes" :key="imagen.id" type="button"
                        data-bs-target="#carouselExampleCaptions" :data-bs-slide-to="index"
                        :class="{ active: index === 0 }" :aria-label="'Slide ' + (index + 1)"
                        :aria-current="index === 0 ? 'true' : null"></button>
                </div>

                <!-- Slides -->
                <div class="carousel-inner">
                    <div v-for="(imagen, index) in informacion.galeria_imagenes" :key="imagen.id"
                        :class="['carousel-item', { active: index === 0 }]">
                        <img :src="asset('noticias/galeria/' + imagen.ruta)" class="d-block w-100 carousel-img"
                            :alt="'Imagen ' + (index + 1) + ' de ' + informacion.noticia_titulo">
                    </div>
                </div>

                <!-- Controles -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>

            <div v-else class="alert alert-info">
                No hay imágenes disponibles en la galería.
            </div>
        </div>
    </section>
</template>

<script>
import { Head, Link, usePage } from '@inertiajs/vue3';
import axios from 'axios';

export default {
    props: ['informacion'],
    components: {
        Head,
        Link,
    },

    data() {
        return {
            titulo: 'Galería:',
            subTitulo: 'Mira las fotografías del Evento:',
        }
    },
    created() {
    },
    methods: {
        asset(path) {
            return '/' + path.replace(/^@@\//, '');
        }
    }
}
</script>
<style scoped>
.carousel-img {
    height: 500px;
    /* Puedes ajustar el alto a lo que necesites */
    object-fit: cover;
    object-position: center;
}
</style>