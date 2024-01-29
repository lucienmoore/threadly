<script setup>
import { computed } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;
const avatarUrl = computed(() => user.name ? `storage/avatars/${user.id}.jpg` : '/avatars/noname.jpg');

const form = useForm({
    name: user.name,
    email: user.email,
    avatar: user.avatar
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Информация о профиле</h2>

            <p class="mt-1 text-sm text-gray-600">
                Обновите информацию о вашем профиле, обновите пароль или измените адрес электронной почты.
            </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
            <div>
                <InputLabel for="avatar" value="Аватар" />

                <img :src="avatarUrl" alt="" class="w-20 h-20 mb-2">

                <input
                    id="avatar"
                    type="file"
                    @change="handleAvatarChange"
                    accept="image/jpeg, image/png"
                />

                <InputError class="mt-2" :message="form.errors.avatar" />
            </div>
            
            <div>
                <InputLabel for="name" value="Имя" class="mt-6" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" value="Адрес электронной почты" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="email"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800">
                    Ваш адрес электронной почты не подтвержден.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none"
                    >
                        Нажмите здесь, чтобы отправить письмо с подтверждением.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600"
                >
                    Ссылка для подтверждения была отправлена на вашу электронную почту.
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="flex gap-2">
                    <PrimaryButton :disabled="form.processing">Сохранить</PrimaryButton>

                    <Transition
                        enter-active-class="transition ease-in-out"
                        enter-from-class="opacity-0"
                        leave-active-class="transition ease-in-out"
                        leave-to-class="opacity-0"
                    >
                        <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 m-auto">Сохранено.</p>
                    </Transition>
                </div>
            </div>
        </form>
    </section>
</template>
