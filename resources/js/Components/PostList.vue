<template>
  <div class="w-full bg-white shadow-md border sm:rounded-lg">
    <h2 class="font-semibold text-lg p-4 bg-custom-blue text-white sm:rounded-t-lg">
      <slot name="title" />
    </h2>
    <ul role="list" class="divide-y divide-slate-300 dark:divide-slate-700 px-4 py-2">
      <li v-for="post in posts" :key="post.id" class="py-3 sm:py-4">
        <div class="flex items-center space-x-1">
          <Link
            :href="
              route('frontend.communities.posts.show', [
                community.slug,
                post.slug,
              ])
            "
            class="
              text-slate-800
              dark:text-slate-400
              font-semibold
              truncate
              text-sm
              hover:text-indigo-700
            "
          >
            {{ post.title }}
          </Link>
          <div class="text-sm flex gap-1">{{ post.votes }} <span v-if="post.votes > 0" class="text-custom-orange">↑</span><span v-if="post.votes < 0" class="text-custom-blue-arrow">↓</span></div>
        </div>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  community: Object,
  posts: Object,
});
</script>