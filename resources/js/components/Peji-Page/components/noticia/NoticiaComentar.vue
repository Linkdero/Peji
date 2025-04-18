<template>
    <section id="blog-comment-form" class="blog-comment-form section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="section-header">
                <h3>{{ titulo }}</h3>
                <p>{{ subTitulo }}</p>
            </div>

            <div class="row gy-3">
                <div v-if="informacionUsuario.idUsuario == ''" class="col-md-6 form-group">
                    <label for="name">Nombre *</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter your full name"
                        v-model="nombreUsuario">
                </div>

                <div v-if="informacionUsuario.correo == ''" class="col-md-6 form-group">
                    <label for="email">Correo *</label>
                    <input type="email" name="email" class="form-control" id="email"
                        placeholder="Enter your email address" v-model="correoUsuario">
                </div>

                <div class="col-12 form-group">
                    <label for="comment">Tu Comentario *</label>
                    <textarea class="form-control" name="comment" id="comment" rows="5"
                        placeholder="Escribe aqui tu comentario" v-model="comentarioUsuario"></textarea>
                </div>
                <div class="col-12 text-center" v-show="validarFormulario">
                    <button type="button" class="btn-submit" @click="setNuevoComentario()">
                        Comentar
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';
import { useUsuarioStore } from '@/store/usuarioStore';

export default {
    props: {
        informacion: {
            type: Object,
            required: true,
            default: () => ({ id_noticia: null })
        },
        informacionUsuario: Object,
    },
    data() {
        return {
            titulo: 'Comparte tu opinión:',
            subTitulo: 'Tu dirección de correo electrónico no será publicada. Los campos obligatorios están marcados *',
            nombreUsuario: '',
            correoUsuario: '',
            comentarioUsuario: '',
            idUsuario: null,
        }
    },
    created() {
        if (this.informacionUsuario.correo != '' || this.informacionUsuario.idUsuario != '' || this.informacionUsuario.nombre != '') {
            this.nombreUsuario = this.informacionUsuario.nombre || '';
            this.correoUsuario = this.informacionUsuario.correo || '';
            this.idUsuario = this.informacionUsuario.idUsuario || null;
        }
    },
    computed: {
        validarFormulario() {
            const emailValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.correoUsuario);
            return this.nombreUsuario.trim() !== '' &&
                emailValido &&
                this.comentarioUsuario.trim() !== '';
        }
    },
    methods: {
        guardarDatosUsuario(datos) {
            const usuarioStore = useUsuarioStore(); // Aquí instancias el store
            const usuarioData = {
                id: datos.id_usuario,
                nombre: datos.usuario_nombre,
                correo: datos.usuario_correo,
            };

            usuarioStore.guardarDatosUsuario(usuarioData);
            console.log('Guardado en el store:', usuarioStore.$state);
        },
        async setNuevoComentario() {
            const confirmacion = await Swal.fire({
                title: '¿Publicar Comentario?',
                html: `
                    <div class="text-start">
                        <p><strong>Comentario:</strong></p>
                        <div class="bg-light p-2 rounded">${this.comentarioUsuario}</div>
                    </div>
                    <p class="mt-3">¿Confirmas que deseas publicar este comentario?</p>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, publicar',
                cancelButtonText: 'Cancelar',
                width: '650px',
                backdrop: `
                    rgba(0,0,0,0.7)
                    url("/images/comment-icon.png")
                    center left
                    no-repeat
                `
            });

            if (!confirmacion.isConfirmed) return;

            try {
                const formData = new FormData();
                formData.append('id_noticia', this.informacion.id_noticia);
                formData.append('usuario_nombre', this.nombreUsuario.trim());
                formData.append('usuario_correo', this.correoUsuario.trim());
                formData.append('comentario_detalle', this.comentarioUsuario.trim());

                if (this.informacionUsuario.idUsuario) {
                    formData.append('id_usuario', this.idUsuario);
                }

                const { data } = await axios.post(
                    `/apiNoticia/${this.informacion.id_noticia}/setNuevoComentario`,
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }
                );
                if (data.usuario) {
                    this.guardarDatosUsuario(data.usuario);
                }
                this.comentarioUsuario = '';
                this.$emit('comentario-nuevo');

                if (data.success) {
                    await Swal.fire({
                        title: '¡Éxito!',
                        text: data.message,
                        icon: 'success',
                        timer: 1500,
                        width: '650px',
                    });
                } else {
                    throw new Error(data.message || 'Error al procesar la respuesta');
                }
            } catch (error) {
                console.error('Error en comentario:', error);
            }
        },
    }
}
</script>