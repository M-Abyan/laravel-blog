<script setup>

const model = defineModel()
defineProps({
    type: String,
    text: String,
    id: String,
    errors: String
})
</script>

<template>
    <div>
        <label :for="id" class="font-bold">{{ text }}</label>
        <input
        class="bg-inherit border-[3px] border-md border-[#212121] w-full py-3 px-3 rounded-sm shadow-[4px_4px]"
        :type="type"
        :id="id"
        v-model="model"
        />
        <div class="h-1">
            <p v-if="errors" class="text-red-500 text-xs">
                {{ errors }}
            </p>
        </div>
    </div>
</template>