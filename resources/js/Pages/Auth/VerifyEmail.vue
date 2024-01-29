<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <GuestLayout>
        <Head title="Email Verification" />

        <div class="mb-4 mt-3 text-sm text-gray-600 mx-auto max-w-lg">
            Благодарим за регистрацию! Прежде чем приступить к работе, подтвердите адрес электронной почты, перейдя по ссылке, которую мы только что отправили. Если письмо не пришло, нажмите на кнопку для повторной отправки.
        </div>

        <div class="mb-4 font-medium text-sm text-green-600 mx-auto max-w-lg" v-if="verificationLinkSent">
            Новая ссылка для подтверждения была отправлена на указанный вами адрес электронной почты.
        </div>

        <form class="mx-auto max-w-lg" @submit.prevent="submit">
            <div class="mt-4 flex flex-col аitems-center justify-between">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Отправить снова
                </PrimaryButton>

                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="underline text-sm mt-3 text-gray-600 hover:text-gray-900 rounded-md focus:outline-none"
                    >Выйти</Link
                >
            </div>
        </form>
    </GuestLayout>
</template>
