<template>
  <div
    class="flex flex-col h-full w-10 p-2 pt-2 bg-custom-bg-vote text-center rounded-l-lg"
  >
    <UpVoteLink
      :slug="post.slug"
      :class="{
        'text-custom-orange upvote_svg': post.postVotes[0] && post.postVotes[0].vote == 1,
      }"
    />
    <div
      class="font-bold text-sm"
      :class="{
        'text-custom-orange': post.postVotes[0] && post.postVotes[0].vote == 1,
        'text-custom-blue-arrow': post.postVotes[0] && post.postVotes[0].vote == -1,
      }"
    >
      {{ post.votes }}
    </div>
    <DownVoteLink
      :slug="post.slug"
      :class="{
        'text-blue-600 downvote_svg-hover': post.postVotes[0] && post.postVotes[0].vote == -1,
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
.upvote_svg path {
  fill: #FF684D;
  stroke: #FF684D;
}

.downvote_svg-hover path {
  fill: #7193FF;
  stroke: #7193FF;
}
</style>
