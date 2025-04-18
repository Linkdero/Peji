// usuarioStore.js
import { defineStore } from 'pinia';

export const useUsuarioStore = defineStore('usuario', {
    state: () => ({
        idUsuario: null,
        nombre: '',
        correo: '',
    }),

    actions: {
        guardarDatosUsuario(datos) {
            this.idUsuario = datos.id;
            this.nombre = datos.nombre;
            this.correo = datos.correo;
        },

        limpiarDatosUsuario() {
            this.$reset();
        },
    },

    persist: {
        enabled: true,
        strategies: [
            {
                key: 'usuarioComentarios',
                storage: localStorage,
                paths: ['idUsuario', 'nombre', 'correo'],
            },
        ],
    },
});
