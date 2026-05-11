<script setup>
import AppFooter from '@/Layouts/AppFooter.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    canRegistrarMypes: Boolean,
});
</script>

<template>
    <Head title="MYPEs El Salvador" />

    <div class="min-h-screen bg-gray-100 flex flex-col">

        <!-- HEADER -->
        <header class="bg-white border-b border-gray-200 shadow-sm">
            <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

                <!-- LOGO -->
                <div class="flex items-center gap-3">

                    <div class="w-11 h-11 bg-orange-500 rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6 text-white"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 10l9-7 9 7v10a1 1 0 01-1 1h-6v-6H10v6H4a1 1 0 01-1-1V10z"
                            />
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-2xl font-bold text-orange-500">
                            MYPEs El Salvador
                        </h1>

                        <p class="text-sm text-gray-500">
                            Directorio de negocios locales
                        </p>
                    </div>
                </div>

                <!-- BOTONES -->
                <nav class="flex items-center gap-3">

                    <template v-if="canLogin">

                        <Link
                            :href="route('login')"
                            class="px-5 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition font-medium">
                            Iniciar sesión
                        </Link>

                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="px-5 py-2 rounded-lg bg-orange-500 hover:bg-orange-600 text-white transition font-medium">
                            Crear usuario
                        </Link>

                        <Link
                            v-if="canRegistrarMypes"
                            :href="route('registrar-mypes')"
                            class="px-5 py-2 rounded-lg border border-orange-500 text-orange-500 hover:bg-orange-50 transition font-medium">
                            Registrar MYPE
                        </Link>

                    </template>

                </nav>

            </div>
        </header>

        <!-- CONTENIDO -->
        <main class="flex-1">

            <!-- HERO -->
            <section class="max-w-7xl mx-auto mt-6 px-6">

                <div
                    class="relative h-[420px] rounded-2xl overflow-hidden bg-cover bg-center"
                    style="background-image: url('https://images.unsplash.com/photo-1520607162513-77705c0f0d4a?q=80&w=1600');"
                >

                    <!-- OVERLAY -->
                    <div class="absolute inset-0 bg-black/40"></div>

                    <!-- CONTENIDO -->
                    <div class="relative z-10 h-full flex flex-col items-center justify-center text-center px-4">

                        <div class="bg-white/80 backdrop-blur-sm px-8 py-6 rounded-2xl shadow-lg">

                            <h2 class="text-5xl font-extrabold text-black mb-4">
                                Descubre MYPEs en tu zona
                            </h2>

                            <p class="text-2xl text-gray-800">
                                Conecta con negocios locales y apoya emprendedores
                                salvadoreños
                            </p>

                        </div>

                        <!-- BUSCADOR -->
                        <div class="w-full max-w-3xl mt-8">

                            <div class="bg-white rounded-xl shadow-lg flex items-center px-5 py-4">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 text-gray-400 mr-3"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                    />
                                </svg>

                                <input
                                    type="text"
                                    placeholder="Busca por nombre, categoría o ubicación..."
                                    class="w-full outline-none text-gray-700"
                                />

                            </div>

                        </div>

                    </div>
                </div>
            </section>

            <!-- LISTADO -->
            <section class="max-w-7xl mx-auto px-6 py-14">

                <h2 class="text-5xl font-bold text-black mb-10">
                    Te puede interesar
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

                    <!-- CARD -->
                    <div class="bg-white rounded-2xl overflow-hidden shadow border border-gray-100">

                        <img
                            src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=1200"
                            class="w-full h-56 object-cover"
                        />

                        <div class="p-5">

                            <div class="flex justify-between items-center mb-3">

                                <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
                                    Restaurantes
                                </span>

                                <span class="text-yellow-500 font-semibold">
                                    ★ 4.5
                                </span>

                            </div>

                            <h3 class="text-2xl font-bold text-gray-900 mb-2">
                                Cafetería La Esquina
                            </h3>

                            <p class="text-gray-600 text-sm mb-4">
                                Cafetería artesanal con los mejores granos de café.
                            </p>

                            <div class="space-y-2 text-sm text-gray-600 mb-5">

                                <div>📍 San Salvador</div>

                                <div>📞 +503 2222 2222</div>

                                <div>✉ info@cafelaesquina.com</div>

                            </div>

                            <Link
                                href="/detalle-pyme"
                                class="block text-center bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-xl font-medium transition">
                                Ver perfil
                            </Link>

                        </div>
                    </div>

                    <!-- CARD -->
                    <div class="bg-white rounded-2xl overflow-hidden shadow border border-gray-100">

                        <img
                            src="https://images.unsplash.com/photo-1487754180451-c456f719a1fc?q=80&w=1200"
                            class="w-full h-56 object-cover"
                        />

                        <div class="p-5">

                            <div class="flex justify-between items-center mb-3">

                                <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
                                    Automotriz
                                </span>

                                <span class="text-yellow-500 font-semibold">
                                    ★ 5.0
                                </span>

                            </div>

                            <h3 class="text-2xl font-bold text-gray-900 mb-2">
                                Taller Rodríguez
                            </h3>

                            <p class="text-gray-600 text-sm mb-4">
                                Reparación y mantenimiento automotriz.
                            </p>

                            <div class="space-y-2 text-sm text-gray-600 mb-5">

                                <div>📍 San Salvador</div>

                                <div>📞 +503 2222 2222</div>

                                <div>✉ contacto@taller.com</div>

                            </div>

                            <button
                                class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-xl font-medium transition">
                                Ver perfil
                            </button>

                        </div>
                    </div>

                    <!-- CARD -->
                    <div class="bg-white rounded-2xl overflow-hidden shadow border border-gray-100">

                        <img
                            src="https://images.unsplash.com/photo-1521334884684-d80222895322?q=80&w=1200"
                            class="w-full h-56 object-cover"
                        />

                        <div class="p-5">

                            <div class="flex justify-between items-center mb-3">

                                <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
                                    Artesanías
                                </span>

                                <span class="text-yellow-500 font-semibold">
                                    ★ 5.0
                                </span>

                            </div>

                            <h3 class="text-2xl font-bold text-gray-900 mb-2">
                                Luna Maya
                            </h3>

                            <p class="text-gray-600 text-sm mb-4">
                                Artesanías y productos salvadoreños.
                            </p>

                            <div class="space-y-2 text-sm text-gray-600 mb-5">

                                <div>📍 San Salvador</div>

                                <div>📞 +503 2222 2222</div>

                                <div>✉ ventas@lunamaya.com</div>

                            </div>

                            <button
                                class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-xl font-medium transition">
                                Ver perfil
                            </button>

                        </div>
                    </div>

                    <!-- CARD -->
                    <div class="bg-white rounded-2xl overflow-hidden shadow border border-gray-100">

                        <img
                            src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?q=80&w=1200"
                            class="w-full h-56 object-cover"
                        />

                        <div class="p-5">

                            <div class="flex justify-between items-center mb-3">

                                <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
                                    Moda
                                </span>

                                <span class="text-yellow-500 font-semibold">
                                    ★ 4.0
                                </span>

                            </div>

                            <h3 class="text-2xl font-bold text-gray-900 mb-2">
                                Boutique Estilo
                            </h3>

                            <p class="text-gray-600 text-sm mb-4">
                                Moda y accesorios para toda la familia.
                            </p>

                            <div class="space-y-2 text-sm text-gray-600 mb-5">

                                <div>📍 San Salvador</div>

                                <div>📞 +503 2222 2222</div>

                                <div>✉ boutique@correo.com</div>

                            </div>

                            <button
                                class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-xl font-medium transition">
                                Ver perfil
                            </button>

                        </div>
                    </div>

                </div>

            </section>

        </main>

        <!-- FOOTER -->
        <AppFooter />

    </div>
</template>