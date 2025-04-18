<template>
    <section id="blog-comments" class="blog-comments section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="blog-comments-3">
                <div class="section-header">
                    <h3>{{ titulo }} <span class="comment-count">({{ comentarios.length }})</span></h3>
                </div>

                <div class="comments-wrapper">
                    <article class="comment-card" v-for="comentario in comentarios" :key="comentario.id_comentario">
                        <div class="comment-header">
                            <div class="user-info">
                                <img src="https://www.iconpacks.net/icons/2/free-user-icon-3296-thumb.png"
                                    alt="User avatar" loading="lazy">
                                <div class="meta">
                                    <h4 class="name">{{ comentario.usuario.usuario_nombre }}</h4>
                                    <span class="date">
                                        <i class="bi bi-calendar3"></i>
                                        {{ new Date(comentario.created_at).toLocaleDateString() }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="comment-content">
                            <p>{{ comentario.comentario_detalle }}</p>
                        </div>

                        <div class="comment-actions">
                            <button class="action-btn like-btn">
                                <i class="bi bi-hand-thumbs-up"></i>
                                <span>{{ comentario.likes.length }}</span>
                            </button>
                            <button class="action-btn reply-btn">
                                <i class="bi bi-reply"></i>
                                <span>Reply</span>
                            </button>
                        </div>

                        <!-- Respuestas -->
                        <div class="reply-thread" v-if="comentario.respuestas.length > 0">
                            <article class="comment-card reply" v-for="respuesta in comentario.respuestas"
                                :key="respuesta.id_comentario">
                                <div class="comment-header">
                                    <div class="user-info">
                                        <img src="assets/img/person/person-f-9.webp" alt="User avatar" loading="lazy">
                                        <div class="meta">
                                            <h4 class="name">{{ respuesta.usuario.usuario_nombre }}</h4>
                                            <span class="date">
                                                <i class="bi bi-calendar3"></i>
                                                {{ new Date(respuesta.created_at).toLocaleDateString() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="comment-content">
                                    <p>{{ respuesta.comentario_detalle }}</p>
                                </div>
                                <div class="comment-actions">
                                    <button class="action-btn like-btn">
                                        <i class="bi bi-hand-thumbs-up"></i>
                                        <span>{{ respuesta.likes.length }}</span>
                                    </button>
                                    <button class="action-btn reply-btn">
                                        <i class="bi bi-reply"></i>
                                        <span>Reply</span>
                                    </button>
                                </div>
                            </article>
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
    props: ['informacion', 'informacionUsuario'],
    components: {
        Head,
        Link,
    },

    data() {
        return {
            titulo: 'Comentarios:',
            comentarios:[]
        }
    },
    created() {
        console.log('Informacion:', this.informacion);
        this.getComentariosNoticia();
    },
    methods: {
        asset(path) {
            return `/` + path.replace(/^@@\//, '');
        },
        async getComentariosNoticia() {
            try {
                const response = await axios.get(`/apiNoticia/${this.informacion.id_noticia}/getComentariosNoticia`);
                this.comentarios = response.data.comentarios;
                console.log('Comentarios:', this.comentarios);
            } catch (error) {
                console.error('Error al obtener comentarios filtradas:', error);
            } finally {
            }
        },
    }
}
</script>