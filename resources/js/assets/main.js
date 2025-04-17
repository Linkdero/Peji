/**
 * Template Name: Blogy
 * Template URL: https://bootstrapmade.com/blogy-bootstrap-blog-template/
 * Updated: Feb 22 2025 with Bootstrap v5.3.3
 * Author: BootstrapMade.com
 * License: https://bootstrapmade.com/license/
 */
import PureCounter from '@srexi/purecounterjs';
import AOS from 'aos';
import 'aos/dist/aos.css';
import GLightbox from 'glightbox';
import 'glightbox/dist/css/glightbox.min.css';
(function () {
    'use strict';

    /**
     * Apply .scrolled class to the body as the page is scrolled down
     */
    setTimeout(() => {
        function toggleScrolled() {
            const selectBody = document.querySelector('body');
            const selectHeader = document.querySelector('#header');
            if (
                !selectHeader.classList.contains('scroll-up-sticky') &&
                !selectHeader.classList.contains('sticky-top') &&
                !selectHeader.classList.contains('fixed-top')
            )
                return;
            window.scrollY > 100 ? selectBody.classList.add('scrolled') : selectBody.classList.remove('scrolled');
        }

        document.addEventListener('scroll', toggleScrolled);
        window.addEventListener('load', toggleScrolled);
        console.log('Retrasado por 1 segundo.');
    }, '1000');

    /**
     * Mobile nav toggle
     */

    setTimeout(() => {
        const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');

        function mobileNavToogle() {
            document.querySelector('body').classList.toggle('mobile-nav-active');
            mobileNavToggleBtn.classList.toggle('bi-list');
            mobileNavToggleBtn.classList.toggle('bi-x');
        }
        if (mobileNavToggleBtn) {
            mobileNavToggleBtn.addEventListener('click', mobileNavToogle);
        }

        /**
         * Hide mobile nav on same-page/hash links
         */
        document.querySelectorAll('#navmenu a').forEach((navmenu) => {
            navmenu.addEventListener('click', () => {
                if (document.querySelector('.mobile-nav-active')) {
                    mobileNavToogle();
                }
            });
        });

        /**
         * Toggle mobile nav dropdowns
         */
        document.querySelectorAll('.navmenu .toggle-dropdown').forEach((navmenu) => {
            navmenu.addEventListener('click', function (e) {
                e.preventDefault();
                this.parentNode.classList.toggle('active');
                this.parentNode.nextElementSibling.classList.toggle('dropdown-active');
                e.stopImmediatePropagation();
            });
        });
        console.log('Navbar Moviles.');
    }, '1000');

    /**
     * Preloader
     */
    const preloader = document.querySelector('#preloader');
    if (preloader) {
        window.addEventListener('load', () => {
            preloader.remove();
        });
    }

    /**
     * Scroll top button
     */
    setTimeout(() => {
        let scrollTop = document.querySelector('.scroll-top');

        function toggleScrollTop() {
            if (scrollTop) {
                window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
            }
        }
        scrollTop.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth',
            });
        });

        window.addEventListener('load', toggleScrollTop);
        document.addEventListener('scroll', toggleScrollTop);
        console.log('Ejecutado el scrollTop');
    }, '1000');

    /**
     * Animation on scroll function and init
     */
    function aosInit() {
        AOS.init({
            duration: 600,
            easing: 'ease-in-out',
            once: true,
            mirror: false,
        });
    }
    window.addEventListener('load', aosInit);

    /**
     * Init swiper sliders
     */
    function initSwiper() {
        document.querySelectorAll('.init-swiper').forEach(function (swiperElement) {
            let config = JSON.parse(swiperElement.querySelector('.swiper-config').innerHTML.trim());

            if (swiperElement.classList.contains('swiper-tab')) {
                initSwiperWithCustomPagination(swiperElement, config);
            } else {
                new Swiper(swiperElement, config);
            }
        });
    }

    window.addEventListener('load', initSwiper);

    /**
     * Initiate Pure Counter
     */
    document.addEventListener('DOMContentLoaded', function () {
        new PureCounter();
    });
    /**
     * Initiate glightbox
     */
    document.addEventListener('DOMContentLoaded', () => {
        const lightbox = GLightbox(); // Inicializa GLightbox
    });
})();
