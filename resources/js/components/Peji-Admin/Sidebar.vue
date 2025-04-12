<template>
    <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
        data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
        data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
        <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
            <a href="index.html">
                <img alt="Logo" src="admin/assets/media/logos/default-dark.svg"
                    class="h-25px app-sidebar-logo-default" />
                <img alt="Logo" src="admin/assets/media/logos/default-small.svg"
                    class="h-20px app-sidebar-logo-minimize" />
            </a>
            <div id="kt_app_sidebar_toggle"
                class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
                data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
                data-kt-toggle-name="app-sidebar-minimize">
                <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
        </div>
        <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
            <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
                <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true"
                    data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                    data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                    data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
                    data-kt-scroll-save-state="true">
                    <div class="menu-item">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">Modulos</span>
                        </div>
                    </div>
                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6"
                        id="kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                        <div v-for="(m, index) in modulos" :key="m.id_modulo"
                            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start"
                            class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention">

                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i :class="`${m.icon} ki-duotone fs-2`">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">{{ m.modulo_detalle }}</span>
                                <span class="menu-arrow"></span>
                            </span>

                            <div
                                class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-2 py-4 w-200px mh-75 overflow-auto">
                                <div class="menu-item" v-for="(m2, index2) in m.sub_modulos">
                                    <Link class="menu-link"
                                        :href="'/dashboard/' + m.modulo_detalle.toLowerCase() + '/' + m2.sub_modulo_detalle.toLowerCase()">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ m2.sub_modulo_detalle }}</span>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

export default {
    data() {
        return {
            modulos: [] // Aquí guardamos los módulos con sus sub módulos
        }
    },
    components: {
        Link
    },
    mounted() {
        this.getModulos();
    },
    methods: {
        async getModulos() {
            try {
                const response = await axios.get('/apiModulo/modulos/getModulosSubModulosActivos');
                this.modulos = response.data;
                console.log(this.modulos);
            } catch (error) {
                console.error('Error al obtener módulos:', error);
            }
        }
    }
}
</script>
