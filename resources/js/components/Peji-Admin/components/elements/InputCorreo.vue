<template>
    <div class="d-flex flex-column mb-8 fv-row">
        <label class="d-flex align-items-center fs-6 fw-semibold mb-2 fw-bold">
            <span class="required">{{ titulo }}</span>
            <span class="ms-1" data-bs-toggle="tooltip" title="numero">
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
            <input type="email" class="form-control form-control-solid ps-12" placeholder="Ingresar Correo" name="email"
                v-model="contenido" />

            <div v-if="tipo == 2" class="col-2 ml-3">
                <button @click="validarNumero()" type="button" class="btn btn-primary btn-sm">
                    <i class="ki-outline ki-plus-circle"></i>Agregar</button>
            </div>
        </div>
    </div>
</template>
<script>
import { Link } from '@inertiajs/vue3';

export default {
    props: ['titulo', 'tipo'],
    data() {
        return {
            contenido: '',
        }
    },
    watch: {
        contenido(n) {
            this.$emit('set-nuevo-correo', n);
        }
    },
    methods: {
        validarNumero() {
            this.$emit('validar-nuevo-correo');
        }
    },
}
</script>