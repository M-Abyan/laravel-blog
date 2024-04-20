  
<script setup>
import PostInput from './Partials/PostInput.vue';
import HeartOutline from 'vue-material-design-icons/HeartOutline.vue';
import HeartFilled from 'vue-material-design-icons/Heart.vue';
import ChatOutline from 'vue-material-design-icons/ChatOutline.vue';
import Button from './Partials/Button.vue';
import { Link, router } from '@inertiajs/vue3';
import { defineProps,ref, reactive } from 'vue';
import Dots from 'vue-material-design-icons/DotsVertical.vue';

const openReply = ref([]);
const openEdit = ref([]);

const isOpen = ref({});

const form = reactive({
    contentChild: '',
})

const toggleReplyInput = (commentId) => {
  const index = openReply.value.indexOf(commentId);
  if (index == -1) {
    openReply.value.push(commentId); // If comment ID not in the array, add it
  } else {
    openReply.value.splice(index, 1); // If comment ID already in the array, remove it
  }
};

const toggleEditInput = (commentId) => {
  const index = openEdit.value.indexOf(commentId);
  if (index == -1) {
    openEdit.value.push(commentId); // If comment ID not in the array, add it
  } else {
    openEdit.value.splice(index, 1); // If comment ID already in the array, remove it
  }
};

const props = defineProps({
  slug: String,
  username: String,
  comments: Object,
  errors: Object
});

function child(comment) {
    router.post(`/${props.username}/${props.slug}/${comment}/child`, {
      contentChild: form.contentChild,
    })
}

function edit(comment) {
    router.post(`/${props.username}/${props.slug}/${comment}/update`, {
      contentChild: form.contentChild,
    })
}


const open = (commentId) => {
  isOpen.value = { [commentId]: !isOpen.value[commentId] };
};
</script>


<template>
  <main class="">
      <div v-for="comment in comments" :key="comment.id" class="ml-2 w-full">
        <div class="border-l-2 border-secondary px-2 flex flex-col">
          <div class="grid grid-cols-2 items-center gap-2">
            <div class="flex items-center gap-2">
              <p class="font-bold">{{ comment.user.name }}</p>
              <p class="text-sm before:content-['📅'] before:mr-1">
                {{
                  new Date(comment.created_at).toLocaleDateString('en-US', { day: 'numeric', month: 'short' })
                }}
              </p>
            </div>
            <div class="justify-self-end relative">
            <Dots v-on:click="open(comment.id)" v-if="comment.can.update && comment.can.delete"/>
            <div v-if="isOpen[comment.id]" class="absolute right-0">
              <button @click="toggleEditInput(comment.id)">edit</button>
              <form @submit.prevent="edit(comment.id)" v-if="openEdit.includes(comment.id)">
                <PostInput type="text" id="comment" text="Comment" v-model="form.contentChild"/>
                <p v-if="errors.contentChild">{{ errors.contentChild }}</p>
                Submit
              </form>
              <Link :href="`/${username}/${slug}/${comment.id}/delete`" class="text-sm" 
              as="button" method="DELETE" >
                Delete
              </Link>
              </div>
            </div>
          </div>
          <p class="text-sm">{{ comment.content }}</p>
          <div class="flex gap-3 my-5">
            <div class="flex gap-1">
                  <Link :href="`/${username}/${slug}/${comment.id}/like`" class="text-xs" as="button" 
                  method="POST" preserve-scroll>
                  <HeartFilled v-if="comment.liked"/>
                  <HeartOutline  v-else/>
                  </Link>
                  <p>{{comment.total_likes}}</p>
                </div>
                <div class="relative">
                  <ChatOutline @click="toggleReplyInput(comment.id)"/>
                  <form @submit.prevent="child(comment.id)" class="flex gap-2 flex-col pb-10 absolute bg-white z-10" 
                  v-if="openReply.includes(comment.id)" >
                    <PostInput type="text" id="comment" text="Comment" v-model="form.contentChild"/>
                    <p v-if="errors.contentChild">{{ errors.contentChild }}</p>
                    <div class="">
                      <Button text="Comment" type="submit" />
                    </div>
                  </form>
                </div>
              </div>
              <CommentList :comments="comment.comments" v-if="comment.comments && comment.comments.length > 0" 
                :slug="slug" :username="username" :errors="errors"/>
          </div>
      </div>
    </main>
</template>
