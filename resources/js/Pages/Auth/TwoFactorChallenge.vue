<script setup>
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const recovery = ref(false);

const form = useForm({
    code: '',
    recovery_code: '',
});

const recoveryCodeInput = ref(null);
const codeInput = ref(null);

const toggleRecovery = async () => {
    recovery.value ^= true;

    await nextTick();

    if (recovery.value) {
        recoveryCodeInput.value.focus();
        form.code = '';
    } else {
        codeInput.value.focus();
        form.recovery_code = '';
    }
};

const submit = () => {
    form.post(route('two-factor.login'));
};
</script>

<template>
    <Head title="Confirmación de dos factores" />

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-orange-100 via-white to-orange-50 px-4">
        <AuthenticationCard class="max-w-[500px] w-full">
            <div class="mb-4 text-sm text-gray-600">
                <template v-if="!recovery">
                    Confirma el acceso a tu cuenta ingresando el código de autenticación de tu aplicación.
                </template>

                <template v-else>
                    Confirma el acceso a tu cuenta ingresando uno de tus códigos de recuperación.
                </template>
            </div>

            <form @submit.prevent="submit" class="block space-y-5">
                <div v-if="!recovery">
                    <InputLabel
                        for="code"
                        value="Código"
                        class="text-gray-700 font-medium"
                    />
                    <TextInput
                        id="code"
                        ref="codeInput"
                        v-model="form.code"
                        type="text"
                        inputmode="numeric"
                        class="mt-2 block w-full rounded-xl border-gray-300 focus:border-orange-400 focus:ring-orange-400"
                        autofocus
                        autocomplete="one-time-code"
                    />
                    <InputError class="mt-2" :message="form.errors.code" />
                </div>

                <div v-else>
                    <InputLabel
                        for="recovery_code"
                        value="Código de recuperación"
                        class="text-gray-700 font-medium"
                    />
                    <TextInput
                        id="recovery_code"
                        ref="recoveryCodeInput"
                        v-model="form.recovery_code"
                        type="text"
                        class="mt-2 block w-full rounded-xl border-gray-300 focus:border-orange-400 focus:ring-orange-400"
                        autocomplete="one-time-code"
                    />
                    <InputError class="mt-2" :message="form.errors.recovery_code" />
                </div>

                <div class="flex items-center justify-between gap-4 pt-2">
                    <button
                        type="button"
                        class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                        @click.prevent="toggleRecovery"
                    >
                        <template v-if="!recovery">
                            Usar un código de recuperación
                        </template>

                        <template v-else>
                            Usar un código de autenticación
                        </template>
                    </button>

                    <PrimaryButton
                        class="py-3 px-6 text-sm rounded-xl"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Iniciar sesión
                    </PrimaryButton>
                </div>
            </form>
        </AuthenticationCard>
    </div>
</template>
