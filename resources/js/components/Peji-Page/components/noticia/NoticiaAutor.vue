<template>
    <div class="author-info">
        <div class="author-details">
            <img src="https://i1.sndcdn.com/artworks-LSDOiTFsz6jZzwk1-nKbxSw-t500x500.jpg" alt="Author"
                class="author-img">
            <div class="info">
                <h4>{{ informacion.creador.name }}</h4>
                <span class="role">Senior Web Developer</span>
            </div>
        </div>
        <div class="post-meta">
            <span class="date"><i class="bi bi-calendar3"></i> {{ informacion.fecha_creacion }}</span>
            <span class="divider">•</span>
            <span class="comments"><i class="bi bi-chat-text"></i> 18 Comentarios</span>
        </div>
    </div>
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
