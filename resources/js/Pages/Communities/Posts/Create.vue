<template>
  <Head title="Create Community" />

  <AuthenticatedLayout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto bg-white m-2 p-6">
          <form @submit.prevent="submit">
            <div>
              <Label for="title" value="Наименование" />
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

const props = defineProps({
  community: Object,
  errors: Object,
});

const form = useForm({
  title: "",
  description: "",
  image: null,
});

const submit = () => {
  form.post(route("communities.posts.store", props.community.slug), {
    preserveScroll: true, 
    onSuccess: () => form.reset('description'), 
  });
};
</script>

