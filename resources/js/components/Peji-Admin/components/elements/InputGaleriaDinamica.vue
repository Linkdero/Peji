<template>
    <div class="fv-row mb-10 fv-plugins-icon-container">
        <label class="d-block fw-semibold fs-6 mb-5 fw-bold">
            <span class="required">{{ titulo }}</span>
        </label>

        <input type="file" ref="fileInput" multiple accept="image/*" @change="getObtenerMultiplesImagenesLocales"
            class="form-control mb-4" />
        <div class="d-flex flex-wrap gap-4">
            <div v-for="(img, index) in imagenesPreview" :key="index" class="position-relative">
                <img :src="img.url" alt="preview" class="rounded shadow"
                    style="width: 125px; height: 125px; object-fit: cover;" />

                <a href="#" @click="eliminarImagen(index)" class="position-absolute top-0 end-0 m-1">
                    <i class="ki-duotone ki-trash-square fs-2 text-danger">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                    </i>
                </a>
            </div>
        </div>
        <div class="form-text mt-2">Tipos de archivo permitidos: PNG, JPG, JPEG (convertidos a WebP).</div>
    </div>
</template>

<script>
import Swal from 'sweetalert2'

export default {
    props: ['titulo'],
    data() {
        return {
            imagenesPreview: [],
            swal: Swal
        };
    },
    methods: {
        async getObtenerMultiplesImagenesLocales(event) {
            const files = Array.from(event.target.files);

            Promise.all(files.map(async (file) => {
                if (!file || !file.type.startsWith('image/')) return;

                // Verificar si ya existe una imagen con el mismo nombre y tamaño
                const yaExiste = this.imagenesPreview.some(preview => {
                    return preview.originalName === file.name && preview.originalSize === file.size;
                });

                if (yaExiste) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.$nextTick(() => {
                            this.swal.fire({
                                title: 'Imagen duplicada',
                                text: `Ya has subido la imagen "${file.name}"`,
                                imageUrl: e.target.result,
                                imageAlt: file.name,
                                confirmButtonText: 'Entendido',
                                icon: 'warning',
                            });
                        });
                    };
                    reader.readAsDataURL(file);
                    return;
                }

                try {
                    const webpBlob = await this.convertirAWebP(file);
                    const webpURL = URL.createObjectURL(webpBlob);

                    this.imagenesPreview.push({
                        url: webpURL,
                        file: webpBlob,
                        originalName: file.name,   // Guardamos nombre original
                        originalSize: file.size,   // Guardamos tamaño original
                    });
                } catch (error) {
                    console.error('Error al convertir imagen a WebP:', error);
                }
            })).then(() => {
                this.$emit('imagenes-seleccionadas', this.imagenesPreview.map(img => img.file));
                this.$refs.fileInput.value = null;
            });
        },
        eliminarImagen(index) {
            this.imagenesPreview.splice(index, 1);
            this.$emit('imagenes-seleccionadas', this.imagenesPreview.map(img => img.file));
        },
        convertirAWebP(file) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                const img = new Image();

                reader.onload = (e) => {
                    img.src = e.target.result;
                };

                img.onload = () => {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');

                    canvas.width = img.width;
                    canvas.height = img.height;
                    ctx.drawImage(img, 0, 0, img.width, img.height);

                    canvas.toBlob(
                        (blob) => (blob ? resolve(blob) : reject(new Error('Error al convertir a WebP'))),
                        'image/webp',
                        0.8
                    );
                };

                reader.readAsDataURL(file);
            });
        },
    },
};
</script>