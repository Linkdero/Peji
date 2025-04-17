<template>
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="container section-title" data-aos="fade-up">
                <h2>{{ titulo }}</h2>
                <div><span class="description-title">{{ subTitulo }}</span></div>
            </div>

            <div class="form-wrapper" data-aos="fade-up" data-aos-delay="400">
                <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" name="name" class="form-control" placeholder="Tu nombre*"
                                    required="">
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" name="email"
                                    placeholder="Tu Correo Electronico*" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                <input type="text" class="form-control" name="phone"
                                    placeholder="Tu número de Teléfono*" required="">
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-list"></i></span>
                                <select name="subject" class="form-control" required="">
                                    <option disabled selected>SELECCIONE UNA CATEGORIA</option>
                                    <option v-for="c in categorias" :value="c.id_categoria" :key="c.id_categoria">
                                        {{ c.categoria_detalle }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-chat-dots"></i></span>
                                <textarea class="form-control" name="message" rows="6"
                                    placeholder="Ingresa el motivo de la solicitud*" required=""></textarea>
                            </div>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center">
                            <button type="submit">Solicitar Información</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>

</template>
<script>
import { Head, Link, usePage } from '@inertiajs/vue3';
import axios from 'axios';
import ListadoCategorias from '@/components/Peji-Admin/components/get/ListadoCategorias.vue';

export default {
    props: ['informacion',"categorias"],
    components: {
        Head,
        Link,
        ListadoCategorias
    },
    data() {
        return {
            titulo: 'Contactanos',
            subTitulo: 'LLena el formulario y nos pondremos en contacto contigo',
        }
    },
    created() {
        console.log('Esta es la Informacion', this.informacion)
    },
    methods: {
    }
}
</script>
