<template>
    <section id="blog-author" class="blog-author section">
        <div class="container" data-aos="fade-up">
            <div class="author-box">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 text-center">
                        <img src="https://i1.sndcdn.com/artworks-LSDOiTFsz6jZzwk1-nKbxSw-t500x500.jpg"
                            class="author-img rounded-circle" alt="" loading="lazy">

                        <div class="author-social-links mt-3">
                            <a href="https://x.com/Linkdero" class="twitter" target="_blank">
                                <i class="bi bi-twitter-x"></i>
                            </a>
                            <a href="https://www.linkedin.com/in/anderson-morales-b873b5237/" class="linkedin"
                                target="_blank">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="https://github.com/Linkdero" class="github" target="_blank">
                                <i class="bi bi-github"></i>
                            </a>
                            <a href="https://www.facebook.com/Segundo.Amo.Y.Maestro.Del.Hentai/" class="facebook"
                                target="_blank">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="https://www.instagram.com/linkdero/" class="instagram" target="_blank">
                                <i class="bi bi-instagram"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-8">
                        <div class="author-content">
                            <h3 class="author-name">{{ informacion.creador.name }}</h3>
                            <span class="author-title">Analista &amp; Programador</span>

                            <div class="author-bio mt-3">
                                Soy programador.
                            </div>

                            <div class="author-website mt-3">
                                <a href="#" class="website-link">
                                    <i class="bi bi-globe"></i>
                                    <span>https://github.com/</span>
                                </a>
                                <a href="#" class="more-posts">
                                    Ver publicación <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</template>
<script>
import { Head, Link, usePage } from '@inertiajs/vue3';
import axios from 'axios';

export default {
    props: ['informacion'],
    components: {
        Head,
        Link,
    },

    data() {
        return {
            titulo: 'Acerca de:',
        }
    },
    created() {
    },
    methods: {
        asset(path) {
            return `/` + path.replace(/^@@\//, '');
        }
    }
}
</script>
