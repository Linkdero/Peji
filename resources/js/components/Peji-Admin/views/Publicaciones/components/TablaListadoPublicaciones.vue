<template>
    <div class="container mt-4">
        <h2 class="mb-4">{{ titulo }}</h2>
        <div class="row">
            <div class="col-md-4 mb-4" v-for="noticia in noticias" :key="noticia.id_noticia">
                <div class="card h-100 shadow-sm">
                    <img :src="`/noticias/miniaturas/${noticia.miniatura}`" class="card-img-top" alt="Miniatura"
                        style="object-fit: cover; height: 200px;" />
                    <div class="card-body">
                        <h5 class="card-title">{{ noticia.noticia_titulo }}</h5>
                        <p class="card-text text-muted mb-1">
                            <strong>Categoría:</strong> {{ noticia.categoria.categoria_detalle }}
                        </p>
                        <p class="card-text text-muted">
                            <strong>Creado por:</strong> {{ noticia.creador.name }}
                        </p>
                    </div>
                    <div class="card-footer text-end">
                        <small class="text-muted">{{ noticia.fecha_creacion }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import axios from 'axios';

export default {
    props: ['modal'],
    data() {
        return {
            titulo: 'Listado de Noticias',
            noticias: [],
            estado: 2
        }
    },
    mounted() {
        this.getNoticiasEstados()
    },
    methods: {
        async getNoticiasEstados() {
            try {
                const response = await axios.get('/apiNoticia/noticias/getNoticiasEstados', {
                    params: {
                        estado: this.estado
                    }
                });
                this.noticias = response.data;
                console.log(this.noticias);
            } catch (error) {
                console.error('Error al obtener noticias:', error);
            }
        },
    },
}
</script>

<style scoped>
.card-title {
    font-size: 1.25rem;
}
</style>
