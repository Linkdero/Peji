<template>
    <section id="blog-hero" class="blog-hero section">
        <div class="container section-title" data-aos="fade-up">
            <h2>{{ titulo }}</h2>
            <div><span class="description-title">{{ subTitulo }}</span></div>
        </div>
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <!-- Indicadores -->
                <div class="carousel-indicators">
                    <button v-for="index in 5" :key="index" type="button" data-bs-target="#carouselExampleCaptions"
                        :data-bs-slide-to="index - 1" :class="{ active: index === 1 }" :aria-label="'Slide ' + index"
                        :aria-current="index === 1 ? 'true' : null"></button>
                </div>

                <!-- Slides -->
                <div class="carousel-inner">
                    <div v-for="index in 5" :key="index" :class="['carousel-item', { active: index === 1 }]">
                        <img :src="'/assets/banner' + index + '.webp'" class="d-block w-100 carousel-img"
                            :alt="'Banner ' + index">
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
import { Head, Link, usePage } from '@inertiajs/vue3';

export default {
    components: {
        Head,
        Link,
    },
    data() {
        return {
            titulo: 'Galeria',
            subTitulo: 'Mira nuestra galeria de eventos',
        }
    },
    // Eliminado el created() y methods ya que no se necesitan para banners estáticos
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