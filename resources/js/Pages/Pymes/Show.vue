<script setup>
import AppFooter from '@/Layouts/AppFooter.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const props = defineProps({
    pyme: Object,
});

const page = usePage();
const flash = computed(() => page.props.flash);

const promedio = computed(() => {
    const resenas = props.pyme?.resenas;
    if (!resenas?.length) return null;
    return (resenas.reduce((s, r) => s + r.calificacion_resenas, 0) / resenas.length).toFixed(1);
});

const DIAS = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

const form = useForm({
    calificacion_resenas: 5,
    comentario_resenas: '',
});

const hoverRating = ref(0);

const submitResena = () => {
    form.post(route('pymes.resenas.store', props.pyme.id), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};

const onErroLoadImagen = (event) => {
    // Oculatar la imagen si no se carga correctamente
    event.target.style.display = 'none';
};
</script>

<template>
    <AppLayout :title="pyme.nombre_pyme">

        <div class="min-h-screen bg-[#f5f5f5] flex flex-col">
            <div class="flex-1 py-10">
                <div class="max-w-5xl mx-auto px-4">

                    <!-- VOLVER -->
                    <div class="mb-6">
                        <Link :href="route('index')"
                            class="inline-flex items-center gap-2 text-gray-700 hover:text-orange-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                            Volver
                        </Link>
                    </div>

                    <!-- ALERTA ÉXITO -->
                    <div v-if="flash?.success"
                        class="mb-6 bg-green-50 border border-green-200 text-green-700 px-5 py-3 rounded-xl text-sm">
                        {{ flash.success }}
                    </div>

                    <!-- CARD NEGOCIO -->
                    <div class="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm">

                        <!-- IMAGEN PRINCIPAL -->
                        <img
                            v-if="pyme?.imagenes?.[0]?.ruta_imagen"
                            :src="pyme.imagenes?.[0]?.ruta_imagen"
                            alt="Imagen del negocio"
                            class="w-full h-[340px] object-cover"
                            v-on:error="onErroLoadImagen"
                        />

                        <!-- INFO -->
                        <div class="p-6">

                            <!-- TOP -->
                            <div class="flex items-start justify-between mb-5">
                                <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full font-medium">
                                    {{ pyme.categoria?.nombre_categoria }}
                                </span>

                                <div class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 text-yellow-400 fill-yellow-400" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81H7.03a1 1 0 00.95-.69l1.07-3.292z" />
                                    </svg>
                                    <span class="font-semibold text-gray-800">
                                        {{ promedio ?? '—' }}
                                    </span>
                                    <span class="text-gray-400 text-sm">
                                        ({{ pyme.resenas?.length || 0 }})
                                    </span>
                                </div>
                            </div>

                            <!-- TÍTULO -->
                            <h1 class="text-5xl font-bold text-gray-900 mb-4">
                                {{ pyme.nombre_pyme }}
                            </h1>

                            <!-- DESCRIPCIÓN -->
                            <p class="text-gray-500 text-lg leading-relaxed mb-8">
                                {{ pyme.descripcion_pyme }}
                            </p>

                            <!-- GRID INFO -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                <!-- DIRECCIÓN -->
                                <div class="flex items-start gap-3">
                                    <div class="text-orange-500 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-lg">Dirección</p>
                                        <p class="text-gray-500">{{ pyme.direccion_pyme }}</p>
                                    </div>
                                </div>

                                <!-- TELÉFONO -->
                                <div class="flex items-start gap-3">
                                    <div class="text-orange-500 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-lg">Teléfono</p>
                                        <a :href="`tel:${pyme.telefono_pyme}`" class="text-gray-500 hover:text-orange-500 transition">
                                            {{ pyme.telefono_pyme }}
                                        </a>
                                    </div>
                                </div>

                                <!-- EMAIL -->
                                <div class="flex items-start gap-3">
                                    <div class="text-orange-500 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-lg">Email</p>
                                        <a :href="`mailto:${pyme.email_pyme}`" class="text-gray-500 hover:text-orange-500 transition">
                                            {{ pyme.email_pyme }}
                                        </a>
                                    </div>
                                </div>

                                <!-- MIEMBRO DESDE -->
                                <div class="flex items-start gap-3">
                                    <div class="text-orange-500 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-lg">Miembro desde</p>
                                        <p class="text-gray-500">
                                            {{ new Date(pyme.created_at).toLocaleDateString('es-SV', { year: 'numeric', month: 'long', day: 'numeric' }) }}
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- GALERÍA ADICIONAL -->
                    <!-- <div v-if="pyme.imagenes?.length > 1" class="bg-white rounded-2xl border border-gray-200 shadow-sm mt-6 p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Galería</h2>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                            <img
                                v-for="imagen in pyme.imagenes.slice(1)"
                                :key="imagen.id"
                                :src="imagen.ruta_imagen"
                                class="w-full h-40 object-cover rounded-xl"
                            />
                        </div>
                    </div> -->

                    <!-- HORARIOS -->
                    <div v-if="pyme.horarios?.length" class="bg-white rounded-2xl border border-gray-200 shadow-sm mt-6 p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Horarios</h2>
                        <div class="divide-y divide-gray-100">
                            <div
                                v-for="horario in pyme.horarios"
                                :key="horario.id"
                                class="flex justify-between py-3 text-sm text-gray-700"
                            >
                                <span class="font-medium">{{ DIAS[horario.dia_semana - 1] ?? horario.dia_semana }}</span>
                                <span>{{ horario.hora_apertura }} – {{ horario.hora_cierre }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- RESEÑAS -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">

                        <!-- FORM RESEÑA -->
                        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 h-fit">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">
                                Deja tu reseña
                            </h3>

                            <form @submit.prevent="submitResena" class="space-y-5">

                                <!-- CALIFICACIÓN -->
                                <div>
                                    <label class="block font-semibold mb-2">Calificación</label>
                                    <div class="flex gap-1">
                                        <button
                                            v-for="star in 5"
                                            :key="star"
                                            type="button"
                                            @click="form.calificacion_resenas = star"
                                            @mouseenter="hoverRating = star"
                                            @mouseleave="hoverRating = 0"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9 transition"
                                                :class="star <= (hoverRating || form.calificacion_resenas)
                                                    ? 'text-yellow-400 fill-yellow-400'
                                                    : 'text-gray-300'"
                                                viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81H7.03a1 1 0 00.95-.69l1.07-3.292z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <p v-if="form.errors.calificacion_resenas" class="text-red-500 text-xs mt-1">
                                        {{ form.errors.calificacion_resenas }}
                                    </p>
                                </div>

                                <!-- COMENTARIO -->
                                <div>
                                    <label class="block font-semibold mb-2">Comentario</label>
                                    <textarea
                                        v-model="form.comentario_resenas"
                                        rows="4"
                                        placeholder="Cuéntanos sobre tu experiencia..."
                                        class="w-full rounded-xl border border-gray-200 bg-gray-100 px-4 py-3 resize-none focus:ring-2 focus:ring-orange-500 focus:outline-none"
                                    />
                                    <p v-if="form.errors.comentario_resenas" class="text-red-500 text-xs mt-1">
                                        {{ form.errors.comentario_resenas }}
                                    </p>
                                </div>

                                <!-- BOTÓN -->
                                <button
                                    type="submit"
                                    :disabled="form.processing"
                                    class="w-full bg-orange-500 hover:bg-orange-600 disabled:opacity-50 text-white font-semibold py-3 rounded-xl transition"
                                >
                                    {{ form.processing ? 'Publicando...' : 'Publicar reseña' }}
                                </button>

                            </form>
                        </div>

                        <!-- LISTA RESEÑAS -->
                        <div class="lg:col-span-2">
                            <h2 class="text-4xl font-bold text-gray-900 mb-6">
                                Reseñas ({{ pyme.resenas?.length || 0 }})
                            </h2>

                            <div v-if="pyme.resenas?.length" class="space-y-5">
                                <div
                                    v-for="resena in pyme.resenas"
                                    :key="resena.id"
                                    class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6"
                                >
                                    <div class="flex items-start justify-between mb-3">
                                        <div>
                                            <h4 class="font-bold text-xl text-gray-900">Usuario</h4>
                                            <p class="text-gray-400 text-sm">
                                                {{ new Date(resena.created_at).toLocaleDateString('es-SV', { year: 'numeric', month: 'long', day: 'numeric' }) }}
                                            </p>
                                        </div>
                                        <div class="flex gap-1">
                                            <svg
                                                v-for="star in 5"
                                                :key="star"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="w-5 h-5"
                                                :class="star <= resena.calificacion_resenas
                                                    ? 'text-yellow-400 fill-yellow-400'
                                                    : 'text-gray-300'"
                                                viewBox="0 0 20 20"
                                            >
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81H7.03a1 1 0 00.95-.69l1.07-3.292z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <p class="text-gray-600 text-lg leading-relaxed">
                                        {{ resena.comentario_resenas }}
                                    </p>
                                </div>
                            </div>

                            <p v-else class="text-gray-400">
                                Aún no hay reseñas para esta MYPE.
                            </p>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </AppLayout>
    <div>
        <AppFooter />
    </div>
</template>
