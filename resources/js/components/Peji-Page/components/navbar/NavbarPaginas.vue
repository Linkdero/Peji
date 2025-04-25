<template>
    <div class="nav-wrap">
        <div class="container d-flex justify-content-center position-relative">
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li>
                        <Link href="/" :class="{ active: $page.url === '/' }" >Inicio</Link>
                    </li>
                    <li>
                        <Link href="/category" :class="{ active: $page.url === '/category' }">Catálogo</Link>
                    </li>
                    <li>
                        <Link href="/about" :class="{ active: $page.url === '/about' }">Sobre Nosotros</Link>
                    </li>
                    <!-- <li class="dropdown">
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
                    </li> -->
                    <li>
                        <Link href="/contact" :class="{ active: $page.url === '/contact' }">Contactanos</Link>
                    </li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </div>
</template>
<script>
import { Head, Link, usePage } from '@inertiajs/vue3';
import axios from 'axios';

export default {
    components: {
        Head,
        Link,
    },
    data() {
        return {
            titulo: 'Contacto',
        }
    },
    created() {
        console.log("Navbar funcionando")
    },
}
</script>
