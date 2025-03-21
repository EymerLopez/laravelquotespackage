<template>
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-300 hover:border-blue-500 transition-all">
        <slot name="header"></slot>
        <p class="text-blue-800 text-lg italic">"{{ quote.quote }}"</p>
        <p class="text-blue-600 font-medium mt-2">- {{ quote.author }}</p>
        <slot name="footer"></slot>
    </div>
</template>

<script setup>
defineProps({
    quote: {
        type: Object,
        required: true,
        validator: (value) => {
            return 'id' in value && 'quote' in value && 'author' in value
        }
    }
})
</script>
