<script setup>
import { router } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
defineProps({
    data: Object,
});
const redirect = (event) => {
    const url = event.target.value;
    if (url) {
        router.get(url);
    }
};
</script>

<template>
    <div class="flex items-center justify-between">
        <select
            class="rounded-md h-10 w-20 bg-transparent border border-white/50 text-white/50"
            @change="redirect"
        >
            <template v-for="link in data.links" :key="link.label">
                <option
                    v-if="link.label != '<' && link.label != '>'"
                    :selected="link.active"
                    :value="link.url"
                    class="text-black"
                >
                    {{ link.label }}
                </option>
            </template>
        </select>
        <div class="flex gap-2">
            <Link
                class="px-4 py-1.5 border border-white/50 rounded-md text-white/75 hover:text-black hover:bg-white transition"
                :href="
                    data.prev_page_url
                        ? data.prev_page_url
                        : route('welcome.index')
                "
            >
                <
            </Link>
            <Link
                class="px-4 py-1.5 border border-white/50 rounded-md text-white/75 hover:text-black hover:bg-white transition"
                :href="
                    data.next_page_url
                        ? data.next_page_url
                        : route('welcome.index')
                "
            >
                >
            </Link>
        </div>
    </div>
</template>
