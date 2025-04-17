<template>
    <div class="tags-widget widget-item">
        <h3 class="widget-title">{{ titulo }}</h3>
        <ul>
            <li v-for="t in tags" :key="t.id_tag" @click="toggleTag(t.id_tag)"
                :class="{ seleccionado: seleccionados.includes(t.id_tag) }">
                <a href="#">{{ t.tag_detalle }}</a>
            </li>
        </ul>
    </div>
</template>

<script>
import { Head, Link, usePage } from '@inertiajs/vue3';
import axios from 'axios';

export default {
    props: ['informacion', 'categorias'],
    components: {
        Head,
        Link,
    },

    data() {
        return {
            titulo: 'Tags',
            tags: [],
            seleccionados: [], // arreglo de ids seleccionados
        };
    },

    created() {
        this.getTags();
    },

    methods: {
        async getTags() {
            try {
                const response = await axios.get('/apiTag/tags/getTagsActivos');
                this.tags = response.data.data;
            } catch (error) {
                console.error('Error al obtener tags:', error);
            }
        },

        toggleTag(id) {
            const index = this.seleccionados.indexOf(id);
            if (index > -1) {
                // ya estaba seleccionado, lo quitamos
                this.seleccionados.splice(index, 1);
            } else {
                // no estaba, lo agregamos
                this.seleccionados.push(id);
            }

            this.$emit('tags-seleccionados', this.seleccionados); // emitimos el arreglo actualizado
        },
    },
};
</script>

<style scoped>
.seleccionado a {
    color: white;
    background-color: #007bff;
    padding: 4px 8px;
    border-radius: 4px;
}
</style>
