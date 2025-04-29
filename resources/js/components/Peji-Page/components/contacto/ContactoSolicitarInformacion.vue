<template>
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="container section-title" data-aos="fade-up">
                <h2>{{ titulo }}</h2>
                <div><span class="description-title">{{ subTitulo }}</span></div>
            </div>

            <div class="form-wrapper" data-aos="fade-up" data-aos-delay="400">
                <form @submit.prevent="confirmarEnvio" role="form" class="php-email-form">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" v-model="form.nombre" class="form-control" placeholder="Tu nombre*"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" v-model="form.correo" class="form-control"
                                    placeholder="Tu correo electrónico*" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                <input type="tel" v-model="form.telefono" class="form-control" pattern="[0-9]+"
                                    maxlength="15" placeholder="Tu número de teléfono*" required>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-list"></i></span>
                                <select v-model="form.categoria" class="form-control" required>
                                    <option disabled value="">SELECCIONE UNA CATEGORÍA</option>
                                    <option v-for="c in categorias" :value="c.categoria_detalle" :key="c.id_categoria">
                                        {{ c.categoria_detalle }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-chat-dots"></i></span>
                                <textarea class="form-control" v-model="form.mensaje" rows="6"
                                    placeholder="Ingresa el motivo de la solicitud*" required></textarea>
                            </div>
                        </div>

                        <div class="my-3">
                            <div v-if="loading" class="loading">Enviando mensaje...</div>
                            <div v-if="error" class="error-message">{{ error }}</div>
                            <div v-if="success" class="sent-message">¡Tu mensaje ha sido enviado con éxito!</div>
                        </div>
                        <div class="text-center">
                            <button type="submit" :disabled="loading">Solicitar Información</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Swal from 'sweetalert2';
import axios from 'axios';

export default {
    props: ['informacion', 'categorias'],
    data() {
        return {
            titulo: 'Contáctanos',
            subTitulo: 'Llena el formulario y nos pondremos en contacto contigo',
            form: {
                nombre: '',
                correo: '',
                telefono: '',
                categoria: '',
                mensaje: ''
            },
            loading: false,
            error: null,
            success: false
        }
    },
    methods: {
        confirmarEnvio() {
            Swal.fire({
                title: '¿Enviar mensaje?',
                text: '¿Estás seguro de que deseas enviar este mensaje?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sí, enviar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.enviarFormulario();
                }
            });
        },
        enviarFormulario() {
            this.loading = true;
            this.error = null;
            this.success = false;

            Swal.fire({
                title: 'Enviando...',
                text: 'Por favor espera mientras procesamos tu solicitud',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            axios.post('/contact', {
                name: this.form.nombre,
                email: this.form.correo,
                phone: this.form.telefono,
                subject: this.form.categoria,
                message: this.form.mensaje
            })
                .then(() => {
                    this.success = true;
                    this.resetForm();

                    Swal.fire({
                        icon: 'success',
                        title: 'Mensaje enviado',
                        text: 'Tu mensaje fue enviado con éxito.'
                    });
                })
                .catch(error => {
                    this.error = 'Hubo un error al enviar el mensaje.';
                    if (error.response?.data?.message) {
                        this.error = error.response.data.message;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: this.error
                    });
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        resetForm() {
            this.form = {
                nombre: '',
                correo: '',
                telefono: '',
                categoria: '',
                mensaje: ''
            };
        }
    }
}
</script>
