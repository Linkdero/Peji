<template>
    <section id="featured-posts" class="featured-posts section">
        <div class="container section-title" data-aos="fade-up">
            <h2>{{ titulo }}</h2>
            <div><span class="description-title">{{ subTitulo }}</span></div>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="blog-posts-slider swiper" ref="swiperContainer">
                <div class="swiper-wrapper">
                    <div v-for="noticia in primerasNoticias" :key="noticia.id_noticia" class="swiper-slide">
                        <div class="blog-post-item">
                            <img :src="'/noticias/miniaturas/' + noticia.miniatura" alt="Imagen de la noticia">
                            <div class="blog-post-content">
                                <div class="post-meta">
                                    <span><i class="bi bi-person"></i> {{ noticia.creador.name }}</span>
                                    <span><i class="bi bi-clock"></i> {{ noticia.fecha_creacion }}</span>
                                    <span><i class="bi bi-chat-dots"></i> 0 Comentarios</span>
                                </div>
                                <h2>
                                    <Link :href="'noticia/' + noticia.id_noticia">{{ noticia.noticia_titulo }}</Link>
                                </h2>
                                <p>{{ noticia.noticia_detalle }}</p>
                                <Link :href="'noticia/' + noticia.id_noticia" class="read-more">Leer más <i
                                    class="bi bi-arrow-right"></i></Link>

                            </div>
                        </div>

                    </div><!-- End slide item -->
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import { Head, Link, usePage } from '@inertiajs/vue3';
import Swiper from 'swiper';
import 'swiper/css';
import axios from 'axios';

export default {
    components: {
        Head,
        Link,
    },
    data() {
        return {
            titulo: 'Noticias Populares',
            subTitulo: 'Visite nuestras noticias populares',
            primerasNoticias: []
        }
    },
    mounted() {
        this.getPrimerasNoticias();

    },
    methods: {
        async getPrimerasNoticias() {
            try {
                const response = await axios.get('/apiNoticia/noticias/getPrimerasNoticias');
                this.primerasNoticias = response.data;
                console.log('Primeras Noticias:', this.primerasNoticias);
            } catch (error) {
                console.error('Error al obtener Primeras Noticias:', error);
                this.error = 'Error al cargar Primeras Noticias';
            } finally {
            }
        },

    }

}
</script>