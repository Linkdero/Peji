<template>
    <div class="hero-img" data-aos="zoom-in">
        <img :src="asset('@@/noticias/miniaturas/' + informacion.miniatura)" />
        <div class="meta-overlay">
            <div class="meta-categories">
                <a href="#" class="category">{{ informacion.categoria.categoria_detalle }}</a>
                <span class="divider">•</span>
                <span class="reading-time"><i class="bi bi-clock"></i> {{ informacion.fecha_creacion }}</span>
            </div>
        </div>
    </div>

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
            titulo: 'Acerca de:',
        }
    },
    created() {
    },
    methods: {
        asset(path) {
            return `/` + path.replace(/^@@\//, '');
        }
    }
}
</script>
