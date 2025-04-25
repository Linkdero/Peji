<template>
    <section id="blog-hero" class="blog-hero section">
        <div class="container section-title" data-aos="fade-up">
            <h2>{{ titulo }}</h2>
            <div>
                <span class="description-title">{{ subTitulo }}</span>
            </div>
        </div>

        <!-- Nuevo contenedor de carrusel de logos -->
        <div class="logo-carousel-container">
            <div class="logo-carousel">
                <!-- Primera copia para animación continua -->
                <div class="logo-slide">
                    <template v-for="i in 8" :key="'logo-1-' + i">
                        <div class="logo-item">
                            <img :src="'/colaboradores/colaborador-' + i + '.webp'" :alt="'Logo colaborador ' + i" />
                        </div>
                    </template>
                </div>

                <!-- Segunda copia para animación continua -->
                <div class="logo-slide">
                    <template v-for="i in 8" :key="'logo-2-' + i">
                        <div class="logo-item">
                            <img :src="'/colaboradores/colaborador-' + i + '.webp'" :alt="'Logo colaborador ' + i" />
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            titulo: 'EMPRESAS COLABORADORAS',
            subTitulo: 'MIRA LAS EMPRESAS QUE CONFÍAN EN NOSOTROS.',
        }
    }
}
</script>

<style scoped>
.section-title {
    text-align: center;
    margin-bottom: 2rem;
}

/* Contenedor principal que limita el ancho */
.logo-carousel-container {
    width: 100%;
    overflow: hidden;
    background-color: #f8f9fa;
    padding: 20px 0;
    position: relative;
}

/* Carrusel con animación */
.logo-carousel {
    display: flex;
    width: 200%;
    animation: scrollLogos 30s linear infinite;
}

/* Cada grupo de logos */
.logo-slide {
    display: flex;
    width: 100%;
    align-items: center;
}

/* Contenedor individual de cada logo */
.logo-item {
    flex: 0 0 12.5%;
    /* 8 logos por fila (100% / 8) */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 80px;
    padding: 0 15px;
    box-sizing: border-box;
}

/* Imagen del logo */
.logo-item img {
    max-width: 100%;
    max-height: 80px;
    object-fit: contain;
    filter: grayscale(100%);
    transition: filter 0.3s ease;
}

.logo-item img:hover {
    filter: grayscale(0%);
}

/* Animación de desplazamiento */
@keyframes scrollLogos {
    0% {
        transform: translateX(0);
    }

    100% {
        transform: translateX(-50%);
        /* Desplaza exactamente la mitad (un conjunto completo) */
    }
}

/* Responsive para tablets */
@media (max-width: 768px) {
    .logo-item {
        flex: 0 0 25%;
        /* 4 logos por fila */
        height: 60px;
        padding: 0 10px;
    }

    .logo-item img {
        max-height: 60px;
    }

    .logo-carousel {
        animation-duration: 20s;
    }
}

/* Responsive para móviles */
@media (max-width: 576px) {
    .logo-item {
        flex: 0 0 50%;
        /* 2 logos por fila */
        height: 50px;
        padding: 0 8px;
    }

    .logo-item img {
        max-height: 50px;
    }

    .logo-carousel {
        animation-duration: 15s;
    }
}
</style>