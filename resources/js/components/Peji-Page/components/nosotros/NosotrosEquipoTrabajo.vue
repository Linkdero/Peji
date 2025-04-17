<template>
    <section id="team" class="team section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>{{ titulo }}</h2>
            <div><span>{{ subTitulo }}</span> <span class="description-title">{{ informacion.empresa_nombre }}</span>
            </div>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="team-member d-flex">
                        <div class="member-img">
                            <img src="assets/anderson.webp" class="img-fluid" alt="" loading="lazy">
                        </div>
                        <div class="member-info flex-grow-1">
                            <h4>Anderson Morales</h4>
                            <span>Programador</span>
                            <p>Encargado de la página web</p>
                            <div class="social">
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-twitter-x"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                                <a href=""><i class="bi bi-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div><!-- End Team Member -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="team-member d-flex">
                        <div class="member-img">
                            <img src="assets/miguel.webp" class="img-fluid" alt="" loading="lazy">
                        </div>
                        <div class="member-info flex-grow-1">
                            <h4>Miguel Herrera</h4>
                            <span>Project Manager</span>
                            <p>Encargado de planificar los eventos</p>
                            <div class="social">
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-twitter-x"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                                <a href=""><i class="bi bi-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div><!-- End Team Member -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="team-member d-flex">
                        <div class="member-img">
                            <img src="assets/juan.webp" class="img-fluid" alt="" loading="lazy">
                        </div>
                        <div class="member-info flex-grow-1">
                            <h4>Juan Jose</h4>
                            <span>Diseñador</span>
                            <p>Encargado de diseñar los modelos para el evento</p>
                            <div class="social">
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-twitter-x"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                                <a href=""><i class="bi bi-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div><!-- End Team Member -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="team-member d-flex">
                        <div class="member-img">
                            <img src="assets/joaquin.webp" class="img-fluid" alt="" loading="lazy">
                        </div>
                        <div class="member-info flex-grow-1">
                            <h4>Joaquin Magaña</h4>
                            <span>Técnico</span>
                            <p>Encargado de realizar la infraestructura de los eventos</p>
                            <div class="social">
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-twitter-x"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                                <a href=""><i class="bi bi-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div><!-- End Team Member -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="team-member d-flex">
                        <div class="member-img">
                            <img src="assets/carlos.webp" class="img-fluid" alt="" loading="lazy">
                        </div>
                        <div class="member-info flex-grow-1">
                            <h4>Carlos Lopez</h4>
                            <span>Marketing</span>
                            <p>Encargado de publicidad</p>
                            <div class="social">
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-twitter-x"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                                <a href=""><i class="bi bi-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div><!-- End Team Member -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="team-member d-flex">
                        <div class="member-img">
                            <img src="assets/lazaro.webp" class="img-fluid" alt="" loading="lazy">
                        </div>
                        <div class="member-info flex-grow-1">
                            <h4>Lazaro Chaly</h4>
                            <span>Lazaro</span>
                            <p>Lazaro</p>
                            <div class="social">
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-twitter-x"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                                <a href=""><i class="bi bi-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div><!-- End Team Member -->

            </div>

        </div>

    </section>
</template>
<script>
import { Head, Link, usePage } from '@inertiajs/vue3';
import axios from 'axios';

export default {
    props: ['informacion', "categorias"],
    components: {
        Head,
        Link,
    },

    data() {
        return {
            titulo: 'Equipo:',
            subTitulo: 'Conoce el equipo de:',
        }
    },
    created() {
    },
    methods: {
    }
}
</script>
