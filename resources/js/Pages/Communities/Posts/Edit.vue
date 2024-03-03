<template>
  <Head title="Редактирование треда" />

  <AuthenticatedLayout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="max-w-xl mx-auto bg-white m-2 p-6">
          <h1 class="text-xl font-bold text-center mb-6 py-2 rounded-md bg-gradient-to-r from-orange-500 to-orange-600 text-white shadow-md">Редактирование треда</h1>
          <form @submit.prevent="submit">
            <div>
              <Input
                id="title"
                type="text"
                class="mt-1 block w-full"
                v-model="form.title"
                autofocus
                autocomplete="title"
                placeholder="Заголовок"
              />
              <InputError :message="errors.title" />
            </div>

            <div class="mt-4">
              <QuillEditor v-model="form.description" />
              <InputError :message="errors.description" />
            </div>

            <div class="mt-4">
              <Label for="image" value="Изображение" />
              <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md"
                  @dragover.prevent="$event.dataTransfer.dropEffect = 'copy'"
                  @drop.prevent="handleDrop">
                <div class="space-y-1 text-center">
                  <div v-if="previewImage" class="mt-4">
                    <div class="relative w-5/6 mx-auto" @mouseover="showDeleteButton = true" @mouseleave="showDeleteButton = false">
                      <img :src="previewImage" alt="Предварительный просмотр изображения" class="max-w-full mx-auto h-auto rounded-md border border-gray-200">
                      <button type="button" class="absolute top-0 right-0 px-2 py-2 mt-2 mr-2 flex items-center hover:bg-gray-100 rounded link-hover" v-show="showDeleteButton" @click="removeImage">
                        <svg class="delete-svg-icon" width="16" height="16" viewBox="0 0 504 617" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M419.722 352.76C419.722 300.83 419.702 248.89 419.742 196.96C419.752 183.65 429.012 172.09 441.432 169.58C459.402 165.94 475.072 178.21 475.872 196.57C475.942 198.19 475.912 199.82 475.912 201.44C475.912 302.69 475.922 403.93 475.912 505.18C475.912 552.59 448.482 592.62 404.232 609.66C392.242 614.28 379.702 616.51 366.902 616.53C290.262 616.63 213.632 616.67 136.992 616.54C89.372 616.46 46.402 584.09 32.922 538.64C29.702 527.78 28.112 516.73 28.112 505.44C28.092 403.45 28.112 301.45 28.082 199.46C28.082 187.37 32.532 177.83 43.462 171.99C61.482 162.36 84.042 175.51 84.222 195.94C84.462 223.65 84.302 251.37 84.302 279.08C84.302 354.61 84.302 430.14 84.302 505.67C84.302 531.08 99.762 551.74 124.172 558.58C128.322 559.74 132.782 560.28 137.102 560.29C213.742 560.39 290.372 560.41 367.012 560.34C395.652 560.31 419.672 536.13 419.702 507.44C419.762 455.88 419.722 404.32 419.722 352.76Z" />
                          <path d="M251.58 140.97C177.45 140.97 103.33 140.98 29.2 140.96C16.05 140.96 5.07001 133.11 1.64001 121.44C-3.89999 102.6 9.20002 84.9697 29.12 84.8097C50.46 84.6297 71.8 84.7697 93.14 84.7597C107.37 84.7597 121.59 84.6697 135.82 84.8197C139.24 84.8597 140.32 83.8397 140.29 80.3497C140.12 63.7497 140.56 47.1397 140.12 30.5497C139.66 13.4797 152.96 0.739697 170.09 0.789697C224.75 0.959697 279.41 0.839699 334.06 0.869699C348.39 0.879699 358.81 8.2497 362.78 21.4197C363.69 24.4597 363.77 27.8197 363.79 31.0397C363.89 47.0197 363.83 62.9897 363.84 78.9697C363.84 84.7597 363.84 84.7597 369.47 84.7597C404.29 84.7597 439.1 84.7397 473.92 84.7797C486.05 84.7897 495.52 89.7397 500.95 100.83C510.09 119.5 496.49 140.92 475.47 140.94C413.7 141.02 351.93 140.97 290.16 140.97C277.28 140.97 264.43 140.97 251.58 140.97ZM251.92 84.7597C269.15 84.7597 286.37 84.7097 303.6 84.8097C306.65 84.8297 308.18 84.2297 308.05 80.7097C307.8 73.9797 307.89 67.2297 308.02 60.4897C308.07 57.8597 307.12 57.0297 304.54 57.0397C269.46 57.0997 234.39 57.0997 199.31 57.0497C196.9 57.0497 195.98 57.8597 196.03 60.3097C196.14 66.9297 196.25 73.5497 195.99 80.1597C195.85 83.7597 196.99 84.8897 200.62 84.8497C217.72 84.6697 234.82 84.7597 251.92 84.7597Z"/>
                          <path d="M168.082 350.58C168.082 318.14 168.042 285.69 168.092 253.25C168.122 236.71 180.742 224.45 197.192 224.79C211.762 225.09 223.562 237.16 224.222 252.48C224.342 255.35 224.272 258.22 224.272 261.09C224.272 322.86 224.282 384.63 224.262 446.4C224.262 458.98 219.202 468.7 207.492 474.08C189.282 482.46 168.212 469.1 168.122 449.05C167.972 416.22 168.082 383.4 168.082 350.58Z"/>
                          <path d="M335.949 350.88C335.949 383.2 335.989 415.52 335.939 447.84C335.909 464.76 323.099 477.1 306.309 476.54C292.179 476.07 280.519 464 279.799 449.09C279.739 447.84 279.749 446.59 279.749 445.35C279.749 381.83 279.729 318.31 279.759 254.79C279.769 242.04 285.039 232.33 296.979 227.05C314.969 219.09 335.769 232.38 335.879 252.05C336.059 284.99 335.929 317.94 335.929 350.88C335.939 350.88 335.949 350.88 335.949 350.88Z" />
                        </svg>
                      </button>
                    </div>
                  </div>
                  <div v-else class="mt-4">
                    <div class="relative w-5/6 mx-auto" @mouseover="showDeleteButton = true" @mouseleave="showDeleteButton = false">
                      <img v-if="post.image" :src="`/storage/${post.image}?${new Date().getTime()}`" alt="Предварительный просмотр изображения" class="max-w-full mx-auto h-auto rounded-md border border-gray-200">
                      <button type="button" class="absolute top-0 right-0 px-2 py-2 mt-2 mr-2 flex items-center hover:bg-gray-100 rounded link-hover" v-show="showDeleteButton" @click="removeImage">
                        <svg class="delete-svg-icon" width="16" height="16" viewBox="0 0 504 617" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M419.722 352.76C419.722 300.83 419.702 248.89 419.742 196.96C419.752 183.65 429.012 172.09 441.432 169.58C459.402 165.94 475.072 178.21 475.872 196.57C475.942 198.19 475.912 199.82 475.912 201.44C475.912 302.69 475.922 403.93 475.912 505.18C475.912 552.59 448.482 592.62 404.232 609.66C392.242 614.28 379.702 616.51 366.902 616.53C290.262 616.63 213.632 616.67 136.992 616.54C89.372 616.46 46.402 584.09 32.922 538.64C29.702 527.78 28.112 516.73 28.112 505.44C28.092 403.45 28.112 301.45 28.082 199.46C28.082 187.37 32.532 177.83 43.462 171.99C61.482 162.36 84.042 175.51 84.222 195.94C84.462 223.65 84.302 251.37 84.302 279.08C84.302 354.61 84.302 430.14 84.302 505.67C84.302 531.08 99.762 551.74 124.172 558.58C128.322 559.74 132.782 560.28 137.102 560.29C213.742 560.39 290.372 560.41 367.012 560.34C395.652 560.31 419.672 536.13 419.702 507.44C419.762 455.88 419.722 404.32 419.722 352.76Z" />
                          <path d="M251.58 140.97C177.45 140.97 103.33 140.98 29.2 140.96C16.05 140.96 5.07001 133.11 1.64001 121.44C-3.89999 102.6 9.20002 84.9697 29.12 84.8097C50.46 84.6297 71.8 84.7697 93.14 84.7597C107.37 84.7597 121.59 84.6697 135.82 84.8197C139.24 84.8597 140.32 83.8397 140.29 80.3497C140.12 63.7497 140.56 47.1397 140.12 30.5497C139.66 13.4797 152.96 0.739697 170.09 0.789697C224.75 0.959697 279.41 0.839699 334.06 0.869699C348.39 0.879699 358.81 8.2497 362.78 21.4197C363.69 24.4597 363.77 27.8197 363.79 31.0397C363.89 47.0197 363.83 62.9897 363.84 78.9697C363.84 84.7597 363.84 84.7597 369.47 84.7597C404.29 84.7597 439.1 84.7397 473.92 84.7797C486.05 84.7897 495.52 89.7397 500.95 100.83C510.09 119.5 496.49 140.92 475.47 140.94C413.7 141.02 351.93 140.97 290.16 140.97C277.28 140.97 264.43 140.97 251.58 140.97ZM251.92 84.7597C269.15 84.7597 286.37 84.7097 303.6 84.8097C306.65 84.8297 308.18 84.2297 308.05 80.7097C307.8 73.9797 307.89 67.2297 308.02 60.4897C308.07 57.8597 307.12 57.0297 304.54 57.0397C269.46 57.0997 234.39 57.0997 199.31 57.0497C196.9 57.0497 195.98 57.8597 196.03 60.3097C196.14 66.9297 196.25 73.5497 195.99 80.1597C195.85 83.7597 196.99 84.8897 200.62 84.8497C217.72 84.6697 234.82 84.7597 251.92 84.7597Z"/>
                          <path d="M168.082 350.58C168.082 318.14 168.042 285.69 168.092 253.25C168.122 236.71 180.742 224.45 197.192 224.79C211.762 225.09 223.562 237.16 224.222 252.48C224.342 255.35 224.272 258.22 224.272 261.09C224.272 322.86 224.282 384.63 224.262 446.4C224.262 458.98 219.202 468.7 207.492 474.08C189.282 482.46 168.212 469.1 168.122 449.05C167.972 416.22 168.082 383.4 168.082 350.58Z"/>
                          <path d="M335.949 350.88C335.949 383.2 335.989 415.52 335.939 447.84C335.909 464.76 323.099 477.1 306.309 476.54C292.179 476.07 280.519 464 279.799 449.09C279.739 447.84 279.749 446.59 279.749 445.35C279.749 381.83 279.729 318.31 279.759 254.79C279.769 242.04 285.039 232.33 296.979 227.05C314.969 219.09 335.769 232.38 335.879 252.05C336.059 284.99 335.929 317.94 335.929 350.88C335.939 350.88 335.949 350.88 335.949 350.88Z" />
                        </svg>
                      </button>
                    </div>
                  </div>
                  <div class="flex justify-center text-sm text-gray-600">
                    <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                      <div class="file-upload" @click="$refs.fileInput.click()">
                        <input type="file" accept="image/png, image/jpeg" class="hidden" ref="fileInput" @change="handleFileUpload($event)">
                        Перенесите или выберите изображение
                      </div>
                    </label>
                  </div>
                  <p class="text-xs text-gray-500">
                    PNG, JPG
                  </p>
                </div>
              </div>
              <InputError class="mt-1" :message="errors.image" />
            </div>

            <div class="flex items-center justify-end mt-4">
              <Button
                class="ml-4"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
              >
                Обновить
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
  post: Object,
  community: Object,
  errors: Object,
});

