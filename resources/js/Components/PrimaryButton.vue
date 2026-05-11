<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button
        :type="type"
        class="
            inline-flex items-center justify-center
            px-5 py-2.5
            bg-orange-500 hover:bg-orange-600 active:bg-orange-700
            border border-transparent
            rounded-xl
            font-semibold text-sm text-white
            shadow-sm
            transition duration-200 ease-in-out
            focus:outline-none focus:ring-2 focus:ring-orange-400 focus:ring-offset-2
            disabled:opacity-50 disabled:cursor-not-allowed
        "
    >
        <slot />
    </button>
</template>
