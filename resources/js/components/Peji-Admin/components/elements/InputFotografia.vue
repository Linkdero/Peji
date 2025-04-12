<template>
    <div class="fv-row mb-10 fv-plugins-icon-container">
        <label class="d-block fw-semibold fs-6 mb-5 fw-bold">
            <span class="required">{{ titulo }}</span>
            <span class="ms-1" data-bs-toggle="tooltip"
                aria-label="E.g. Select a logo to represent the company that's running the campaign."
                data-bs-original-title="E.g. Select a logo to represent the company that's running the campaign."
                data-kt-initialized="1">
                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                </i>
            </span>
        </label>

        <div class="image-input image-input-empty image-input-outline image-input-placeholder"
            data-kt-image-input="true">
            <div class="image-input-wrapper w-125px h-125px"
                :style="{ backgroundImage: imagenPrevia ? `url(${imagenPrevia})` : '' }"></div>

            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change avatar"
                data-bs-original-title="Change avatar" data-kt-initialized="1">
                <i class="ki-duotone ki-pencil fs-7">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                <input type="file" name="avatar" accept=".png, .jpg, .jpeg" @change="getImagenLocal" />
                <input type="hidden" name="avatar_remove" />
            </label>

            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Cancel avatar"
                data-bs-original-title="Cancel avatar" data-kt-initialized="1" @click="cancelImage">
                <i class="ki-duotone ki-cross fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </span>

            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Remove avatar"
                data-bs-original-title="Remove avatar" data-kt-initialized="1" @click="removeImage">
                <i class="ki-duotone ki-cross fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </span>
        </div>

        <div class="form-text">Tipos de archivo permitidos: png, jpg, jpeg.</div>
        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
    </div>
</template>

<script>
export default {
    props: ['titulo'],
    data() {
        return {
            imagenPrevia: null, // Base64 o URL de imagen convertida a WebP
            imagenSeleccionada: null, // Archivo WebP convertido
        };
    },
    methods: {
        async getImagenLocal(event) {
            const file = event.target.files[0];
            if (!file || !file.type.startsWith('image/')) return;

            try {
                const webpBlob = await this.setConvertirImagenWEBP(file);
                const webpURL = URL.createObjectURL(webpBlob);

                this.imagenPrevia = webpURL;
                this.imagenSeleccionada = webpBlob;
                this.$emit('imagen-seleccionada', webpBlob);
            } catch (error) {
                console.error('Error al convertir la imagen:', error);
            }
        },

        setConvertirImagenWEBP(file) {
            return new Promise((resolve, reject) => {
                const img = new Image();
                const reader = new FileReader();

                reader.onload = (e) => {
                    img.src = e.target.result;
                };

                img.onload = () => {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');

                    canvas.width = img.width;
                    canvas.height = img.height;
                    ctx.drawImage(img, 0, 0, img.width, img.height);

                    canvas.toBlob((blob) => {
                        if (blob) resolve(blob);
                        else reject(new Error('Error al convertir a WebP'));
                    }, 'image/webp', 0.8); // Calidad 0.8 (puedes ajustarla)
                };

                reader.readAsDataURL(file);
            });
        },
    },
};
</script>

<style>
.image-input-placeholder {
    background-image: url('../svgblank-image.svg');
    background-size: cover;
    background-position: center;
}

[data-bs-theme='dark'] .image-input-placeholder {
    background-image: url('../svg/blank-image-dark.svg');
}

.image-input-wrapper {
    background-size: cover;
    background-position: center;
}
</style>