<template>
    <div class="min-h-screen bg-blue-50 p-8">
        <div class="max-w-4xl mx-auto">
            <!-- Cabecera -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-4xl font-bold text-blue-900">Quotes</h1>
                <InertiaLink
                    href="quotes-ui/random"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                >
                    Random Quote
                </InertiaLink>
            </div>

            <!-- Listado de citas -->
            <div class="space-y-4">
                <div
                    v-for="quote in quotes"
                    :key="quote.id"
                    class="hover:scale-[1.01] transition-transform"
                >
                    <InertiaLink :href="`/quotes-ui/${quote.id}`" class="block">
                        <QuoteCard :quote="quote"/>
                    </InertiaLink>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-between items-center">
                <button
                    @click="previousPage"
                    :disabled="currentPage === 1"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    Previous
                </button>

                <span class="text-blue-700 font-medium">
                  Page {{ currentPage }} of {{ totalPages }}
                </span>

                <button
                    @click="nextPage"
                    :disabled="currentPage === totalPages"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    Next
                </button>
            </div>

            <!-- Info de paginación -->
            <div class="mt-4 text-sm text-blue-500 text-center">
                Show {{ skip + 1 }} - {{ Math.min(skip + limit, total) }} of {{ total }} quotes
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import axios from 'axios'
import QuoteCard from '@laravelquotes/Components/QuoteCard.vue'


const quotes = ref([])
const total = ref(0)
const skip = ref(0)
const limit = ref(10) // Puedes cambiar este valor según necesites

const currentPage = computed(() => Math.floor(skip.value / limit.value) + 1)
const totalPages = computed(() => Math.ceil(total.value / limit.value))

const fetchQuotes = async () => {
    try {
        const response = await axios.get('/quotes', {
            params: {
                skip: skip.value,
                limit: limit.value
            }
        })

        quotes.value = response.data.quotes
        total.value = response.data.total
    } catch (error) {
        console.error('Error fetching quotes:', error)
    }
}

const nextPage = () => {
    if (skip.value + limit.value < total.value) {
        skip.value += limit.value
        fetchQuotes()
    }
}

const previousPage = () => {
    if (skip.value >= limit.value) {
        skip.value -= limit.value
        fetchQuotes()
    }
}

onMounted(fetchQuotes)
</script>
