<template>
  <Head title="Все сообщества" />

  <AuthenticatedLayout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="px-4 sm:px-6 lg:px-8">
          <div class="flex justify-end">
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
              <Link
                :href="route('communities.create')"
                class="
                  inline-flex
                  items-center
                  justify-center
                  rounded-md
                  border border-transparent
                  bg-custom-orange
                  px-4
                  py-2
                  text-sm
                  font-medium
                  text-white
                  shadow-sm
                  hover:bg-custom-orange-hover
                  sm:w-auto
                  transition ease-in-out duration-150
                "
                >Добавить сообщество</Link
              >
            </div>
          </div>
          <div class="mt-4 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div
                class="
                  inline-block
                  min-w-full
                  py-2
                  align-middle
                  md:px-6
                  lg:px-8
                "
              >
                <div
                  class="
                    overflow-hidden
                    shadow
                    ring-1 ring-black ring-opacity-5
                    md:rounded-lg
                  "
                >
                  <table class="min-w-full divide-y divide-gray-300">
                    <!-- <div>
                      <select v-model="sortKey" @change="fetchSortedCommunities">
                        <option value="name">Название</option>
                        <option value="created_at">Дата создания</option>
                      </select>
                    </div> -->
                    <thead class="bg-white">
                      <tr>
                        <th
                          scope="col"
                          class="
                            py-3.5
                            pl-4
                            pr-3
                            text-left text-sm
                            font-semibold
                            text-gray-900
                            sm:pl-6
                          "
                        >
                          Название
                        </th>
                        <th
                          scope="col"
                          class="
                            px-3
                            py-3.5
                            text-left text-sm
                            font-semibold
                            text-gray-900
                          "
                        >
                          Треды
                        </th>
                        <th
                          scope="col"
                          class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                        >
                          <span class="sr-only">Edit</span>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                      <tr
                        v-for="community in communities.data"
                        :key="community.id"
                      >
                        <td
                          class="
                            whitespace-nowrap
                            py-4
                            pl-4
                            pr-3
                            text-sm
                            font-medium
                            text-gray-900
                            sm:pl-6
                          "
                        >
                          <Link
                            :href="
                              route('frontend.communities.show', community.slug)
                            "
                            class="
                              text-blue-500
                              hover:text-blue-700
                              font-semibold
                            "
                            >{{ community.name }}</Link
                          >
                        </td>
                        <td
                          class="
                            whitespace-nowrap
                            px-3
                            py-4
                            text-sm text-gray-500
                          "
                        >
                          {{ community.slug }}
                        </td>
                        <td
                          class="
                            relative
                            whitespace-nowrap
                            py-4
                            pl-3
                            pr-4
                            text-right text-sm
                            font-medium
                            sm:pr-6
                          "
                        >
                        <div v-if="community.user_id === $page.props.auth.user.id">
                          <Link
                            :href="route('communities.edit', community.slug)"
                            class="text-custom-button hover:text-indigo-900 mr-3"
                            >Редактировать</Link
                          >
                          <button
                            @click="confirmDeletion(community.slug)"
                            :href="route('communities.destroy', community.slug)"
                            class="text-red-600 hover:text-red-900"
                            method="delete"
                            as="button"
                            type="button"
                            >Удалить</button
                          >
                        </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div v-if="communities.data.length === 0" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                  </div>
                  <div v-else class="m-2 p-2">
                    <Pagination :links="communities.links" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import Pagination from "../../Components/Pagination.vue";
import { Inertia } from '@inertiajs/inertia';

defineProps({
  communities: Object,
});

const confirmDeletion = (slug) => {
  if (confirm('Вы уверены, что хотите удалить это сообщество?')) {
    Inertia.delete(route('communities.destroy', slug));
  }
};

</script>