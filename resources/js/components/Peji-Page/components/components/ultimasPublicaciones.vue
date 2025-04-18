<template>
    <div class="recent-posts-widget widget-item">
        <h3 class="widget-title">{{ titulo }}</h3>
        <div class="post-item" v-for="u in ultimasNoticias">
            <img :src="'/noticias/miniaturas/' + u.miniatura" alt="" class="flex-shrink-0">
            <div>
                <h4>
                    <Link :href="`/noticia/${u.id_noticia}`">{{ u.noticia_titulo }}</Link>
                </h4>
                <time datetime="2020-01-01">{{ u.fecha_creacion }}</time>
            </div>
        </div>
    </div>
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
            titulo: 'Ultimas Publicaciones',
            ultimasNoticias: [],
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
