<template>
    <div class="d-flex flex-column mb-8 fv-row">
        <label class="d-flex align-items-center fs-6 fw-semibold mb-2 fw-bold">
            <span class="required">{{ titulo }}</span>
            <span class="ms-1" data-bs-toggle="tooltip" title="titulo">
                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                </i>
            </span>
        </label>
        <div class="position-relative d-flex align-items-center">
            <i class="ki-duotone ki-pencil fs-2 position-absolute mx-4">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
                <span class="path4"></span>
                <span class="path5"></span>
                <span class="path6"></span>
            </i>
            <input class="form-control form-control-solid ps-12" placeholder="Ingresar Titulo" name="titulo"
                v-model="contenido" />
        </div>
    </div>

</template>
<script>
import { Link } from '@inertiajs/vue3';

export default {
    props: ['titulo'],
    data() {
        return {
            contenido: '',
        }
    },
    watch: {
        contenido(n) {
            this.$emit('set-nuevo-titulo', n);
        }
    }
}
</script>