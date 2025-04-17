<template>
    <header id="header" class="header position-relative">
        <div class="container-fluid container-xl position-relative">
            <div class="top-row d-flex align-items-center justify-content-between">
                <a href="#" class="logo d-flex align-items-end">
                    <div class="author-image">
                        <img :src="asset('@@/logo/logo.webp')" alt="Logo" class="img-fluid rounded">
                    </div>
                </a>

                <div class="d-flex align-items-center">
                    <div class="social-links">
                        <a v-for="r in redSocial" :href="r.link" target="_blank">
                            <i :class="r.red_social.icon"></i>
                        </a>
                    </div>

                    <!-- <form class="search-form ms-4">
                        <input type="text" placeholder="Search..." class="form-control">
                        <button type="submit" class="btn"><i class="bi bi-search"></i></button>
                    </form> -->
                </div>
            </div>
        </div>

        <NavbarPaginas />
    </header>
</template>
<script>
import { Link } from '@inertiajs/vue3';
import  NavbarPaginas  from '@/components/Peji-Page/components/navbar/NavbarPaginas.vue';

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
