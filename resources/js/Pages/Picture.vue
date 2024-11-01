<script setup>
import Card from "@/Components/Custom/Card.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { router } from "@inertiajs/vue3";
defineProps({
    pictures: Object,
    episodes: Object,
    nextEpisode: Object,
    prevEpisode: Object,
    cosmic_title: String,
    title: String,
    description: String,
    keywords: String,
    image_url: String,
    slug: String,
    ep: String,
});
const redirect = (event) => {
    const ep = event.target.value;
    if (ep) {
        router.get(
            route("picture.index", {
                slug: slug,
                episode: ep,
            })
        );
    }
};
</script>

<template>
    <AppLayout
        :title="title"
        :description="description"
        :keywords="keywords"
        :image_url="image_url"
    >
        <div class="marginY">
            <h1 class="text-xl md:text-2xl text-center text-white marginB">
                {{ title }}
            </h1>
            <div class="overflow-hidden relative">
                <img
                    v-for="picture in pictures"
                    class="w-full object-cover"
                    :src="picture.picture_url"
                    :alt="cosmic_title + ' ' + picture.picture_index + 1"
                />
            </div>
            <div class="sticky bottom-2 left-0 px-2 w-full">
                <select class="rounded-md w-full" @change="redirect">
                    <template v-for="episode in episodes" :key="episode.number">
                        <option
                            :selected="episode.number == ep"
                            :value="episode.number"
                            class="text-black"
                        >
                            ตอนที่ {{ episode.number }}
                        </option>
                    </template>
                </select>
            </div>
        </div>
    </AppLayout>
</template>
