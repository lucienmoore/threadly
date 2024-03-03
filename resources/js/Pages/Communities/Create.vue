<template>
  <Head title="Создание сообщества" />

  <AuthenticatedLayout>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto bg-white m-2 p-6">
          <h1 class="text-xl font-bold text-center mb-6 py-2 rounded-md bg-gradient-to-r from-orange-500 to-orange-600 text-white shadow-md">Создание сообщества</h1>
          <form @submit.prevent="submit">
            <div>
              <TextInput
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
                class="mt-1 block w-full border-gray-300 focus:border-custom-input-focus focus:ring-custom-input-focus rounded-md shadow-sm"
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
import TextInput from "@/Components/TextInput.vue";
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

