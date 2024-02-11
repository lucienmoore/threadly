<script setup>
import { ref } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import PostCard from "@/Components/PostCard.vue";
import Pagination from "@/Components/Pagination.vue";
import CommunityList from "@/Components/CommunityList.vue";

defineProps({
  communities: Object,
  posts: Object,
})
</script>
  

<template>
  <GuestLayout>
    <section class="flex flex-col gap-4 justify-center md:flex-row">
      <div class="w-full md:w-8/12 order-last md:order-first">
        <PostCard
          v-for="post in posts.data"
          :post="post"
          :community="post.community_slug"
          :key="post.id"
        />
        <div class="mt-4">
          <Pagination v-if="posts.meta.links.length > 3" :links="posts.meta.links" />
        </div>
      </div>
      <div class="w-full md:w-4/12 pt-4 ">
        <CommunityList :communities="communities.data">
          <template #title>Популярные сообщества</template></CommunityList
        >
      </div>
    </section>
  </GuestLayout>
</template>