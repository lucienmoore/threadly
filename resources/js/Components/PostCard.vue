<template>
  <a
    :href="route('frontend.communities.posts.show', [community, post.slug])"
    class="
      mt-4
      flex
      bg-white
      rounded-lg
      border border-gray-200
      shadow-sm
      hover:border-custom-card-hover
      dark:bg-gray-800 dark:border-gray-700
    "
  >
    <div class="flex">
      <PostVote :post="post" />
    </div>
    <div class="ml-1">
      <div class="flex flex-wrap m-2 pt-1 text-xs">
        <Link
          :href="route('frontend.communities.show', community)"
          class="font-semibold mr-1 hover:underline"
          >t/{{ community }}</Link
        >
        <div class="flex flex-wrap text-gray-500"><span class="mr-1 hidden posted-dot">•</span> Опубликовано
          <span class="mx-1 text-gray-500">{{ post.name }}</span>
          {{ post.created_at }}
        </div>
      </div>
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
      <p class="mb-3 ml-2 pr-4 text-sm font-normal text-gray-700 dark:text-gray-400" v-html="post.description">
      </p>
      <div class="flex text-xs mb-3">
        <p class="mr-4 pl-2 flex gap-1.5 text-custom-gray font-bold">
          <div>
            <svg width="20" height="20" viewBox="0 0 47 48" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M23.8004 1.30017C28.8004 1.30017 33.8004 1.30017 38.8004 1.30017C42.1004 1.30017 44.7004 3.50019 45.4004 6.60019C45.5004 7.10019 45.5004 7.60018 45.5004 8.00018C45.5004 15.5002 45.5004 23.0002 45.5004 30.4002C45.5004 34.3002 42.6004 37.2002 38.7004 37.2002C33.4004 37.2002 28.2004 37.2002 22.9004 37.2002C22.6004 37.2002 22.3004 37.3002 22.1004 37.5002C18.8004 40.2002 15.6004 43.0002 12.3004 45.7002C12.0004 45.9002 11.7004 46.2002 11.3004 46.0002C10.9004 45.8002 10.9004 45.5002 10.9004 45.1002C10.9004 42.6002 10.9004 40.2002 10.9004 37.7002C10.9004 37.3002 10.8004 37.2002 10.4004 37.2002C9.30039 37.2002 8.1004 37.2002 7.0004 37.0002C4.1004 36.4002 1.90039 33.7002 1.90039 30.7002C1.90039 23.1002 1.90039 15.4002 1.90039 7.80017C1.90039 4.20017 4.9004 1.3002 8.5004 1.2002C13.6004 1.3002 18.7004 1.30017 23.8004 1.30017ZM23.7004 2.80017C18.8004 2.80017 13.8004 2.80017 8.90039 2.80017C8.40039 2.80017 7.90039 2.80018 7.40039 2.90018C5.00039 3.50018 3.40039 5.50019 3.40039 8.10019C3.40039 15.5002 3.40039 23.0002 3.40039 30.4002C3.40039 30.6002 3.40039 30.7002 3.40039 30.9002C3.50039 33.3002 5.30041 35.4002 7.70041 35.7002C8.60041 35.8002 9.50039 35.8002 10.4004 35.8002C12.5004 35.8002 12.5004 35.7002 12.5004 37.8002C12.5004 39.6002 12.5004 41.4002 12.5004 43.2002C12.5004 43.3002 12.5004 43.5002 12.6004 43.6002C12.7004 43.5002 12.9004 43.4002 13.0004 43.4002C15.9004 41.0002 18.7004 38.6002 21.6004 36.1002C21.9004 35.8002 22.2004 35.7002 22.7004 35.7002C28.1004 35.7002 33.4004 35.7002 38.8004 35.7002C41.9004 35.7002 44.2004 33.5002 44.2004 30.3002C44.2004 22.9002 44.2004 15.4002 44.2004 8.00018C44.2004 7.60018 44.2004 7.1002 44.1004 6.7002C43.5004 4.3002 41.5004 2.7002 39.0004 2.7002C33.7004 2.8002 28.7004 2.80017 23.7004 2.80017Z" fill="#878A8C" stroke="#878A8C" stroke-width="2"/>
            </svg>
          </div>
          <div>
            {{ post.comments_count }} Комментариев
          </div>
        </p>
      </div>
    </div>
  </a>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import PostVote from "./PostVote.vue";


defineProps({
  post: Object,
  community: String,
});
</script>

<style>

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