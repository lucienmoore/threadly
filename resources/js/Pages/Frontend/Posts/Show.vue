<template>
  <guest-layout>
    <section class="flex flex-col gap-2 md:flex-row m-2 p-2">
      <div class="w-full md:w-8/12">
        <div class="mx-2 p-4 bg-white rounded-lg">
          <h2 class="font-semibold text-2xl text-black">
            <Link :href="route('frontend.communities.show', community.slug)">
              t/{{ community.name }}
            </Link>
          </h2>
        </div>
        <div class="flex m-2 bg-white rounded-lg text-sm text-slate-400">
          <div>
            <PostVote :post="post.data" />
          </div>
          <div class="w-full">
            <div class="flex flex-col gap-1 md:flex-row justify-between ml-2 mt-2 mr-2 p-2">
              <div>
                Опубликовано пользователем
                <span class="text-slate-700">{{
                  post.data.name
                }}</span>
                {{ post.data.created_at }}
              </div>

              <div class="flex flex-col">
                <div v-if="can_update" @click="isMenuOpen = !isMenuOpen" class="flex cursor-pointer sm:justify-start md:justify-end">
                ☰
              </div>

              <div v-if="isMenuOpen" class="menu-content">
                <div class="flex gap-2" v-if="$page.props.auth.auth_check">
                  <Link
                    v-if="can_update"
                    :href="route('communities.posts.edit', [community.slug, post.data.slug])"
                    class="menu-link hover:text-gray-700 transition ease-in-out duration-200">Редактировать</Link>
                  <Link
                    v-if="can_delete"
                    :href="route('communities.posts.destroy', [community.slug, post.data.slug])"
                    class="menu-link hover:text-gray-700 transition ease-in-out duration-200"
                    method="delete"
                    as="button"
                    type="button">Удалить</Link>
                </div>
              </div>

            </div>

            </div>
            <div class="ml-2 pl-2">
              <h1 class="font-semibold text-3xl text-black">
                {{ post.data.title }}
              </h1>
              <p class="text-slate-700 my-2">{{ post.data.description }}</p>
              <a
                :href="post.data.url"
                class="font-semibold text-blue-500 text-sm hover:text-blue-300"
                >{{ post.data.url }}</a
              >
            </div>
            <hr />
            <div v-if="$page.props.auth.auth_check">
              <form class="m-2 p-2 max-w-md" @submit.prevent="submit">
                <div class="mt-2">
                  <label
                    for="comment"
                    class="
                      block
                      mb-2
                      text-sm
                      font-medium
                      text-gray-900
                      dark:text-gray-400
                    "
                    >Ваш комментарий</label
                  >
                  <textarea
                    v-model="form.content"
                    id="comment"
                    rows="4"
                    class="
                      block
                      p-2.5
                      w-full
                      text-sm text-gray-900
                      bg-gray-50
                      rounded-lg
                      border border-gray-300
                      focus:ring-blue-500 focus:border-blue-500
                      dark:bg-gray-700
                      dark:border-gray-600
                      dark:placeholder-gray-400
                      dark:text-white
                      dark:focus:ring-blue-500
                      dark:focus:border-blue-500
                    "
                    placeholder="Что об этом думаете?"
                  ></textarea>
                </div>
                <div class="mt-2">
                  <button
                  :disabled="!form.content.trim()"
                  class="
                    px-4
                    py-2
                    bg-custom-button
                    hover:bg-blue-700
                    text-white
                    rounded-md
                    disabled:bg-blue-300
                  "
                  >
                    Отправить
                  </button>
                </div>
              </form>
            </div>
            <div>
              <ul role="list" class="divide-y divide-gray-200 m-2 p-2">
                <li
                  v-for="(comment, index) in reversedComments"
                  :key="index"
                  class="py-4 flex flex-col"
                >
                  <div class="text-sm">
                    <span class="font-semibold ml-1 text-slate-700">{{
                      comment.name
                    }}
                    </span>
                    <span class="text-gray-500 text-xs"> ({{ comment.created_at }})</span>
                  </div>
                  <div class="text-slate-600 m-2 p-2">
                    {{ comment.content }}
                  </div>
                </li>
              </ul>
            </div>
            <hr />
          </div>
        </div>
      </div>
      <div class="w-full md:w-4/12">
        <PostList :posts="posts.data" :community="community">
          <template #title>Популярные треды</template>
        </PostList>
      </div>
    </section>
  </guest-layout>
</template>

<script setup>
import { ref } from 'vue';
import { computed } from 'vue';
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import PostVote from "@/Components/PostVote.vue";
import PostList from "@/Components/PostList.vue";

const isMenuOpen = ref(false);

const props = defineProps({
  community: Object,
  post: Object,
  posts: Object,
  can_delete: Boolean,
  can_update: Boolean,
});

const form = useForm({
  content: "",
});

const submit = () => {
  form.post(
    route("frontend.posts.comments", [
      props.community.slug,
      props.post.data.slug,
    ]),
    {
      onSuccess: () => form.reset("content"),
    }
  );
};

const reversedComments = computed(() => {
  return [...props.post.data.comments].reverse();
});
</script>