<template>
    <section id="latest-posts" class="latest-posts section">

        <div class="container section-title" data-aos="fade-up">
            <h2>{{ titulo }}</h2>
            <div> <span class="description-title">{{ subTitulo }}</span></div>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                <div class="col-lg-4" v-for="u in ultimasNoticias" :key="u.id_noticia">
                    <article>

                        <div class="post-img">
                            <img :src="`/noticias/miniaturas/${u.miniatura}`" alt="" class="img-fluid">
                        </div>

                        <p class="post-category">{{ u.categoria.categoria_detalle }}</p>

                        <h2 class="title">
                            <Link :href="'noticia/' + u.id_noticia">{{ u.noticia_titulo }}</Link>
                        </h2>

                        <div class="d-flex align-items-center">
                            <img src="https://i1.sndcdn.com/artworks-LSDOiTFsz6jZzwk1-nKbxSw-t500x500.jpg" alt=""
                                class="img-fluid post-author-img flex-shrink-0">
                            <div class="post-meta">
                                <p class="post-author">{{ u.creador.name }}</p>
                                <p class="post-date">
                                    <time>{{ u.fecha_creacion }}</time>
                                </p>
                            </div>
                        </div>

                    </article>
                </div>

            </div>
        </div>

    </section>
</template>

<script>
import { Head, Link, usePage } from '@inertiajs/vue3';
import axios from 'axios';

export default {
    components: {
        Head,
        Link,
    },
    data() {
        return {
            titulo: 'Ultimas Noticias',
            subTitulo: 'Visite nuestras ultimas noticias',
            ultimasNoticias: []
        }
    },
    created() {
        this.getUltimasNoticias();
    },
    methods: {
        async getUltimasNoticias() {
            try {
                const response = await axios.get('/apiNoticia/noticias/getUltimasNoticias');
                this.ultimasNoticias = response.data;
                console.log('Ultimas Noticias:', this.ultimasNoticias);
            } catch (error) {
                console.error('Error al obtener Ultimas Noticias:', error);
                this.error = 'Error al cargar Ultimas Noticias';
            } finally {
            }
        },
    }
}
</script>