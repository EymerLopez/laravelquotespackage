<template>
    <div class="min-h-screen bg-blue-50 p-8">
        <div class="max-w-4xl mx-auto">
            <!-- Encabezado -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-blue-900 mb-4">Random Quote</h1>
                <button
                    @click="fetchRandomQuote"
                    :disabled="loading"
                    class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    {{ loading ? 'Searching...' : 'New Quote' }}
                </button>
            </div>

            <!-- Contenido principal -->
            <div class="relative min-h-[200px]">
                <!-- Estado de carga -->
                <div v-if="loading" class="text-center py-8">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500 mx-auto"></div>
                    <p class="mt-2 text-blue-600">Searching new quote...</p>
                </div>

                <!-- Cita -->
                <div v-else-if="quote" class="animate-fade-in">
                    <QuoteCard :quote="quote"/>
                </div>

                <!-- Estado inicial -->
                <div v-else class="text-center py-8 text-blue-600">
                    <p>Click to get another quote</p>
                </div>

                <!-- Manejo de errores -->
                <div v-if="error" class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    {{ error }}
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'
import QuoteCard from '@/Components/QuoteCard.vue'

const quote = ref(null)
const loading = ref(false)
const error = ref(null)

const fetchRandomQuote = async () => {
    try {
        // Reset states
        loading.value = true
        error.value = null
        quote.value = null

        const response = await axios.get('/quotes/random')
        quote.value = response.data
    } catch (err) {
        error.value = 'Error al obtener la cita. Intenta nuevamente.'
        console.error('Error fetching random quote:', err)
    } finally {
        loading.value = false
    }
}
</script>
