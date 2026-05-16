<script setup>
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    password: '',
});

const passwordInput = ref(null);

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => {
            form.reset();

            passwordInput.value.focus();
        },
    });
};
</script>

<template>
    <Head title="Confirmar contraseña" />

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-orange-100 via-white to-orange-50 px-4">
        <AuthenticationCard class="max-w-[500px] w-full">
            <div class="mb-4 text-sm text-gray-600">
                Esta es un área segura de la aplicación. Confirma tu contraseña antes de continuar.
            </div>

            <form @submit.prevent="submit" class="block space-y-5">
                <div>
                    <InputLabel
                        for="password"
                        value="Contraseña"
                        class="text-gray-700 font-medium"
                    />
                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-2 block w-full rounded-xl border-gray-300 focus:border-orange-400 focus:ring-orange-400"
                        required
                        autocomplete="current-password"
                        autofocus
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="pt-2">
                    <PrimaryButton
                        class="w-full justify-center py-3 text-sm rounded-xl"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Confirmar
                    </PrimaryButton>
                </div>
            </form>
        </AuthenticationCard>
    </div>
</template>
