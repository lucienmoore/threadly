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

  if (props.modelValue) {
    const delta = quill.clipboard.convert(props.modelValue);
    quill.setContents(delta, 'silent');
  }

  quill.on('text-change', () => {
  let html = quill.root.innerHTML;

  html = html
    .replace(/^(\s*<br\s*\/?>|\s*<p><br\s*\/?><\/p>|\s*)+/g, '') // Удаляем в начале
    .replace(/(\s*<br\s*\/?>|\s*<p><br\s*\/?><\/p>|\s*)+$/g, ''); // Удаляем в конце

  const text = quill.getText();
  const isTextEmpty = !text.trim();

  if (isTextEmpty) {
    emit('update:modelValue', '');
    return;
  }

  emit('update:modelValue', html);
  });

  watch(() => props.modelValue, (newValue, oldValue) => {
    if (!quill.hasFocus() && newValue !== oldValue) {
      const delta = quill.clipboard.convert(newValue);
      quill.setContents(delta, 'silent');
    }
  });
});
</script>
