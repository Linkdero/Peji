<template>
    <header id="header" class="header position-relative">
        <div class="container-fluid container-xl position-relative">
            <div class="top-row d-flex align-items-center justify-content-between">
                <a href="#" class="logo d-flex align-items-center">
                    <div class="author-image">
                        <img :src="asset('@@/logo/logo.webp')" alt="Logo" class="img-fluid">
                    </div>
                </a>
                <div class="d-flex align-items-center">
                    <div class="social-links">
                        <a v-for="r in redSocial" :key="r.id" :href="r.link" target="_blank" class="social-icon">
                            <i :class="r.red_social.icon"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <NavbarPaginas />
    </header>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import NavbarPaginas from '@/components/Peji-Page/components/navbar/NavbarPaginas.vue';

export default {
    props: ['nombre', 'redSocial', 'logo'],
    components: {
        Link,
        NavbarPaginas
    },
    data() {
        return {
        };
    },
    methods: {
        asset(path) {
            return `/` + path.replace(/^@@\//, '');
        }
    }
};
</script>

<style scoped>
.header {
    padding: 15px 0;
    background-color: #fff;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
}

.top-row {
    width: 100%;
    padding: 0 15px;
}

.logo {
    text-decoration: none;
}

.author-image {
    width: auto;
    height: auto;
    max-width: 180px;
    transform-origin: left center;
    transform: scale(1.2);
}

.author-image img {
    max-width: 100%;
    height: auto;
}

.social-links {
    display: flex;
    gap: 15px;
    transform-origin: right center;
    transform: scale(1.2);
}

.social-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    color: #333;
    transition: all 0.3s ease;
    font-size: 18px;
}

.social-icon:hover {
    color: #0078d4;
}

/* Media queries para responsividad */
@media (max-width: 991px) {
    .author-image {
        max-width: 150px;
        transform: scale(1.1);
    }

    .social-links {
        transform: scale(1.1);
    }
}

@media (max-width: 768px) {
    .top-row {
        padding: 0 10px;
    }

    .author-image {
        max-width: 120px;
        transform: scale(1);
    }

    .social-links {
        transform: scale(1);
        gap: 12px;
    }
}

@media (max-width: 576px) {
    .header {
        padding: 10px 0;
    }

    .top-row {
        flex-direction: column;
        align-items: center;
        gap: 15px;
    }

    .author-image {
        max-width: 140px;
        transform: scale(1);
    }

    .social-links {
        margin-top: 5px;
        gap: 20px;
    }

    .social-icon {
        font-size: 20px;
    }
}
</style>