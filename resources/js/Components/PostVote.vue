<template>
  <div
    class="flex flex-col h-full w-12 p-2 pt-3 bg-custom-bg-vote text-center rounded-l-lg"
  >
    <UpVoteLink
      :slug="post.slug"
      :class="{
        'text-custom-orange': post.postVotes[0] && post.postVotes[0].vote == 1,
      }"
    />
    <div
      class="font-bold"
      :class="{
        'text-custom-orange': post.postVotes[0] && post.postVotes[0].vote == 1,
        'text-blue-600': post.postVotes[0] && post.postVotes[0].vote == -1,
      }"
    >
      {{ post.votes }}
    </div>
    <DownVoteLink
      :slug="post.slug"
      :class="{
        'text-blue-600': post.postVotes[0] && post.postVotes[0].vote == -1,
      }"
    />
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import UpVoteLink from "./UpVoteLink.vue";
import DownVoteLink from "./DownVoteLink.vue";

defineProps({
  post: Object,
});
</script>

<style>
</style>