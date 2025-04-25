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
                                <a href="#" class="fw-bold link-primary">Nuevos Banners</a>.
                            </div>
                        </div>
                        <InputGaleriaDinamica :titulo="'Galería de Imágenes'"
                            @imagenes-seleccionadas="actualizarGaleria" />
                        <div v-show="validarFormulario" class="text-center">
                            <a @click="setNuevoBanner()" href="#" class="btn btn-sm btn-success">
                                <span class="indicator-label">
                                    <i class="ki-duotone ki-plus-circle                        ">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Publicar Banners</span>
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
import axios from 'axios';
import Swal from 'sweetalert2';
import InputGaleriaDinamica from '@/components/Peji-Admin/components/elements/InputGaleriaDinamica.vue';

export default {
    data() {
        return {
            titulo: 'Publica Nuevo Banner',
            idModal: 'modal_nuevo_banner',
            galeriaSeleccionada: [],
            loading: false
        }
    },
    components: {
        InputGaleriaDinamica
    },
    computed: {
        validarFormulario() {
            return this.galeriaSeleccionada.length > 0
        }
    },
    methods: {
        actualizarGaleria(imagenes) {
            this.galeriaSeleccionada = imagenes;
        },

        async setNuevoBanner() {
            const confirmacion = await Swal.fire({
                title: '¿Publicar Banners?',
                text: "¿Deseas publicar estos nuevos Banners?",
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

                // Agregar cada imagen al FormData
                this.galeriaSeleccionada.forEach((imagen, index) => {
                    formData.append(`imagenes[${index}]`, imagen);
                });

                // Estado por defecto (opcional)
                formData.append('id_estado', 1);

                // Enviar a la ruta correcta
                const response = await axios.post('/apiBanner/banner/setNuevoBanner', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                });

                if (response.data.success) {
                    await Swal.fire({
                        title: '¡Éxito!',
                        text: 'Los banners se han publicado correctamente.',
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                    });

                    this.resetFormulario();
                    const modal = bootstrap.Modal.getInstance(document.getElementById(this.idModal));
                    if (modal) modal.hide();
                    this.$emit('publicacion-exitosa');
                }
            } catch (error) {
                console.error('Error al publicar banners:', error);
                let mensaje = 'Ocurrió un error al publicar los banners.';

                if (error.response?.data?.message) {
                    mensaje = error.response.data.message;
                }

                await Swal.fire({
                    title: 'Error',
                    text: mensaje,
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            } finally {
                this.loading = false;
            }
        },

        resetFormulario() {
            this.galeriaSeleccionada = [];
        }
    },
}
</script>