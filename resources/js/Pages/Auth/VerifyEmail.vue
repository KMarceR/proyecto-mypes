<script setup>
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    status: String,
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <Head title="Verificar correo electrónico" />

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-orange-100 via-white to-orange-50 px-4">
        <AuthenticationCard class="max-w-[500px] w-full">
            <div class="mb-4 text-sm text-gray-600">
                Antes de continuar, verifica tu correo electrónico haciendo clic en el enlace que acabamos de enviarte.
                Si no lo recibiste, podemos enviarte otro.
            </div>

            <div v-if="verificationLinkSent" class="mb-4 font-medium text-sm text-green-600">
                Se ha enviado un nuevo enlace de verificación al correo que registraste.
            </div>

            <form @submit.prevent="submit" class="block space-y-5">
                <div class="pt-2 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <PrimaryButton
                        class="w-full sm:w-auto justify-center py-3 text-sm rounded-xl"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Reenviar correo de verificación
                    </PrimaryButton>

                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                        <Link
                            :href="route('profile.show')"
                            class="text-sm text-gray-600 hover:text-gray-900 underline rounded-md"
                        >
                            Editar perfil
                        </Link>

                        <Link
                            :href="route('logout')"
                            method="post"
                            as="button"
                            class="text-sm text-gray-600 hover:text-gray-900 underline rounded-md"
                        >
                            Cerrar sesión
                        </Link>
                    </div>
                </div>
            </form>
        </AuthenticationCard>
    </div>
</template>
