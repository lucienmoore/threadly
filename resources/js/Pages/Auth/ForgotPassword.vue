<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password" />

        <div class="mb-4 mt-3 text-sm text-gray-600 mx-auto max-w-lg">
            Забыли пароль? Напишите адрес электронной почты, и мы пришлём вам ссылку для сброса пароля.
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600 mx-auto max-w-lg">
            {{ status }}
        </div>

        <form class="mx-auto max-w-lg" @submit.prevent="submit" novalidate>
            <div>
                <InputLabel for="email" value="Почта" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    autofocus
                    autocomplete="email"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton>
                    Получить ссылку для сброса пароля
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
