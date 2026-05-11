<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Iniciar Sesión" />

    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-orange-100 via-white to-orange-50 px-4"
    >

        <AuthenticationCard>

            <!-- LOGO -->
            <template #logo>

                <template>
    <div
        class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-orange-100 via-white to-orange-50 px-4"
    >
        <!-- Logo -->
        <div class="mb-6">
            <slot name="logo" />
        </div>

        <!-- Card -->
        <div
            class="w-full max-w-md bg-white rounded-3xl shadow-2xl border border-orange-100 px-8 py-10"
        >
            <slot />
        </div>
    </div>
</template>

            </template>

            <!-- STATUS -->
            <div
                v-if="status"
                class="mb-6 rounded-xl bg-green-100 border border-green-200 text-green-700 px-4 py-3 text-sm"
            >
                {{ status }}
            </div>

            <!-- FORM -->
            <form @submit.prevent="submit" class="space-y-5">

                <!-- EMAIL -->
                <div>

                    <InputLabel
                        for="email"
                        value="Correo Electrónico"
                        class="text-gray-700 font-medium"
                    />

                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mt-2 block w-full rounded-xl border-gray-300 focus:border-orange-400 focus:ring-orange-400"
                        placeholder="correo@ejemplo.com"
                        required
                        autofocus
                        autocomplete="username"
                    />

                    <InputError
                        class="mt-2"
                        :message="form.errors.email"
                    />

                </div>

                <!-- PASSWORD -->
                <div>

                    <InputLabel
                        for="password"
                        value="Contraseña"
                        class="text-gray-700 font-medium"
                    />

                    <TextInput
                        id="password"
                        v-model="form.password"
                        type="password"
                        class="mt-2 block w-full rounded-xl border-gray-300 focus:border-orange-400 focus:ring-orange-400"
                        placeholder="••••••••"
                        required
                        autocomplete="current-password"
                    />

                    <InputError
                        class="mt-2"
                        :message="form.errors.password"
                    />

                </div>

                <!-- REMEMBER -->
                <div class="flex items-center justify-between">

                    <label class="flex items-center">

                        <Checkbox
                            v-model:checked="form.remember"
                            name="remember"
                            class="rounded border-gray-300 text-orange-500 focus:ring-orange-400"
                        />

                        <span class="ms-2 text-sm text-gray-600">
                            Recordarme
                        </span>

                    </label>

                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="text-sm text-orange-500 hover:text-orange-600 font-medium"
                    >
                        ¿Olvidaste tu contraseña?
                    </Link>

                </div>

                <!-- BUTTON -->
                <div class="pt-2">

                    <PrimaryButton
                        class="w-full justify-center py-3 text-sm rounded-xl"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Iniciar Sesión
                    </PrimaryButton>

                </div>

                <!-- REGISTER -->
                <div class="text-center pt-4">

                    <p class="text-sm text-gray-500">
                        ¿No tienes una cuenta?

                        <Link
                            :href="route('register')"
                            class="text-orange-500 hover:text-orange-600 font-semibold"
                        >
                            Crear cuenta
                        </Link>
                    </p>

                </div>

            </form>

        </AuthenticationCard>

    </div>
</template>