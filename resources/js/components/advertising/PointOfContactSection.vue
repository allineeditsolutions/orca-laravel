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
                <h3 class="text-lg font-semibold text-black">Point of Contact</h3>
            </div>
            <button
                type="button"
                class="flex items-center gap-2 text-black hover:text-gray-700 font-medium text-sm mr-3"
                @click.stop="isOpen = !isOpen"
            >
                <svg
                    :class="`w-5 h-5 transform transition-transform duration-200 text-gray-400 ${isOpen ? 'rotate-180' : ''}`"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
        </div>
        <div v-if="isOpen" class="p-2 lg:p-5 space-y-5 sm:space-y-6">
            <div class="space-y-3 bg-white rounded-2xl p-3 border border-gray-100 shadow-sm">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input
                        type="radio"
                        name="pointOfContact"
                        value="Same as Main Owner"
                        :checked="formData.pointOfContact === 'Same as Main Owner'"
                        @change="handleChange('pointOfContact', 'Same as Main Owner'); handleChange('otherPointOfContact', '')"
                        class="w-4 h-4 text-black focus:ring-black/10"
                    />
                    <span class="text-gray-800 font-medium">Same as Main Owner</span>
                </label>
                <template v-if="hasCoOwners">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input
                            type="radio"
                            name="pointOfContact"
                            value="Same as Co-Owner"
                            :checked="formData.pointOfContact === 'Same as Co-Owner'"
                            @change="handleChange('pointOfContact', 'Same as Co-Owner'); handleChange('otherPointOfContact', '')"
                            class="w-4 h-4 text-black focus:ring-black/10"
                        />
                        <span class="text-gray-800 font-medium">Same as Co-Owner</span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input
                            type="radio"
                            name="pointOfContact"
                            value="Both"
                            :checked="formData.pointOfContact === 'Both'"
                            @change="handleChange('pointOfContact', 'Both Main & Co-Owner'); handleChange('otherPointOfContact', '')"
                            class="w-4 h-4 text-black focus:ring-black/10"
                        />
                        <span class="text-gray-800 font-medium">Both Main & Co-Owner</span>
                    </label>
                </template>
                <label class="flex items-center gap-3 cursor-pointer">
                    <input
                        type="radio"
                        name="pointOfContact"
                        value="Other(Specify)"
                        :checked="formData.pointOfContact === 'Other(Specify)'"
                        @change="handleChange('pointOfContact', 'Other(Specify)')"
                        class="w-4 h-4 text-black focus:ring-black/10"
                    />
                    <span class="text-gray-800 font-medium">Other(Specify)</span>
                </label>
                <div v-if="formData.pointOfContact === 'Other(Specify)'" class="mt-5 sm:mt-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 sm:gap-3">
                        <!-- First Name -->
                        <div>
                            <label class="flex items-center gap-2 text-base sm:text-lg text-gray-800 mb-2">
                                First Name <span class="text-red-500 text-xl">*</span>
                            </label>
                            <input
                                type="text"
                                :value="formData.pointOfContactFirstName"
                                @input="handleChange('pointOfContactFirstName', $event.target.value)"
                                placeholder="First Name"
                                :class="['w-full p-2 border-2 rounded-xl focus:ring-4 transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:shadow-lg shadow-md focus:shadow-xl', validationErrors.pointOfContactFirstName ? 'border-red-500 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200 focus:ring-black/10 focus:border-black hover:border-gray-400']"
                            />
                            <p v-if="validationErrors.pointOfContactFirstName" class="mt-1 text-sm text-red-600">{{ validationErrors.pointOfContactFirstName }}</p>
                        </div>
                        <!-- Email Address -->
                        <div>
                            <label class="flex items-center gap-2 text-base sm:text-lg text-gray-800 mb-2">
                                Email Address <span class="text-red-500 text-xl">*</span>
                            </label>
                            <input
                                type="email"
                                :value="formData.pointOfContactEmail"
                                @input="handleChange('pointOfContactEmail', $event.target.value)"
                                placeholder="Email Address"
                                :class="['w-full p-2 border-2 rounded-xl focus:ring-4 transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:shadow-lg shadow-md focus:shadow-xl', validationErrors.pointOfContactEmail ? 'border-red-500 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200 focus:ring-black/10 focus:border-black hover:border-gray-400']"
                            />
                            <p v-if="validationErrors.pointOfContactEmail" class="mt-1 text-sm text-red-600">{{ validationErrors.pointOfContactEmail }}</p>
                        </div>
                        <!-- Phone -->
                        <div>
                            <label class="flex items-center gap-2 text-base sm:text-lg text-gray-800 mb-2">
                                Phone <span class="text-red-500 text-xl">*</span>
                            </label>
                            <input
                                type="tel"
                                :value="formData.pointOfContactPhone"
                                @input="handlePhoneChange($event.target.value)"
                                placeholder="(000) 000-0000"
                                :class="['w-full p-2 border-2 rounded-xl focus:ring-4 transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:shadow-lg shadow-md focus:shadow-xl', validationErrors.pointOfContactPhone ? 'border-red-500 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200 focus:ring-black/10 focus:border-black hover:border-gray-400']"
                            />
                            <p v-if="validationErrors.pointOfContactPhone" class="mt-1 text-sm text-red-600">{{ validationErrors.pointOfContactPhone }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';

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

const hasCoOwners = computed(() => {
    return props.formData.coOwners && Array.isArray(props.formData.coOwners) && props.formData.coOwners.length > 0;
});

const formatPhoneNumber = (value) => {
    // Remove all non-digit characters
    const phoneNumber = value.replace(/\D/g, '');
    
    // Limit to 10 digits
    const limitedNumber = phoneNumber.slice(0, 10);
    
    // Format as (000) 000-0000
    if (limitedNumber.length === 0) {
        return '';
    } else if (limitedNumber.length <= 3) {
        return `(${limitedNumber}`;
    } else if (limitedNumber.length <= 6) {
        return `(${limitedNumber.slice(0, 3)}) ${limitedNumber.slice(3)}`;
    } else {
        return `(${limitedNumber.slice(0, 3)}) ${limitedNumber.slice(3, 6)}-${limitedNumber.slice(6)}`;
    }
};

const handleChange = (field, value) => {
    emit('data-change', field, value);
};

const handlePhoneChange = (value) => {
    const formatted = formatPhoneNumber(value);
    emit('data-change', 'pointOfContactPhone', formatted);
};
</script>

