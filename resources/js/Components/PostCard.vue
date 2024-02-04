<template>
  <a
    :href="route('frontend.communities.posts.show', [community, post.slug])"
    class="
      mt-4
      flex
      flex-wrap
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
      <div class="community-image"><img src="" class="" alt="Обложка сообщества"></div>
    </div>
    <div class="ml-1">
      <div class="flex flex-wrap m-2 pt-1 text-xs">
        <Link
          :href="route('frontend.communities.show', community)"
          class="font-semibold mr-1 hover:underline"
          >t/{{ community }}</Link
        >
        <div class="flex flex-wrap text-gray-500">• Опубликовано
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
      <p class="mb-3 ml-2 text-sm font-normal text-gray-700 dark:text-gray-400">
        {{ post.description }}
      </p>
      <div class="flex text-xs mb-2 pb-2">
        <p class="mr-4 p-2">Комментариев ({{ post.comments_count }})</p>
        <!-- <Link
          :href="
            route('frontend.communities.posts.show', [community, post.slug])
          "
          class="
            inline-flex
            items-center
            py-2
            px-3
            text-sm
            font-medium
            text-center text-white
            bg-custom-orange
            rounded-lg
            hover:bg-custom-orange-hover
            dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800
          "
        >
          Перейти в тред
          <svg
            aria-hidden="true"
            class="ml-2 -mr-1 w-4 h-4"
            fill="currentColor"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fill-rule="evenodd"
              d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
              clip-rule="evenodd"
            ></path>
          </svg>
        </Link> -->
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

@media (min-width: 499px) { 

  .community-image {
    display: none;
  }

}

</style>