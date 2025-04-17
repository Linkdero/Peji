<template>
    <section id="blog-comments" class="blog-comments section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="blog-comments-3">
                <div class="section-header">
                    <h3>Discussion <span class="comment-count">(8)</span></h3>
                </div>

                <div class="comments-wrapper">
                    <!-- Comment 1 -->
                    <article class="comment-card">
                        <div class="comment-header">
                            <div class="user-info">
                                <img src="assets/img/person/person-f-9.webp" alt="User avatar" loading="lazy">
                                <div class="meta">
                                    <h4 class="name">Sarah Williams</h4>
                                    <span class="date"><i class="bi bi-calendar3"></i> February 13,
                                        2025</span>
                                </div>
                            </div>
                        </div>
                        <div class="comment-content">
                            <p>Proin iaculis purus consequat sem cure digni ssim donec porttitora entum
                                suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et.
                                Maecen aliquam, risus at semper.</p>
                        </div>
                        <div class="comment-actions">
                            <button class="action-btn like-btn">
                                <i class="bi bi-hand-thumbs-up"></i>
                                <span>12</span>
                            </button>
                            <button class="action-btn reply-btn">
                                <i class="bi bi-reply"></i>
                                <span>Reply</span>
                            </button>
                        </div>
                    </article>

                    <!-- Comment 2 with replies -->
                    <article class="comment-card">
                        <div class="comment-header">
                            <div class="user-info">
                                <img src="assets/img/person/person-m-9.webp" alt="User avatar" loading="lazy">
                                <div class="meta">
                                    <h4 class="name">James Cooper</h4>
                                    <span class="date"><i class="bi bi-calendar3"></i> February 13,
                                        2025</span>
                                </div>
                            </div>
                        </div>
                        <div class="comment-content">
                            <p>Quisque ut nisi. Donec mi odio, faucibus at, scelerisque quis, convallis in,
                                nisi. Suspendisse non nisl sit amet velit hendrerit rutrum. Ut leo. Ut a
                                nisl id ante tempus hendrerit.</p>
                        </div>
                        <div class="comment-actions">
                            <button class="action-btn like-btn">
                                <i class="bi bi-hand-thumbs-up"></i>
                                <span>8</span>
                            </button>
                            <button class="action-btn reply-btn">
                                <i class="bi bi-reply"></i>
                                <span>Reply</span>
                            </button>
                        </div>

                        <!-- Reply Thread -->
                        <div class="reply-thread">
                            <!-- Reply 1 -->
                            <article class="comment-card reply">
                                <div class="comment-header">
                                    <div class="user-info">
                                        <img src="assets/img/person/person-f-9.webp" alt="User avatar" loading="lazy">
                                        <div class="meta">
                                            <h4 class="name">Emily Parker</h4>
                                            <span class="date"><i class="bi bi-calendar3"></i> February 13,
                                                2025</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="comment-content">
                                    <p>Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia
                                        Curae.</p>
                                </div>
                                <div class="comment-actions">
                                    <button class="action-btn like-btn">
                                        <i class="bi bi-hand-thumbs-up"></i>
                                        <span>5</span>
                                    </button>
                                    <button class="action-btn reply-btn">
                                        <i class="bi bi-reply"></i>
                                        <span>Reply</span>
                                    </button>
                                </div>
                            </article>

                            <!-- Reply 2 -->
                            <article class="comment-card reply">
                                <div class="comment-header">
                                    <div class="user-info">
                                        <img src="assets/img/person/person-f-7.webp" alt="User avatar" loading="lazy">
                                        <div class="meta">
                                            <h4 class="name">Daniel Brown</h4>
                                            <span class="date"><i class="bi bi-calendar3"></i> February 13,
                                                2025</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="comment-content">
                                    <p>Nam commodo suscipit quam. Vestibulum ullamcorper mauris at ligula.
                                        Fusce fermentum odio nec arcu.</p>
                                </div>
                                <div class="comment-actions">
                                    <button class="action-btn like-btn">
                                        <i class="bi bi-hand-thumbs-up"></i>
                                        <span>3</span>
                                    </button>
                                    <button class="action-btn reply-btn">
                                        <i class="bi bi-reply"></i>
                                        <span>Reply</span>
                                    </button>
                                </div>
                            </article>
                        </div>
                    </article>

                    <!-- Comment 3 -->
                    <article class="comment-card">
                        <div class="comment-header">
                            <div class="user-info">
                                <img src="assets/img/person/person-m-6.webp" alt="User avatar" loading="lazy">
                                <div class="meta">
                                    <h4 class="name">Rachel Adams</h4>
                                    <span class="date"><i class="bi bi-calendar3"></i> February 13,
                                        2025</span>
                                </div>
                            </div>
                        </div>
                        <div class="comment-content">
                            <p>Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo
                                ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                        </div>
                        <div class="comment-actions">
                            <button class="action-btn like-btn">
                                <i class="bi bi-hand-thumbs-up"></i>
                                <span>6</span>
                            </button>
                            <button class="action-btn reply-btn">
                                <i class="bi bi-reply"></i>
                                <span>Reply</span>
                            </button>
                        </div>
                    </article>
                </div>
            </div>

        </div>

    </section>
</template>
<script>
import { Head, Link, usePage } from '@inertiajs/vue3';
import axios from 'axios';

export default {
    props: ['informacion'],
    components: {
        Head,
        Link,
    },

    data() {
        return {
            titulo: 'Acerca de:',
        }
    },
    created() {
    },
    methods: {
        asset(path) {
            return `/` + path.replace(/^@@\//, '');
        }
    }
}
</script>