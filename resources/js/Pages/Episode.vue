<script setup>
import Card from "@/Components/Custom/Card.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
defineProps({
    episodes: Object,
    title: String,
    description: String,
    cosmic: Object,
});
</script>

<template>
    <AppLayout
        :title="title"
        :description="description"
        :keywords="cosmic.slug"
        :image_url="cosmic.image_url"
    >
        <div class="marginY">
            <div class="marginB">
                <Card>
                    <img
                        class="mx-auto max-h-[320px] mb-1"
                        :src="cosmic.image_url"
                        :alt="cosmic.title"
                    />
                    <div class="flex justify-center gap-2 my-3">
                        <span
                            class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded capitalize"
                        >
                            {{ cosmic.type }}
                        </span>
                        <span
                            class="bg-red-100 text-red-800 text-sm font-medium px-2.5 py-0.5 rounded capitalize"
                        >
                            {{ cosmic.status }}
                        </span>
                    </div>
                    <h1 class="text-xl md:text-2xl text-center text-white">
                        {{ title }}
                    </h1>
                    <p class="text-white/75 mt-3 text-center">
                        {{ cosmic.description }}
                    </p>
                </Card>
            </div>
            <Card>
                <ul class="grid grid-cols-3 md:grid-cols-5 gap-2 md:gap-3">
                    <li v-for="episode in episodes">
                        <Link
                            :href="
                                route('picture.index', {
                                    slug: cosmic.slug,
                                    episode: episode.number,
                                })
                            "
                            class="text-xs sm:text-sm text-white/80 border border-white/50 block pl-4 py-2 rounded-md hover:bg-white hover:text-black transition"
                        >
                            ตอนที่ {{ episode.number }}
                        </Link>
                    </li>
                </ul>
            </Card>
        </div>
    </AppLayout>
</template>
