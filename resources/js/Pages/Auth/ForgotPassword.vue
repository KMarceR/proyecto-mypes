<script setup>
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <Head title="Recuperar contraseña" />

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-orange-100 via-white to-orange-50 px-4">
        <AuthenticationCard class="max-w-[500px] w-full">


            <div class="mb-4 text-sm text-gray-600">
                ¿Olvidaste tu contraseña? No hay problema. Ingresa tu correo y te enviaremos un enlace para restablecerla.
            </div>

            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit" class="block space-y-5">
                <div>
                    <InputLabel for="email" value="Correo electrónico" class="text-gray-700 font-medium" />
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
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="pt-2">
                    <PrimaryButton
                        class="w-full justify-center py-3 text-sm rounded-xl"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Enviar enlace de restablecimiento
                    </PrimaryButton>
                </div>

                <div class="text-center pt-4">
                    <p class="text-sm text-gray-500">
                        ¿Ya recuerdas tu contraseña?
                        <Link :href="route('login')" class="text-orange-500 hover:text-orange-600 font-semibold">
                            Inicia sesión
                        </Link>
                    </p>
                </div>
            </form>
        </AuthenticationCard>
    </div>
</template>
