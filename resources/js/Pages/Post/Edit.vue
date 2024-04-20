<script setup>

import Editor from '../../Components/Partials/Editor.vue';
import Button from '../../Components/Partials/Button.vue';
import Navbar from '../../Components/Partials/Navbar.vue';
import PostInput from '../../Components/Partials/PostInput.vue';

import { router } from '@inertiajs/vue3'
import { reactive  } from 'vue';


const props = defineProps( {'post': Object, errors: Object})

const form = reactive({
    title: props.post.title,
    excerpt: props.post.excerpt,
    content: props.post.content,
})

function submit() {
    router.put(`/${props.post.user.username}/${props.post.id}/edit`, form)
}

</script>
<template>
    <main class="mx-auto max-w-2xl">
        <div class="pb-10">
            <Navbar text="Create"/>
                <form @submit.prevent="submit" class="">
                    <Editor v-model="form.content"/>
                    <p v-if="errors.content">{{ errors.content }}</p>
                    <div class="grid md:grid-cols-[1fr_2fr] gap-2 my-4">
                        <div>
                            <PostInput 
                            placeholder="Your Title Goes Here" 
                            id="title" 
                            v-model="form.title" 
                            text="Title: "/>
                            <p v-if="errors.title">{{ errors.title }}</p>
                        </div>
                        <PostInput 
                        placeholder="Your Exceerpt Goes Here" 
                        id="excerpt" 
                        v-model="form.excerpt" 
                        text="Excerpt (Optional)"/>
                    </div>
                    <div class="w-full flex justify-end">
                        <Button text="Edit" type="submit"/>
                    </div>
                </form>
        </div>
    </main>
</template>