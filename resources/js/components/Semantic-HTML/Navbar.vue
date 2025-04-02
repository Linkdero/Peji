<template>
    <header id="header" class="header position-relative">
        <div class="container-fluid container-xl position-relative">
            <div class="top-row d-flex align-items-center justify-content-between">
                <Link href="/" class="logo d-flex align-items-end">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="/assets/img/logo.webp" alt=""> -->
                <h1 class="sitename">{{ siteName }}</h1><span>.</span>
                </Link>

                <div class="d-flex align-items-center">
                    <div class="social-links">
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                    </div>

                    <form class="search-form ms-4" @submit.prevent="handleSearch">
                        <input type="text" placeholder="Search..." class="form-control" v-model="searchQuery">
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
                            <Link href="/" :class="{ active: $page.url === '/' }">Home</Link>
                        </li>
                        <li>
                            <Link href="/about" :class="{ active: $page.url === '/about' }">About</Link>
                        </li>
                        <li>
                            <Link href="/category" :class="{ active: $page.url === '/category' }">Category</Link>
                        </li>
                        <li>
                            <Link href="/blog-details" :class="{ active: $page.url === '/blog-details' }">Blog Details
                            </Link>
                        </li>
                        <li>
                            <Link href="/author-profile" :class="{ active: $page.url === '/author-profile' }">Author
                            Profile</Link>
                        </li>
                        <li class="dropdown">
                            <a href="#"><span>Pages</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
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
                            <Link href="/contact" :class="{ active: $page.url === '/contact' }">Contact</Link>
                        </li>
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>
            </div>
        </div>
    </header>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

interface Props {
    siteName?: string;
}

const props = withDefaults(defineProps<Props>(), {
    siteName: 'Blogy'
});

const searchQuery = ref('');

const handleSearch = () => {
    console.log('Searching for:', searchQuery.value);
};
</script>