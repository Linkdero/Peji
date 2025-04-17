<script>
import { Link } from '@inertiajs/vue3';
import ContactoDetalle from '@/components/Peji-Page/components/contacto/ContactoDetalle.vue';
import ContactoInformacion from '@/components/Peji-Page/components/contacto/ContactoInformacion.vue';
import ContactoIframe from '@/components/Peji-Page/components/contacto/ContactoIframe.vue';
import ContactoSolicitarInformacion from '@/components/Peji-Page/components/contacto/ContactoSolicitarInformacion.vue';

export default {
    props: ['informacion','categorias'],
    components: {
        Link,
        ContactoDetalle,
        ContactoInformacion,
        // ContactoIframe,
        ContactoSolicitarInformacion
    }
}
</script>

<template>
    <ContactoDetalle />
    <section id="contact" class="contact section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <ContactoInformacion :informacion="informacion" />
            <ContactoIframe :informacion="informacion" />
            <ContactoSolicitarInformacion :categorias="categorias"/>
        </div>
    </section>
</template>