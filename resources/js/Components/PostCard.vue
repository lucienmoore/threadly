<template>
  <div
    :href="route('frontend.communities.posts.show', [community, post.slug])"
    class="
      mt-4
      flex
      bg-white
      sm:rounded-lg
      border border-gray-200
      shadow-sm
      hover:border-custom-card-hover
      dark:bg-gray-800 dark:border-gray-700
      cursor-pointer
    "
    @click="goToPost"
  >
    <div @click.stop>
      <PostVote :post="post" />
    </div>
    <div class="grow">
      <div class="flex flex-wrap m-2 pt-1 text-xs">
        <Link
          :href="route('frontend.communities.show', community)"
          @click.stop="goToCommunity"
          class="font-semibold mr-1 hover:underline"
          >t/{{ community }}</Link
        >
        <div class="flex flex-wrap text-gray-500"><span class="mr-1 hidden posted-dot">•</span> Опубликовано
          <span class="mx-1 text-gray-500">{{ post.name }}</span>
          {{ post.created_at }}
        </div>
      </div>
      <div>
        <h5
          class="
            mb-2
            ml-2
            text-lg
            font-medium
            tracking-tight
            text-gray-900
            dark:text-white
          "
        >
          {{ post.title }}
        </h5>
      </div>
      <div v-if="!post.image">
        <p class="mb-3 ml-2 pr-4 text-sm font-normal text-gray-700 dark:text-gray-400" v-html="post.description"></p>
      </div>
      <div v-else class="image-container flex justify-center">
        <img :src="`/storage/${post.image}`" alt="Post Image" class="post-image">
      </div>
      <div class="flex text-xs mb-2">
        <p class="mr-4 pl-2 flex gap-1.5 text-custom-gray font-bold px-2 py-2 items-center">
          <div>
            <svg width="20" height="20" viewBox="0 0 47 48" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M23.8004 1.30017C28.8004 1.30017 33.8004 1.30017 38.8004 1.30017C42.1004 1.30017 44.7004 3.50019 45.4004 6.60019C45.5004 7.10019 45.5004 7.60018 45.5004 8.00018C45.5004 15.5002 45.5004 23.0002 45.5004 30.4002C45.5004 34.3002 42.6004 37.2002 38.7004 37.2002C33.4004 37.2002 28.2004 37.2002 22.9004 37.2002C22.6004 37.2002 22.3004 37.3002 22.1004 37.5002C18.8004 40.2002 15.6004 43.0002 12.3004 45.7002C12.0004 45.9002 11.7004 46.2002 11.3004 46.0002C10.9004 45.8002 10.9004 45.5002 10.9004 45.1002C10.9004 42.6002 10.9004 40.2002 10.9004 37.7002C10.9004 37.3002 10.8004 37.2002 10.4004 37.2002C9.30039 37.2002 8.1004 37.2002 7.0004 37.0002C4.1004 36.4002 1.90039 33.7002 1.90039 30.7002C1.90039 23.1002 1.90039 15.4002 1.90039 7.80017C1.90039 4.20017 4.9004 1.3002 8.5004 1.2002C13.6004 1.3002 18.7004 1.30017 23.8004 1.30017ZM23.7004 2.80017C18.8004 2.80017 13.8004 2.80017 8.90039 2.80017C8.40039 2.80017 7.90039 2.80018 7.40039 2.90018C5.00039 3.50018 3.40039 5.50019 3.40039 8.10019C3.40039 15.5002 3.40039 23.0002 3.40039 30.4002C3.40039 30.6002 3.40039 30.7002 3.40039 30.9002C3.50039 33.3002 5.30041 35.4002 7.70041 35.7002C8.60041 35.8002 9.50039 35.8002 10.4004 35.8002C12.5004 35.8002 12.5004 35.7002 12.5004 37.8002C12.5004 39.6002 12.5004 41.4002 12.5004 43.2002C12.5004 43.3002 12.5004 43.5002 12.6004 43.6002C12.7004 43.5002 12.9004 43.4002 13.0004 43.4002C15.9004 41.0002 18.7004 38.6002 21.6004 36.1002C21.9004 35.8002 22.2004 35.7002 22.7004 35.7002C28.1004 35.7002 33.4004 35.7002 38.8004 35.7002C41.9004 35.7002 44.2004 33.5002 44.2004 30.3002C44.2004 22.9002 44.2004 15.4002 44.2004 8.00018C44.2004 7.60018 44.2004 7.1002 44.1004 6.7002C43.5004 4.3002 41.5004 2.7002 39.0004 2.7002C33.7004 2.8002 28.7004 2.80017 23.7004 2.80017Z" fill="#878A8C" stroke="#878A8C" stroke-width="3"/>
            </svg>
          </div>
          <div>
            {{ post.comments_count }} Комментариев
          </div>
        </p>
        <div @click.stop="sharePost" class="flex gap-1.5 text-custom-gray font-bold cursor-pointer px-2 py-2 items-center hover:bg-gray-100 rounded link-hover">
          <svg width="20" height="20" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2.30002 3C2.30002 2.6 2.30002 2.19999 2.30002 1.79999C2.30002 0.899988 2.90002 0.2 3.80002 0C3.90002 0 4.10001 0 4.20001 0C7.20001 0 10.1 0 13.1 0C14.1 0 14.8 0.599976 15 1.59998C15 1.69998 15 1.9 15 2C15 5.4 15 8.89999 15 12.3C15 13.3 14.4 14 13.5 14.2C13.2 14.3 12.8 14.2 12.5 14.3C12.3 14.3 12.2 14.3 12 14.3C12 14.5 12 14.7 12 14.9C11.9 15.9 11.1 16.6 10.1 16.6C8.10001 16.6 6.1 16.6 4 16.6C3.3 16.6 2.59999 16.6 1.89999 16.6C0.899994 16.6 0.2 16 0 15C0 14.9 0 14.8 0 14.6C0 11.4 0 8.2 0 5C0 4 0.600006 3.29998 1.60001 3.09998C1.90001 2.99998 2.10002 3 2.30002 3ZM10.6 9.69998C10.6 8.09998 10.6 6.49999 10.6 4.89999C10.6 4.49999 10.5 4.39999 10.1 4.39999C7.40001 4.39999 4.80001 4.39999 2.10001 4.39999C1.70001 4.39999 1.60001 4.49999 1.60001 4.89999C1.60001 8.09999 1.60001 11.2 1.60001 14.4C1.60001 14.8 1.70001 14.9 2.10001 14.9C4.80001 14.9 7.40001 14.9 10.1 14.9C10.5 14.9 10.6 14.8 10.6 14.4C10.6 12.9 10.6 11.3 10.6 9.69998ZM12.1 12.7C12.4 12.7 12.8 12.7 13.1 12.7C13.5 12.7 13.6 12.6 13.6 12.2C13.6 8.79998 13.6 5.4 13.6 2C13.6 1.6 13.5 1.5 13.1 1.5C10.2 1.5 7.29999 1.5 4.39999 1.5C4.29999 1.5 4.30001 1.5 4.20001 1.5C4.00001 1.5 3.89999 1.59999 3.89999 1.79999C3.89999 2.19999 3.89999 2.6 3.89999 3C3.99999 3 4.00001 3 4.10001 3C6.10001 3 8.10001 3 10.1 3C10.3 3 10.5 2.99998 10.7 3.09998C11.5 3.29998 12.1 4.09999 12.1 4.89999C12.1 7.39999 12.1 10 12.1 12.5C12.1 12.5 12.1 12.6 12.1 12.7Z" fill="#878A8C"/>
          </svg>
          <div>
            Поделиться
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import PostVote from "./PostVote.vue";
import Toastify from 'toastify-js'
import 'toastify-js/src/toastify.css'

