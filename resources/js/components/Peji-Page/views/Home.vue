<script>
import { Link } from '@inertiajs/vue3';
import NoticiasCarousel from '@/components/Peji-Page/components/inicio/NoticiasCarousel.vue';
import NoticiasUltimasPrincipal from '@/components/Peji-Page/components/inicio/NoticiasUltimasPrincipal.vue';
import NoticiasPopulares from '@/components/Peji-Page/components/inicio/NoticiasPopulares.vue';
import NoticiasCategoria from '@/components/Peji-Page/components/inicio/NoticiasCategoria.vue';
import NoticiasOferta from '@/components/Peji-Page/components/inicio/NoticiasOferta.vue';
import NoticiasUltimas from '@/components/Peji-Page/components/inicio/NoticiasUltimas.vue';
import NoticiasSuscripcion from '@/components/Peji-Page/components/inicio/NoticiasSuscripcion.vue';
import NoticiaColaboradores from '@/components/Peji-Page/components/inicio/NoticiaColaboradores.vue';

export default {
    props: ['informacion', 'categorias'],
    components: {
        Link,
        NoticiasCarousel,
        NoticiasUltimasPrincipal,
        // NoticiasPopulares,
        // NoticiasCategoria,
        NoticiasOferta,
        // NoticiasUltimas,
        NoticiasSuscripcion,
        NoticiaColaboradores
    }
}
</script>

<template>
    <NoticiasCarousel />
    <NoticiaColaboradores />

    <NoticiasUltimasPrincipal />
    <NoticiasPopulares />
    <NoticiasCategoria />
    <!-- <NoticiasOferta /> -->
    <NoticiasUltimas />
    <NoticiasSuscripcion :informacion="informacion" />
</template>