<script setup>
import HeartOutline from 'vue-material-design-icons/HeartOutline.vue';
import HeartFilled from 'vue-material-design-icons/Heart.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    username: String,
    slug: String,
    condition: Boolean,
    total: Number
})

</script>

<template>
    <div class="flex items-center gap-1 bg-secondary 
    rounded-md border-secondary px-3 py-2 text-white">
                        <Link :href="`/${username}/${slug}/like`" class="text-xs" as="button" 
                        method="POST" preserve-scroll>
                            <HeartFilled v-if="condition"/>
                            <HeartOutline  v-else/>
                        </Link>
                        <p>
                            {{ total }}
                        </p>
    </div>
</template>