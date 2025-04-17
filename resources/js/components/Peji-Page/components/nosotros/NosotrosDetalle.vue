<template>
    <div class="page-title">
        <div class="breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="bi bi-house"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Category</a></li>
                    <li class="breadcrumb-item active current">About</li>
                </ol>
            </nav>
        </div>

        <div class="title-wrapper">
            <h1>{{ titulo }} {{ informacion.empresa_nombre }}</h1>
            <p>nos especializamos en la creación de eventos elegantes e inolvidables. Desde bodas sofisticadas y fiestas
                corporativas hasta celebraciones íntimas, nuestro equipo se dedica a diseñar experiencias únicas que
                reflejen estilo, exclusividad y atención al detalle.
            </p>
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
            titulo: 'Acerca de:',
        }
    },
    created() {
    },
    methods: {
    }
}
</script>
