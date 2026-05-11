<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import AppFooter from '@/Layouts/AppFooter.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const negocio = ref({
    nombre: 'Cafetería La Esquina',
    categoria: 'Restaurantes',
    descripcion:
        'Cafetería artesanal con los mejores granos de café peruano. Ambiente acogedor y deliciosos postres caseros.',
    direccion: 'San Salvador, Centro Histórico',
    telefono: '+503 2222 2222',
    email: 'info@cafelaesquina.com',
    miembroDesde: '15 de marzo de 2026',
    rating: 4.5,
    reviews: 2,
    imagen:
        'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=1400&auto=format&fit=crop',
});

const reviews = ref([
    {
        nombre: 'María García',
        fecha: '10 de abril de 2026',
        comentario:
            'Excelente café y muy buen servicio. El ambiente es muy agradable para trabajar o estudiar.',
        rating: 5,
    },
    {
        nombre: 'Carlos Pérez',
        fecha: '12 de abril de 2026',
        comentario:
            'Buenos productos, aunque a veces está muy lleno. Los postres son deliciosos.',
        rating: 4,
    },
]);

const form = useForm({
    nombre: '',
    comentario: '',
    rating: 5,
});

const hoverRating = ref(0);

const submitReview = () => {
    reviews.value.unshift({
        nombre: form.nombre,
        comentario: form.comentario,
        rating: form.rating,
        fecha: 'Hoy',
    });

    form.reset();
    form.rating = 5;
};
</script>

<template>
    <AppLayout title="Detalle MYPE">

        <div class="min-h-screen bg-[#f5f5f5] flex flex-col">

            <!-- CONTENIDO -->
            <div class="flex-1 py-10">
                <div class="max-w-5xl mx-auto px-4">

                    <!-- VOLVER -->
                    <div class="mb-6">
                        <Link href="/"
                            class="inline-flex items-center gap-2 text-gray-700 hover:text-orange-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>

                            Volver
                        </Link>
                    </div>

                    <!-- CARD NEGOCIO -->
                    <div class="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm">

                        <!-- IMAGEN -->
                        <img :src="negocio.imagen" alt="Negocio" class="w-full h-[340px] object-cover" />

                        <!-- INFO -->
                        <div class="p-6">

                            <!-- TOP -->
                            <div class="flex items-start justify-between mb-5">

                                <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full font-medium">
                                    {{ negocio.categoria }}
                                </span>

                                <div class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 text-yellow-400 fill-yellow-400" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81H7.03a1 1 0 00.95-.69l1.07-3.292z" />
                                    </svg>

                                    <span class="font-semibold text-gray-800">
                                        {{ negocio.rating }}
                                    </span>

                                    <span class="text-gray-400 text-sm">
                                        ({{ negocio.reviews }})
                                    </span>
                                </div>
                            </div>

                            <!-- TITULO -->
                            <h1 class="text-5xl font-bold text-gray-900 mb-4">
                                {{ negocio.nombre }}
                            </h1>

                            <!-- DESCRIPCION -->
                            <p class="text-gray-500 text-lg leading-relaxed mb-8">
                                {{ negocio.descripcion }}
                            </p>

                            <!-- GRID INFO -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                <!-- DIRECCION -->
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
                                        <p class="font-semibold text-lg">
                                            Dirección
                                        </p>

                                        <p class="text-gray-500">
                                            {{ negocio.direccion }}
                                        </p>
                                    </div>
                                </div>

                                <!-- TELEFONO -->
                                <div class="flex items-start gap-3">
                                    <div class="text-orange-500 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="font-semibold text-lg">
                                            Teléfono
                                        </p>

                                        <p class="text-gray-500">
                                            {{ negocio.telefono }}
                                        </p>
                                    </div>
                                </div>

                                <!-- EMAIL -->
                                <div class="flex items-start gap-3">
                                    <div class="text-orange-500 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 12H8m8 0l-8 0m8 0l-8 0m8 0l-8 0M4 6h16v12H4V6z" />
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="font-semibold text-lg">
                                            Email
                                        </p>

                                        <p class="text-gray-500">
                                            {{ negocio.email }}
                                        </p>
                                    </div>
                                </div>

                                <!-- FECHA -->
                                <div class="flex items-start gap-3">
                                    <div class="text-orange-500 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="font-semibold text-lg">
                                            Miembro desde
                                        </p>

                                        <p class="text-gray-500">
                                            {{ negocio.miembroDesde }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- REVIEWS -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">

                        <!-- FORM REVIEW -->
                        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 h-fit">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">
                                Deja tu reseña
                            </h3>

                            <form @submit.prevent="submitReview" class="space-y-5">

                                <!-- NOMBRE -->
                                <div>
                                    <label class="block font-semibold mb-2">
                                        Tu nombre
                                    </label>

                                    <input v-model="form.nombre" type="text" placeholder="Ingresa tu nombre"
                                        class="w-full rounded-xl border border-gray-200 bg-gray-100 px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:outline-none" />
                                </div>

                                <!-- RATING -->
                                <div>
                                    <label class="block font-semibold mb-2">
                                        Calificación
                                    </label>

                                    <div class="flex gap-1">
                                        <button v-for="star in 5" :key="star" type="button" @click="form.rating = star"
                                            @mouseenter="hoverRating = star" @mouseleave="hoverRating = 0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9 transition" :class="star <= (hoverRating || form.rating)
                                                    ? 'text-yellow-400 fill-yellow-400'
                                                    : 'text-gray-300'
                                                " viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81H7.03a1 1 0 00.95-.69l1.07-3.292z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- COMENTARIO -->
                                <div>
                                    <label class="block font-semibold mb-2">
                                        Comentario
                                    </label>

                                    <textarea v-model="form.comentario" rows="4"
                                        placeholder="Cuéntanos sobre tu experiencia..."
                                        class="w-full rounded-xl border border-gray-200 bg-gray-100 px-4 py-3 resize-none focus:ring-2 focus:ring-orange-500 focus:outline-none" />
                                </div>

                                <!-- BOTON -->
                                <button type="submit"
                                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-xl transition">
                                    Publicar reseña
                                </button>
                            </form>
                        </div>

                        <!-- LISTA REVIEWS -->
                        <div class="lg:col-span-2">
                            <h2 class="text-4xl font-bold text-gray-900 mb-6">
                                Reseñas ({{ reviews.length }})
                            </h2>

                            <div class="space-y-5">

                                <div v-for="(review, index) in reviews" :key="index"
                                    class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                                    <div class="flex items-start justify-between mb-3">

                                        <div>
                                            <h4 class="font-bold text-xl text-gray-900">
                                                {{ review.nombre }}
                                            </h4>

                                            <p class="text-gray-400">
                                                {{ review.fecha }}
                                            </p>
                                        </div>

                                        <div class="flex gap-1">
                                            <svg v-for="star in 5" :key="star" xmlns="http://www.w3.org/2000/svg"
                                                class="w-5 h-5" :class="star <= review.rating
                                                        ? 'text-yellow-400 fill-yellow-400'
                                                        : 'text-gray-300'
                                                    " viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81H7.03a1 1 0 00.95-.69l1.07-3.292z" />
                                            </svg>
                                        </div>
                                    </div>

                                    <p class="text-gray-600 text-lg leading-relaxed">
                                        {{ review.comentario }}
                                    </p>
                                </div>
                            </div>
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