<script setup>

import Editor from '../../Components/Partials/Editor.vue';
import Button from '../../Components/Partials/Button.vue';
import Navbar from '../../Components/Partials/Navbar.vue';
import PostInput from '../../Components/Partials/PostInput.vue';

import { router } from '@inertiajs/vue3'
import { reactive  } from 'vue';
defineProps({ errors: Object, tags:Object })

const form = reactive({
    title: null,
    excerpt: null,
    content: '<h2>I’m running Tiptap with Vue.js. 🎉</h2>',
    tags: [],
})

function submit() {
    router.post('/create', form)
}

</script>
<template>
    <main class="mx-auto max-w-2xl">
        <div class="pb-10">
            <Navbar text="Create"/>
                <form @submit.prevent="submit" class="">
                    <Editor v-model="form.content" />
                    <p v-if="errors.content">{{ errors.content }}</p>
                    <div class="grid md:grid-cols-[1fr_2fr] gap-2 my-4">
                        <div>
                            <PostInput 
                            placeholder="Your Title Goes Here" 
                            id="title" 
                            v-model="form.title" 
                            text="Title: " required/>
                            <p v-if="errors.title">{{ errors.title }}</p>
                        </div>
                        <PostInput 
                        placeholder="Your Exceerpt Goes Here" 
                        id="excerpt" 
                        v-model="form.excerpt" 
                        text="Excerpt (Optional)" />
                    </div>
                    <div class="w-full grid grid-cols-[3fr_1fr]">
                        <div class="flex gap-2">
                            Select Tags:
                            <div v-for="tag in tags" :key="tag.id">
                                <input type="checkbox" :id="tag.name" :value="tag.id" hidden v-model="form.tags">
                                <label :for="tag.name" :class="{ 'bg-green-200': form.tags.includes(tag.id) }" 
                                class="px-2 py-1 rounded">#{{ tag.name }}</label>
                            </div>
                            <p v-if="errors.tags">{{ errors.tags }}</p>
                        </div>
                        <div class="flex justify-end">
                            <Button text="Create" type="submit"/>
                        </div>
                    </div>
                </form>
        </div>
    </main>
</template>