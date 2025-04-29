<template>
    <div class="modal fade" :id="idModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content rounded">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <div :id="idModal + '_form'" class="form " action="#">
                        <div class="mb-13 text-center">
                            <h1 class="mb-3 h2">{{ titulo }}</h1>
                            <div class="text-muted fw-semibold fs-5">En este apartado editaras la información de tu
                                <a href="#" class="fw-bold link-primary">Empresa</a>.
                            </div>
                        </div>

                        <InputRadioEncabezado :secciones="secciones" :valorSeleccionado="activeSection"
                            @pagina-seleccionada="activeSection = $event" />
                        <!-- Sección Principal -->
                        <div v-if="activeSection === 1">
                            <InputTitulo :titulo="'Título de la Noticia'" @set-nuevo-titulo="actualizarTitulo" />
                            <TextoEnriquecidoDetalle :titulo="'Detalle de la Noticia'"
                                @set-nuevo-detalle="actualizarDetalle" />
                            <InputFotografia :titulo="'Miniatura Noticia'" @imagen-seleccionada="actualizarMiniatura" />
                        </div>

                        <!-- Sección Contacto -->
                        <div v-if="activeSection === 2">
                            <InputNumero :titulo="'Número de telefono de la empresa'"
                                @set-nuevo-numero="actualizarNumero" @validar-nuevo-numero="validarNuevoNumero()"
                                :tipo="2" />
                            <TablaNumerosTelefonos :telefono="numeroCargado" :key="key" />
                            <InputCorreo :titulo="'Correo Electronico de la empresa'"
                                @set-nuevo-correo="actualizarCorreo" @validar-nuevo-correo="validarNuevoCorreo()"
                                :tipo="2" />

                            <TablaCorreos :correo="correoCargado" :key="key" />
                        </div>

                        <!-- Sección Redes Sociales -->
                        <div v-if="activeSection === 3" class="row">
                            <InputTitulo :titulo="'Link de la Red Social'" @set-nuevo-titulo="actualizarTitulo" />
                            <ListadoRedesSociales :modal="idModal" @red-social-seleccionada="actualizarRedSocial" />
                            <div class="col-md-6 fv-row"
                                v-if="(tituloSeleccionado != '') && (redSocialSeleccionada != '')">
                                <div class="row">
                                    <label class="required fs-6 fw-semibold mb-2 fw-bold">Agregar Red Social</label>
                                    <button @click="validarRedSocial()" type="button" class="btn btn-primary btn-sm">
                                        <i class="ki-outline ki-plus-circle"></i>Agregar
                                    </button>
                                </div>
                            </div>
                            <TablaRedesSociales :red="redSocialCargada" />
                            <!-- Aquí irían los componentes para redes sociales -->
                        </div>

                        <!-- Sección Lugar y Horario -->
                        <div v-if="activeSection === 4">
                            <InputTitulo :titulo="'Dirección de la Empresa'" @set-nuevo-titulo="actualizarTitulo" />
                            <InputTextarea :titulo="'Dirección Iframe'" @set-nuevo-detalle="actualizarDetalle" />
                            <div class="row" v-if="(tituloSeleccionado != '') && (detalleSeleccionado != '')">
                                <label class="required fs-6 fw-semibold mb-2 fw-bold">Agregar Dirección</label>
                                <button @click="validarDireccion()" type="button" class="btn btn-primary btn-sm">
                                    <i class="ki-outline ki-plus-circle"></i>Agregar
                                </button>
                            </div>
                            <TablaDirecciones :direccion="direccionCargada" />
                        </div>

                        <div v-show="activeSection === 1 && validarFormulario" class="text-center">
                            <a @click="setNuevaPublicacion()" href="#" class="btn btn-sm btn-success">
                                <span class="indicator-label">
                                    <i class="ki-duotone ki-plus-circle">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Publicar Noticia
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { Link } from '@inertiajs/vue3';
import InputTitulo from '@/components/Peji-Admin/components/elements/InputTitulo.vue';
import TextoEnriquecidoDetalle from '@/components/Peji-Admin/components/elements/TextoEnriquecidoDetalle.vue';
import InputFotografia from '@/components/Peji-Admin/components/elements/InputFotografia.vue';
import InputNumero from '@/components/Peji-Admin/components/elements/InputNumero.vue';
import TablaNumerosTelefonos from '@/components/Peji-Admin/components/set/TablaNumerosTelefonos.vue';
import TablaCorreos from '@/components/Peji-Admin/components/set/TablaCorreos.vue';
import InputRadioEncabezado from '@/components/Peji-Admin/components/elements/InputRadioEncabezado.vue';
import InputCorreo from '@/components/Peji-Admin/components/elements/InputCorreo.vue';
import ListadoRedesSociales from '@/components/Peji-Admin/components/get/ListadoRedesSociales.vue';
import TablaRedesSociales from '@/components/Peji-Admin/components/set/TablaRedesSociales.vue';
import TablaDirecciones from '@/components/Peji-Admin/components/set/TablaDirecciones.vue';
import InputTextarea from '@/components/Peji-Admin/components/elements/InputTextarea.vue';

