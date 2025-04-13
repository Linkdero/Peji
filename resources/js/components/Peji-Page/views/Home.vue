<script>
import { Link } from '@inertiajs/vue3';
import NoticiasUltimasPrincipal from '@/components/Peji-Page/components/NoticiasUltimasPrincipal.vue';
import NoticiasPopulares from '@/components/Peji-Page/components/NoticiasPopulares.vue';
import NoticiasCategoria from '@/components/Peji-Page/components/NoticiasCategoria.vue';
import NoticiasOferta from '@/components/Peji-Page/components/NoticiasOferta.vue';
import NoticiasUltimas from '@/components/Peji-Page/components/NoticiasUltimas.vue';
import NoticiasSuscripcion from '@/components/Peji-Page/components/NoticiasSuscripcion.vue';

export default {
    components: {
        Link,
        NoticiasUltimasPrincipal,
        NoticiasPopulares,
        NoticiasCategoria,
        NoticiasOferta,
        NoticiasUltimas,
        NoticiasSuscripcion,
    }
}
</script>

<template>
    <NoticiasUltimasPrincipal />
    <NoticiasPopulares />
    <NoticiasCategoria />
    <NoticiasOferta />
    <NoticiasUltimas />
    <NoticiasSuscripcion />
</template>