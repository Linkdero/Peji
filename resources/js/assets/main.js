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

// Exportamos una función que podemos llamar para inicializar todo
export function initializeUI() {
    /**
     * Apply .scrolled class to the body as the page is scrolled down
     */
    function toggleScrolled() {
        const selectBody = document.querySelector('body');
        const selectHeader = document.querySelector('#header');
        if (
            !selectHeader ||
            (!selectHeader.classList.contains('scroll-up-sticky') &&
                !selectHeader.classList.contains('sticky-top') &&
                !selectHeader.classList.contains('fixed-top'))
        )
            return;
        window.scrollY > 100 ? selectBody.classList.add('scrolled') : selectBody.classList.remove('scrolled');
    }

    document.addEventListener('scroll', toggleScrolled);
    toggleScrolled(); // Execute immediately

    /**
     * Mobile nav toggle
     */
    const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');

    function mobileNavToogle() {
        document.querySelector('body').classList.toggle('mobile-nav-active');
        mobileNavToggleBtn.classList.toggle('bi-list');
        mobileNavToggleBtn.classList.toggle('bi-x');
    }

    if (mobileNavToggleBtn) {
        // Limpiamos eventos anteriores para evitar duplicados
        mobileNavToggleBtn.removeEventListener('click', mobileNavToogle);
        mobileNavToggleBtn.addEventListener('click', mobileNavToogle);
    }

    /**
     * Hide mobile nav on same-page/hash links
     */
    document.querySelectorAll('#navmenu a').forEach((navmenu) => {
        // Limpiamos eventos anteriores
        const navClickHandler = () => {
            if (document.querySelector('.mobile-nav-active')) {
                mobileNavToogle();
            }
        };
        navmenu.removeEventListener('click', navClickHandler);
        navmenu.addEventListener('click', navClickHandler);
    });

    /**
     * Toggle mobile nav dropdowns
     */
    document.querySelectorAll('.navmenu .toggle-dropdown').forEach((navmenu) => {
        const dropdownHandler = function (e) {
            e.preventDefault();
            this.parentNode.classList.toggle('active');
            this.parentNode.nextElementSibling.classList.toggle('dropdown-active');
            e.stopImmediatePropagation();
        };
        // Limpiamos eventos anteriores
        navmenu.removeEventListener('click', dropdownHandler);
        navmenu.addEventListener('click', dropdownHandler);
    });

    /**
     * Preloader
     */
    const preloader = document.querySelector('#preloader');
    if (preloader) {
        preloader.remove();
    }

    /**
     * Scroll top button
     */
    let scrollTop = document.querySelector('.scroll-top');
    if (scrollTop) {
        function toggleScrollTop() {
            window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
        }

        // Primero definimos la función handler
        const scrollTopHandler = (e) => {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth',
            });
        };

        // Luego limpiamos eventos anteriores
        scrollTop.removeEventListener('click', scrollTopHandler);

        // Y finalmente añadimos el nuevo listener
        scrollTop.addEventListener('click', scrollTopHandler);
        toggleScrollTop(); // Execute immediately
        document.addEventListener('scroll', toggleScrollTop);
    }
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
    aosInit(); // Initialize AOS

    /**
     * Init swiper sliders
     */
    if (typeof Swiper !== 'undefined') {
        document.querySelectorAll('.init-swiper').forEach(function (swiperElement) {
            const configElement = swiperElement.querySelector('.swiper-config');
            if (configElement) {
                let config = JSON.parse(configElement.innerHTML.trim());

                // Verificamos si ya hay un Swiper inicializado en este elemento
                if (swiperElement._swiper) {
                    swiperElement._swiper.destroy(true, true);
                }

                if (swiperElement.classList.contains('swiper-tab')) {
                    if (typeof initSwiperWithCustomPagination === 'function') {
                        initSwiperWithCustomPagination(swiperElement, config);
                    }
                } else {
                    new Swiper(swiperElement, config);
                }
            }
        });
    }

    /**
     * Initiate Pure Counter
     */
    new PureCounter();

    /**
     * Initiate glightbox
     */
    const lightbox = GLightbox(); // Inicializa GLightbox

    console.log('UI components initialized');
}

// Ejecutamos inmediatamente para la primera carga
initializeUI();

// También exponemos globalmente para compatibilidad con código existente
window.initializeUI = initializeUI;
