<template>
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    {{ titulo }} </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Dashboards</li>
                </ul>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                    data-bs-target="#modal_editar_informacion">Editar Información</a>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
                <InformacionEmpresa :informacion="informacion" />
            </div>
        </div>
    </div>
    <ModalEditarInformacion :key="key" :informacion="informacion" @publicacion-exitosa="publicacionExitosa" />
</template>
<script>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3';
import ModalEditarInformacion from '@/components/Peji-Admin/views/Empresa/components/ModalEditarInformacion.vue';
import InformacionEmpresa from '@/components/Peji-Admin/views/Empresa/components/InformacionEmpresa.vue';

export default {
    props: ['informacion'],
    data() {
        return {
            titulo: 'Información de la Empresa',
            key: 0,
        }
    },
    components: {
        ModalEditarInformacion,
        InformacionEmpresa
    },
    methods: {
        publicacionExitosa() {
            this.key++;
        }
    },
    computed: {
    }
}
</script>