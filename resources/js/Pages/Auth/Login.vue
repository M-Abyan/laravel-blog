<script setup>
import Auth from '../../Components/Layout/Auth.vue';
import Input from '../../Components/Partials/Input.vue';
import Button from '../../Components/Partials/Button.vue';

import { reactive } from 'vue'
import { router, Link } from '@inertiajs/vue3'
defineProps({ errors: Object })

const form = reactive({
    email: null,
    password: null,
})

function submit() {
    router.post('/login', form)
}

</script>
<template>
    <Auth>
        <form @submit.prevent="submit" class="flex flex-col gap-4">
            <Input type="text" id="email" text="Email" v-model="form.email" :errors="errors.email"/>
            <Input type="password" id="password" text="Password" v-model="form.password" :errors="errors.email"/>
            <div class="flex justify-end items-center gap-2">
                <Link href="/register">Dont Have Account?</Link>
                <Button type="submit" text="Login"/>
            </div>
        </form>
    </Auth>
</template>