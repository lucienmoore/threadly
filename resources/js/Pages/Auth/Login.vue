<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Авторизация" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600 mx-auto max-w-lg">
            {{ status }}
        </div>

        <form class="mx-auto max-w-lg bg-white shadow-md rounded px-8 pt-6 pb-6 mb-4" @submit.prevent="submit" novalidate>
            <div>
                <InputLabel for="email" value="Электронная почта" />

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

            <div class="mt-4">
                <InputLabel for="password" value="Пароль" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="flex flex-col mt-4">
                <PrimaryButton>
                    Войти
                </PrimaryButton>
                <div class="text-right mt-1">
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none"
                    >
                        Забыли пароль?
                    </Link>
                    <br>
                    <Link

                        :href="route('register')"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none"
                    >
                        Нет аккаунта?
                    </Link>
                </div>
            </div>
        </form>
    </GuestLayout>
</template>
