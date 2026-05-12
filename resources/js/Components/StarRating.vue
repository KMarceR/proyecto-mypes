<script setup>
defineProps({
    modelValue: Number
})

const emit = defineEmits(['update:modelValue'])
</script>

<template>
    <div class="flex gap-1">
        <span v-for="star in 5" :key="star" @click="emit('update:modelValue', star)" class="cursor-pointer text-3xl"
            :class="modelValue >= star
                ? 'text-yellow-400'
                : 'text-gray-300'">
            ★
        </span>
    </div>
</template>