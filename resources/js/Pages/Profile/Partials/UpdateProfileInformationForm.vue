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
const avatarPreview = ref(avatarUrl.value); 

const form = useForm({
    name: user.name,
    email: user.email,
    avatar: null
});

const handleFileChange = (event) => {
    form.avatar = event.target.files[0];
    avatarPreview.value = URL.createObjectURL(form.avatar); 
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

const fileInputRef = ref(null); // Добавлено: ссылка на input файл

const triggerFileInput = () => { // Добавлено: метод для открытия диалога выбора файла
    fileInputRef.value.click();
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

                <div @click="triggerFileInput" class="rounded w-40 h-40 flex items-center justify-center border border-gray-300 my-1 avatar-hover relative">
                    <img :src="avatarPreview" alt="" class="rounded object-cover h-40 w-40">
                    <div class="overlay absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 hover:opacity-100">
                        <span class="text-white text-sm font-bold">Обновить аватар</span>
                    </div>
                </div>

                <input
                    ref="fileInputRef"
                    id="avatar"
                    type="file"
                    @change="handleFileChange"
                    accept="image/*"
                    class="hidden" 
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

<style>
.avatar-hover:hover {
    cursor: pointer;
}
.avatar-hover .overlay {
    transition: opacity 0.3s;
    opacity: 0;
}
.avatar-hover:hover .overlay {
    opacity: 1;
}
</style>