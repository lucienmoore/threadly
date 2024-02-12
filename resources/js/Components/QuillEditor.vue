<template>
  <div id="quillEditor" ref="editor" class="quill-editor"></div>
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

  quill.root.dataset.placeholder = 'Введите текст';

  if (props.modelValue) {
    const delta = quill.clipboard.convert(props.modelValue);
    quill.setContents(delta, 'silent');
  }

  quill.on('text-change', () => {
  let html = quill.root.innerHTML;

  html = html
    .replace(/^(\s*<br\s*\/?>|\s*<p><br\s*\/?><\/p>|\s*)+/g, '') 
    .replace(/(\s*<br\s*\/?>|\s*<p><br\s*\/?><\/p>|\s*)+$/g, ''); 

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

<style>
.ql-editor {
  font-size: 14px;
  font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

#quillEditor .ql-editor.ql-blank::before {
  font-style: normal; 
  color: #6B7280
}
</style>