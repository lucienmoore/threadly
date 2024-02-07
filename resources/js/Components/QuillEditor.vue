<template>
  <div ref="editor" class="quill-editor"></div>
</template>

<script setup>
import { onMounted, ref, watch } from 'vue';
import Quill from 'quill';
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
  modelValue: String,
});

const emit = defineEmits(['update:modelValue']);

const editor = ref(null);

let quill;

onMounted(() => {
  quill = new Quill(editor.value, {
    theme: 'snow',
    modules: {
      toolbar: [
        ['bold', 'italic', 'underline', 'strike'],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        ['clean'],
      ],
    },
  });

  quill.on('text-change', () => {
    emit('update:modelValue', quill.root.innerHTML);
  });

  watch(() => props.modelValue, (newValue) => {
    if (quill && newValue !== quill.root.innerHTML) {
      quill.root.innerHTML = newValue;
    }
  });
});
</script>
