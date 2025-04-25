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
        informacionUsuario: Object,
    },
    data() {
        return {
            keyComentarios: 0,
        }
    },
    components: {
        NoticiaMiniatura,
        NoticiaAutor,
        NoticiaAutorInformacion,
        NoticiaComentarios,
        NoticiaComentar,
        NoticiaGaleria
    },
    methods: {
        recargaComentarios() {
            this.keyComentarios++;
        },
        // Nueva función para procesar el HTML
        processHtmlContent(html) {
            if (!html) return '';
            
            // Reemplazar entidades HTML para iframes
            let processedHtml = html
                .replace(/&lt;iframe/g, '<iframe')
                .replace(/&lt;\/iframe&gt;/g, '</iframe>')
                .replace(/&gt;/g, '>')
                .replace(/&quot;/g, '"');
            
            return processedHtml;
        }
    },
    computed: {
        // Computed property para el contenido procesado
        processedContent() {
            return this.processHtmlContent(this.noticia.noticia_detalle);
        }
    }
}
</script>

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
                                <!-- Usamos la propiedad computada aquí -->
                                <div class="content" v-html="processedContent"></div>
                            </div>
                        </article>
                    </div>
                </section>

                <NoticiaAutorInformacion :informacion="noticia" />
                <NoticiaGaleria :informacion="noticia" />

                <NoticiaComentarios :informacion="noticia" :informacionUsuario="informacionUsuario"
                    :key="keyComentarios" />

                <NoticiaComentar :informacion="noticia" :informacionUsuario="informacionUsuario"
                    @comentario-nuevo="recargaComentarios()" />
            </div>
        </div>
    </div>
</template>
<style scoped>
/* Estilos para hacer iframes responsivos */
.content>>>iframe {
    width: 100%;
    height: auto;
    aspect-ratio: 16/9;
    /* Ajusta según la proporción que necesites */
    border: none;
    margin: 1rem 0;
}

/* Contenedor adicional para iframes */
.iframe-container {
    position: relative;
    overflow: hidden;
    width: 100%;
    padding-top: 56.25%;
    /* Proporción 16:9 */
}

.iframe-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
</style>