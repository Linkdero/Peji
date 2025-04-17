<template>
    <div class="row gy-4 mb-5">
        <!-- Dirección -->
        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="info-card">
                <div class="icon-box">
                    <i class="bi bi-geo-alt"></i>
                </div>
                <h3>Nuestras Oficinas</h3>
                <p v-for="(direccion, index) in informacion.direcciones" :key="'dir' + index">
                    {{ direccion.direccion_detalle }}
                </p>
            </div>
        </div>

        <!-- Teléfonos y correos -->
        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="info-card">
                <div class="icon-box">
                    <i class="bi bi-telephone"></i>
                </div>
                <h3>Información de Contacto</h3>
                <div v-for="(telefono, tIndex) in informacion.telefonos" :key="'tel' + tIndex">
                    <p><i class="bi bi-telephone"></i> {{ telefono.telefono_detalle }}</p>
                </div>
                <div v-for="(correo, cIndex) in informacion.correos" :key="'correo' + cIndex">
                    <p><i class="bi bi-envelope"></i> {{ correo.correo_detalle }}</p>
                </div>
            </div>
        </div>

        <!-- Horario -->
        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="info-card">
                <div class="icon-box">
                    <i class="bi bi-clock"></i>
                </div>
                <h3>Horario de Atención</h3>
                <div v-for="(horario, hIndex) in informacion.horarios" :key="'hora' + hIndex">
                    <p>
                        {{ horario.dia.dia_detalle }}: {{ horario.hora_inicio }} - {{ horario.hora_final }}
                    </p>
                </div>
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
