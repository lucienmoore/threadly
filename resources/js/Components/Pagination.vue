<template>
  <div class="flex overflow-x-auto">
    <template v-for="(link, key) in links" :key="key">
      <div
        v-if="link.url === null"
        v-html="link.label"
        class="mb-1 mr-1 px-4 py-3 text-gray-400 text-sm leading-4 border rounded select-none whitespace-nowrap"
      ></div>
      <Link
        v-else
        :href="link.url"
        v-html="link.label"
        class="mb-1 mr-1 px-4 py-3 text-gray-900 text-sm leading-4 border rounded hover:bg-custom-pagination-bg whitespace-nowrap"
        :class="{ 'bg-custom-pagination-bg': link.active }"
      ></Link>
    </template>
  </div>
</template>


<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  links: {
    type: Array,
    required: true
  },
});
</script>