const imageToRemove = ref(false);

const form = useForm({
  title: props.post?.title,
  description: props.post?.description,
  image: null,
  delete_image: false
});

const showDeleteButton = ref(false); 
const previewImage = ref(null);
const fileInput = ref(null);

const resetFileInput = () => {
  if (fileInput.value) {
    fileInput.value.value = '';
  }
};

const removeImage = () => {
  form.image = null;
  previewImage.value = null;
  props.post.image = null;
  form.delete_image = true;
  imageToRemove.value = true; 
};

const handleDrop = event => {
  const file = event.dataTransfer.files[0];
  if (file && file.type.match('image.*')) {
    form.image = file;
    previewImage.value = URL.createObjectURL(file);
  }
};

const handleFileUpload = event => {
  const file = event.target.files[0];
  form.image = file;
  previewImage.value = URL.createObjectURL(file);
  resetFileInput();
};

const submit = () => {
  const formData = new FormData();
  formData.append('title', form.title);
  formData.append('description', form.description);

  if (imageToRemove.value) {
    formData.append('delete_image', 'true');
  }

  if (form.image) {
    formData.append('image', form.image);
  }

  form.post(route("communities.posts.update", [props.community.slug, props.post.slug]), {
    data: formData,
    onSuccess: () => {
      previewImage.value = null;
      imageToRemove.value = false; 
    },
    onError: (error) => {
      console.error("Ошибка при обновлении поста", error);
    },
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

.delete-svg-icon {
  fill: black; 
}

.link-hover:hover .delete-svg-icon {
  fill: red; 
}

</style>