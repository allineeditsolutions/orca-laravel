<template>
    <div class="min-h-screen bg-gradient-to-br from-gray-100 via-gray-50 to-gray-100 flex flex-col relative">
        <!-- Top Accent Bar -->
        <div class="fixed top-0 left-0 right-0 bg-black h-2 z-10"></div>
        
        <!-- Decorative Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 right-10 w-72 h-72 bg-teal-100 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute top-40 left-10 w-72 h-72 bg-gray-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-1/2 w-72 h-72 bg-teal-50 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
        </div>
        
        <!-- Scrollable Content Area -->
        <div class="flex-1 overflow-y-auto px-2 sm:px-4 pt-2 pb-24 sm:pb-28 md:pb-32" style="scrollbar-width: thin; scrollbar-color: #9ca3af #f3f4f6;">
            <div class="w-full max-w-4xl mx-auto mt-10 sm:mt-14 md:mt-18 relative z-0">
            <!-- Success Message Screen -->
            <div v-if="isSubmitted" class="p-4 space-y-6">
                <div class="border border-gray-200 rounded-2xl bg-white shadow-2xl backdrop-blur-sm">
                    <div class="p-6 sm:p-8 md:p-10">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 md:w-8 md:h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-green-600">
                                Your visit request has been successfully submitted.
                            </h2>
                        </div>
                        <div class="space-y-2 text-sm sm:text-base md:text-lg text-gray-900 leading-relaxed">
                            <p>
                                We will review your availability and contact you soon to confirm your visit.
                            </p>
                            <p>
                                Thank you for your interest in this property.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Form Content -->
            <div v-else class="border border-gray-200 rounded-2xl bg-white shadow-2xl backdrop-blur-sm overflow-hidden">
                <div class="p-6 sm:p-8 md:p-10 space-y-6 sm:space-y-8">
                    <!-- Form Title -->
                    <div class="mb-6">
                        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900">
                            Schedule a Visit
                        </h1>
                    </div>

                    <form @submit.prevent="handleSubmit" class="space-y-6 sm:space-y-8">
                        <!-- Name Fields -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                            <div>
                                <label class="block mb-2 text-gray-800 font-medium">
                                    First Name <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="text"
                                    v-model="formData.firstName"
                                    @input="clearValidationError('first_name')"
                                    required
                                    :class="['w-full p-2 border-2 rounded-xl focus:ring-4 transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:shadow-lg shadow-md focus:shadow-xl', validationErrors.first_name ? 'border-red-500 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200 focus:ring-black/10 focus:border-black hover:border-gray-400']"
                                    placeholder="Enter your first name"
                                />
                                <p v-if="validationErrors.first_name" class="mt-1 text-sm text-red-600">{{ validationErrors.first_name }}</p>
                            </div>
                            <div>
                                <label class="block mb-2 text-gray-800 font-medium">
                                    Last Name <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="text"
                                    v-model="formData.lastName"
                                    @input="clearValidationError('last_name')"
                                    required
                                    :class="['w-full p-2 border-2 rounded-xl focus:ring-4 transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:shadow-lg shadow-md focus:shadow-xl', validationErrors.last_name ? 'border-red-500 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200 focus:ring-black/10 focus:border-black hover:border-gray-400']"
                                    placeholder="Enter your last name"
                                />
                                <p v-if="validationErrors.last_name" class="mt-1 text-sm text-red-600">{{ validationErrors.last_name }}</p>
                            </div>
                        </div>

                        <!-- Phone Number and Email -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                            <div>
                                <label class="block mb-2 text-gray-800 font-medium">
                                    Phone Number <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="tel"
                                    :value="formData.phoneNumber"
                                    @input="handlePhoneChange($event.target.value)"
                                    required
                                    :class="['w-full p-2 border-2 rounded-xl focus:ring-4 transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:shadow-lg shadow-md focus:shadow-xl', validationErrors.phone_number ? 'border-red-500 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200 focus:ring-black/10 focus:border-black hover:border-gray-400']"
                                    placeholder="(000) 000-0000"
                                />
                                <p v-if="validationErrors.phone_number" class="mt-1 text-sm text-red-600">{{ validationErrors.phone_number }}</p>
                            </div>
                            <div>
                                <label class="block mb-2 text-gray-800 font-medium">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="email"
                                    v-model="formData.email"
                                    @input="clearValidationError('email')"
                                    required
                                    :class="['w-full p-2 border-2 rounded-xl focus:ring-4 transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:shadow-lg shadow-md focus:shadow-xl', validationErrors.email ? 'border-red-500 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200 focus:ring-black/10 focus:border-black hover:border-gray-400']"
                                    placeholder="email@gmail.com"
                                />
                                <p v-if="validationErrors.email" class="mt-1 text-sm text-red-600">{{ validationErrors.email }}</p>
                            </div>
                        </div>

                        <!-- Move-in Date -->
                        <div>
                            <label class="block mb-2 text-gray-800 font-medium">
                                When are you hoping to move-in? <span class="text-red-500">*</span>
                            </label>
                            <DatePicker
                                v-model="formData.moveInDate"
                                :required="true"
                                :minDate="new Date()"
                                dateFormat="yy-mm-dd"
                                placeholder="Select move-in date"
                                fluid
                                class="w-full"
                                :manualInput="false"
                            />
                        </div>

                        <!-- Preferred Method of Communication -->
                        <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                            <label class="block mb-3 text-gray-800 font-medium">
                                Preferred Method of Communication <span class="text-red-500">*</span>
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <label class="flex items-center gap-3 cursor-pointer p-2 rounded-lg hover:bg-white transition-colors duration-200">
                                    <input
                                        type="checkbox"
                                        value="Phone Call"
                                        v-model="formData.preferredCommunication"
                                        class="w-5 h-5 text-teal-700 border-gray-300 rounded focus:ring-teal-700 focus:ring-2 cursor-pointer"
                                    />
                                    <span class="text-gray-900 font-medium">Phone Call</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer p-2 rounded-lg hover:bg-white transition-colors duration-200">
                                    <input
                                        type="checkbox"
                                        value="SMS"
                                        v-model="formData.preferredCommunication"
                                        class="w-5 h-5 text-teal-700 border-gray-300 rounded focus:ring-teal-700 focus:ring-2 cursor-pointer"
                                    />
                                    <span class="text-gray-900 font-medium">SMS</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer p-2 rounded-lg hover:bg-white transition-colors duration-200">
                                    <input
                                        type="checkbox"
                                        value="Email"
                                        v-model="formData.preferredCommunication"
                                        class="w-5 h-5 text-teal-700 border-gray-300 rounded focus:ring-teal-700 focus:ring-2 cursor-pointer"
                                    />
                                    <span class="text-gray-900 font-medium">Email</span>
                                </label>
                            </div>
                        </div>

                        <!-- Availability Section -->
                        <div class="space-y-4">
                            <div>
                                <label class="block mb-2 text-gray-800 font-medium">
                                    When are you available to view this property? <span class="text-red-500">*</span>
                                </label>
                                <p class="text-sm text-gray-600 mb-4">
                                    Please write a few times you are available to view this home over the next 3 days.
                                </p>
                            </div>

                            <!-- Availability 1 -->
                            <div class="border-2 border-gray-200 rounded-lg p-5 bg-gradient-to-br from-gray-50 to-white shadow-sm hover:shadow-md transition-all duration-300">
                                <label class="block mb-3 text-gray-800 font-medium">
                                    Availability 1 <span class="text-red-500">*</span>
                                </label>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-700">Date</label>
                                        <DatePicker
                                            v-model="formData.availability1.date"
                                            :required="true"
                                            :minDate="new Date()"
                                            dateFormat="yy-mm-dd"
                                            placeholder="Select date"
                                            fluid
                                            class="w-full"
                                            :manualInput="false"
                                        />
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-700">From</label>
                                        <input
                                            type="time"
                                            v-model="formData.availability1.from"
                                            required
                                            class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl "
                                        />
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-700">To</label>
                                        <input
                                            type="time"
                                            v-model="formData.availability1.to"
                                            required
                                            class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl "
                                        />
                                    </div>
                                </div>
                            </div>

                            <!-- Availability 2 -->
                            <div class="border-2 border-gray-200 rounded-lg p-5 bg-gradient-to-br from-gray-50 to-white shadow-sm hover:shadow-md transition-all duration-300">
                                <label class="block mb-3 text-gray-800 font-medium">
                                    Availability 2 
                                </label>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-700">Date</label>
                                        <DatePicker
                                            v-model="formData.availability2.date"
                                            :required="true"
                                            :minDate="new Date()"
                                            dateFormat="yy-mm-dd"
                                            placeholder="Select date"
                                            fluid
                                            class="w-full"
                                            :manualInput="false"
                                        />
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-700">From</label>
                                        <input
                                            type="time"
                                            v-model="formData.availability2.from"
                                            required
                                            class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl "
                                        />
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-700">To</label>
                                        <input
                                            type="time"
                                            v-model="formData.availability2.to"
                                            required
                                            class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl "
                                        />
                                    </div>
                                </div>
                            </div>

                            <!-- Availability 3 -->
                            <div class="border-2 border-gray-200 rounded-lg p-5 bg-gradient-to-br from-gray-50 to-white shadow-sm hover:shadow-md transition-all duration-300">
                                <label class="block mb-3 text-gray-800 font-medium">
                                    Availability 3 
                                </label>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-700">Date</label>
                                        <DatePicker
                                            v-model="formData.availability3.date"
                                            :required="true"
                                            :minDate="new Date()"
                                            dateFormat="yy-mm-dd"
                                            placeholder="Select date"
                                            fluid
                                            class="w-full"
                                            :manualInput="false"
                                        />
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-700">From</label>
                                        <input
                                            type="time"
                                            v-model="formData.availability3.from"
                                            required
                                            class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl "
                                        />
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-700">To</label>
                                        <input
                                            type="time"
                                            v-model="formData.availability3.to"
                                            required
                                            class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl "
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Message -->
                        <div>
                            <label class="block mb-2 text-gray-800 font-medium">
                                Message (Please include information about yourself, kids, pets, etc.) <span class="text-red-500">*</span>
                            </label>
                            <textarea
                                v-model="formData.message"
                                @input="clearValidationError('message')"
                                rows="4"
                                required
                                :class="['w-full p-2 border-2 rounded-xl focus:ring-4 transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:shadow-lg shadow-md focus:shadow-xl resize-y', validationErrors.message ? 'border-red-500 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200 focus:ring-black/10 focus:border-black hover:border-gray-400']"
                                placeholder="Type your message here..."
                            ></textarea>
                            <p v-if="validationErrors.message" class="mt-1 text-sm text-red-600">{{ validationErrors.message }}</p>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>

        <!-- Fixed Footer with Submit Button -->
        <div v-if="!isSubmitted" class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-lg z-20">
            <div class="w-full max-w-4xl mx-auto px-2 sm:px-4 py-4 sm:py-5">
                <div class="flex justify-end">
                    <button
                        type="button"
                        @click="handleSubmit"
                        :disabled="isSubmitting"
                        class="w-full sm:w-auto px-10 py-4 bg-gradient-to-r from-teal-700 to-teal-800 hover:from-teal-800 hover:to-teal-900 text-white font-semibold rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                    >
                        <span v-if="isSubmitting">Submitting...</span>
                        <span v-else>Schedule a Visit</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import DatePicker from 'primevue/datepicker';
