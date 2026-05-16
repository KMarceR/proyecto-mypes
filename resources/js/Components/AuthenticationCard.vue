<template>
    <div
        class="min-h-screen flex flex-col justify-center items-center px-4 py-10"
    >

        <!-- LOGO -->
        <div class="mb-6 text-center">

            <slot name="logo" />

            <h1 class="mt-4 text-3xl font-extrabold text-orange-500">
                MYPEs El Salvador
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Plataforma de negocios locales
            </p>

        </div>

        <!-- CARD -->
        <div
            class="
                w-full sm:max-w-lg
                bg-white
                border border-gray-100
                rounded-3xl
                shadow-xl
                overflow-hidden
                p-8
            "
        >

            <slot />

        </div>

    </div>
</template>
