<template>
    <div class="container my-5">
        <!-- Header con logo y nombre -->
        <div class="text-center mb-5">
            <img v-if="informacion?.empresa_logo" :src="'/logo/' + informacion.empresa_logo" alt="Logo de la empresa"
                class="company-logo mb-3">
            <h1 class="display-4 fw-bold text-primary">{{ informacion?.empresa_nombre || titulo }}</h1>
            <div class="divider mx-auto my-3"></div>
        </div>

        <!-- Sección de descripción -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h3 class="card-title text-center mb-4">Nuestra Empresa</h3>
                        <p class="card-text text-muted text-center fs-5" v-html="informacion?.empresa_detalle"></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información de contacto en cards -->
        <div class="row g-4 mb-5">
            <!-- Teléfonos -->
            <div class="col-md-4" v-if="informacion?.telefonos?.length">
                <div class="card h-100 shadow-sm border-0 hover-effect">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-telephone-fill text-primary fs-1 mb-3"></i>
                        <h5 class="card-title mb-3">Teléfonos</h5>
                        <div v-for="(telefono, index) in informacion.telefonos" :key="index">
                            <a :href="'tel:' + telefono.telefono_detalle" class="text-decoration-none">
                                <p class="card-text mb-1">{{ telefono.telefono_detalle }}</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Correos -->
            <div class="col-md-4" v-if="informacion?.correos?.length">
                <div class="card h-100 shadow-sm border-0 hover-effect">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-envelope-fill text-primary fs-1 mb-3"></i>
                        <h5 class="card-title mb-3">Correos Electrónicos</h5>
                        <div v-for="(correo, index) in informacion.correos" :key="index">
                            <a :href="'mailto:' + correo.correo_detalle" class="text-decoration-none">
                                <p class="card-text mb-1">{{ correo.correo_detalle }}</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Direcciones -->
            <div class="col-md-4" v-if="informacion?.direcciones?.length">
                <div class="card h-100 shadow-sm border-0 hover-effect">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-geo-alt-fill text-primary fs-1 mb-3"></i>
                        <h5 class="card-title mb-3">Dirección</h5>
                        <div v-for="(direccion, index) in informacion.direcciones" :key="index">
                            <p class="card-text mb-1">{{ direccion.direccion_detalle }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Horario -->
        <div class="row mb-5" v-if="informacion?.horarios?.length">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h3 class="card-title text-center mb-4">Horario de Atención</h3>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr v-for="(horario, index) in informacion.horarios" :key="index">
                                        <td class="fw-bold">{{ horario.dia.dia_detalle }}</td>
                                        <td>{{ formatHora(horario.hora_inicio) }} - {{ formatHora(horario.hora_final) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mapa -->
        <div class="row mb-5" v-if="informacion?.direcciones?.length">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h3 class="card-title text-center mb-4">Ubicación</h3>
                        <div class="ratio ratio-16x9" v-html="informacion.direcciones[0].iframe_mapa"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Redes Sociales -->
        <div class="row" v-if="informacion?.redes_sociales?.length">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 text-center">
                        <h3 class="card-title mb-4">Síguenos en Redes Sociales</h3>
                        <div class="d-flex justify-content-center flex-wrap">
                            <a v-for="(red, index) in informacion.redes_sociales" :key="index" :href="red.link"
                                target="_blank" class="btn btn-outline-primary mx-2 mb-2 social-btn">
                                <i :class="red.red_social.icon"></i>
                                {{ red.red_social.red_social_detalle }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: ['informacion'],
    data: () => ({
        titulo: 'Información de la Empresa',
        informacion: null
    }),
    methods: {
        formatHora(hora) {
            if (!hora) return '';
            return hora.substring(0, 5); // Formatea "09:00:00" a "09:00"
        }
    }
}
</script>

<style scoped>
.company-logo {
    max-height: 120px;
    width: auto;
}

.divider {
    width: 80px;
    height: 4px;
    background-color: #0d6efd;
    border-radius: 2px;
}

.hover-effect {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-effect:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
}

.social-btn {
    transition: all 0.3s ease;
    min-width: 120px;
}

.social-btn:hover {
    transform: scale(1.05);
}

.card {
    border-radius: 15px;
}

.table {
    margin-bottom: 0;
}

.table td {
    padding: 0.75rem;
    border-bottom: 1px solid #eee;
}

.table tr:last-child td {
    border-bottom: none;
}
</style>