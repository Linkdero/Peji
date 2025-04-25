<template>
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h3 class="card-title text-center mb-4">Correo Electtronico</h3>
                    <div class="table-responsive text-center">
                        <table class="table table-row-bordered gy-1 table-striped">
                            <thead>
                                <tr>
                                    <th scope="col" class="fw-bold">ID</th>
                                    <th scope="col" class="fw-bold">Correo</th>
                                    <th scope="col" class="fw-bold text-end">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(c, index) in correosElectronicos" :key="index">
                                    <td class="fw-bold">{{ c.id_correo }}</td>
                                    <td class="fw-bold">{{ c.correo_detalle }}</td>
                                    <td class="text-end">
                                        <button @click="eliminarTelefono(c.id_correo, index)"
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
    props: ['correo'],
    data() {
        return {
            titulo: 'Editar Información',
            correosElectronicos: [],
        }
    },
    mounted() {
        if (this.correo.length > 0) {
            this.correosElectronicos = this.correo
        }
    },
}
</script>