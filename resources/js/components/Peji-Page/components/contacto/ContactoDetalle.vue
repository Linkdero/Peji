<template>
    <div class="page-title">
        <div class="breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="bi bi-house"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Category</a></li>
                    <li class="breadcrumb-item active current">Contact</li>
                </ol>
            </nav>
        </div>

        <div class="title-wrapper">
            <h1>{{ titulo }}</h1>
            <p>¡Estamos aquí para ayudarte! Si tienes preguntas, comentarios o necesitas soporte, no dudes en
                comunicarte con nosotros.</p>
        </div>
    </div>
</template>
<script>
import { Head, Link, usePage } from '@inertiajs/vue3';
import axios from 'axios';

export default {
    components: {
        Head,
        Link,
    },
    data() {
        return {
            titulo: 'Contacto',
        }
    },
    created() {
    },
    methods: {
    }
}
</script>
