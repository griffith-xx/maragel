<script setup>
import Body from "@/Components/Custom/Body.vue";
import Container from "@/Components/Custom/Container.vue";
import Navbar from "@/Components/Custom/Navbar.vue";
import Footer from "@/Components/Custom/Footer.vue";
import { Head, usePage } from "@inertiajs/vue3";
defineProps({
    title: String,
    description: String,
    keywords: String,
    image_url: String,
});
const url = usePage().props.ziggy.url;
</script>

<template>
    <Head :title="title">
        <meta name="description" :content="description" />
        <meta name="keywords" :content="keywords" />

        <meta property="og:title" :content="title" />
        <meta property="og:description" :content="description" />
        <meta property="og:image" :content="image_url" />
        <meta property="og:url" :content="url" />
        <meta property="og:type" content="website" />

        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" :content="title" />
        <meta name="twitter:description" :content="description" />
        <meta name="twitter:image" :content="image_url" />
        <meta name="twitter:url" :content="url" />

        <link rel="canonical" :href="url" />

        <meta name="robots" content="index, follow" />
    </Head>

    <Body>
        <Navbar />
        <Container>
            <slot />
        </Container>
        <Footer />
    </Body>
</template>
