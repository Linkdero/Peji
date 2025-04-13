<template>
    <header id="header" class="header position-relative">
        <div class="container-fluid container-xl position-relative">
            <div class="top-row d-flex align-items-center justify-content-between">
                <Link href="/" class="logo d-flex align-items-end">
                <div class="author-image">
                    <img src="logo/logo.webp" alt="Logo" class="img-fluid rounded">
                </div>
                </Link>

                <div class="d-flex align-items-center">
                    <div class="social-links">
                        <a v-for="r in redSocial" :href="r.link" target="_blank">
                            <i :class="r.red_social.icon"></i>
                        </a>
                    </div>

                    <form class="search-form ms-4">
                        <input type="text" placeholder="Search..." class="form-control">
                        <button type="submit" class="btn"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </div>
        </div>

        <div class="nav-wrap">
            <div class="container d-flex justify-content-center position-relative">
                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li>
                            <Link href="/" :class="{ active: $page.url === '/' }">Inicio</Link>
                        </li>
                        <li>
                            <Link href="/about" :class="{ active: $page.url === '/about' }">Sobre Nosotros</Link>
                        </li>
                        <li>
                            <Link href="/category" :class="{ active: $page.url === '/category' }">Categorias</Link>
                        </li>
                        <li>
                            <Link href="/blog-details" :class="{ active: $page.url === '/blog-details' }">Noticias Detalladas
                            </Link>
                        </li>
                        <li class="dropdown">
                            <a href="#"><span>Secciones</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li>
                                    <Link href="/about">About</Link>
                                </li>
                                <li>
                                    <Link href="/category">Category</Link>
                                </li>
                                <li>
                                    <Link href="/blog-details">Blog Details</Link>
                                </li>
                                <li>
                                    <Link href="/author-profile">Author Profile</Link>
                                </li>
                                <li>
                                    <Link href="/search-results">Search Results</Link>
                                </li>
                                <li>
                                    <Link href="/404">404 Not Found Page</Link>
                                </li>

                                <li class="dropdown">
                                    <a href="#"><span>Deep Dropdown</span> <i
                                            class="bi bi-chevron-down toggle-dropdown"></i></a>
                                    <ul>
                                        <li><a href="#">Deep Dropdown 1</a></li>
                                        <li><a href="#">Deep Dropdown 2</a></li>
                                        <li><a href="#">Deep Dropdown 3</a></li>
                                        <li><a href="#">Deep Dropdown 4</a></li>
                                        <li><a href="#">Deep Dropdown 5</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <Link href="/contact" :class="{ active: $page.url === '/contact' }">Contactanos</Link>
                        </li>
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>
            </div>
        </div>
    </header>
</template>
<script>
import { Link } from '@inertiajs/vue3';

export default {
    props: ['nombre', 'redSocial'],
    components: {
        Link
    },
    data() {
        return {
        };
    },
    methods: {
    }
};
</script>
