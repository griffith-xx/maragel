<script setup>
import Card from "@/Components/Custom/Card.vue";
import Pagination from "@/Components/Custom/Pagination.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
defineProps({
    cosmics: Object,
    title: String,
    description: String,
    keywords: String,
    image_url: String,
});
</script>

<template>
    <AppLayout
        :title="title"
        :description="description"
        :keywords="keywords"
        :image_url="image_url"
    >
        <div class="marginY">
            <div class="marginB">
                <Card>
                    <h1 class="text-xl md:text-2xl text-center text-white">
                        {{ title }}
                    </h1>
                </Card>
            </div>

            <Card>
                <div
                    class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 sm:gap-4"
                >
                    <template v-for="cosmic in cosmics.data" :key="cosmic.id">
                        <Link
                            class="block relative group bg-transparent overflow-hidden rounded-xl"
                            :href="
                                route('episode.index', { slug: cosmic.slug })
                            "
                        >
                            <img
                                class="h-[265px] md:h-[295px] lg:h-[315px] w-full object-cover group-hover:scale-105 transition"
                                :src="cosmic.image_url"
                                :alt="cosmic.title"
                            />
                            <div
                                class="absolute bg-black/95 px-2 flex justify-center items-center bottom-0 w-full h-[65px]"
                            >
                                <p
                                    class="text-center text-white/85 text-xs sm:text-sm line-clamp-2 group-hover:text-white transition"
                                >
                                    {{ cosmic.title }}
                                </p>
                            </div>
                            <div
                                class="absolute top-2 px-2 w-full flex justify-end"
                            >
                                <span
                                    v-if="cosmic.type == 'manhwa'"
                                    class="bg-blue-600 text-white text-xs px-2 py-0.5 rounded-md text-center capitalize"
                                >
                                    {{ cosmic.type }}
                                </span>
                                <span
                                    v-if="cosmic.type == 'manga'"
                                    class="bg-red-600 text-white text-xs px-2 py-0.5 rounded-md text-center capitalize"
                                >
                                    {{ cosmic.type }}
                                </span>
                                <span
                                    v-if="cosmic.type == 'manhua'"
                                    class="bg-green-600 text-white text-xs px-2 py-0.5 rounded-md text-center capitalize"
                                >
                                    {{ cosmic.type }}
                                </span>
                            </div>
                        </Link>
                    </template>
                </div>
            </Card>

            <div class="marginY">
                <Card>
                    <Pagination :data="cosmics" />
                </Card>
            </div>
        </div>
    </AppLayout>
</template>
