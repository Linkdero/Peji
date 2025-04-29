<template>
    <div class="col-md-6 fv-row">
        <label class="required fs-6 fw-semibold mb-2 fw-bold">{{ titulo }}</label>
        <select id="redes" class="form-select form-select-solid" data-control="select2" data-hide-search="true"
            data-placeholder="SELECCIONE UNA RED SOCIAL" name="target_assign">
            <option disabled selected>SELECCIONE UNA RED SOCIAL</option>
            <option v-for="r in redes" :value="r.id_red_social" :key="r.id_red_social">
                {{ r.red_social_detalle }}
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
            titulo: 'Listado de Redes Sociales',
            redes: [],
        }
    },
    mounted() {
        this.getRedesSociales()
    },
    methods: {
        async getRedesSociales() {
            try {
                const response = await axios.get('/apiRedSocial/redSocial/getAllRedesSociales');
                this.redes = response.data.data;
                console.log(response);

                setTimeout(() => {
                    $('#redes').select2({
                        placeholder: 'Redes',
                        allowClear: true,
                        width: '100%',
                        dropdownParent: $(`#${this.modal}`) // Cambia esto según tu estructura HTML
                    });
                    $('#redes').on("change", (event) => {
                        const selectedId = $(event.target).val();
                        const nombre = $(event.target).find(':selected').text();
                        this.$emit("red-social-seleccionada", selectedId, nombre);
                    });
                }, 100);
            } catch (error) {
                console.error('Error al obtener redes:', error);
            }
        },
    },
}
</script>