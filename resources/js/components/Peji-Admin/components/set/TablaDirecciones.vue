<template>
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h3 class="card-title text-center mb-4">Redes Sociales</h3>
                    <div class="table-responsive text-center">
                        <table class="table table-row-bordedireccion gy-1 table-striped">
                            <thead>
                                <tr>
                                    <th scope="col" class="fw-bold">ID</th>
                                    <th scope="col" class="fw-bold">Dirección</th>
                                    <th scope="col" class="fw-bold">Iframe</th>
                                    <th scope="col" class="fw-bold text-end">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(d, index) in direccionEmpresa" :key="index">
                                    <td class="fw-bold">{{ d.id_direccion }}</td>
                                    <td class="fw-bold">{{ d.direccion_detalle }}</td>
                                    <td class="fw-bold">{{ d.iframe_mapa }}</td>
                                    <td class="text-end">
                                        <button @click="eliminarDirección(d.id_direccion, index)"
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
    props: ['direccion'],
    data() {
        return {
            titulo: 'Editar Información',
            direccionEmpresa: [],
        }
    },
    mounted() {
        if (this.direccion.length > 0) {
            this.direccionEmpresa = this.direccion
        }
    },
    methods: {
        eliminarDirección(id, index) {
            this.direccionEmpresa.splice(index, 1);
        }
    }
}
</script>