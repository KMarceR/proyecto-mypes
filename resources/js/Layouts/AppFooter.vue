<template>
    <footer class="bg-orange-500 text-white text-center py-6 w-full">
        <p class="text-lg font-medium">
            MYPEs El Salvador © {{ currentYear }}
        </p>
    </footer>
</template>

<script setup>
// Año actual automático
const currentYear = new Date().getFullYear();
</script>