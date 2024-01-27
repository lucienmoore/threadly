<template>
  <guest-layout>
    <section class="flex md:flex-row m-2 p-2">
      <div class="w-8/12 mt-5">
        <Link
          v-if="$page.props.auth.auth_check"
          :href="route('communities.posts.create', community.slug)"
          class="px-3 py-2 rounded font-medium bg-custom-orange hover:bg-custom-orange-hover text-white"
          >Создать пост</Link
        >
        <PostCard
          v-for="post in posts.data"
          :post="post"
          :community="community.slug"
          :key="post.id"
        />
        <div class="mt-4 p-2">
          <Pagination :links="posts.meta.links" />
        </div>
      </div>
      <div class="w-4/12 p-4">
        <div>
          <h2
            class="
              font-semibold
              text-lg
              p-4
              bg-custom-orange
              rounded-t-lg
              text-white
            "
          >
            Информация о {{ community.name }}
          </h2>
          <p class="bg-white p-4 rounded-b-lg">{{ community.description }}</p>
        </div>
        <CommunityList class="mt-4" :communities="communities.data">
          <template #title>Популярные сообщества</template>
        </CommunityList>
      </div>
    </section>
  </guest-layout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Link } from "@inertiajs/vue3";
import PostCard from "@/Components/PostCard.vue";
import Pagination from "@/Components/Pagination.vue";
import CommunityList from "@/Components/CommunityList.vue";

defineProps({
  community: Object,
  posts: Object,
  communities: Object,
});
</script>
