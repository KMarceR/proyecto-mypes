<script setup>
import AppFooter from '@/Layouts/AppFooter.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    categorias: Array,
    pyme: Object,
});

const form = useForm({
    categoria_id:     props.pyme?.categoria_id     ?? '',
    nombre_pyme:      props.pyme?.nombre_pyme      ?? '',
    telefono_pyme:    props.pyme?.telefono_pyme    ?? '',
    email_pyme:       props.pyme?.email_pyme       ?? '',
    direccion_pyme:   props.pyme?.direccion_pyme   ?? '',
    descripcion_pyme: props.pyme?.descripcion_pyme ?? '',
    imagen:           props.pyme?.imagenes?.[0]?.ruta_imagen ?? '',
});

const submit = () => {
    form.put(route('pymes.update', props.pyme.id));
};
</script>

<template>
    <AppLayout title="Editar MYPE">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar MYPE
            </h2>
        </template>

        <div class="py-10 bg-gray-100 min-h-screen">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

                <!-- Sin MYPE registrada -->
                <div v-if="!pyme" class="bg-white shadow-xl sm:rounded-2xl p-10 text-center">
                    <p class="text-gray-500 mb-4">Aún no tienes una MYPE registrada.</p>
                    <Link :href="route('detallepymes')"
                        class="inline-flex items-center gap-2 bg-orange-500 text-white px-6 py-3 rounded-xl font-semibold hover:bg-orange-600 transition">
                        Registrar mi MYPE
                    </Link>
                </div>

                <template v-else>
                    <!-- Botón volver -->
                    <div class="mb-6">
                        <Link :href="route('perfilpymes')"
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
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>

                            <div>
                                <h1 class="text-3xl font-bold text-gray-900">
                                    Editar información de tu MYPE
                                </h1>
                                <p class="text-gray-500 mt-2">
                                    Actualiza los datos de tu negocio
                                </p>
                            </div>
                        </div>

                        <!-- Mensajes de éxito/error -->
                        <div v-if="$page.props.flash?.success"
                            class="mb-6 rounded-xl bg-green-50 border border-green-200 px-4 py-3 text-green-700 text-sm font-medium">
                            {{ $page.props.flash.success }}
                        </div>

                        <!-- Formulario -->
                        <form @submit.prevent="submit" class="space-y-6">

                            <!-- Nombre -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    Nombre del negocio
                                    <span class="text-red-500">*</span>
                                </label>
                                <input v-model="form.nombre_pyme" type="text" placeholder="Ej: Cafetería La Esquina"
                                    class="w-full rounded-xl border border-gray-200 bg-gray-100 px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:outline-none" />
                                <p v-if="form.errors.nombre_pyme" class="text-red-500 text-sm mt-1">
                                    {{ form.errors.nombre_pyme }}
                                </p>
                            </div>

                            <!-- Categoría y Teléfono -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                                        Categoría
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <select v-model="form.categoria_id"
                                        class="w-full rounded-xl border border-gray-200 bg-gray-100 px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:outline-none">
                                        <option value="">Selecciona una categoría</option>
                                        <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">
                                            {{ categoria.nombre_categoria }}
                                        </option>
                                    </select>
                                    <p v-if="form.errors.categoria_id" class="text-red-500 text-sm mt-1">
                                        {{ form.errors.categoria_id }}
                                    </p>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                                        Teléfono
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input v-model="form.telefono_pyme" type="text" placeholder="+503 2222 2222"
                                        class="w-full rounded-xl border border-gray-200 bg-gray-100 px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:outline-none" />
                                    <p v-if="form.errors.telefono_pyme" class="text-red-500 text-sm mt-1">
                                        {{ form.errors.telefono_pyme }}
                                    </p>
                                </div>
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    Email
                                    <span class="text-red-500">*</span>
                                </label>
                                <input v-model="form.email_pyme" type="email" placeholder="info@tunegocio.com"
                                    class="w-full rounded-xl border border-gray-200 bg-gray-100 px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:outline-none" />
                                <p v-if="form.errors.email_pyme" class="text-red-500 text-sm mt-1">
                                    {{ form.errors.email_pyme }}
                                </p>
                            </div>

                            <!-- Dirección -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    Dirección
                                    <span class="text-red-500">*</span>
                                </label>
                                <input v-model="form.direccion_pyme" type="text" placeholder="San Salvador, El Salvador"
                                    class="w-full rounded-xl border border-gray-200 bg-gray-100 px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:outline-none" />
                                <p v-if="form.errors.direccion_pyme" class="text-red-500 text-sm mt-1">
                                    {{ form.errors.direccion_pyme }}
                                </p>
                            </div>

                            <!-- Descripción -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    Descripción
                                    <span class="text-red-500">*</span>
                                </label>
                                <textarea v-model="form.descripcion_pyme" rows="4"
                                    placeholder="Describe tu negocio, productos o servicios..."
                                    class="w-full rounded-xl border border-gray-200 bg-gray-100 px-4 py-3 resize-none focus:ring-2 focus:ring-orange-500 focus:outline-none" />
                                <p v-if="form.errors.descripcion_pyme" class="text-red-500 text-sm mt-1">
                                    {{ form.errors.descripcion_pyme }}
                                </p>
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
                                    {{ form.processing ? 'Guardando...' : 'Guardar cambios' }}
                                </button>

                                <Link :href="route('perfilpymes')"
                                    class="w-full rounded-xl border border-gray-300 py-3 text-center font-semibold text-gray-700 hover:bg-gray-100 transition">
                                    Cancelar
                                </Link>
                            </div>
                        </form>
                    </div>
                </template>
            </div>
        </div>
    </AppLayout>
    <div>
        <AppFooter />
    </div>
</template>
