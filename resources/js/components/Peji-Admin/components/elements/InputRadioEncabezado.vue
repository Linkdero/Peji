<template>
    <div class="nav-group nav-group-outline mx-auto mb-15">
        <button v-for="(s, indice) in secciones" :key="indice"
            class="btn btn-color-gray-600 btn-active btn-active-secondary px-6 py-3 me-2"
            :class="{ 'active': valorSeleccionado === s.value }" @click="paginaSeleccionada(s.value)">
            {{ s.label }}
        </button>
    </div>
</template>

<script>
export default {
    props: {
        secciones: {
            type: Array,
            required: true
        },
        valorSeleccionado: {
            type: String,
            required: true
        }
    },
    methods: {
        paginaSeleccionada(nuevoValor) {
            this.$emit('pagina-seleccionada', nuevoValor);
        }
    }
};
</script>
