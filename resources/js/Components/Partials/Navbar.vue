<script setup>
import { Link } from '@inertiajs/vue3';

import { usePage } from '@inertiajs/vue3'
import { ref  } from 'vue';

import Burger from 'vue-material-design-icons/Hamburger.vue';
import BurgerRemove from 'vue-material-design-icons/HamburgerRemove.vue';

const page = usePage()
const user = ref(page.props.auth.user)

const isOpen = ref(false)

function open() {
    isOpen.value = !isOpen.value
    console.log(isOpen.value)
}

defineProps({
    text: String
})

</script>
<template>
        <header class="py-10 grid grid-cols-[1fr_2fr_1fr]">
            <h1 class="font-bold md:text-2xl text-sm place-self-center">_.<span class="underline">Nerd</span>ies.</h1>
            <div class="text-xs justify-self-center font-bold place-self-center md:text-lg text-center">
                <p v-if="user">
                    Hi, {{ user.name }}
                </p>
                <p v-if="!user">
                    Hello
                </p>
            </div>
            <Burger v-on:click="open" v-show="!isOpen" class="md:hidden justify-self-end"/>
            <BurgerRemove v-on:click="open" v-show="isOpen" class="md:hidden justify-self-end"/>
            <nav class="md:flex gap-2 absolute top-20 right-5 border-2 md:border-0 border-secondary bg-white z-10 p-5 md:static " :class="!isOpen ? 'hidden' : 'flex'">
                <div class="md:flex-row md:flex md:items-center">
                    <div>
                        <Link href="/">Home</Link>
                    </div>
                    <div class="flex flex-col md:flex-row justify-center" v-if="!user">
                        <Link href="/login" class="my-2 md:my-0 md:mx-2">Login</Link>
                        <Link href="/register">Register</Link>
                    </div>
                    <div class="flex flex-col md:flex-row" v-if="user">
                        <Link href="/create" class="my-2 md:mx-2">Create</Link>
                        <Link method="POST" href="/logout" as="button">
                            Logout
                        </Link>
                    </div>
                </div>
            </nav>
            
        </header>
</template>