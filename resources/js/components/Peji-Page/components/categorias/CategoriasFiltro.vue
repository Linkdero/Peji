<template>
    <div class="col-lg-4 sidebar">
        <div class="widgets-container" data-aos="fade-up" data-aos-delay="200">
            <div class="search-widget widget-item">
                <h3 class="widget-title">Search</h3>
                <form action="">
                    <input type="text">
                    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                </form>
            </div>
            <FiltroCategoriasAgupadas @categoria-seleccionada="categoriaSeleccionada" />
            <ultimasPublicaciones />
            <FiltroTags @tags-seleccionados="tagsSeleccionados" />
        </div>

    </div>
</template>
<script>
import { Head, Link, usePage } from '@inertiajs/vue3';
import axios from 'axios';
import FiltroCategoriasAgupadas from '../components/FiltroCategoriasAgupadas.vue';
import ultimasPublicaciones from '../components/ultimasPublicaciones.vue';
import FiltroTags from '../components/FiltroTags.vue';

export default {
    props: ['informacion', "categorias"],
    components: {
        Head,
        Link,
        FiltroCategoriasAgupadas,
        ultimasPublicaciones,
        FiltroTags
    },

    data() {
        return {
            titulo: 'Categorias',
            subTitulo: 'En este apartado puedes ver todas nuestra publicaciones filtradas.',
            categoriaConteoNoticias: []
        }
    },
    created() {
    },
    methods: {
        tagsSeleccionados(n) {
            this.$emit('tags-seleccionados', n);
        },
        categoriaSeleccionada(n) {
            this.$emit('categoria-seleccionada', n);
        }
    }
}
</script>