import confetti from 'canvas-confetti';

export default {
    name: 'ScheduleAVisit',
    components: {
        DatePicker
    },
    data() {
        return {
            isSubmitted: false,
            isSubmitting: false,
            validationErrors: {},
            propertyAddress: '',
            formData: {
                firstName: '',
                lastName: '',
                phoneNumber: '',
                email: '',
                moveInDate: null,
                preferredCommunication: [],
                availability1: {
                    date: null,
                    from: '',
                    to: ''
                },
                availability2: {
                    date: null,
                    from: '',
                    to: ''
                },
                availability3: {
                    date: null,
                    from: '',
                    to: ''
                },
                message: ''
            }
        };
    },
    mounted() {
        // Get property address from route query parameter or use default
        const address = this.$route.query.address || '1227-1205 Howe St, Vancouver';
        this.propertyAddress = address;
        
        // Pre-populate message with property address
    },
    methods: {
        formatDate(date) {
            if (!date) return '';
            // PrimeVue DatePicker returns Date objects
            if (date instanceof Date) {
                // Normalize to date only (set time to midnight)
                const normalized = new Date(date);
                normalized.setHours(0, 0, 0, 0);
                return normalized.toISOString().split('T')[0];
            }
            return date;
        },
        formatPhoneNumber(value) {
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
        },
        handlePhoneChange(value) {
            const formatted = this.formatPhoneNumber(value);
            this.formData.phoneNumber = formatted;
            this.clearValidationError('phone_number');
        },
        clearValidationError(field) {
            if (this.validationErrors[field]) {
                delete this.validationErrors[field];
            }
        },
        async handleSubmit() {
            // Prevent double submission
            if (this.isSubmitting) {
                return;
            }
            
            try {
                this.isSubmitting = true;
                this.validationErrors = {};
                
                // Prepare availability data as JSON object
                const availability = {
                    availability1: {
                        date: this.formatDate(this.formData.availability1.date),
                        from: this.formData.availability1.from,
                        to: this.formData.availability1.to
                    },
                    availability2: {
                        date: this.formatDate(this.formData.availability2.date),
                        from: this.formData.availability2.from,
                        to: this.formData.availability2.to
                    },
                    availability3: {
                        date: this.formatDate(this.formData.availability3.date),
                        from: this.formData.availability3.from,
                        to: this.formData.availability3.to
                    }
                };
                
                // Prepare data for API
                const submitData = {
                    first_name: this.formData.firstName,
                    last_name: this.formData.lastName,
                    phone_number: this.formData.phoneNumber,
                    email: this.formData.email,
                    move_in_date: this.formatDate(this.formData.moveInDate),
                    preferred_communication: this.formData.preferredCommunication,
                    availability: availability,
                    message: this.formData.message,
                };

                // Make API call
                const response = await fetch('/api/schedule-visits', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                    },
                    body: JSON.stringify(submitData),
                });

                const result = await response.json();

                if (!response.ok) {
                    // Handle validation errors
                    if (response.status === 422 && result.errors) {
                        this.isSubmitting = false;
                        // Convert Laravel validation errors format to flat object
                        const errors = {};
                        Object.keys(result.errors).forEach(key => {
                            errors[key] = Array.isArray(result.errors[key]) ? result.errors[key][0] : result.errors[key];
                        });
                        this.validationErrors = errors;
                        // Scroll to first error
                        const firstErrorField = Object.keys(errors)[0];
                        const errorElement = document.querySelector(`[name="${firstErrorField}"]`) || 
                                            document.querySelector(`input[placeholder*="${firstErrorField}"]`) ||
                                            document.querySelector(`textarea[placeholder*="${firstErrorField}"]`);
                        if (errorElement) {
                            errorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            errorElement.focus();
                        }
                        return;
                    }
                    throw new Error(result.message || 'Failed to save schedule visit');
                }

                // Success
                this.validationErrors = {};
                
                // Add confetti effect
                const duration = 3000;
                const end = Date.now() + duration;

                const colors = ['#FF0000', '#00FF00', '#0000FF', '#FFFF00', '#FF00FF', '#00FFFF', '#FFA500', '#FF1493', '#9370DB', '#FF69B4'];
                
                // Continuous confetti from sides
                (function frame() {
                    // Confetti from left side
                    confetti({
                        particleCount: 2,
                        angle: 60,
                        spread: 55,
                        origin: { x: 0 },
                        colors: colors
                    });
                    // Confetti from right side
                    confetti({
                        particleCount: 2,
                        angle: 120,
                        spread: 55,
                        origin: { x: 1 },
                        colors: colors
                    });

                    if (Date.now() < end) {
                        requestAnimationFrame(frame);
                    }
                }());
                
                this.isSubmitted = true;
            } catch (error) {
                console.error('Error submitting form:', error);
                alert('An error occurred while saving: ' + error.message);
            } finally {
                this.isSubmitting = false;
            }
        }
    }
};
</script>

<style scoped>
@keyframes blob {
    0%, 100% {
        transform: translate(0, 0) scale(1);
    }
    33% {
        transform: translate(30px, -50px) scale(1.1);
    }
    66% {
        transform: translate(-20px, 20px) scale(0.9);
    }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}
</style>

<style>
/* Custom styles for PrimeVue DatePicker */
.p-datepicker {
    width: 100% !important;
}

.p-datepicker-input {
    width: 100% !important;
}

/* Custom Scrollbar Styling */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f3f4f6;
}

::-webkit-scrollbar-thumb {
    background: #9ca3af;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #6b7280;
}
</style>

