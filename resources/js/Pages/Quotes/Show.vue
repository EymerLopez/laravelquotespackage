<template>
    <div class="min-h-screen bg-blue-50 p-8">
        <div class="max-w-4xl mx-auto">
            <QuoteCard :quote="quote" class="mb-6">
                <template #header>
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold text-blue-900">Quote Detail</h2>
                        <InertiaLink
                            href="/quotes-ui"
                            class="text-blue-500 hover:text-blue-700 text-sm"
                        >
                            ← Back to lists
                        </InertiaLink>
                    </div>
                </template>
            </QuoteCard>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import QuoteCard from '@laravelquotes/Components/QuoteCard.vue'

const props = defineProps({
    id: {
        type: [String, Number],
        required: true
    }
})

const quote = ref(null)
const loading = ref(true)
const error = ref(null)

onMounted(async () => {
    try {
        const response = await axios.get(`/quotes/${props.id}`)
        quote.value = response.data
    } catch (err) {
        error.value = 'error on load lists'
    } finally {
        loading.value = false
    }
})
</script>
