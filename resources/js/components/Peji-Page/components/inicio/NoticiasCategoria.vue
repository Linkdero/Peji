<template>
    <section id="category-section" class="category-section section">
        <div class="container section-title" data-aos="fade-up">
            <h2>{{ titulo }}</h2>
            <div> <span class="description-title">{{ subTitulo }}</span></div>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4 mb-4">
                <div class="col-lg-4" v-for="p in primerasTres" :key="p.id_noticia">
                    <article class="featured-post">
                        <div class="post-img">
                            <img :src="`/noticias/miniaturas/${p.miniatura}`" alt="" class="img-fluid" loading="lazy">
                        </div>
                        <div class="post-content">
                            <div class="category-meta">
                                <span class="post-category">{{ p.categoria.categoria_detalle }}</span>
                                <div class="author-meta">
                                    <img src="https://i1.sndcdn.com/artworks-LSDOiTFsz6jZzwk1-nKbxSw-t500x500.jpg"
                                        alt="" class="author-img">
                                    <span class="author-name">{{ p.creador.name }}</span>
                                    <span class="post-date">{{ p.fecha_creacion }}</span>
                                </div>
                            </div>
                            <h2 class="title">
                                <Link :href="'noticia/' + p.id_noticia">{{ p.noticia_titulo }}</Link>
                            </h2>
                        </div>
                    </article>
                </div>
            </div>

            <!-- List Posts -->
            <div class="row">
                <div class="col-xl-4 col-lg-6" v-for="u in ultimasSeis" :key="u.id_noticia">
                    <article class="list-post">
                        <div class="post-img">
                            <img :src="`/noticias/miniaturas/${u.miniatura}`" alt="" class="img-fluid" loading="lazy">
                        </div>
                        <div class="post-content">
                            <div class="category-meta">
                                <span class="post-category">{{ u.categoria.categoria_detalle }}</span>
                            </div>
                            <h3 class="title">
                                <Link :href="'noticia/' + u.id_noticia">{{ u.noticia_titulo }}</Link>
                            </h3>
                            <div class="post-meta">
                                <span class="post-date">{{ u.fecha_creacion }}</span>
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
            titulo: 'SECCIÓN DE CATÁLOGO',
            subTitulo: 'CATALOGO DE EVENTOS',
            todasNoticias: [],
            primerasTres: [],
            ultimasSeis: [],
        }
    },
    created() {
        this.getTodasNoticias();
    },
    computed: {
        noticiasDestacadas() {
            return this.noticias.slice(0, 3); // Las primeras 3
        },
        noticiasRestantes() {
            return this.noticias.slice(3); // Las siguientes
        }
    },
    methods: {
        async getTodasNoticias() {
            try {
                const response = await axios.get('/apiNoticia/noticias/getNoticiasActivas');
                this.todasNoticias = response.data;
                this.primerasTres = this.todasNoticias.slice(0, 3);
                this.ultimasSeis = this.todasNoticias.slice(-6);
                console.log('Todas Noticias:', this.todasNoticias);
            } catch (error) {
                console.error('Error al obtener Todas Noticias:', error);
                this.error = 'Error al cargar Todas Noticias';
            } finally {
            }
        },
    }
}
</script>