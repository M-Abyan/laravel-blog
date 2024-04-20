<script setup>
import { Link } from '@inertiajs/vue3';
import Button from '../../Components/Partials/Button.vue';
import Navbar from '../../Components/Partials/Navbar.vue';
import Likes from '../../Components/Partials/Likes.vue';
import Dots from 'vue-material-design-icons/DotsVertical.vue';

import { ref } from 'vue';

defineProps({
    'posts': Object,
    'can': Object,
    'tags': Object
})

const colorTags = (tag) => {
    const tagColors = {
        'PHP': 'text-red-500',
        'Javascript': 'text-yellow-500'
    };

    return tagColors[tag] || 'text-sky-500';
};

const isOpen = ref({});

const open = (postId) => {
    isOpen.value = { [postId]: !isOpen.value[postId] };
};

</script>
<template>
    <main class="mx-auto max-w-2xl">
        <Navbar text="Home"/>
        <div class="max-w-xl mx-auto">
            <div class="flex flex-col gap-5">
                <div v-for="post in posts" :key="post.id" 
                class="border-[3px] border-secondary shadow-secondary p-4 shadow-[6px_6px] rounded-md indent-0 ">
                    <div class="text-xs mt-4 font-bold  underline">
                        {{ post.user.name }}
                    </div>
                    <div class="flex items-center justify-between relative">
                        <Link :href="`/${post.user.username}/${post.slug}`" class="text-xl md:text-3xl font-bold">
                            {{ post.title }}
                        </Link>
                        <Dots v-on:click="open(post.id)" v-if="post.can.update && post.can.delete"/>
                        <div v-if="isOpen[post.id]" class="absolute right-0 top-10 border-2 w-44 flex flex-col gap-5 py-3 px-3 bg-white border-secondary">
                                <Link :href="`/${post.user.username}/${post.slug}/edit`" class="w-fit" >
                                    Edit
                                </Link>
                                <Link :href="`/${post.user.username}/${post.slug}/delete`" class="w-fit" as="button" method="DELETE">
                                    Delete
                                </Link>
                        </div>
                    </div>
                    <div class="text-xs text-[#6b6b6b] my-2">
                        {{ post.excerpt }}
                    </div>
                    <div class="flex w-full justify-between">
                        <div class="flex pt-3 gap-5">
                            <p v-for="tag in post.tags" :key="tag.id" class="font-semibold text-xs flex items-center">
                                <span :class="colorTags(tag.name)">
                                    #
                                </span>
                                <span>
                                    {{ tag.name }}
                                </span>
                            </p>
                        </div>
                        <Likes :username="post.user.username" :slug="post.slug" :condition="post.liked" :total="post.total_likes"/>
                    </div>         
                </div>
            </div>
        </div>
    </main>
</template>