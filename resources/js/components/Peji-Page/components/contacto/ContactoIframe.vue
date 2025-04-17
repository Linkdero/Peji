<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="" data-aos=" fade-up" data-aos-delay="400" v-for="(d, index) in informacion.direcciones"
                :key="'iframe' + index">
                <div v-html="d.iframe_mapa" class="ratio ratio-16x9"></div>
            </div>
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
            titulo: 'Contacto',
        }
    },
    created() {
        console.log('Esta es la Informacion', this.informacion)

    },
    methods: {
    }
}
</script>
