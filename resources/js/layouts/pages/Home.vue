<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import NoticiasUltimasPrincipal from '@/components/Peji-Page/NoticiasUltimasPrincipal.vue';
import NoticiasPopulares from '@/components/Peji-Page/NoticiasPopulares.vue';
import NoticiasCategoria from '@/components/Peji-Page/NoticiasCategoria.vue';
import NoticiasOferta from '@/components/Peji-Page/NoticiasOferta.vue';
import NoticiasUltimas from '@/components/Peji-Page/NoticiasUltimas.vue';
import NoticiasSuscripcion from '@/components/Peji-Page/NoticiasSuscripcion.vue';

</script>

<template>
    <MainLayout>
        <NoticiasUltimasPrincipal />
        <NoticiasPopulares />
        <NoticiasCategoria />
        <NoticiasOferta />
        <NoticiasUltimas />
        <NoticiasSuscripcion />
    </MainLayout>
</template>