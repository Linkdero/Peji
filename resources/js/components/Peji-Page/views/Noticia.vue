<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <section id="blog-details" class="blog-details section">
                    <div class="container" data-aos="fade-up">
                        <article class="article">
                            <NoticiaMiniatura :informacion="noticia" />
                            <div class="article-content" data-aos="fade-up" data-aos-delay="100">
                                <div class="content-header">
                                    <h1 class="title">{{ noticia.noticia_titulo }} </h1>
                                    <NoticiaAutor :informacion="noticia" />
                                </div>
                                <div class="content">
                                    {{ noticia.noticia_detalle }}
                                </div>
                            </div>
                        </article>
                    </div>
                </section>

                <NoticiaAutorInformacion :informacion="noticia" />
                <NoticiaGaleria :informacion="noticia" />

                <NoticiaComentarios />

                <NoticiaComentar :informacion="noticia" />
            </div>
        </div>
    </div>
</template>

<script>
import NoticiaMiniatura from '@/components/Peji-Page/components/noticia/NoticiaMiniatura.vue';
import NoticiaAutor from '@/components/Peji-Page/components/noticia/NoticiaAutor.vue';
import NoticiaAutorInformacion from '@/components/Peji-Page/components/noticia/NoticiaAutorInformacion.vue';
import NoticiaComentarios from '@/components/Peji-Page/components/noticia/NoticiaComentarios.vue';
import NoticiaComentar from '@/components/Peji-Page/components/noticia/NoticiaComentar.vue';
import NoticiaGaleria from '@/components/Peji-Page/components/noticia/NoticiaGaleria.vue';

export default {
    props: {
        noticia: Object,
    },
    components: {
        NoticiaMiniatura,
        NoticiaAutor,
        NoticiaAutorInformacion,
        NoticiaComentarios,
        NoticiaComentar,
        NoticiaGaleria
    },
    created() {
        console.log('Noticia', this.noticia)
    },
}
</script>

<style scoped>
.noticia-container {
    padding: 1rem;
}
</style>
