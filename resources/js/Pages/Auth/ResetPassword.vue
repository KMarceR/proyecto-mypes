<script setup>
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("password.update"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <Head title="Restablecer contraseña" />

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-orange-100 via-white to-orange-50 px-4">
        <AuthenticationCard class="max-w-[500px] w-full">
            <form @submit.prevent="submit" class="block space-y-5">
                <div>
                    <InputLabel
                        for="email"
                        value="Correo electrónico"
                        class="text-gray-700 font-medium"
                    />
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mt-2 block w-full rounded-xl border-gray-300 focus:border-orange-400 focus:ring-orange-400"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div>
                    <InputLabel
                        for="password"
                        value="Nueva contraseña"
                        class="text-gray-700 font-medium"
                    />
                    <TextInput
                        id="password"
                        v-model="form.password"
                        type="password"
                        class="mt-2 block w-full rounded-xl border-gray-300 focus:border-orange-400 focus:ring-orange-400"
                        required
                        autocomplete="new-password"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div>
                    <InputLabel
                        for="password_confirmation"
                        value="Confirmar contraseña"
                        class="text-gray-700 font-medium"
                    />
                    <TextInput
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        class="mt-2 block w-full rounded-xl border-gray-300 focus:border-orange-400 focus:ring-orange-400"
                        required
                        autocomplete="new-password"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.password_confirmation"
                    />
                </div>

                <div class="pt-2">
                    <PrimaryButton
                        class="w-full justify-center py-3 text-sm rounded-xl"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Restablecer contraseña
                    </PrimaryButton>
                </div>
            </form>
        </AuthenticationCard>
    </div>
</template>
