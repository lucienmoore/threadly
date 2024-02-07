<template>
  <Head title="Все сообщества" />

  <AuthenticatedLayout>
    <div class="py-12">
      <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
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
                  bg-custom-blue
                  px-4
                  py-2
                  text-sm
                  font-medium
                  text-white
                  shadow-sm
                  hover:bg-blue-500
                  sm:w-auto
                  transition ease-in-out duration-150
                "
                >Создать сообщество</Link
              >
            </div>
          </div>
          <div class="mb-4 mt-4">
            <input
              v-model="searchQuery"
              autofocus
              @input="fetchCommunities"
              type="text"
              placeholder="Поиск по названию..."
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            />
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
                <div v-if="communities.data.length > 0"
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
                          Описание
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
                          Создатель
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
                          Создано
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
                            max-w-40
                            truncate
                            text-sm text-gray-500
                          "
                        >
                          {{ community.description }}
                        </td>
                        <td
                          class="
                            whitespace-nowrap
                            px-3
                            py-4
                            break-all
                            truncate
                            max-w-40
                            text-sm text-gray-500
                          "
                        >
                        {{ community.user_name }}
                        </td>
                        <td
                          class="
                            whitespace-nowrap
                            px-3
                            py-4
                            break-all
                            max-w-40
                            text-sm text-gray-500
                          "
                        >
                        {{ community.created_at }}
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
                        <div class="flex justify-end gap-1" v-if="community.user_id === $page.props.auth.user.id || user.is_admin == 1">
                          <a
                            v-if="community.user_id === $page.props.auth.user.id"
                            :href="route('communities.edit', community.slug)"
                            class="px-2 py-2 hover:bg-gray-100 text-blue-700 link-hover"
                            method="delete"
                            as="button"
                            type="button"
                            ><svg class="edit-svg-icon" width="16" height="16" viewBox="0 0 481 481" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M239.751 480.27C200.301 480.27 160.861 480.38 121.411 480.24C71.3711 480.07 28.4111 451.5 9.49113 406.03C3.47113 391.57 0.491129 376.49 0.491129 360.84C0.481129 280.7 0.21113 200.57 0.58113 120.43C0.84113 65.6101 36.4411 19.4701 89.2111 5.20008C99.4411 2.44008 110.371 1.23008 121.001 1.15008C176.171 0.760079 231.351 0.940081 286.531 0.980081C301.681 0.990081 312.361 11.4601 312.041 25.7701C311.791 37.0801 302.771 47.1601 291.531 48.5601C289.191 48.8501 286.801 48.8501 284.431 48.8501C230.131 48.8701 175.821 48.8201 121.521 48.8801C89.1411 48.9101 62.1511 67.9401 52.1611 98.3601C49.8311 105.47 48.5511 113.26 48.5311 120.74C48.2811 200.63 48.2611 280.51 48.4211 360.4C48.4911 395.74 73.4111 425.14 108.031 431.29C112.551 432.09 117.221 432.33 121.821 432.33C200.721 432.39 279.611 432.4 358.511 432.36C394.811 432.34 423.881 408.5 430.751 373C431.741 367.9 431.871 362.57 431.871 357.35C431.951 303.05 431.911 248.75 431.931 194.46C431.941 182.77 437.271 174.36 446.991 170.45C461.951 164.42 478.511 174.75 479.701 190.85C479.801 192.22 479.811 193.59 479.811 194.97C479.811 249.52 479.941 304.07 479.771 358.61C479.641 400.9 462.241 434.58 427.811 459.09C407.061 473.86 383.551 480.37 358.101 480.31C318.641 480.19 279.201 480.27 239.751 480.27Z"/>
                              <path d="M426.69 0.97998C447.58 2.08998 465.67 12.92 475.13 35.33C484.22 56.86 481.14 77.66 465.13 94.84C445.83 115.55 425.34 135.16 405.32 155.2C372.78 187.78 340.11 220.24 307.71 252.96C301.21 259.52 294.12 264.2 285.23 266.97C264.89 273.3 244.79 280.38 224.54 287C215.1 290.09 206.44 288.35 199.36 281.23C192.28 274.11 190.66 265.46 193.77 256.01C201.04 233.88 208.26 211.73 215.91 189.73C217.41 185.42 220.11 181.11 223.34 177.87C276.32 124.61 329.49 71.54 382.6 18.41C393.9 7.09997 407.43 1.13998 426.69 0.97998Z"/>
                            </svg></a
                          >
                          <button
                            @click="confirmDeletion(community.slug)"
                            :href="route('communities.destroy', community.slug)"
                            class="px-2 py-2 text-red-600 hover:bg-gray-100 text-red-700 link-hover"
                            method="delete"
                            as="button"
                            type="button"
                            >
                            <svg class="delete-svg-icon" width="16" height="16" viewBox="0 0 504 617" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M419.722 352.76C419.722 300.83 419.702 248.89 419.742 196.96C419.752 183.65 429.012 172.09 441.432 169.58C459.402 165.94 475.072 178.21 475.872 196.57C475.942 198.19 475.912 199.82 475.912 201.44C475.912 302.69 475.922 403.93 475.912 505.18C475.912 552.59 448.482 592.62 404.232 609.66C392.242 614.28 379.702 616.51 366.902 616.53C290.262 616.63 213.632 616.67 136.992 616.54C89.372 616.46 46.402 584.09 32.922 538.64C29.702 527.78 28.112 516.73 28.112 505.44C28.092 403.45 28.112 301.45 28.082 199.46C28.082 187.37 32.532 177.83 43.462 171.99C61.482 162.36 84.042 175.51 84.222 195.94C84.462 223.65 84.302 251.37 84.302 279.08C84.302 354.61 84.302 430.14 84.302 505.67C84.302 531.08 99.762 551.74 124.172 558.58C128.322 559.74 132.782 560.28 137.102 560.29C213.742 560.39 290.372 560.41 367.012 560.34C395.652 560.31 419.672 536.13 419.702 507.44C419.762 455.88 419.722 404.32 419.722 352.76Z" />
                              <path d="M251.58 140.97C177.45 140.97 103.33 140.98 29.2 140.96C16.05 140.96 5.07001 133.11 1.64001 121.44C-3.89999 102.6 9.20002 84.9697 29.12 84.8097C50.46 84.6297 71.8 84.7697 93.14 84.7597C107.37 84.7597 121.59 84.6697 135.82 84.8197C139.24 84.8597 140.32 83.8397 140.29 80.3497C140.12 63.7497 140.56 47.1397 140.12 30.5497C139.66 13.4797 152.96 0.739697 170.09 0.789697C224.75 0.959697 279.41 0.839699 334.06 0.869699C348.39 0.879699 358.81 8.2497 362.78 21.4197C363.69 24.4597 363.77 27.8197 363.79 31.0397C363.89 47.0197 363.83 62.9897 363.84 78.9697C363.84 84.7597 363.84 84.7597 369.47 84.7597C404.29 84.7597 439.1 84.7397 473.92 84.7797C486.05 84.7897 495.52 89.7397 500.95 100.83C510.09 119.5 496.49 140.92 475.47 140.94C413.7 141.02 351.93 140.97 290.16 140.97C277.28 140.97 264.43 140.97 251.58 140.97ZM251.92 84.7597C269.15 84.7597 286.37 84.7097 303.6 84.8097C306.65 84.8297 308.18 84.2297 308.05 80.7097C307.8 73.9797 307.89 67.2297 308.02 60.4897C308.07 57.8597 307.12 57.0297 304.54 57.0397C269.46 57.0997 234.39 57.0997 199.31 57.0497C196.9 57.0497 195.98 57.8597 196.03 60.3097C196.14 66.9297 196.25 73.5497 195.99 80.1597C195.85 83.7597 196.99 84.8897 200.62 84.8497C217.72 84.6697 234.82 84.7597 251.92 84.7597Z"/>
                              <path d="M168.082 350.58C168.082 318.14 168.042 285.69 168.092 253.25C168.122 236.71 180.742 224.45 197.192 224.79C211.762 225.09 223.562 237.16 224.222 252.48C224.342 255.35 224.272 258.22 224.272 261.09C224.272 322.86 224.282 384.63 224.262 446.4C224.262 458.98 219.202 468.7 207.492 474.08C189.282 482.46 168.212 469.1 168.122 449.05C167.972 416.22 168.082 383.4 168.082 350.58Z"/>
                              <path d="M335.949 350.88C335.949 383.2 335.989 415.52 335.939 447.84C335.909 464.76 323.099 477.1 306.309 476.54C292.179 476.07 280.519 464 279.799 449.09C279.739 447.84 279.749 446.59 279.749 445.35C279.749 381.83 279.729 318.31 279.759 254.79C279.769 242.04 285.039 232.33 296.979 227.05C314.969 219.09 335.769 232.38 335.879 252.05C336.059 284.99 335.929 317.94 335.929 350.88C335.939 350.88 335.949 350.88 335.949 350.88Z" />
                            </svg>
                          </button
                          >
                        </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div v-if="communities.links && communities.links.length > 3" class="m-2 p-2">
                    <Pagination :links="communities.links" />
                  </div>
                </div>
                <div v-if="communities.data.length === 0" class="text-center py-2">
                  <h2 class="text-sm text-gray-600">По запросу ничего не найдено</h2>
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
import { Head, Link, usePage } from "@inertiajs/vue3";
import Pagination from "../../Components/Pagination.vue";
import { Inertia } from '@inertiajs/inertia';
import { ref, watch } from 'vue';

const debounce = (fn, delay = 600) => {
  let timeoutId;
  return (...args) => {
    clearTimeout(timeoutId);
    timeoutId = setTimeout(() => {
      fn(...args);
    }, delay);
  };
};

const searchQuery = ref(localStorage.getItem('searchQuery') || '');

const debouncedFetchCommunities = debounce(() => {
  Inertia.get(route('communities.index'), { search: searchQuery.value }, {
    only: ['communities'],
    preserveState: true,
    preserveScroll: true,
    replace: true,
  });
});

watch(searchQuery, (newValue, oldValue) => {
  if (newValue !== oldValue) {
    debouncedFetchCommunities();
    localStorage.setItem('searchQuery', newValue);
  }
});

defineProps({
  communities: Object,
});

const confirmDeletion = (slug) => {
  if (confirm('Вы уверены, что хотите удалить это сообщество?')) {
    Inertia.delete(route('communities.destroy', slug));
  }
};

const user = usePage().props.auth.user;

</script>

<style>
.delete-svg-icon {
  fill: black; 
}

.link-hover:hover .delete-svg-icon {
  fill: red; 
}

.edit-svg-icon {
  fill: black; 
}

.link-hover:hover .edit-svg-icon {
  fill: #0079D3;
}
</style>