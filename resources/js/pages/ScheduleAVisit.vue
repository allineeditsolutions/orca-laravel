<template>
    <div class="min-h-screen bg-gradient-to-br from-gray-100 via-gray-50 to-gray-100 flex items-start justify-center px-2 sm:px-4 pt-2 pb-4 sm:pb-8 md:pb-12 relative">
        <!-- Top Accent Bar -->
        <div class="fixed top-0 left-0 right-0 bg-black h-2 z-10"></div>
        
        <!-- Decorative Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 right-10 w-72 h-72 bg-teal-100 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute top-40 left-10 w-72 h-72 bg-gray-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-1/2 w-72 h-72 bg-teal-50 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
        </div>
        
        <div class="w-full max-w-4xl mt-10 sm:mt-14 md:mt-18 relative z-0">
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
                                    required
                                    class="w-full p-3.5 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-md shadow-sm focus:shadow-lg"
                                    placeholder="Enter your first name"
                                />
                            </div>
                            <div>
                                <label class="block mb-2 text-gray-800 font-medium">
                                    Last Name <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="text"
                                    v-model="formData.lastName"
                                    required
                                    class="w-full p-3.5 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-md shadow-sm focus:shadow-lg"
                                    placeholder="Enter your last name"
                                />
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
                                    v-model="formData.phoneNumber"
                                    required
                                    class="w-full p-3.5 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-md shadow-sm focus:shadow-lg"
                                    placeholder="(778) 465-5658"
                                />
                            </div>
                            <div>
                                <label class="block mb-2 text-gray-800 font-medium">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="email"
                                    v-model="formData.email"
                                    required
                                    class="w-full p-3.5 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-md shadow-sm focus:shadow-lg"
                                    placeholder="email@gmail.com"
                                />
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
                            <div class="space-y-3">
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
                                            class="w-full p-2.5 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 transition-all duration-300 text-base text-gray-900 bg-white hover:border-gray-400 shadow-sm focus:shadow-md"
                                        />
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-700">To</label>
                                        <input
                                            type="time"
                                            v-model="formData.availability1.to"
                                            required
                                            class="w-full p-2.5 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 transition-all duration-300 text-base text-gray-900 bg-white hover:border-gray-400 shadow-sm focus:shadow-md"
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
                                            class="w-full p-2.5 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 transition-all duration-300 text-base text-gray-900 bg-white hover:border-gray-400 shadow-sm focus:shadow-md"
                                        />
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-700">To</label>
                                        <input
                                            type="time"
                                            v-model="formData.availability2.to"
                                            required
                                            class="w-full p-2.5 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 transition-all duration-300 text-base text-gray-900 bg-white hover:border-gray-400 shadow-sm focus:shadow-md"
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
                                            class="w-full p-2.5 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 transition-all duration-300 text-base text-gray-900 bg-white hover:border-gray-400 shadow-sm focus:shadow-md"
                                        />
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-700">To</label>
                                        <input
                                            type="time"
                                            v-model="formData.availability3.to"
                                            required
                                            class="w-full p-2.5 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 transition-all duration-300 text-base text-gray-900 bg-white hover:border-gray-400 shadow-sm focus:shadow-md"
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
                                rows="4"
                                required
                                class="w-full p-3.5 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-md shadow-sm focus:shadow-lg resize-y"
                                placeholder="Type your message here..."
                            ></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4 flex justify-end">
                            <button
                                type="submit"
                                class="w-full sm:w-auto px-10 py-4 bg-gradient-to-r from-teal-700 to-teal-800 hover:from-teal-800 hover:to-teal-900 text-white font-semibold rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 active:scale-95"
                            >
                                Schedule a Visit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import DatePicker from 'primevue/datepicker';

export default {
    name: 'ScheduleAVisit',
    components: {
        DatePicker
    },
    data() {
        return {
            isSubmitted: false,
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
        handleSubmit() {
            // Validate that at least one communication method is selected
            if (this.formData.preferredCommunication.length === 0) {
                alert('Please select at least one preferred method of communication.');
                return;
            }
            
            // Convert date objects to ISO strings for API submission
            const submitData = {
                ...this.formData,
                moveInDate: this.formatDate(this.formData.moveInDate),
                availability1: {
                    ...this.formData.availability1,
                    date: this.formatDate(this.formData.availability1.date)
                },
                availability2: {
                    ...this.formData.availability2,
                    date: this.formatDate(this.formData.availability2.date)
                },
                availability3: {
                    ...this.formData.availability3,
                    date: this.formatDate(this.formData.availability3.date)
                }
            };
            
            // Here you would typically send the form data to your backend API
            
            // For now, just show success message
            this.isSubmitted = true;
            
            // In a real application, you would do something like:
            // axios.post('/api/schedule-visit', submitData)
            //     .then(response => {
            //         this.isSubmitted = true;
            //     })
            //     .catch(error => {
            //         console.error('Error submitting form:', error);
            //     });
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
</style>

