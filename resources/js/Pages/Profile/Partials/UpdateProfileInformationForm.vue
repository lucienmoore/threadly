<script setup>
import { computed, ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

const props = defineProps ({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;
const avatarUrl = computed(() => user.avatar ? `/storage/${user.avatar}` : '/storage/avatars/user.svg');

const form = useForm({
    name: user.name,
    email: user.email,
    avatar: null
});

const handleFileChange = (event) => {
    form.avatar = event.target.files[0];
};

const submit = () => {
    const formData = new FormData();

    formData.append('avatar', form.avatar);
    formData.append('name', form.name);
    formData.append('email', form.email);

    form.post(route('profile.update'), {
        data: formData,
        forceFormData: true,
        onSuccess: () => Inertia.reload(),
    });
};

</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Информация о профиле</h2>

            <p class="mt-1 text-sm text-gray-600">
                Обновите информацию о вашем профиле, обновите пароль или измените адрес электронной почты.
            </p>
        </header>

        <form @submit.prevent="submit" enctype="multipart/form-data" class="mt-6 space-y-6" novalidate>
            <div>
                <InputLabel for="avatar" value="Аватар" />

                <div class="w-40 h-40 flex items-center justify-center border border-gray-300 my-1">
                    <img :src="avatarUrl" alt="" class="object-cover h-40 w-40">
                </div>

                <div class="mt-4">
                    <input
                    id="avatar"
                    type="file"
                    @change="handleFileChange"
                    accept="image/*"
                    class="block w-full text-sm text-gray-900 bg-gray-50 rounded-l-lg rounded-r-lg border border-gray-300 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 file:cursor-pointer file:active:bg-custom-orange-hover file:mr-4 file:py-2 file:px-4 file:rounded-r-lg file:border-0 file:font-medium file:bg-custom-orange file:text-white"
                    />
                    <InputError class="mt-2" :message="form.errors.avatar" />
                </div>

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
