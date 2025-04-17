<template>
    <div class="categories-widget widget-item">
        <h3 class="widget-title">{{ titulo }}</h3>
        <ul class="mt-3">
            <li v-for="c in categoriaConteoNoticias" :key="c.id_categoria"
                :class="{ active: categoriaSeleccionadaId === c.id_categoria }"
                @click="categoriaSeleccionada(c.id_categoria)">
                <a href="#">
                    {{ c.categoria_detalle }}
                    <span>({{ c.noticias_count }})</span>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3';
import axios from 'axios';

export default {
    props: ['informacion', 'categorias'],
    components: {
        Head,
        Link,
    },
    data() {
        return {
            titulo: 'Catálogo',
            categoriaConteoNoticias: [],
            categoriaSeleccionadaId: null, // ← Aquí guardamos cuál está seleccionada
        };
    },
    created() {
        this.getCategoriasConteoNoticias();
    },
    methods: {
        async getCategoriasConteoNoticias() {
            try {
                const response = await axios.get('/apiCategoria/categorias/getCategoriasConteoNoticias');
                this.categoriaConteoNoticias = response.data.data;
                console.log(this.categoriaConteoNoticias);
            } catch (error) {
                console.error('Error al obtener categorías:', error);
            }
        },
        categoriaSeleccionada(id) {
            if (this.categoriaSeleccionadaId === id) {
                // Si ya está seleccionada, la deselecciona
                this.categoriaSeleccionadaId = null;
                this.$emit('categoria-seleccionada', null);
            } else {
                // Si no está seleccionada, la selecciona
                this.categoriaSeleccionadaId = id;
                this.$emit('categoria-seleccionada', id);
            }
        },
    },
};
</script>

<style scoped>
li.active a {
    font-weight: bold;
    color: #007bff;
    background-color: #f0f8ff;
    border-radius: 4px;
    padding: 4px 8px;
}
</style>
