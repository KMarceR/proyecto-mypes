# SearchResults.vue

<script setup>
import AppFooter from '@/Layouts/AppFooter.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    resultados: {
        type: Array,
        default: () => []
    },
    busqueda: {
        type: String,
        default: ''
    },
    selectedCategory: {
        type: [String, Number],
        default: ''
    },
    selectedOrderBy: {
        type: String,
        default: ''
    }
});


const inputBusqueda = ref(props.busqueda ?? '');
const selectCategoria = ref(props.selectedCategory ?? '');
const selectOrden = ref(props.selectedOrderBy ?? '');

const promedio = (resenas) => {
    if (!resenas?.length) return '—';
    const avg = resenas.reduce((s, r) => s + r.calificacion_resenas, 0) / resenas.length;
    return avg.toFixed(1);
};

const onErroLoadImagen = (event) => {
    // Oculatar la imagen si no se carga correctamente
    event.target.style.display = 'none';
};
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
                    <form class="bg-white rounded-2xl border border-gray-200 shadow-sm flex items-center px-5 py-4" action="resultados-busqueda" method="GET">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 mr-3" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="hidden" name="categoria" v-model="selectCategoria" />
                        <input type="hidden" name="order_by" v-model="selectOrden" />
                        <input type="text"  placeholder="Buscar negocios..." v-model="inputBusqueda"
                            class="w-full outline-none border-none focus:ring-0 text-gray-700" name="busqueda" />
                    </form>
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

                        <form class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full lg:w-auto" action="resultados-busqueda" method="GET">
                            <input type="hidden" name="busqueda" v-model="inputBusqueda" />

                            <select v-model="selectCategoria" class="rounded-2xl border-gray-200 focus:border-orange-500 focus:ring-orange-500" name="category">
                                <option value="">Todas las categorías</option>
                                <option v-for="categoria in $page.props.categorias" :key="categoria.id" :value="categoria.id">
                                    {{ categoria.nombre_categoria }}
                                </option>
                            </select>

                            <select v-model="selectOrden" class="rounded-2xl border-gray-200 focus:border-orange-500 focus:ring-orange-500" name="order_by">
                                <option value="">Ordenar por</option>
                                <option value="recientes">Más recientes</option>
                                <option value="mejor_valoradas">Mejor valoradas</option>
                                <option value="populares">Más populares</option>
                            </select>

                            <button
                                type="submit"
                                class="bg-orange-500 hover:bg-orange-600 transition text-white font-semibold px-6 py-3 rounded-2xl shadow">
                                Aplicar filtros
                            </button>

                        </form>
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
                        class="bg-white rounded-2xl overflow-hidden shadow border border-gray-100">

                        <img :src="pyme.imagenes?.[0]?.ruta_imagen"
                            v-if="pyme.imagenes?.[0]?.ruta_imagen"
                            v-on:error="onErroLoadImagen"
                            class="w-full h-56 object-cover" />

                        <div class="p-5">

                            <div class="flex justify-between items-center mb-3">

                                <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
                                    {{ pyme.categoria?.nombre_categoria }}
                                </span>

                                <span class="text-yellow-500 font-semibold">
                                    ★ {{ promedio(pyme.resenas) }}
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

                    <Link :href="route('index')"
                        class="inline-flex bg-orange-500 hover:bg-orange-600 text-white px-8 py-4 rounded-2xl font-bold transition shadow-lg">
                        Volver al inicio
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>

    <AppFooter />
</template>
