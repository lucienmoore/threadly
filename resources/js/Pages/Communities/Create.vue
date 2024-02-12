<template>
  <Head title="Создание сообщества" />

  <AuthenticatedLayout>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto bg-white m-2 p-6">
          <h1 class="text-xl font-bold text-center mb-6 py-2 rounded-md bg-gradient-to-r from-blue-600 to-purple-700 text-white shadow-md">Создание сообщества</h1>
          <form @submit.prevent="submit">
            <div>
              <Input
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.name"
                autofocus
                autocomplete="name"
                placeholder="Название"
              />
              <InputError :message="errors.name" />
            </div>

            <div class="mt-4">
              <textarea
                id="description"
                class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                rows="3"
                v-model="form.description"
                autocomplete="description"
                placeholder="Описание"
              ></textarea>
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

defineProps({
  errors: Object,
});

const form = useForm({
  name: "",
  description: "",
  slug: "",
});

const submit = () => {
  form.post(route("communities.store"));
};
</script>

