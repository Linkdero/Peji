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

        <textarea class="form-control" rows="3" v-model="contenido"></textarea>
    </div>
</template>

<script>
export default {
    props: ['titulo'],
    data() {
        return {
            contenido: '',
        }
    },
    watch: {
        contenido(n) {
            this.$emit('set-nuevo-detalle', n);
        }
    }
}
</script>
