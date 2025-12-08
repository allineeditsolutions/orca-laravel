<template>
    <div class="border border-gray-100 rounded-2xl bg-gray-50 shadow-sm hover:shadow-md transition-shadow duration-300">
        <div
            class="flex items-center justify-between bg-white border-b border-gray-200 cursor-pointer hover:bg-gray-50 transition-colors"
            @click="isOpen = !isOpen"
        >
            <div class="flex items-center gap-3 p-3">
                <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm3 1h6v4H7V5zm6 6H7v2h6v-2z" clip-rule="evenodd" />
                </svg>
                <h3 class="text-lg font-semibold text-black">Mailing Information</h3>
            </div>
            <button
                type="button"
                class="flex items-center gap-2 text-black hover:text-gray-700 text-sm mr-3"
                @click.stop="isOpen = !isOpen"
            >
                <svg
                    :class="`w-5 h-5 transform transition-transform duration-200 text-gray-400 ${isOpen ? 'rotate-180' : ''}`"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
        </div>
        <div v-if="isOpen" class="p-2 lg:p-5 space-y-5 sm:space-y-3">
            <div class="space-y-3 bg-white rounded-2xl p-3 border border-gray-100 shadow-sm">
                <h5 class="font-semibold text-gray-800 text-base sm:text-lg ">
                    Owner primary residence mailing address
                </h5>


                <div class="space-y-3">
                    <!-- Row 1: Unit & Suite #, Street Address -->
                    <div class="grid grid-cols-1 md:grid-cols-[1fr_2fr] gap-3">
                        <!-- Unit & Suite # -->
                        <div class="r-mb-2">
                            <label class="flex items-center gap-2 text-base sm:text-lg lg:text-md text-gray-800 ">
                                Unit & Suite #
                            </label>
                            <input
                                type="text"
                                :value="formData.unitSuite"
                                @input="handleChange('unitSuite', $event.target.value)"
                                placeholder="Unit & Suite #"
                                class="p-2 w-full w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                            />
                        </div>

                        <!-- Street Address -->
                        <div class="r-mb-2">
                            <label class="flex items-center gap-2 text-base sm:text-lg lg:text-md text-gray-800 ">
                                Street Address <span class="text-red-500 text-xl">*</span>
                            </label>
                            <input
                                type="text"
                                :value="formData.streetAddress"
                                @input="handleChange('streetAddress', $event.target.value)"
                                placeholder="Street Address*"
                                :class="['p-2 w-full border-2 rounded-xl focus:ring-4 transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:shadow-lg shadow-md focus:shadow-xl', validationErrors.streetAddress ? 'border-red-500 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200 focus:ring-black/10 focus:border-black hover:border-gray-400']"
                            />
                            <p v-if="validationErrors.streetAddress" class="mt-1 text-sm text-red-600">{{ validationErrors.streetAddress }}</p>
                        </div>
                    </div>

                    <!-- Row 2: City, Province, Postal / ZIP Code -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <!-- City -->
                        <div class="r-mb-2">
                            <label class="flex items-center gap-2 text-base sm:text-lg lg:text-md text-gray-800 ">
                                City <span class="text-red-500 text-xl">*</span>
                            </label>
                            <input
                                type="text"
                                :value="formData.city"
                                @input="handleChange('city', $event.target.value)"
                                placeholder="City*"
                                :class="['w-full p-2 border-2 rounded-xl focus:ring-4 transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:shadow-lg shadow-md focus:shadow-xl', validationErrors.city ? 'border-red-500 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200 focus:ring-black/10 focus:border-black hover:border-gray-400']"
                            />
                            <p v-if="validationErrors.city" class="mt-1 text-sm text-red-600">{{ validationErrors.city }}</p>
                        </div>

                        <!-- Province -->
                        <div class="r-mb-2">
                            <label class="flex items-center gap-2 text-base sm:text-lg lg:text-md text-gray-800 ">
                                Province <span class="text-red-500 text-xl">*</span>
                            </label>
                            <div class="relative">
                                <select
                                    :value="formData.province"
                                    @change="handleChange('province', $event.target.value)"
                                    :class="['w-full p-2 pr-12 sm:pr-14 md:pr-16 lg:pr-20 xl:pr-24 border-2 rounded-xl focus:ring-4 transition-all duration-300 text-base text-gray-900 bg-white appearance-none cursor-pointer hover:shadow-lg shadow-md focus:shadow-xl', validationErrors.province ? 'border-red-500 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200 focus:ring-black/10 focus:border-black hover:border-gray-400']"
                                >
                                    <option value="">Select Province</option>
                                    <option v-for="province in provinces" :key="province" :value="province">
                                        {{ province }}
                                    </option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 sm:pr-6 md:pr-8 lg:pr-17 xl:pr-3 pointer-events-none">
                                    <svg class="w-6 h-6 sm:w-7 sm:h-7 lg:w-8 lg:h-8 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" class="text-gray-400" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                            <p v-if="validationErrors.province" class="mt-1 text-sm text-red-600">{{ validationErrors.province }}</p>
                        </div>

                        <!-- Postal / ZIP Code -->
                        <div>
                            <label class="flex items-center gap-2 text-base sm:text-lg lg:text-md text-gray-800 ">
                                Postal / ZIP Code <span class="text-red-500 text-xl">*</span>
                            </label>
                            <input
                                type="text"
                                :value="formData.postalCode"
                                @input="handleChange('postalCode', $event.target.value)"
                                placeholder="Postal / ZIP Code*"
                                :class="['w-full p-2 border-2 rounded-xl focus:ring-4 transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:shadow-lg shadow-md focus:shadow-xl', validationErrors.postalCode ? 'border-red-500 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200 focus:ring-black/10 focus:border-black hover:border-gray-400']"
                            />
                            <p v-if="validationErrors.postalCode" class="mt-1 text-sm text-red-600">{{ validationErrors.postalCode }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    formData: {
        type: Object,
        required: true,
    },
    validationErrors: {
        type: Object,
        default: () => ({}),
    },
});

const emit = defineEmits(['data-change']);

const isOpen = ref(true);

const provinces = [
    'Alberta',
    'British Columbia',
    'Manitoba',
    'New Brunswick',
    'Newfoundland and Labrador',
    'Nova Scotia',
    'Nunavut',
    'Ontario',
    'Prince Edward Island',
    'Quebec',
    'Saskatchewan',
    'Yukon',
    'Northwest Territories',
    'Philippines',
];

const handleChange = (field, value) => {
    emit('data-change', field, value);
};
</script>

