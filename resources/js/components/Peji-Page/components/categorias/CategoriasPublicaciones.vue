<template>
    <div class="col-lg-8">
        <!-- Category Posts Section -->
        <section id="category-postst" class="category-postst section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <!-- Loading State -->
                <div v-if="loading" class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                </div>

                <!-- Noticias -->
                <div class="row gy-4" v-else>
                    <div v-if="noticias.data.length === 0" class="col-12 text-center py-5">
                        <h4>No se encontraron noticias</h4>
                    </div>

                    <div class="col-lg-6" v-for="noticia in noticias.data" :key="noticia.id_noticia">
                        <article>
                            <div class="post-img">
                                <img :src="`/noticias/miniaturas/${noticia.miniatura}`" alt="Miniatura"
                                    class="img-fluid" />
                            </div>

                            <p class="post-category">{{ noticia.categoria.categoria_detalle }}</p>

                            <h2 class="title">
                                <Link :href="`/noticia/${noticia.id_noticia}`">{{ noticia.noticia_titulo }}</Link>
                            </h2>

                            <div class="d-flex align-items-center">
                                <img src="https://i1.sndcdn.com/artworks-LSDOiTFsz6jZzwk1-nKbxSw-t500x500.jpg"
                                    alt="Autor" class="img-fluid post-author-img flex-shrink-0" />
                                <div class="post-meta">
                                    <p class="post-author">{{ noticia.creador.name }}</p>
                                    <p class="post-date">
                                        <time>{{ noticia.fecha_creacion }}</time>
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pagination Section -->
        <section id="pagination-2" class="pagination-2 section" v-if="noticias.data.length > 0 && !loading">
            <div class="container">
                <div class="d-flex justify-content-center">
                    <ul class="pagination">
                        <li class="page-item" :class="{ disabled: noticias.current_page === 1 }">
                            <a class="page-link" href="#" @click.prevent="changePage(noticias.current_page - 1)">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                        </li>

                        <li class="page-item" v-for="page in displayedPages" :key="page"
                            :class="{ active: page === noticias.current_page, disabled: page === '...' }">
                            <a class="page-link" href="#" @click.prevent="page !== '...' ? changePage(page) : null">
                                {{ page }}
                            </a>
                        </li>

                        <li class="page-item" :class="{ disabled: noticias.current_page === noticias.last_page }">
                            <a class="page-link" href="#" @click.prevent="changePage(noticias.current_page + 1)">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import { Head, Link, usePage } from '@inertiajs/vue3';
import axios from 'axios';

export default {
    props: ['categoria', "tags"],
    components: {
        Head,
        Link,
    },

    data() {
        return {
            titulo: 'Categorias',
            loading: false,
            noticias: {
                data: [],
                current_page: 1,
                last_page: 1,
                per_page: 10,
                total: 0,
                links: []
            }
        }
    },

    computed: {
        // Calcula las páginas a mostrar en el paginador
        displayedPages() {
            const pages = [];
            const current = this.noticias.current_page;
            const last = this.noticias.last_page;
            const delta = 2; // Número de páginas a mostrar alrededor de la actual

            // Caso cuando hay pocas páginas
            if (last <= 7) {
                for (let i = 1; i <= last; i++) {
                    pages.push(i);
                }
                return pages;
            }

            // Rango izquierdo y derecho
            let left = current - delta;
            let right = current + delta + 1;

            // Ajustar rangos si están fuera de los límites
            if (left < 1) {
                left = 1;
                right = 1 + 2 * delta;
            }
            if (right >= last) {
                right = last;
                left = last - 2 * delta;
                if (left < 1) left = 1;
            }

            // Agregar primera página y puntos suspensivos si es necesario
            if (left > 1) {
                pages.push(1);
                if (left > 2) {
                    pages.push('...');
                }
            }

            // Agregar páginas centrales
            for (let i = left; i < right; i++) {
                pages.push(i);
            }

            // Agregar última página y puntos suspensivos si es necesario
            if (right < last) {
                if (right < last - 1) {
                    pages.push('...');
                }
                pages.push(last);
            }

            return pages;
        }
    },

    created() {
        this.getNoticiasFiltradas();
    },

    methods: {
        async getNoticiasFiltradas(page = 1) {
            this.loading = true;
            try {
                const response = await axios.get('/apiNoticia/noticias/getNoticiasFiltradas', {
                    params: {
                        id_categoria: this.categoria,
                        tags: this.tags,
                        page: page,
                        per_page: this.noticias.per_page
                    }
                });

                this.noticias = response.data;
            } catch (error) {
                console.error('Error al obtener noticias filtradas:', error);
            } finally {
                this.loading = false;
            }
        },

        changePage(page) {
            if (page >= 1 && page <= this.noticias.last_page && page !== this.noticias.current_page) {
                this.getNoticiasFiltradas(page);
                // Scroll suave al principio
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }
    }
}
</script>

<style scoped>
.pagination {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
}

.page-item {
    margin: 0 3px;
}

.page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0.5rem 0.75rem;
    color: #333;
    text-decoration: none;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.page-item.active .page-link {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}

.page-item.disabled .page-link {
    color: #6c757d;
    pointer-events: none;
    background-color: #fff;
    border-color: #dee2e6;
    opacity: 0.6;
}

.page-link:hover:not(.active) {
    background-color: #f8f9fa;
}

.post-img img {
    transition: transform 0.3s ease;
}

.post-img:hover img {
    transform: scale(1.03);
}

.title a {
    color: #212529;
    text-decoration: none;
    transition: color 0.3s ease;
}

.title a:hover {
    color: #007bff;
}
</style>