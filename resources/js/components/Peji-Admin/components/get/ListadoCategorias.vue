<template>
    <div class="col-md-6 fv-row">
        <label class="required fs-6 fw-semibold mb-2 fw-bold">{{ titulo }}</label>
        <select id="categorias" class="form-select form-select-solid" data-control="select2" data-hide-search="true"
            data-placeholder="SELECCIONE UNA CATEGORIA" name="target_assign">
            <option disabled selected>SELECCIONE UNA CATEGORIA</option>
            <option v-for="c in categorias" :value="c.id_categoria" :key="c.id_categoria">
                {{ c.categoria_detalle }}
            </option>
        </select>
    </div>
</template>
<script>
import { Link } from '@inertiajs/vue3';

export default {
    props: ['modal'],
    data() {
        return {
            titulo: 'Listado de Categorías',
            categorias: [],
        }
    },
    mounted() {
        this.getCategorias()
    },
    methods: {
        async getCategorias() {
            try {
                const response = await axios.get('/apiCategoria/categorias/getCategoriasActivas');
                this.categorias = response.data.data;
                console.log(this.categorias);

                setTimeout(() => {
                    $('#categorias').select2({
                        placeholder: 'Categorias',
                        allowClear: true,
                        width: '100%',
                        create: true,
                        sortField: 'text',
                        dropdownParent: $(`#${this.modal} .modal-body`)
                    });

                    $('#categorias').on("change", (event) => {
                        const selectedId = $(event.target).val();
                        this.$emit("categoria-seleccionada", selectedId);
                    });
                }, 100);
            } catch (error) {
                console.error('Error al obtener categorias:', error);
            }
        },
    },
}
</script>