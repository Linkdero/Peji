<script>
import { Link } from '@inertiajs/vue3';
import NosotrosDetalle from '@/components/Peji-Page/components/nosotros/NosotrosDetalle.vue';
import NosotrosDescripcion from '@/components/Peji-Page/components/nosotros/NosotrosDescripcion.vue';
import NosotrosEquipoTrabajo from '@/components/Peji-Page/components/nosotros/NosotrosEquipoTrabajo.vue';

export default {
        props: ['informacion', 'categorias'],
        components: {
                Link,
                NosotrosDetalle,
                NosotrosDescripcion,
                NosotrosEquipoTrabajo
        }
}
</script>

<template>
        <NosotrosDetalle :informacion="informacion" />
        <NosotrosDescripcion :informacion="informacion" />
        <!-- <NosotrosEquipoTrabajo :informacion="informacion" /> -->
</template>