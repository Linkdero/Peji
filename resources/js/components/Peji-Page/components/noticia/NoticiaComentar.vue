<template>
    <section id="blog-comment-form" class="blog-comment-form section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <form method="post" role="form">

                <div class="section-header">
                    <h3>{{ titulo }}</h3>
                    <p>{{ subTitulo }}</p>
                </div>

                <div class="row gy-3">
                    <div class="col-md-6 form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter your full name"
                            required="">
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="Enter your email address" required="">
                    </div>

                    <div class="col-12 form-group">
                        <label for="website">Website</label>
                        <input type="url" name="website" class="form-control" id="website"
                            placeholder="Your website (optional)">
                    </div>

                    <div class="col-12 form-group">
                        <label for="comment">Your Comment *</label>
                        <textarea class="form-control" name="comment" id="comment" rows="5"
                            placeholder="Write your thoughts here..." required=""></textarea>
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn-submit">Comentar</button>
                    </div>
                </div>

            </form>

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
            titulo: 'Comparte tu opinión:',
            subTitulo: 'Su dirección de correo electrónico no será publicada. Los campos obligatorios están marcados',
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
