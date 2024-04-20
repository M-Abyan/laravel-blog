<script setup>
defineProps({
    text: String,
    type: String,
})
</script>

<template>

    <button 
    class="bg-secondary text-primary py-2 px-4 rounded-sm"
    :type="type || `button`">
        {{ text }}
    </button>

</template>