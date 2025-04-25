<template>
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h3 class="card-title text-center mb-4">Redes Sociales</h3>
                    <div class="table-responsive text-center">
                        <table class="table table-row-bordered gy-1 table-striped">
                            <thead>
                                <tr>
                                    <th scope="col" class="fw-bold">ID</th>
                                    <th scope="col" class="fw-bold">Red Social</th>
                                    <th scope="col" class="fw-bold">Link</th>
                                    <th scope="col" class="fw-bold text-end">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(r, index) in redesSociales" :key="index">
                                    <td class="fw-bold">{{ r.id_red }}</td>
                                    <td class="fw-bold">{{ r.red_social.red_social_detalle }}</td>
                                    <td class="fw-bold">{{ r.link }}</td>
                                    <td class="text-end">
                                        <button @click="eliminarTelefono(r.id_red, index)"
                                            class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
    props: ['red'],
    data() {
        return {
            titulo: 'Editar Información',
            redesSociales: [],
        }
    },
    mounted() {
        if (this.red.length > 0) {
            this.redesSociales = this.red
        }
    },
}
</script>