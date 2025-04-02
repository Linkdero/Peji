<template>
    <footer id="footer" class="footer">
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <Link href="/" class="logo d-flex align-items-center">
                    <span class="sitename">{{ siteName }}</span>
                    </Link>
                    <div class="footer-contact pt-3">
                        <p>{{ address.street }}</p>
                        <p>{{ address.city }}, {{ address.state }} {{ address.zip }}</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>{{ contact.phone }}</span></p>
                        <p><strong>Email:</strong> <span>{{ contact.email }}</span></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a v-for="social in socialLinks" :key="social.name" :href="social.url" target="_blank"
                            rel="noopener">
                            <i :class="social.icon"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links" v-for="(linkGroup, index) in linkGroups" :key="index">
                    <h4>{{ linkGroup.title }}</h4>
                    <ul>
                        <li v-for="(link, linkIndex) in linkGroup.links" :key="linkIndex">
                            <Link v-if="link.internal" :href="link.url">{{ link.text }}</Link>
                            <a v-else :href="link.url" target="_blank" rel="noopener">{{ link.text }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">{{ siteName }}</strong> <span>All Rights
                    Reserved</span></p>
            <div class="credits">
                Designed by <a href="https://bootstrapmade.com/" target="_blank" rel="noopener">BootstrapMade</a>
            </div>
        </div>
    </footer>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

interface Address {
    street: string;
    city: string;
    state: string;
    zip: string;
}

interface Contact {
    phone: string;
    email: string;
}

interface SocialLink {
    name: string;
    url: string;
    icon: string;
}

interface FooterLink {
    text: string;
    url: string;
    internal?: boolean;
}

interface LinkGroup {
    title: string;
    links: FooterLink[];
}

interface Props {
    siteName?: string;
    address?: Address;
    contact?: Contact;
    socialLinks?: SocialLink[];
    linkGroups?: LinkGroup[];
}

const props = withDefaults(defineProps<Props>(), {
    siteName: '',
    address: () => ({
        street: 'A108 Adam Street',
        city: 'New York',
        state: 'NY',
        zip: '535022'
    }),
    contact: () => ({
        phone: '+1 5589 55488 55',
        email: 'info@example.com'
    }),
    socialLinks: () => [
        { name: 'twitter', url: '#', icon: 'bi bi-twitter-x' },
        { name: 'facebook', url: '#', icon: 'bi bi-facebook' },
        { name: 'instagram', url: '#', icon: 'bi bi-instagram' },
        { name: 'linkedin', url: '#', icon: 'bi bi-linkedin' }
    ],
    linkGroups: () => [
        {
            title: 'Useful Links',
            links: [
                { text: 'Home', url: '/', internal: true },
                { text: 'About us', url: '/about', internal: true },
                { text: 'Services', url: '#', internal: false },
                { text: 'Terms of service', url: '#', internal: false },
                { text: 'Privacy policy', url: '#', internal: false }
            ]
        },
        {
            title: 'Our Services',
            links: [
                { text: 'Web Design', url: '#', internal: false },
                { text: 'Web Development', url: '#', internal: false },
                { text: 'Product Management', url: '#', internal: false },
                { text: 'Marketing', url: '#', internal: false },
                { text: 'Graphic Design', url: '#', internal: false }
            ]
        },
        {
            title: 'Hic solutasetp',
            links: [
                { text: 'Molestiae accusamus iure', url: '#', internal: false },
                { text: 'Excepturi dignissimos', url: '#', internal: false },
                { text: 'Suscipit distinctio', url: '#', internal: false },
                { text: 'Dilecta', url: '#', internal: false },
                { text: 'Sit quas consectetur', url: '#', internal: false }
            ]
        },
        {
            title: 'Nobis illum',
            links: [
                { text: 'Ipsam', url: '#', internal: false },
                { text: 'Laudantium dolorum', url: '#', internal: false },
                { text: 'Dinera', url: '#', internal: false },
                { text: 'Trodelas', url: '#', internal: false },
                { text: 'Flexo', url: '#', internal: false }
            ]
        }
    ]
});
</script>