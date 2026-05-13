<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import AppFooter from '@/Layouts/AppFooter.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    categorias: Array,
    pymes: Array,
    resenas: Array,
});

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">


                    <!-- CONTENIDO -->
                    <main class="flex-1">

                        <!-- HERO -->
                        <section class="max-w-7xl mx-auto mt-6 px-6">
                            <div class="relative h-[420px] rounded-2xl overflow-hidden bg-cover bg-center"
                                style="background-image: url('https://images.unsplash.com/photo-1520607162513-77705c0f0d4a?q=80&w=1600');">

                                <!-- OVERLAY -->
                                <div class="absolute inset-0 bg-black/40"></div>

                                <!-- CONTENIDO HERO -->
                                <div
                                    class="relative z-10 h-full flex flex-col items-center justify-center text-center px-4">

                                    <div class="bg-white/80 backdrop-blur-sm px-8 py-6 rounded-2xl">

                                        <h2 class="text-5xl font-extrabold text-black mb-4">
                                            Descubre MYPEs en tu zona
                                        </h2>

                                        <p class="text-2xl text-gray-800">
                                            Conecta con negocios locales y apoya a emprendedores
                                            de tu comunidad
                                        </p>

                                    </div>

                                    <!-- BUSCADOR -->
                                    <div class="w-full max-w-3xl mt-8">
                                        <div class="bg-white rounded-xl shadow-lg flex items-center px-5 py-4">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 mr-3"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>

                                            <input type="text" placeholder="Busca por nombre, categoría o ubicación..."
                                                class="w-full outline-none text-gray-700" />
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </section>

                        <!-- CATEGORÍAS -->
                        <section class="max-w-7xl mx-auto px-6 py-14">

                            <div class="flex items-center justify-between mb-8">

                                <h2 class="text-4xl font-bold text-black">
                                    Explora Categorías
                                </h2>

                            </div>

                            <div class="flex gap-5 overflow-x-auto scrollbar-hide pb-2">

                                <div v-for="categoria in categorias" :key="categoria.id"
                                    class="min-w-[220px] bg-white rounded-2xl shadow border border-gray-100 p-6 hover:shadow-lg transition cursor-pointer">

                                    <div
                                        class="w-14 h-14 rounded-xl bg-orange-100 flex items-center justify-center mb-5 text-3xl">
                                        📂
                                    </div>

                                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                                        {{ categoria.nombre_categoria }}
                                    </h3>

                                    <p class="text-gray-500 text-sm">
                                        Explora negocios de esta categoría.
                                    </p>

                                </div>

                            </div>

                        </section>

                        <!-- LISTADO -->
                        <section class="max-w-7xl mx-auto px-6 py-14">

                            <h2 class="text-5xl font-bold text-black mb-10">
                                Te puede interesar
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

                                <div v-for="pyme in pymes" :key="pyme.id"
                                    class="bg-white rounded-2xl overflow-hidden shadow border border-gray-100">

                                    <img :src="pyme.imagenes?.[0]?.ruta_imagen || 'https://via.placeholder.com/400x300'"
                                        class="w-full h-56 object-cover" />

                                    <div class="p-5">

                                        <div class="flex justify-between items-center mb-3">

                                            <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
                                                {{ pyme.categoria?.nombre_categoria }}
                                            </span>

                                            <span class="text-yellow-500 font-semibold">
                                                ★ {{ pyme.resenas?.length || 0 }}
                                            </span>

                                        </div>

                                        <h3 class="text-2xl font-bold text-gray-900 mb-2">
                                            {{ pyme.nombre_pyme }}
                                        </h3>

                                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                            {{ pyme.descripcion_pyme }}
                                        </p>

                                        <div class="space-y-2 text-sm text-gray-600 mb-5">

                                            <div>
                                                📍 {{ pyme.direccion_pyme }}
                                            </div>

                                            <div>
                                                📞 {{ pyme.telefono_pyme }}
                                            </div>

                                            <div>
                                                ✉ {{ pyme.email_pyme }}
                                            </div>

                                        </div>

                                        <Link :href="`/pymes/${pyme.id}`"
                                            class="block text-center bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-xl font-medium transition">
                                            Ver perfil
                                        </Link>

                                    </div>

                                </div>

                            </div>
                        </section>

                        <!-- ÚLTIMOS COMENTARIOS -->
                        <section class="max-w-7xl mx-auto px-6 pb-14">

                            <div class="flex gap-6 overflow-x-auto scrollbar-hide pb-2">
                                <h2 class="text-4xl font-bold text-black">
                                    Últimas reseñas
                                </h2>
                                <div v-for="resena in resenas" :key="resena.id"
                                    class="min-w-[360px] bg-white rounded-2xl border border-gray-100 shadow p-6">

                                    <div class="flex items-center justify-between mb-4">

                                        <div>
                                            <h4 class="font-bold text-lg text-gray-900">
                                                Usuario
                                            </h4>

                                            <p class="text-sm text-gray-400">
                                                {{ resena.pyme?.nombre_pyme }}
                                            </p>
                                        </div>

                                        <div class="flex gap-1 text-yellow-400">
                                            {{ '★'.repeat(resena.calificacion_resenas) }}
                                        </div>

                                    </div>

                                    <p class="text-gray-600 leading-relaxed">
                                        {{ resena.comentario_resenas }}
                                    </p>

                                </div>

                            </div>

                        </section>

                        <!-- CTA REGISTRO MYPE -->
                        <section class="max-w-7xl mx-auto px-6 pb-20">

                            <div
                                class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-orange-500 to-orange-600 shadow-2xl">

                                <!-- DECORACIÓN -->
                                <div class="absolute -top-10 -right-10 w-48 h-48 bg-white/10 rounded-full">
                                </div>

                                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-white/10 rounded-full">
                                </div>

                                <!-- CONTENIDO -->
                                <div
                                    class="relative z-10 px-8 py-16 md:px-16 flex flex-col lg:flex-row items-center justify-between gap-10">

                                    <!-- TEXTO -->
                                    <div class="max-w-2xl">

                                        <span
                                            class="inline-flex items-center bg-white/20 text-white text-sm font-medium px-4 py-2 rounded-full mb-5">
                                            🚀 Impulsa tu negocio
                                        </span>

                                        <h2 class="text-4xl md:text-5xl font-extrabold text-white leading-tight mb-5">

                                            ¿Tienes una MYPE?
                                            <br />

                                            Haz crecer tu negocio con nosotros
                                        </h2>

                                        <p class="text-orange-100 text-lg leading-relaxed">
                                            Registra tu emprendimiento y permite que más personas
                                            descubran tus productos y servicios en todo El Salvador.
                                            Aumenta tu visibilidad y conecta con nuevos clientes.
                                        </p>

                                    </div>

                                    <!-- BOTONES -->
                                    <div class="flex flex-col sm:flex-row gap-4 w-full lg:w-auto">

                                        <Link href="/perfil-pymes"
                                            class="bg-white text-orange-600 hover:bg-orange-50 transition px-8 py-4 rounded-2xl font-bold text-center shadow-lg">

                                            Crear perfil de MYPE
                                        </Link>

                                        <Link href="/detalle-pyme"
                                            class="border border-white/40 text-white hover:bg-white/10 transition px-8 py-4 rounded-2xl font-bold text-center">

                                            Ver ejemplos
                                        </Link>

                                    </div>

                                </div>

                            </div>

                        </section>
                    </main>
                </div>
            </div>
        </div>
    </AppLayout>
    <div>
        <AppFooter />
    </div>
</template>
