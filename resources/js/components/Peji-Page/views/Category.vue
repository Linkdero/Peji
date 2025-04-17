<script>
import { Link } from '@inertiajs/vue3';
import CategoriasDetalle from '@/components/Peji-Page/components/categorias/CategoriasDetalle.vue';
import CategoriasPublicaciones from '@/components/Peji-Page/components/categorias/CategoriasPublicaciones.vue';
import CategoriasFiltro from '@/components/Peji-Page/components/categorias/CategoriasFiltro.vue';

export default {
    data() {
        return {
            categoriaIdSeleccionado: [],
            tagsIdSeleccionados: [],
            key: 0,
        }
    },
    components: {
        Link,
        CategoriasDetalle,
        CategoriasPublicaciones,
        CategoriasFiltro
    },
    methods: {
        tagsSeleccionados(n) {
            this.tagsIdSeleccionados = n;
            this.key++;
        },
        categoriaSeleccionada(n) {
            this.categoriaIdSeleccionado = n;
            this.key++;
        }
    }
}
</script>

<template>
    <CategoriasDetalle />

    <div class="container">
        <div class="row">
            <CategoriasPublicaciones :categoria="categoriaIdSeleccionado" :tags="tagsIdSeleccionados" :key="key" />
            <CategoriasFiltro @tags-seleccionados="tagsSeleccionados" @categoria-seleccionada="categoriaSeleccionada" />
        </div>
    </div>
</template>