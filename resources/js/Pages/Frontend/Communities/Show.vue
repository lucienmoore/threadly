<template>
  <guest-layout>
    <section class="flex flex-col md:flex-row gap-4">
      <div class="w-full md:w-8/12 mt-5">
        <div class="p-4 mb-3 bg-white sm:rounded-lg hidden md:block">
          <h2 class="font-semibold text-2xl text-black">
            <Link :href="route('frontend.communities.show', community.slug)">
              t/{{ community.name }}
            </Link>
          </h2>
        </div>
        <div v-if="posts.data.length === 0" class="w-8/12 mt-5 pl-2">
          Здесь пока что пусто...
        </div>
        <div v-else>
          <PostCard
            v-for="post in posts.data"
            :post="post"
            :community="community.slug"
            :key="post.id"
          />
          <div class="mt-4">
            <Pagination v-if="posts.meta.links.length > 3" :links="posts.meta.links" />
          </div>
        </div>
      </div>
      <div class="w-full md:w-4/12 mt-5 order-first md:order-last">
        <div>
          <h2
            class="
              font-semibold
              text-lg
              p-4
              bg-custom-blue
              sm:rounded-t-lg
              text-white
            "
          >
            О сообществе {{ community.name }}
          </h2>
          <p class="bg-white p-3 rounded-b-lg flex flex-col gap-4">
            <div>
              {{ community.description }}
            </div>
            <div>
              🎂 Дата создания: {{ formatDate(community.created_at) }}
            </div>
            <div class="flex justify-center">
              <Link
              v-if="$page.props.auth.auth_check"
              :href="route('communities.posts.create', community.slug)"
              class="px-4 py-2 w-full text-center rounded-full font-medium text-sm bg-custom-blue hover:bg-blue-500 text-white"
              >Создать тред</Link>
            </div>
          </p>
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
import { format, parseISO } from 'date-fns';
import { ru } from 'date-fns/locale';

const formatDate = (dateString) => {
  const date = parseISO(dateString);
  return format(date, "PP", { locale: ru });
};

defineProps({
  community: Object,
  posts: Object,
  communities: Object,
});
</script>
