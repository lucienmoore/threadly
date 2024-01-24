<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    avatar: null,
});

const submit = () => {
    let formData = new FormData();
    for (let field in form) {
        formData.append(field, form[field]);
    }

    form.post(route('register'), {
        data: formData,
        onFinish: () => form.reset('password', 'password_confirmation'),
        forceFormData: true,
    });
};

const handleFileChange = (event) => {
    form.avatar = event.target.files[0];
};
</script>

<template>
    <GuestLayout>
        <Head title="Регистрация" />
        <form @submit.prevent="submit" novalidate>
            <div>
                <InputLabel for="name" value="Имя" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    autofocus
                    autocomplete="name"
                    placeholder="Можно вымышленное"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Адрес электронной почты" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    autocomplete="email"
                    placeholder="youremail@example.com"
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
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Подтверждение пароля" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="mt-4">
                <InputLabel for="avatar" value="Отображаемый аватар" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" />
                <input
                id="avatar"
                type="file"
                @change="handleFileChange"
                accept="image/*"
                class="block w-full text-sm text-gray-900 bg-gray-50 rounded-l-lg rounded-r-lg border border-gray-300 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 file:cursor-pointer file:active:bg-custom-orange-hover file:mr-4 file:py-2 file:px-4 file:rounded-r-lg file:border-0 file:font-medium file:bg-custom-orange file:text-white"
                />
                <InputError class="mt-2" :message="form.errors.avatar" />
            </div>

            <div class="flex flex-col items-center mt-4">
                <PrimaryButton>
                    Зарегистрироваться
                </PrimaryButton>
            </div>
            <div class="text-right mt-1">
                <Link
                :href="route('login')"
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none"
                >
                    Есть аккаунт?
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
