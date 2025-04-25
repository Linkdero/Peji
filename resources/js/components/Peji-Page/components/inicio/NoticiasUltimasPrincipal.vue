<template>
    <section id="blog-hero" class="blog-hero section">
        <div class="container section-title" data-aos="fade-up">
            <h2>{{ titulo }}</h2>
            <div><span class="description-title">{{ subTitulo }}</span></div>
        </div>
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="blog-grid">
                <article v-for="(n, index) in ultimasNoticias" :key="n.id_noticia"
                    :class="index < 1 ? 'blog-item featured' : 'blog-item'" :data-aos="'fade-up'"
                    :data-aos-delay="(index + 1) * 100">

                    <img :src="`/noticias/miniaturas/${n.miniatura}`" :alt="n.noticia_titulo" class="img-fluid">
                    <div class="blog-content">
                        <div class="post-meta">
                            <span class="date">{{ n.fecha_creacion }}</span>
                            <span class="category">{{ n.categoria.categoria_detalle }}</span>
                        </div>
                        <component :is="index < 2 ? 'h2' : 'h3'" class="post-title">
                            <Link :href="'noticia/' + n.id_noticia" :title="n.noticia_titulo">{{ n.noticia_titulo }}
                            </Link>
                        </component>
                    </div>
                </article>

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
            titulo: 'Ultimos Eventos',
            subTitulo: 'Visite nuestras ultimos eventos',
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