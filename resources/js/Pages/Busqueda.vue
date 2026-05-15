# SearchResults.vue

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import AppFooter from '@/Layouts/AppFooter.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    resultados: {
        type: Array,
        default: () => []
    },
    busqueda: {
        type: String,
        default: ''
    }
});
</script>

<template>

    <Head title="Resultados de búsqueda" />

    <AppLayout title="Resultados de búsqueda">

        <!-- HEADER -->
        <template #header>
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h2 class="font-bold text-3xl text-gray-900">
                        Resultados de búsqueda
                    </h2>

                    <p class="text-gray-500 mt-1">
                        Resultados encontrados para:
                        <span class="font-semibold text-orange-500">
                            {{ busqueda }}
                        </span>
                    </p>
                </div>

                <!-- BUSCADOR -->
                <div class="w-full md:w-[420px]">
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm flex items-center px-5 py-4">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 mr-3" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>

                        <input type="text" :value="busqueda" placeholder="Buscar negocios..."
                            class="w-full outline-none border-none focus:ring-0 text-gray-700" />
                    </div>
                </div>
            </div>
        </template>

        <div class="py-10 bg-gray-50 min-h-screen">

            <div class="max-w-7xl mx-auto px-6">

                <!-- FILTROS -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 mb-8">

                    <div class="flex flex-col lg:flex-row gap-4 lg:items-center lg:justify-between">

                        <div>
                            <h3 class="text-xl font-bold text-gray-900">
                                Filtrar resultados
                            </h3>

                            <p class="text-gray-500 text-sm mt-1">
                                Encuentra la MYPE ideal según tus necesidades
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full lg:w-auto">

                            <select class="rounded-2xl border-gray-200 focus:border-orange-500 focus:ring-orange-500">
                                <option>Todas las categorías</option>
                                <option>Restaurantes</option>
                                <option>Tecnología</option>
                                <option>Moda</option>
                                <option>Servicios</option>
                            </select>

                            <select class="rounded-2xl border-gray-200 focus:border-orange-500 focus:ring-orange-500">
                                <option>Ordenar por</option>
                                <option>Más recientes</option>
                                <option>Mejor valoradas</option>
                                <option>Más populares</option>
                            </select>

                            <button
                                class="bg-orange-500 hover:bg-orange-600 transition text-white font-semibold px-6 py-3 rounded-2xl shadow">
                                Aplicar filtros
                            </button>

                        </div>
                    </div>
                </div>

                <!-- RESULTADOS -->
                <div class="flex items-center justify-between mb-8">

                    <h3 class="text-3xl font-bold text-gray-900">
                        {{ resultados.length }} resultados encontrados
                    </h3>

                    <div class="text-sm text-gray-500">
                        Mostrando negocios disponibles
                    </div>
                </div>

                <!-- GRID -->
                <div v-if="resultados.length > 0" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

                    <!-- CARD -->
                    <div v-for="pyme in resultados" :key="pyme.id"
                        class="bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition duration-300 group">

                        <!-- IMAGEN -->
                        <div class="relative overflow-hidden">

                            <img :src="pyme.imagen || 'https://images.unsplash.com/photo-1520607162513-77705c0f0d4a?q=80&w=1200'"
                                class="w-full h-64 object-cover group-hover:scale-105 transition duration-300" />

                            <div class="absolute top-4 left-4">
                                <span
                                    class="bg-white/90 backdrop-blur-sm text-orange-600 text-xs font-bold px-4 py-2 rounded-full shadow">
                                    {{ pyme.categoria?.nombre_categoria || 'Categoría' }}
                                </span>
                            </div>

                            <div
                                class="absolute top-4 right-4 bg-black/70 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                ★ {{ pyme.rating || '5.0' }}
                            </div>
                        </div>

                        <!-- CONTENIDO -->
                        <div class="p-6">

                            <div class="mb-4">
                                <h3 class="text-2xl font-extrabold text-gray-900 mb-2">
                                    {{ pyme.nombre_pyme }}
                                </h3>

                                <p class="text-gray-600 leading-relaxed line-clamp-3">
                                    {{ pyme.descripcion_pyme }}
                                </p>
                            </div>

                            <!-- INFO -->
                            <div class="space-y-3 text-sm text-gray-600 mb-6">

                                <div class="flex items-center gap-3">
                                    <span class="text-lg">📍</span>
                                    <span>{{ pyme.direccion_pyme }}</span>
                                </div>

                                <div class="flex items-center gap-3">
                                    <span class="text-lg">📞</span>
                                    <span>{{ pyme.telefono_pyme }}</span>
                                </div>

                                <div class="flex items-center gap-3">
                                    <span class="text-lg">✉</span>
                                    <span>{{ pyme.email_pyme }}</span>
                                </div>
                            </div>

                            <!-- BOTONES -->
                            <div class="flex gap-3">

                                <Link :href="`/detalle-pyme/${pyme.id}`"
                                    class="flex-1 text-center bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-2xl transition">
                                    Ver perfil
                                </Link>

                                <button class="px-4 rounded-2xl border border-gray-200 hover:bg-gray-100 transition">
                                    ❤️
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- VACÍO -->
                <div v-else class="bg-white rounded-3xl border border-gray-100 shadow-sm p-16 text-center">

                    <div class="text-7xl mb-6">
                        🔍
                    </div>

                    <h3 class="text-3xl font-bold text-gray-900 mb-4">
                        No encontramos resultados
                    </h3>

                    <p class="text-gray-500 max-w-2xl mx-auto mb-8 leading-relaxed">
                        Intenta buscar con otros términos o explora diferentes categorías
                        para encontrar negocios y emprendimientos.
                    </p>

                    <Link href="/dashboard"
                        class="inline-flex bg-orange-500 hover:bg-orange-600 text-white px-8 py-4 rounded-2xl font-bold transition shadow-lg">
                        Volver al inicio
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>

    <AppFooter />
</template>