<script setup>
const model = defineModel()
defineProps({
    text: String,
    id: String,
    placeholder: String
})
</script>

<template>
    <div class="flex flex-col  shadow-[3px_3px]">
        <div class="border-t-[3px] border-x-[3px] rounded-t-sm border-black flex">
            <label :for="id" class=" w-fit px-2">
                {{text}} 
            </label>
            <div class="border-l-[3px] border-black px-2">
            </div>
        </div>
        <textarea type="text" :id="id" 
        v-model="model"
        class="border-[3px] p-2 border-secondary outline-0" :placeholder="placeholder">
        </textarea>
    </div>
</template>