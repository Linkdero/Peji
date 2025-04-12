<template>
    <div class="col-md-6 fv-row">
        <label class="required fs-6 fw-semibold mb-2 fw-bold">{{ titulo }}</label>
        <select id="tags" class="form-select form-select-solid" data-control="select2" data-hide-search="true"
            data-placeholder="SELECCIONE TAGS" name="target_assign" multiple="multiple">
            <option v-for="t in tags" :value="t.id_tag" :key="t.id_tag">
                {{ t.tag_detalle }}
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
            titulo: 'Listado de Tags',
            tags: [],
        }
    },
    mounted() {
        this.getTags()
    },
    methods: {
        async getTags() {
            try {
                const response = await axios.get('/apiTag/tags/getTagsActivos');
                this.tags = response.data.data;
                console.log(this.tags);

                setTimeout(() => {
                    $('#tags').select2({
                        placeholder: 'Categorias',
                        allowClear: true,
                        width: '100%',
                        create: true,
                        sortField: 'text',
                        tags: true,
                        dropdownParent: $(`#${this.modal} .modal-body`)
                    });

                    $('#tags').on("change", (event) => {
                        const selectedId = $(event.target).val();
                        this.$emit("tags-seleccionados", selectedId);
                    });
                }, 100);
            } catch (error) {
                console.error('Error al obtener tags:', error);
            }
        },
    },
}
</script>