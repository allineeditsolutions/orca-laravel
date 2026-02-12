<template>
    <div class="flex items-center justify-center gap-4 sm:gap-8 md:gap-16 lg:gap-32 xl:gap-40 w-full py-0 sm:py-8 md:py-10 lg:py-14 xl:py-0">
        <div v-for="(step, index) in steps" :key="step.number" 
             :class="['flex items-center', index === 0 ? 'ml-2 sm:ml-4 md:ml-12 lg:ml-16 xl:ml-20' : '', index === steps.length - 1 ? 'mr-2 sm:mr-4 md:mr-12 lg:mr-16 xl:mr-20' : '']">
            <!-- Step Circle and Title -->
            <div class="flex flex-col sm:flex-row items-center gap-2 sm:gap-3 md:gap-4">
                <div
                    :class="[
                        'w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 rounded-full flex items-center justify-center font-bold text-sm sm:text-base md:text-lg transition-all duration-300',
                        step.number === currentStep
                            ? 'bg-black text-white shadow-lg scale-105 sm:scale-110'
                            : step.number < currentStep
                            ? 'bg-green-600 text-white shadow-md'
                            : 'bg-gray-100 border-2 border-gray-300 text-gray-400'
                    ]"
                >
                    <svg v-if="step.number < currentStep" class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7 lg:w-8 lg:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                    <span v-else>{{ step.number }}</span>
                </div>
                <span :class="['text-xs sm:text-sm md:text-base font-semibold text-center', step.number === currentStep ? 'text-gray-900' : step.number < currentStep ? 'text-green-600' : 'text-gray-500']">
                    {{ step.title }}
                </span>
            </div>
        </div>
    </div>
</template>
<script setup>
defineProps({
    steps: {
        type: Array,
        required: true,
    },
    currentStep: {
        type: Number,
        required: true,
    },
});
</script>