const props = defineProps({
  post: Object,
  community: String,
});

const goToPost = () => {
  const url = route('frontend.communities.posts.show', [props.community, props.post.slug]);
  window.location.href = url;
};

const goToCommunity = () => {
  const url = route('frontend.communities.show', community);
  window.location.href = url;
};

const sharePost = () => {
  const postLink = route('frontend.communities.posts.show', [props.community, props.post.slug]);
  
  navigator.clipboard.writeText(postLink).then(() => {
    Toastify({
      text: "Ссылка скопирована!",
      className: "toastify-left-border",
      position: "center",
      gravity: "bottom", 
      duration: 5000
    }).showToast();
  }).catch(err => {
    console.error('Ошибка при копировании: ', err);
    Toastify({
      text: "Не удалось скопировать ссылку",
      backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
      className: "error",
      position: "center",
      gravity: "bottom", 
      duration: 3000
    }).showToast();
  });
};
</script>

<style>

.post-image {
  margin-bottom: 0.5rem;
  max-height: 30rem;
}

.toastify-left-border {
  border-left: 4px solid #24A0ED; 
  background: white;
  color: black; 
  padding-left: 20px; 
  padding-right: 20px; 
  font-size: 16px; 
  border-radius: 4px; 
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
}

@media (min-width: 462px) { 
  .posted-dot {
    display: block;
  }
}

@media (min-width: 456px) { 
  .posted-dot {
    display: block;
  }
}

</style>