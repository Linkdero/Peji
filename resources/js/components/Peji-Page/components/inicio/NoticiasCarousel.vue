<!-- Componente de Carrusel -->
<template>
    <section id="carousel-section" class="section my-2">
        <div class="container-fluid p-0">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <!-- Indicadores -->
                <div class="carousel-indicators">
                    <button v-for="(banner, index) in banners" :key="'indicator-' + banner.id_banner" type="button"
                        data-bs-target="#carouselExampleCaptions" :data-bs-slide-to="index"
                        :class="{ active: index === 0 }" :aria-label="'Slide ' + (index + 1)"></button>
                </div>

                <!-- Slides -->
                <div class="carousel-inner">
                    <div v-for="(b, index) in banners" :key="'slide-' + b.id_banner"
                        :class="['carousel-item', { active: index === 0 }]">
                        <div class="carousel-img-wrapper">
                            <img :src="'/banners/' + b.banner" class="carousel-img" :alt="'Banner ' + b.id_banner">
                        </div>
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
        </div>
    </section>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3';
import axios from 'axios';

export default {
    components: {
        Head,
        Link,
    },
    data() {
        return {
            banners: [],
        }
    },
    created() {
        this.getBannersActivos();
    },
    methods: {
        async getBannersActivos() {
            try {
                const response = await axios.get('/apiBanner/banner/getBannersActivos');
                this.banners = response.data.data;
            } catch (error) {
                console.error('Error al obtener los banners:', error);
            }
        },
    }
}
</script>

<style scoped>
.section {
    width: 100%;
    padding: 0;
    margin: 0;
    overflow: hidden;
}

.container-fluid {
    max-width: 100%;
    width: 100%;
    padding: 0;
    margin: 0;
}

.carousel {
    width: 100%;
}

.carousel-inner {
    width: 100%;
}

.carousel-item {
    width: 100%;
}

.carousel-img-wrapper {
    width: 100%;
    height: auto;
    overflow: hidden;
}

.carousel-img {
    width: 100%;
    height: auto;
    max-height: 500px;
    object-fit: cover;
    object-position: center;
    display: block;
}

/* Media queries ajustados */
@media (max-width: 992px) {
    .carousel-img {
        max-height: 400px;
    }
}

@media (max-width: 768px) {
    .carousel-img {
        max-height: 300px;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 1.5rem;
        height: 1.5rem;
    }
}

@media (max-width: 576px) {
    .carousel-img {
        max-height: 200px;
    }

    .carousel-indicators {
        margin-bottom: 0;
    }

    .carousel-indicators button {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin: 0 2px;
    }
}
</style>