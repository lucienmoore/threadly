<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-orange-500 hover:bg-custom-orange-hover focus:bg-custom-orange-active border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest">
        <slot />
    </button>
</template>
