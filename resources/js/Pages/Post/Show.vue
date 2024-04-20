<script setup>
import Navbar from '../../Components/Partials/Navbar.vue';
import PostInput from '../../Components/Partials/PostInput.vue';
import Button from '../../Components/Partials/Button.vue';
import CommentList from '../../Components/CommentList.vue'
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
    post: Object,
    errors: Object
});

const form = reactive({
    content: '',
})


function submit() {
    router.post(`/${props.post.user.username}/${props.post.slug}/comment`, form)
    // console.log(form.content)
}
</script>

<template>
    <main class="mx-auto max-w-2xl ">
        <Navbar/>
        <article class="prose">
            <h1 class="text-balance">{{ post.title }}</h1>
            <p class="text-pretty">{{ post.excerpt }}</p>
            <div v-html="post.content"></div>
        </article>
        <!--  -->
        <div class="py-20">
            <form @submit.prevent="submit" class="flex gap-2 flex-col pb-10">
                <PostInput type="text" id="comment" text="Comment" v-model="form.content"/>
                <p v-if="errors.content">{{ errors.content }}</p>
                <Button text="Comment" type="submit" />
            </form>
            <div class="flex flex-col gap-5">
                <CommentList :comments="post.comments" :slug="post.slug" :username="post.user.username" :errors="errors"/>
            </div>
        </div>
        <!--  -->
    </main>
</template>