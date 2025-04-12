<template>
    <div class="modal fade" :id="idModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content rounded">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <form :id="idModal + '_form'" class="form " action="#">
                        <div class="mb-13 text-center">
                            <h1 class="mb-3 h2">{{ titulo }}</h1>
                            <div class="text-muted fw-semibold fs-5">En este apartado publicarás
                                <a href="#" class="fw-bold link-primary">Nuevas Noticias</a>.
                            </div>
                        </div>
                        <InputTitulo :titulo="'Título de la Noticia'" @set-nuevo-titulo="actualizarTitulo" />
                        <div class="row g-9 mb-8">
                            <ListadoCategorias :modal="idModal" @categoria-seleccionada="actualizarCategoria" />
                            <ListadoTagsMultiples :modal="idModal" @tags-seleccionados="actualizarTags" />
                        </div>
                        <TextoEnriquecidoDetalle :titulo="'Detalle de la Noticia'"
                            @set-nuevo-detalle="actualizarDetalle" />
                        <InputFotografia :titulo="'Miniatura Noticia'" @imagen-seleccionada="actualizarMiniatura" />
                        <InputGaleriaDinamica :titulo="'Galería de Imágenes'"
                            @imagenes-seleccionadas="actualizarGaleria" />
                        <div v-show="validarFormulario" class="text-center">
                            <a @click="setNuevaPublicacion()" href="#" class="btn btn-sm btn-success">
                                <span class="indicator-label">
                                    <i class="ki-duotone ki-plus-circle                        ">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Publicar Noticia</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import InputTitulo from '@/components/Peji-Admin/components/elements/InputTitulo.vue';
import ListadoCategorias from '@/components/Peji-Admin/components/get/ListadoCategorias.vue';
import ListadoTagsMultiples from '@/components/Peji-Admin/components/get/ListadoTagsMultiples.vue';
import TextoEnriquecidoDetalle from '@/components/Peji-Admin/components/elements/TextoEnriquecidoDetalle.vue';
import InputFotografia from '@/components/Peji-Admin/components/elements/InputFotografia.vue';
import InputGaleriaDinamica from '@/components/Peji-Admin/components/elements/InputGaleriaDinamica.vue';

export default {
    data() {
        return {
            titulo: 'Publica Noticias',
            idModal: 'modal_nueva_publicacion',
            tituloSeleccionado: '',
            categoriaSeleccionada: '',
            tagsSeleccionados: [],
            detalleSeleccionado: '',
            miniaturaSeleccionada: '',
            galeriaSeleccionada: [],
        }
    },
    components: {
        InputTitulo,
        ListadoCategorias,
        ListadoTagsMultiples,
        TextoEnriquecidoDetalle,
        InputFotografia,
        InputGaleriaDinamica
    },
    computed: {
        validarFormulario() {
            return this.tituloSeleccionado !== '' &&
                this.categoriaSeleccionada !== '' &&
                this.categoriaSeleccionada !== null &&
                this.tagsSeleccionados.length > 0 &&
                this.detalleSeleccionado !== '' &&
                this.miniaturaSeleccionada !== '' &&
                this.galeriaSeleccionada.length > 0
        }
    },
    methods: {
        actualizarTitulo(n) {
            this.tituloSeleccionado = n;
            console.log('Nuevo título seleccionado:', n);
        },
        actualizarCategoria(n) {
            this.categoriaSeleccionada = n;
            console.log('Nueva categoria seleccionada:', n);
        },
        actualizarTags(n) {
            this.tagsSeleccionados = n;
            console.log('Nuevos tags seleccionados:', n);
        },
        actualizarDetalle(n) {
            this.detalleSeleccionado = n;
            console.log('Nuevo detalle seleccionado:', n);
        },
        actualizarMiniatura(n) {
            this.miniaturaSeleccionada = n;
            console.log('Nueva miniatura seleccionada:', n);
        },
        actualizarGaleria(n) {
            this.galeriaSeleccionada = n;
            console.log('Nueva galería seleccionada:', n);
        },
        async setNuevaPublicacion() {
            // Mostrar confirmación con SweetAlert
            const confirmacion = await Swal.fire({
                title: '¿Publicar Noticia?',
                text: "¿Deseas publicar esta nueva noticia?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, publicar',
                cancelButtonText: 'Cancelar'
            });

            if (!confirmacion.isConfirmed) return;

            this.loading = true;

            try {
                const formData = new FormData();
                formData.append('titulo', this.tituloSeleccionado);
                formData.append('id_categoria', this.categoriaSeleccionada);
                formData.append('tags', JSON.stringify(this.tagsSeleccionados));
                formData.append('detalle', this.detalleSeleccionado);

                // Asegúrate de que el nombre del archivo tenga extensión .webp
                if (this.miniaturaSeleccionada) {
                    formData.append('miniatura', this.miniaturaSeleccionada, 'miniatura.webp');
                }

                // Galería de imágenes
                this.galeriaSeleccionada.forEach((imagen, index) => {
                    formData.append(`galeria[${index}]`, imagen, `imagen-${index}.webp`);
                });

                // Enviar datos con Axios
                const response = await axios.post('/apiNoticia/noticias/setNuevaNoticia', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                });

                // Mostrar mensaje de éxito
                await Swal.fire({
                    title: '¡Éxito!',
                    text: 'La noticia se ha publicado correctamente.',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                });
                this.resetFormulario();

                // Cerrar modal y resetear formulario
                const modal = bootstrap.Modal.getInstance(document.getElementById(this.idModal));
                if (modal) modal.hide();
                this.$emit('publicacion-exitosa');
            } catch (error) {
                console.error('Error al publicar noticia:', error);

                let mensajeError = 'Ocurrió un error al publicar la noticia.';
                if (error.response && error.response.data.message) {
                    mensajeError = error.response.data.message;
                }

                await Swal.fire({
                    title: 'Error',
                    text: mensajeError,
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            } finally {
                this.loading = false;
            }
        },
        resetFormulario() {
            this.tituloSeleccionado = '';
            this.categoriaSeleccionada = '';
            this.tagsSeleccionados = [];
            this.detalleSeleccionado = '';
            this.miniaturaSeleccionada = '';
            this.galeriaSeleccionada = [];
        }
    },
}
</script>