export default {
    props: ['informacion'],
    data() {
        return {
            titulo: 'Editar Información',
            idModal: 'modal_editar_informacion',
            key: 0,
            numeroCargado: [],
            correoCargado: [],
            tituloSeleccionado: '',
            detalleSeleccionado: '',
            miniaturaSeleccionada: '',
            numeroSeleccionado: '',
            activeSection: 1,
            secciones: [
                { label: 'Principal', value: 1 },
                { label: 'Contacto', value: 2 },
                { label: 'Redes Sociales', value: 3 },
                { label: 'Lugar y Horario', value: 4 }

            ],
            correoSeleccionado: '',
            redSocialSeleccionada: '',
            redSocialSeleccionadaNombre: '',
            redSocialCargada: [],
            direccionCargada: [],
        }
    },
    created() {
        this.numeroCargado = this.informacion.telefonos;
        this.correoCargado = this.informacion.correos;
        this.redSocialCargada = this.informacion.redes_sociales;
        this.direccionCargada = this.informacion.direcciones;
        console.log('Esta es la información de la empresa:', this.informacion);
    },
    components: {
        InputTitulo,
        TextoEnriquecidoDetalle,
        InputFotografia,
        InputNumero,
        TablaNumerosTelefonos,
        TablaCorreos,
        InputRadioEncabezado,
        InputCorreo,
        ListadoRedesSociales,
        TablaRedesSociales,
        TablaDirecciones,
        InputTextarea
    },
    computed: {
        validarFormulario() {
            return this.tituloSeleccionado !== '' &&
                this.detalleSeleccionado !== '' &&
                this.miniaturaSeleccionada !== ''
        }
    },
    methods: {
        actualizarTitulo(n) {
            this.tituloSeleccionado = n;
            console.log('Nuevo título seleccionado:', n);
        },
        actualizarDetalle(n) {
            this.detalleSeleccionado = n;
            console.log('Nuevo detalle seleccionado:', n);
        },
        actualizarMiniatura(n) {
            this.miniaturaSeleccionada = n;
            console.log('Nueva miniatura seleccionada:', n);
        },
        actualizarNumero(n) {
            this.numeroSeleccionado = n;
            console.log('Nuevo número seleccionado:', n);
        },
        validarNuevoNumero() {
            if (this.numeroSeleccionado) {
                const existe = this.numeroCargado.some(
                    t => t.telefono_detalle === this.numeroSeleccionado
                );

                if (!existe) {
                    this.numeroCargado.push({
                        id_telefono: 0,
                        telefono_detalle: this.numeroSeleccionado
                    });
                    this.key++; // Actualiza la tabla
                    console.log('Número agregado:', this.numeroSeleccionado);
                } else {
                    Swal.fire({
                        icon: "success",
                        title: "El número ya fue agregado",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            } else {
                console.log('Número vacío');
            }
        },
        actualizarCorreo(n) {
            this.correoSeleccionado = n;
            console.log('Nuevo correo seleccionado:', n);
        },
        validarNuevoCorreo() {
            if (this.correoSeleccionado) {
                const existe = this.correoCargado.some(
                    c => c.correo_detalle === this.correoSeleccionado
                );

                if (!existe) {
                    this.correoCargado.push({
                        id_correo: 0,
                        correo_detalle: this.correoSeleccionado
                    });
                    this.key++; // Actualiza la tabla
                    console.log('Correo agregado:', this.correoCargado);
                } else {
                    Swal.fire({
                        icon: "success",
                        title: "El correo ya fue agregado",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            } else {
                console.log('Número vacío');
            }
        },
        actualizarRedSocial(n, m) {
            this.redSocialSeleccionada = n;
            this.redSocialSeleccionadaNombre = m;
            console.log('Nueva red social seleccionada:', n);
        },
        validarRedSocial() {
            // Asegurarse que redSocialCargada es un array
            this.redSocialCargada = this.redSocialCargada || [];

            // Verificar si ya existe la red social con el mismo link
            const existe = this.redSocialCargada.some(
                c => c.red_social && c.link === this.tituloSeleccionado
            );

            if (!existe) {
                // Aquí necesitas asegurarte de incluir la estructura red_social
                this.redSocialCargada.push({
                    id_red: 0,
                    id_red_social: this.redSocialSeleccionada,
                    link: this.tituloSeleccionado,
                    red_social: {
                        red_social_detalle: this.redSocialSeleccionadaNombre, // Deberías obtener este valor
                        icon: "bi bi-globe" // Icono por defecto
                    }
                });
                this.key++;
                console.log('Red social agregada:', this.redSocialCargada);
            } else {
                Swal.fire({
                    icon: "warning",
                    title: "Esta red social ya fue agregada",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        },
        validarDireccion() {
            // Asegurarse que redSocialCargada es un array
            this.direccionCargada = this.direccionCargada || [];

            // Verificar si ya existe la red social con el mismo link
            const existe = this.direccionCargada.some(
                d => d.direccion_detalle === this.tituloSeleccionado || d.iframe_mapa === this.detalleSeleccionado
                
            );

            if (!existe) {
                // Aquí necesitas asegurarte de incluir la estructura red_social
                this.direccionCargada.push({
                    id_direccion: 0,
                    direccion_detalle: this.tituloSeleccionado,
                    iframe_mapa: this.detalleSeleccionado,
                });
                this.key++;
                console.log('Dirección agregada:', this.direccionCargada);
            } else {
                Swal.fire({
                    icon: "warning",
                    title: "Esta dirección ya fue agregada",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }
    },
}
</script>