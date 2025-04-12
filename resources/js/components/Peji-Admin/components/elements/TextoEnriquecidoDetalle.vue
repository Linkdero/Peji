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

        <div class="position-relative">
            <div id="editor" class="form-control form-control-solid" style="min-height: 150px;"></div>
        </div>
    </div>
</template>

<script>
import Quill from 'quill';
import 'quill/dist/quill.snow.css';

export default {
    props: ['titulo'],
    data() {
        return {
            contenido: '',
            quill: null,
        }
    },
    mounted() {
        // Inicializa el editor
        this.quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Agrega el detalle...',
            modules: {
                toolbar: [
                    [{ 'font': [] }, { 'size': [] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'script': 'sub' }, { 'script': 'super' }],
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    [{ 'indent': '-1' }, { 'indent': '+1' }],
                    [{ 'direction': 'rtl' }],
                    [{ 'align': [] }],
                    ['blockquote', 'code-block'],
                    ['link'],
                    ['clean']
                ]
            }
        });


        // Escuchar cambios y actualizar `contenido`
        this.quill.on('text-change', () => {
            this.contenido = this.quill.root.innerHTML;
        });
    },
    watch: {
        contenido(nuevo) {
            this.$emit('set-nuevo-detalle', nuevo);
        }
    }
}
</script>
