<script setup>
import Auth from '../../Components/Layout/Auth.vue';
import Input from '../../Components/Partials/Input.vue';
import Button from '../../Components/Partials/Button.vue';

import { reactive } from 'vue'
import { router, Link } from '@inertiajs/vue3'
defineProps({ errors: Object })

const form = reactive({
    email: null,
    username: null,
    name: null,
    password: null,
})

function submit() {
    router.post('/register', form)
}

</script>
<template>
    <Auth>
        <form @submit.prevent="submit" class="flex flex-col gap-4">
            <Input type="text" id="email" text="Email" v-model="form.email" :errors="errors.email"/>
            <Input type="text" id="username" text="Username" v-model="form.username" :errors="errors.username"/>
            <Input type="text" id="name" text="Name" v-model="form.name" :errors="errors.name"/>
            <Input type="password" id="password" text="Password" v-model="form.password" :errors="errors.password"/>
            <div class="flex justify-end items-center gap-2">
                <Link href="/login">Have Account?</Link>
                <Button type="submit" text="Register"/>
            </div>
        </form>
    </Auth>
</template>