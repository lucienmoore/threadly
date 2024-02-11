<template>
  <Head title="Создать тред" />

  <AuthenticatedLayout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto bg-white m-2 p-6">
          <form @submit.prevent="submit">
            <div>
              <Label for="title" value="Заголовок" />
              <Input
                id="title"
                type="text"
                class="mt-1 block w-full"
                v-model="form.title"
                autofocus
                autocomplete="title"
              />
              <InputError :message="errors.title" />
            </div>

            <div class="mt-4">
              <Label for="description" value="Описание" />
              <QuillEditor v-model="form.description" />
              <InputError :message="errors.description" />
            </div>

            <div class="mt-4">
              <Label for="image" value="Изображение" />
              <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-1 text-center">
                  <div v-if="previewImage" class="mt-4 relative">
                    <img :src="previewImage" alt="Предварительный просмотр изображения" class="max-w-full h-auto rounded-md border border-gray-200">
                    <button type="button" class="absolute top-0 right-0 text-white p-1 mr-1" @click="removeImage">
                      &#x2715; <!-- Этот символ представляет собой крестик (X), который можно использовать в качестве кнопки удаления -->
                    </button>
                  </div>
                  <div class="flex justify-center text-sm text-gray-600">
                    <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                      <div class="file-upload" @click="$refs.fileInput.click()">
                        <input type="file" class="hidden" ref="fileInput" @change="handleFileUpload($event)">
                        Кликните здесь, чтобы загрузить изображение
                      </div>
                    </label>
                  </div>
                  <p class="text-xs text-gray-500">
                    PNG, JPG до 10МБ
                  </p>
                </div>
              </div>
              <InputError :message="errors.image" />
            </div>

            <div class="flex items-center justify-end mt-4">
              <Button
                class="ml-4"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
              >
                Создать
              </Button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import InputError from "@/Components/InputError.vue";
import Label from "@/Components/Label.vue";
import { Head, useForm } from "@inertiajs/vue3";
import QuillEditor from "@/Components/QuillEditor.vue";
import 'quill/dist/quill.snow.css'; 
import { ref } from 'vue';

const props = defineProps({
  community: Object,
  errors: Object,
});

const form = useForm({
  title: "",
  description: "",
  image: null,
});

const previewImage = ref(null);

const removeImage = () => {
  form.image = null;
  previewImage.value = null;
};

const handleFileUpload = event => {
  const file = event.target.files[0];
  form.image = file;
  previewImage.value = URL.createObjectURL(file);
};

const submit = () => {
  const formData = new FormData();

  formData.append('title', form.title);
  formData.append('description', form.description);

  if (form.image) {
    formData.append('image', form.image);
  }

  form.post(route("communities.posts.store", props.community.slug), {
    data: formData, 
    preserveScroll: true,
    onSuccess: () => form.reset('description'), 
    headers: {
      'Content-Type': 'multipart/form-data',
    },
  });
};

</script>

<style>

.ql-toolbar {
  margin-top: 0.25rem;
}

.ql-editor {
  min-height: 8rem; 
}

.file-upload {
  border: 2px dashed #ddd;
  border-radius: 5px;
  padding: 10px;
  text-align: center;
  cursor: pointer;
  color: #888;
}
.file-upload:hover {
  background-color: #f4f4f4;
}

</style>