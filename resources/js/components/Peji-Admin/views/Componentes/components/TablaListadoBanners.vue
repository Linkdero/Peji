<template>
    <div class="container mt-4">
        <h2 class="mb-4">{{ titulo }}</h2>
        <div class="row">
            <div class="col-md-4 mb-4" v-for="b in banners" :key="b.id_banner">
                <div class="card h-100 shadow-sm">
                    <img :src="`/banners/${b.banner}`" class="card-img-top" :alt="b.banner"
                        style="object-fit: cover; height: 200px;">
                    <div class="card-body">
                        <h5 class="card-title">{{ b.banner }}</h5>
                        <button @click="toggleEstado(b)" class="btn btn-sm mx-1"
                            :class="b.estado.id_estado == 1 ? 'btn-warning' : 'btn-primary'">
                            <i :class="b.estado.id_estado == 1 ? 'fa-circle-exclamation' : 'fa-circle-check'"
                                class="fa-solid"></i>
                            {{ b.estado.id_estado == 1 ? 'Deshabilitar' : 'Habilitar' }}
                        </button>
                        <button @click="setEliminarBanner(b.id_banner)" class="btn btn-danger btn-sm mx-1">
                            <i class="fa-solid fa-trash"></i> Eliminar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        titulo: 'Listado de Banners',
        banners: []
    }),
    async mounted() {
        await this.getAllBanners();
    },
    methods: {
        async getAllBanners() {
            try {
                const { data } = await axios.get('/apiBanner/banner/getAllBanners');
                this.banners = data.data;
            } catch (error) {
                this.mostrarError('Error al cargar banners');
            }
        },

        async toggleEstado(banner) {
            const nuevoEstado = banner.estado.id_estado == 1 ? 2 : 1;
            const accion = nuevoEstado == 1 ? 'habilitar' : 'deshabilitar';

            if (await this.confirmarAccion(`¿${accion.charAt(0).toUpperCase() + accion.slice(1)} este banner?`)) {
                try {
                    await axios.put(`/apiBanner/banner/setCambiarEstadoBanner/${banner.id_banner}`, {
                        id_estado: nuevoEstado
                    });
                    banner.estado.id_estado = nuevoEstado;
                    this.mostrarExito(`Banner ${accion}ado correctamente`);
                } catch (error) {
                    this.mostrarError(`Error al ${accion} banner`);
                }
            }
        },

        async setEliminarBanner(id) {
            if (await this.confirmarAccion('¿Eliminar este banner?', 'Esta acción no se puede deshacer', 'warning')) {
                try {
                    await axios.delete(`/apiBanner/banner/setEliminarBanner/${id}`);
                    this.banners = this.banners.filter(b => b.id_banner !== id);
                    this.mostrarExito('Banner eliminado correctamente');
                } catch (error) {
                    this.mostrarError('Error al eliminar banner');
                }
            }
        },

        async confirmarAccion(titulo, texto = '', icono = 'question') {
            const { isConfirmed } = await Swal.fire({
                title: titulo,
                text: texto,
                icon: icono,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar'
            });
            return isConfirmed;
        },

        mostrarExito(mensaje) {
            Swal.fire({
                title: 'Éxito',
                text: mensaje,
                icon: 'success',
                timer: 1500,
                showConfirmButton: false,
            }
            );
        },

        mostrarError(mensaje) {
            Swal.fire({
                title: 'Error',
                text: mensaje,
                icon: 'error',
                timer: 1500,
                showConfirmButton: false,
            }
            );
        }
    }
}
</script>