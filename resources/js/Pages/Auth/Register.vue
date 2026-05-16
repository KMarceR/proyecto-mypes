<script setup>
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    terms: false,
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <Head title="Crear Cuenta" />

    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-orange-100 via-white to-orange-50 px-4"
    >
        <AuthenticationCard class="max-w-[500px] w-full">


            <form @submit.prevent="submit" class="block space-y-5">
                <!-- NOMBRE -->
                <div>
                    <InputLabel
                        for="name"
                        value="Nombre"
                        class="text-gray-700 font-medium"
                    />
                    <TextInput
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="mt-2 block w-full rounded-xl border-gray-300 focus:border-orange-400 focus:ring-orange-400"
                        placeholder="Tu nombre completo"
                        required
                        autofocus
                        autocomplete="name"
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

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
                        autocomplete="username"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <!-- CONTRASEÑA -->
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
                        autocomplete="new-password"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <!-- CONFIRMAR CONTRASEÑA -->
                <div>
                    <InputLabel
                        for="password_confirmation"
                        value="Confirmar Contraseña"
                        class="text-gray-700 font-medium"
                    />
                    <TextInput
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        class="mt-2 block w-full rounded-xl border-gray-300 focus:border-orange-400 focus:ring-orange-400"
                        placeholder="••••••••"
                        required
                        autocomplete="new-password"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.password_confirmation"
                    />
                </div>

                <!-- TÉRMINOS -->
                <div
                    v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature"
                >
                    <InputLabel for="terms">
                        <div class="flex items-center">
                            <Checkbox
                                id="terms"
                                v-model:checked="form.terms"
                                name="terms"
                                class="rounded border-gray-300 text-orange-500 focus:ring-orange-400"
                                required
                            />
                            <div class="ms-2 text-sm text-gray-600">
                                Acepto los
                                <a
                                    target="_blank"
                                    :href="route('terms.show')"
                                    class="underline text-orange-500 hover:text-orange-600 font-medium"
                                    >Términos de Servicio</a
                                >
                                y la
                                <a
                                    target="_blank"
                                    :href="route('policy.show')"
                                    class="underline text-orange-500 hover:text-orange-600 font-medium"
                                    >Política de Privacidad</a
                                >
                            </div>
                        </div>
                        <InputError class="mt-2" :message="form.errors.terms" />
                    </InputLabel>
                </div>

                <!-- BOTÓN -->
                <div class="pt-2">
                    <PrimaryButton
                        class="w-full justify-center py-3 text-sm rounded-xl"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Crear Cuenta
                    </PrimaryButton>
                </div>

                <!-- LOGIN -->
                <div class="text-center pt-4">
                    <p class="text-sm text-gray-500">
                        ¿Ya tienes una cuenta?
                        <Link
                            :href="route('login')"
                            class="text-orange-500 hover:text-orange-600 font-semibold"
                        >
                            Iniciar sesión
                        </Link>
                    </p>
                </div>
            </form>
        </AuthenticationCard>
    </div>
</template>
