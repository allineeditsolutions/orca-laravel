<template>
    <div class="fixed top-0 left-0 right-0 w-full bg-gray-100/95 backdrop-blur border-b border-gray-300 z-50">
        <div class="px-4 sm:px-6 bg-gray-200 shadow-md">
            <div class="w-full max-w-6xl lg:max-w-[1900px] mx-auto" >
                <!-- Mobile/Small: scrollable with connectors -->
                <div class="relative flex md:hidden items-center py-4">
                    <!-- Left fade gradient -->
                    <div class="absolute left-0 top-0 bottom-0 w-8 bg-gradient-to-r from-gray-200 to-transparent z-10 pointer-events-none"></div>
                    <!-- Right fade gradient -->
                    <div class="absolute right-0 top-0 bottom-0 w-8 bg-gradient-to-l from-gray-200 to-transparent z-10 pointer-events-none"></div>
                    
                    <div 
                        ref="mobileScrollContainer"
                        class="flex items-center justify-start gap-3 sm:gap-4 overflow-x-auto overflow-y-hidden py-2 px-2 scrollbar-hide"
                        style="scroll-snap-type: x mandatory; -webkit-overflow-scrolling: touch;"
                    >
                        <div 
                            v-for="(step, index) in steps" 
                            :key="step.number" 
                            :data-step-number="step.number"
                            class="flex items-center flex-shrink-0"
                            :style="{ scrollSnapAlign: 'center' }"
                        >
                            <!-- Connector line between steps -->
                            <div 
                                v-if="index > 0"
                                :class="[
                                    'w-6 sm:w-8 h-0.5 mx-1 transition-colors duration-300',
                                    steps[index - 1].number < currentStep ? 'bg-green-600' : 'bg-gray-300'
                                ]"
                            ></div>
                            
                            <div class="flex flex-col items-center gap-2 min-w-[80px] sm:min-w-[90px]">
                                <div
                                    :class="[
                                        'w-12 h-12 sm:w-14 sm:h-14 rounded-full flex items-center justify-center font-bold text-base sm:text-lg transition-all duration-300 shadow-sm',
                                        step.number === currentStep
                                            ? 'bg-black text-white border-3 border-black shadow-lg scale-110 ring-4 ring-black/10'
                                            : step.number < currentStep
                                            ? 'bg-green-600 text-white border-3 border-green-600 shadow-md'
                                            : 'bg-gray-100 text-gray-400 border-2 border-gray-300'
                                    ]"
                                >
                                    <svg v-if="step.number < currentStep" class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span v-else class="font-bold">{{ step.number }}</span>
                                </div>
                                <span 
                                    :class="[
                                        'text-xs sm:text-sm font-semibold text-center w-full break-words px-1 leading-tight',
                                        step.number === currentStep 
                                            ? 'text-black font-bold' 
                                            : step.number < currentStep
                                            ? 'text-green-700'
                                            : 'text-gray-500'
                                    ]"
                                >
                                    {{ step.title }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Desktop: horizontal tabs -->
                <div class="hidden md:flex items-center justify-center gap-4 sm:gap-6 md:gap-8 lg:gap-12 py-4">
                    <div v-for="(step, index) in steps" :key="step.number" class="flex items-center flex-shrink-0 flex-1 max-w-[140px] md:max-w-[260px]">
                        <!-- Step Circle and Title -->
                        <div class="flex flex-col items-center gap-2 w-full">
                            <div
                                :class="[
                                    'w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center font-bold text-sm sm:text-base transition-all duration-300',
                                    step.number === currentStep
                                        ? 'bg-black text-white border-2 border-black shadow-lg scale-110'
                                        : step.number < currentStep
                                        ? 'bg-green-600 text-white border-2 border-green-600 shadow-md'
                                        : 'bg-gray-100 text-gray-400 border-2 border-gray-300'
                                ]"
                            >
                                <svg v-if="step.number < currentStep" class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                                <span v-else>{{ step.number }}</span>
                            </div>
                            <span :class="['text-xs sm:text-sm font-semibold text-center w-full break-words', step.number === currentStep ? 'text-gray-900' : 'text-gray-500']">
                                {{ step.title }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch, nextTick, onMounted } from 'vue';

const props = defineProps({
    steps: {
        type: Array,
        required: true,
    },
    currentStep: {
        type: Number,
        required: true,
    },
});

const mobileScrollContainer = ref(null);

// Auto-scroll to current step on mobile
const scrollToCurrentStep = () => {
    if (!mobileScrollContainer.value) return;
    
    nextTick(() => {
        const container = mobileScrollContainer.value;
        const stepElements = container.querySelectorAll('[data-step-number]');
        
        stepElements.forEach((el) => {
            const stepNumber = parseInt(el.getAttribute('data-step-number'));
            if (stepNumber === props.currentStep) {
                const containerRect = container.getBoundingClientRect();
                const elementRect = el.getBoundingClientRect();
                const scrollLeft = container.scrollLeft + (elementRect.left - containerRect.left) - (containerRect.width / 2) + (elementRect.width / 2);
                
                container.scrollTo({
                    left: scrollLeft,
                    behavior: 'smooth'
                });
            }
        });
    });
};

// Watch for current step changes
watch(() => props.currentStep, () => {
    scrollToCurrentStep();
});

// Scroll to current step on mount
onMounted(() => {
    scrollToCurrentStep();
});
</script>

<style scoped>
/* Hide scrollbar for webkit browsers */
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for Firefox */
.scrollbar-hide {
    scrollbar-width: none;
    -ms-overflow-style: none;
}

/* Support for border-3 (if not available in Tailwind) */
.border-3 {
    border-width: 3px;
}
</style>

