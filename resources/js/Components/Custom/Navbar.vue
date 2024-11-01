<script setup>
import Container from "./Container.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <header class="sticky top-0 left-0 z-40 w-full">
        <nav class="bg-black/90 py-6">
            <Container>
                <ul class="flex-none flex justify-end gap-5">
                    <li>
                        <Link
                            :class="
                                route().current() == 'welcome.index'
                                    ? 'text-white/90'
                                    : 'text-white/50 hover:text-white/90 transition'
                            "
                            class="flex-1"
                            :href="route('welcome.index')"
                        >
                            หน้าแรก
                        </Link>
                    </li>
                    <li>
                        <Link
                            :class="
                                route().current() == 'search.index'
                                    ? 'text-white/90'
                                    : 'text-white/50 hover:text-white/90 transition'
                            "
                            :href="route('welcome.index')"
                        >
                            ค้นหา
                        </Link>
                    </li>
                </ul>
            </Container>
        </nav>
    </header>
</template>
