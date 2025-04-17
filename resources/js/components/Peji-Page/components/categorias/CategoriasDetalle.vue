<template>
    <div class="page-title position-relative">
        <div class="breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="bi bi-house"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Category</a></li>
                    <li class="breadcrumb-item active current">Category</li>
                </ol>
            </nav>
        </div>

        <div class="title-wrapper">
            <h1>{{ titulo }}</h1>
            <p>{{ subTitulo }}</p>
        </div>
    </div>
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
            titulo: 'CATÁLOGO',
            subTitulo: 'En este apartado puedes ver todas nuestra publicaciones filtradas.',
        }
    },
    created() {
    },
    methods: {
    }
}
</script>
