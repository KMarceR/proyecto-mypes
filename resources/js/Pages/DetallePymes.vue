<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import AppFooter from '@/Layouts/AppFooter.vue';
import { Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    nombre: '',
    categoria: '',
    telefono: '',
    email: '',
    direccion: '',
    descripcion: '',
    imagen: '',
});

const categorias = [
    'Restaurante',
    'Tecnología',
    'Ropa y Accesorios',
    'Servicios',
    'Educación',
    'Salud',
];

const submit = () => {
    form.post('/mypes');
};
</script>

<template>
    <AppLayout title="Registrar MYPE">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Registrar MYPE
            </h2>
        </template>

        <div class="py-10 bg-gray-100 min-h-screen">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

                <!-- Botón volver -->
                <div class="mb-6">
                    <Link href="/"
                        class="inline-flex items-center gap-2 text-gray-700 hover:text-orange-500 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>

                        Volver
                    </Link>
                </div>

                <!-- Card Principal -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl p-8">

                    <!-- Encabezado -->
                    <div class="flex items-start gap-4 mb-8">
                        <div class="w-14 h-14 rounded-xl bg-orange-500 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10l1-2a2 2 0 012-1h12a2 2 0 012 1l1 2m-18 0h18m-16 0v7a2 2 0 002 2h10a2 2 0 002-2v-7m-8 4h4" />
                            </svg>
                        </div>

                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">
                                Registra tu MYPE
                            </h1>

                            <p class="text-gray-500 mt-2">
                                Completa la información de tu negocio para que
                                más personas puedan conocerte
                            </p>
                        </div>
                    </div>

                    <!-- Formulario -->
                    <form @submit.prevent="submit" class="space-y-6">

                        <!-- Nombre -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2">
                                Nombre del negocio
                                <span class="text-red-500">*</span>
                            </label>

                            <input v-model="form.nombre" type="text" placeholder="Ej: Cafetería La Esquina"
                                class="w-full rounded-xl border border-gray-200 bg-gray-100 px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:outline-none" />
                        </div>

                        <!-- Categoria y Telefono -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    Categoría
                                    <span class="text-red-500">*</span>
                                </label>

                                <select v-model="form.categoria"
                                    class="w-full rounded-xl border border-gray-200 bg-gray-100 px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:outline-none">
                                    <option value="">
                                        Selecciona una categoría
                                    </option>

                                    <option v-for="categoria in categorias" :key="categoria" :value="categoria">
                                        {{ categoria }}
                                    </option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    Teléfono
                                    <span class="text-red-500">*</span>
                                </label>

                                <input v-model="form.telefono" type="text" placeholder="+503 2222 2222"
                                    class="w-full rounded-xl border border-gray-200 bg-gray-100 px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:outline-none" />
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2">
                                Email
                                <span class="text-red-500">*</span>
                            </label>

                            <input v-model="form.email" type="email" placeholder="info@tunegocio.com"
                                class="w-full rounded-xl border border-gray-200 bg-gray-100 px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:outline-none" />
                        </div>

                        <!-- Dirección -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2">
                                Dirección
                                <span class="text-red-500">*</span>
                            </label>

                            <input v-model="form.direccion" type="text" placeholder="San Salvador, El Salvador"
                                class="w-full rounded-xl border border-gray-200 bg-gray-100 px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:outline-none" />
                        </div>

                        <!-- Descripción -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2">
                                Descripción
                                <span class="text-red-500">*</span>
                            </label>

                            <textarea v-model="form.descripcion" rows="4"
                                placeholder="Describe tu negocio, productos o servicios..."
                                class="w-full rounded-xl border border-gray-200 bg-gray-100 px-4 py-3 resize-none focus:ring-2 focus:ring-orange-500 focus:outline-none" />
                        </div>

                        <!-- Imagen -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2">
                                URL de imagen (opcional)
                            </label>

                            <input v-model="form.imagen" type="text" placeholder="https://ejemplo.com/imagen.jpg"
                                class="w-full rounded-xl border border-gray-200 bg-gray-100 px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:outline-none" />

                            <p class="text-sm text-gray-400 mt-2">
                                Si no proporcionas una imagen, se usará una por defecto
                            </p>
                        </div>

                        <!-- Botones -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">

                            <button type="submit" :disabled="form.processing"
                                class="w-full rounded-xl bg-orange-500 py-3 text-white font-semibold hover:bg-orange-600 transition disabled:opacity-50">
                                Registrar MYPE
                            </button>

                            <Link href="/"
                                class="w-full rounded-xl border border-gray-300 py-3 text-center font-semibold text-gray-700 hover:bg-gray-100 transition">
                                Cancelar
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
    <div>
        <AppFooter />
    </div>
</template>