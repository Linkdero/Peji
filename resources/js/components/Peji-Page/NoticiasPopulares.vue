<template>
    <section id="featured-posts" class="featured-posts section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Featured Posts</h2>
            <div><span>Check Our</span> <span class="description-title">Featured Posts</span></div>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="blog-posts-slider swiper" ref="swiperContainer">
                <!-- El resto de tu template permanece igual -->
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="blog-post-item">
                            <img src="https://elolivar.es/olivar-content/uploads/2023/09/como-organizar-una-fiesta.jpg"
                                alt="Blog Image">
                            <div class="blog-post-content">
                                <div class="post-meta">
                                    <span><i class="bi bi-person"></i> Julia Parker</span>
                                    <span><i class="bi bi-clock"></i> Jan 15, 2025</span>
                                    <span><i class="bi bi-chat-dots"></i> 6 Comments</span>
                                </div>
                                <h2><a href="#">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet</a></h2>
                                <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia
                                    Curae; Fusce porttitor metus eget lectus consequat, sit amet feugiat magna
                                    vulputate.</p>
                                <a href="#" class="read-more">Read More <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End slide item -->

                    <div class="swiper-slide">
                        <div class="blog-post-item">
                            <img src="https://www.technomag.fr/wp-content/uploads/2023/04/soiree-technomag-960x720.jpg"
                                alt="Blog Image">
                            <div class="blog-post-content">
                                <div class="post-meta">
                                    <span><i class="bi bi-person"></i> Mark Wilson</span>
                                    <span><i class="bi bi-clock"></i> Jan 18, 2025</span>
                                    <span><i class="bi bi-chat-dots"></i> 6 Comments</span>
                                </div>
                                <h2><a href="#">Sed ut perspiciatis unde omnis iste natus error sit voluptatem</a></h2>
                                <p>Maecenas tempus tellus eget condimentum rhoncus sem quam semper libero sit amet
                                    adipiscing sem neque sed ipsum.</p>
                                <a href="#" class="read-more">Read More <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End slide item -->

                    <div class="swiper-slide">
                        <div class="blog-post-item">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRmqBevmwrJHD5RkXmz6s3J7O7rdohF4eu3pA&s"
                                alt="Blog Image">
                            <div class="blog-post-content">
                                <div class="post-meta">
                                    <span><i class="bi bi-person"></i> Sarah Johnson</span>
                                    <span><i class="bi bi-clock"></i> Jan 21, 2025</span>
                                    <span><i class="bi bi-chat-dots"></i> 15 Comments</span>
                                </div>
                                <h2><a href="#">At vero eos et accusamus et iusto odio dignissimos ducimus</a></h2>
                                <p>Nullam dictum felis eu pede mollis pretium integer tincidunt cras dapibus vivamus
                                    elementum semper nisi.</p>
                                <a href="#" class="read-more">Read More <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End slide item -->

                    <div class="swiper-slide">
                        <div class="blog-post-item">
                            <img src="https://media.istockphoto.com/id/486420378/es/foto/cabezal-de-nataci%C3%B3n-en-pista-de-baile.jpg?s=612x612&w=0&k=20&c=ejizPt_OXETjf2pzuIKlq6uF-oxIjXpYPgRHrOwiHZA="
                                alt="Blog Image">
                            <div class="blog-post-content">
                                <div class="post-meta">
                                    <span><i class="bi bi-person"></i> David Brown</span>
                                    <span><i class="bi bi-clock"></i> Jan 24, 2025</span>
                                    <span><i class="bi bi-chat-dots"></i> 10 Comments</span>
                                </div>
                                <h2><a href="#">Et harum quidem rerum facilis est et expedita distinctio</a></h2>
                                <p>Donec quam felis ultricies nec pellentesque eu pretium quis sem nulla consequat massa
                                    quis enim.</p>
                                <a href="#" class="read-more">Read More <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End slide item -->

                    <div class="swiper-slide">
                        <div class="blog-post-item">
                            <img src="https://weezevent.com/wp-content/uploads/2019/01/12145054/organiser-soiree.jpg"
                                alt="Blog Image">
                            <div class="blog-post-content">
                                <div class="post-meta">
                                    <span><i class="bi bi-person"></i> Emma Davis</span>
                                    <span><i class="bi bi-clock"></i> Jan 27, 2025</span>
                                    <span><i class="bi bi-chat-dots"></i> 6 Comments</span>
                                </div>
                                <h2><a href="#">Nam libero tempore, cum soluta nobis est eligendi optio</a></h2>
                                <p>Aenean leo ligula porttitor eu consequat vitae eleifend ac enim aliquam lorem ante
                                    dapibus in viverra.</p>
                                <a href="#" class="read-more">Read More <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End slide item -->
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import Swiper from 'swiper';
import 'swiper/css';

const swiperContainer = ref<HTMLElement | null>(null);

onMounted(() => {
    if (swiperContainer.value) {
        new Swiper(swiperContainer.value, {
            loop: true,
            speed: 800,
            autoplay: {
                delay: 5000
            },
            slidesPerView: 3,
            spaceBetween: 30,
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 20
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                1200: {
                    slidesPerView: 3,
                    spaceBetween: 30
                }
            }
        });
    }
});
</script>