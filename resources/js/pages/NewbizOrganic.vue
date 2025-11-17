<template>
    <div class="min-h-screen bg-gray-50 flex items-center justify-center px-2 sm:px-4 py-4 sm:py-8 md:py-12">
        <!-- Top Accent Bar -->
        <div class="fixed top-0 left-0 right-0 bg-black h-2 z-10"></div>
        
        <!-- Main Content - Centered -->
        <div class="w-full max-w-6xl mt-2">
            <div class="bg-white rounded-lg sm:rounded-xl md:rounded-2xl shadow-xl sm:shadow-2xl overflow-hidden border border-gray-200 flex flex-col">
                <!-- Header Section with Branding - Inside the box -->
                <div v-if="!isSubmitted" class="border-b border-gray-200 px-4 sm:px-6 md:px-10 lg:px-16 xl:px-20 pt-0 sm:pt-8 md:pt-12 lg:pt-4 pb-0 sm:pb-8 md:pb-12 lg:pb-4">
                    <div class="flex flex-col items-center gap-2 sm:gap-4 md:gap-6">
                        <StepIndicator :steps="steps" :current-step="currentStep" />
                    </div>
                </div>
                <div class="flex flex-col lg:flex-row flex-1 min-h-[400px] sm:min-h-[500px] md:min-h-[600px] lg:min-h-[650px]">
                    <!-- Success Message -->
                    <div v-if="isSubmitted" class="w-full flex items-center justify-center" style="padding: 2rem; box-sizing: border-box;">
                        <div class="w-full text-center" style="box-sizing: border-box;">
                            <div class="mb-6 flex justify-center" style="margin-bottom: 1.5rem; box-sizing: border-box;">
                                <div class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 rounded-full bg-green-100 flex items-center justify-center" style="box-sizing: border-box;">
                                    <svg class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-4" style="margin-bottom: 1rem; box-sizing: border-box;">
                                Request Submitted Successfully!
                            </h2>
                            <p class="text-base sm:text-lg md:text-xl text-gray-600 mb-2" style="margin-bottom: 0.5rem; box-sizing: border-box;">
                                Thank you for your interest in Orca Realty Inc.
                            </p>
                            <p class="text-sm sm:text-base md:text-lg text-gray-500" style="box-sizing: border-box;">
                                One of our Property Management experts will review your information and prepare a personalized Rental Evaluation for you. We'll be in touch soon!
                            </p>
                        </div>
                    </div>

                    <!-- Left Panel - Information -->
                    <div v-if="!isSubmitted" class="bg-[#F3F2F3] lg:w-2/5 text-gray-900 relative overflow-hidden">
                        <!-- Step 1 Content -->
                        <div v-if="currentStep === 1" class="relative z-10 h-full flex flex-col px-4 py-4 ">
                            <div class="mb-6">
                                <div class="flex items-center justify-center">
                                    <h1 class="text-lg sm:text-xl md:text-2xl lg:text-3xl xl:text-3xl font-bold text-gray-900 text-center text-uppercase">
                                        Orca Realty Inc.
                                    </h1>
                                </div>
                                <h2 class="text-lg sm:text-xl md:text-2xl lg:text-3xl xl:text-3xl font-bold mb-2 leading-tight text-center">
                                    Free Rental Consultation
                                </h2>
                                <p class="text-gray-600 text-xs sm:text-sm md:text-base lg:text-lg font-medium  text-center">
                                    Get expert advice at no cost
                                </p>
                            </div>
                            
                            <div class="space-y-3 xl:space-y-12 text-gray-700 leading-relaxed flex-1 text-sm sm:text-base md:text-lg lg:text-xl">
                                <div class="flex items-start gap-3 sm:gap-4 md:gap-6 lg:gap-8">
                                    <div class="flex-shrink-0 mt-0.5 sm:mt-1 md:mt-1.5 lg:mt-2">
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7 lg:w-8 lg:h-8 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <p class="pr-2 sm:pr-4 md:pr-6 lg:pr-8">
                                        Tell us about your property, and one of our Property Management
                                        experts will prepare a <strong class="text-gray-900 font-bold">personalized Rental Evaluation</strong> for you
                                        — completely free.
                                    </p>
                                </div>
                                <div class="flex items-start gap-3 sm:gap-4 md:gap-6 lg:gap-8 r-mt-4">
                                    <div class="flex-shrink-0 mt-0.5 sm:mt-1 md:mt-1.5 lg:mt-2">
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7 lg:w-8 lg:h-8 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                    </div>
                                    <p class="pr-2 sm:pr-4 md:pr-6 lg:pr-8">
                                        Providing complete details ensures you receive the most
                                        accurate advice and recommendations tailored to your property.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2 Content - Petr Vokoun -->
                        <div v-if="currentStep === 2" class="relative z-10 h-full flex flex-col">
                            <!-- Centered Content -->
                            <div class="flex-1 flex flex-col items-center justify-center ">
                                <!-- Profile Picture - Circular -->
                                <div class="mb-3">
                                    <div class="w-32 h-32 sm:w-40 sm:h-40 md:w-48 md:h-48 lg:w-56 lg:h-56 rounded-full bg-teal-700 overflow-hidden shadow-lg relative">
                                        <img
                                            src="/images/orca-team-petr-vokoun-400x400-1.png"
                                            alt="Petr Vokoun"
                                            class="w-full h-full object-cover"
                                        />
                                    </div>
                                </div>

                                <!-- Name -->
                                <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-6 sm:mb-8 md:mb-10 text-center r-m-3">
                                    Petr Vokoun
                                </h2>

                                <!-- First Text Block -->
                                <div class="max-w-lg mx-auto px-4 mb-6 sm:mb-8 r-mb-3">
                                    <p class="text-sm sm:text-base md:text-lg text-gray-700 text-center leading-relaxed">
                                        Please share as much detail as you can about your property. The more we know, the more accurate your rental evaluation will be. Once we've reviewed everything, a member of our team will be in touch to walk you through the next steps.
                                    </p>
                                </div>

                                <!-- Second Text Block -->
                                <div class="max-w-lg mx-auto px-4">
                                    <p class="text-sm sm:text-base md:text-lg text-gray-700 text-center leading-relaxed">
                                        Looking forward to helping you explore the best options for your property.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="absolute top-0 right-0 w-32 h-32 sm:w-48 sm:h-48 md:w-64 md:h-64 bg-black/5 rounded-full -mr-16 sm:-mr-24 md:-mr-32 -mt-16 sm:-mt-24 md:-mt-32"></div>
                        <div class="absolute bottom-0 left-0 w-24 h-24 sm:w-36 sm:h-36 md:w-48 md:h-48 bg-black/5 rounded-full -ml-12 sm:-ml-18 md:-ml-24 -mb-12 sm:-mb-18 md:-mb-24"></div>
                    </div>

                    <!-- Right Panel - Form -->
                    <div v-if="!isSubmitted" class="lg:w-3/5 p-4  bg-white flex flex-col lg:max-h-[750px] min-h-0">
                        <div v-if="currentStep === 1" class="flex flex-col h-full">
                            <!-- Header Section -->
                            <div class="mb-4">
                                <div class="flex items-center gap-2 sm:gap-3 md:gap-4 mb-2 ">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900">
                                        Select Your City
                                        <span class="text-red-500 r-ml-1">*</span>
                                    </h3>
                                </div>
                                <p class="text-gray-500 text-xs sm:text-sm md:text-base lg:text-lg">Choose the city where your property is located</p>
                            </div>

                            <!-- Cities Grid -->
                            <div class="r-pb-3 flex-1 overflow-y-auto pr-1 sm:pr-2 md:pr-4 lg:pr-3">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-3 md:gap-5 lg:gap-6 xl:gap-2">
                                    <label
                                        v-for="city in cities"
                                        :key="city"
                                        :class="[
                                            'group relative flex items-center cursor-pointer',
                                            'p-2 rounded-lg sm:rounded-xl border-2 transition-all duration-200',
                                            selectedCity === city
                                                ? 'border-black bg-gray-50 shadow-md'
                                                : 'border-gray-200 bg-white hover:border-gray-400 hover:bg-gray-50 hover:shadow-sm'
                                        ]"
                                    >
                                        <div class="flex items-center w-full">
                                            <div :class="[
                                                'relative flex items-center justify-center mr-3 ',
                                                'transition-all duration-200'
                                            ]">
                                                <input
                                                    type="radio"
                                                    name="city"
                                                    :value="city"
                                                    v-model="selectedCity"
                                                    class="sr-only"
                                                />
                                                <div :class="[
                                                    'relative w-5 h-5 sm:w-5 sm:h-5 md:w-6 md:h-6 rounded-full border-2 transition-all duration-200',
                                                    selectedCity === city
                                                        ? 'border-black bg-black'
                                                        : 'border-gray-300 group-hover:border-gray-500'
                                                ]">
                                                    <div v-if="selectedCity === city" class="absolute inset-0 flex items-center justify-center">
                                                        <div class="w-2 h-2 sm:w-2 sm:h-2 md:w-2.5 md:h-2.5 bg-white rounded-full"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <span :class="[
                                                'flex-1 font-medium transition-colors duration-200 text-sm sm:text-base md:text-lg',
                                                selectedCity === city
                                                    ? 'text-black font-semibold'
                                                    : 'text-gray-700 group-hover:text-gray-900'
                                            ]">
                                                {{ city }}
                                            </span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Continue Button -->
                            <div class="flex justify-end mt-2 pt-4 border-t border-gray-200">
                                <button
                                    @click="handleNext"
                                    :disabled="!selectedCity"
                                    :class="[
                                        'group relative w-full sm:w-auto p-2 px-5 rounded-xl font-semibold text-sm sm:text-base md:text-lg',
                                        'transition-all duration-300 transform',
                                        selectedCity
                                            ? 'bg-black hover:bg-gray-800 text-white shadow-lg hover:shadow-xl hover:scale-105 active:scale-100'
                                            : 'bg-gray-200 text-gray-400 cursor-not-allowed'
                                    ]"
                                >
                                    <span class="flex items-center justify-center gap-2 md:gap-3 cursor-pointer">
                                        Continue
                                        <svg :class="[
                                            'w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 transition-transform duration-300',
                                            selectedCity ? 'group-hover:translate-x-1' : ''
                                        ]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>

                        <!-- Step 2: Property Information -->
                        <div v-if="currentStep === 2" class="flex flex-col h-full">
                            <div class="mb-4 sm:mb-6 flex-shrink-0">
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900">
                                        Property Information Step
                                    </h3>
                                </div>
                            </div>

                            <div class="flex-1 space-y-3 overflow-y-auto overflow-x-hidden pr-1  min-h-0" style="scrollbar-width: thin; scrollbar-color: #9ca3af #f3f4f6;">
                                <!-- Name -->
                                <div class="bg-gray-50 rounded-2xl p-3 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                                    <label class="flex items-center gap-2 text-base sm:text-lg lg:text-md text-gray-800 mb-1">
                                        Name <span class="text-red-500 text-xl">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        v-model="formData.name"
                                        class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base sm:text-lg lg:text-xl text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl font-medium"
                                        placeholder="Enter your name"
                                    />
                                </div>

                                <!-- Email and Phone Number - 2 Columns -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 ">
                                    <!-- Email -->
                                    <div class="bg-gray-50 rounded-2xl p-3 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                                        <label class="flex items-center gap-2 text-base sm:text-lg lg:text-md text-gray-800 mb-3">
                                            Email <span class="text-red-500 text-xl">*</span>
                                        </label>
                                        <input
                                            type="email"
                                            v-model="formData.email"
                                            class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base sm:text-lg lg:text-xl text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl font-medium"
                                            placeholder="Enter your email"
                                        />
                                    </div>

                                    <!-- Phone Number -->
                                    <div class="bg-gray-50 rounded-2xl p-3 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                                        <label class="flex items-center gap-2 text-base sm:text-lg lg:text-md text-gray-800 mb-3">
                                            Phone Number <span class="text-red-500 text-xl">*</span>
                                        </label>
                                        <input
                                            type="tel"
                                            v-model="formData.phoneNumber"
                                            class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base sm:text-lg lg:text-xl text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl font-medium"
                                            placeholder="(000) 000-0000"
                                        />
                                    </div>
                                </div>

                                <!-- Rental Property Address -->
                                <div class="bg-gray-50 rounded-2xl p-3 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                                    <p class="text-sm sm:text-base lg:text-lg text-gray-600 mb-3 sm:mb-4 lg:mb-5 font-medium">
                                        In order to provide you with a proper rental evaluation, please provide your rental property address.
                                    </p>
                                    <label class="flex items-center gap-2 text-base sm:text-lg lg:text-md text-gray-800 mb-3">
                                        Rental Property Address <span class="text-red-500 text-xl">*</span>
                                    </label>
                                    <textarea
                                        v-model="formData.rentalPropertyAddress"
                                        class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base sm:text-lg lg:text-xl text-gray-900 placeholder-gray-400 resize-y min-h-[120px] sm:min-h-[140px] lg:min-h-[160px] bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl font-medium"
                                        placeholder="Enter your rental property address"
                                        rows="4"
                                    ></textarea>
                                </div>

                                <!-- City of Rental Property Address -->
                                <div class="bg-gray-50 rounded-2xl p-3 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                                    <label class="flex items-center gap-2 text-base sm:text-lg lg:text-md text-gray-800 mb-3">
                                        Please re-confirm the City of your rental property address. <span class="text-red-500 text-xl">*</span>
                                    </label>
                                    <div class="relative">
                                        <select
                                            v-model="formData.cityOfRentalProperty"
                                            class="w-full p-2 pr-12 sm:pr-14 md:pr-16 lg:pr-20 xl:pr-24 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base sm:text-lg lg:text-xl text-gray-900 bg-white appearance-none cursor-pointer hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl font-medium"
                                        >
                                            <option value="">-Select Option-</option>
                                            <option v-for="city in cities" :key="city" :value="city">{{ city }}</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center pointer-events-none">
                                            <svg class="w-6 h-6 sm:w-7 sm:h-7 lg:w-8 lg:h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gray-50 rounded-2xl p-3 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                                    <label class="flex items-center gap-2 text-base sm:text-lg lg:text-md text-gray-800 mb-3">
                                        Best describe your property <span class="text-red-500 text-xl">*</span>
                                    </label>
                                    <div class="relative">
                                        <select
                                            v-model="formData.bestDescProperty"
                                            class="w-full p-2 pr-12 sm:pr-14 md:pr-16 lg:pr-20 xl:pr-24 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base sm:text-lg lg:text-xl text-gray-900 bg-white appearance-none cursor-pointer hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl font-medium"
                                        >
                                            <option value="">-Select Option-</option>
                                            <option v-for="option in bestDescPropertyOptions" :key="option" :value="option">{{ option }}</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center pointer-events-none">
                                            <svg class="w-6 h-6 sm:w-7 sm:h-7 lg:w-8 lg:h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Estimated Square Footage and Number of Bedrooms - 2 Columns -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 lg:gap-3">
                                    <!-- Estimated Square Footage -->
                                    <div class="bg-gray-50 rounded-2xl p-3 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                                        <label class="flex items-center gap-2 text-base sm:text-lg lg:text-md text-gray-800 mb-3">
                                            Estimated Square footage <span class="text-red-500 text-xl">*</span>
                                        </label>
                                        <input
                                            type="number"
                                            v-model="formData.estimatedSquareFootage"
                                            class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base sm:text-lg lg:text-xl text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl font-medium"
                                            placeholder="0"
                                            min="0"
                                        />
                                    </div>

                                    <!-- Number of Bedrooms -->
                                    <div class="bg-gray-50 rounded-2xl p-3 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                                        <label class="flex items-center gap-2 text-base sm:text-lg lg:text-md text-gray-800 mb-3">
                                            Number of Bedrooms <span class="text-red-500 text-xl">*</span>
                                        </label>
                                        <input
                                            type="number"
                                            v-model="formData.numberOfBedrooms"
                                            class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base sm:text-lg lg:text-xl text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl font-medium"
                                            placeholder="0"
                                            min="0"
                                        />
                                    </div>
                                </div>

                                <!-- When are you planning to rent out your property? -->
                                <div class="bg-gray-50 rounded-2xl p-3 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                                    <label class="flex items-center gap-2 text-base sm:text-lg lg:text-md text-gray-800 mb-3">
                                        When are you planning to rent out your property? <span class="text-red-500 text-xl">*</span>
                                    </label>
                                    <div class="relative">
                                        <select
                                            v-model="formData.whenPlanningToRent"
                                            class="w-full p-2 pr-12 sm:pr-14 md:pr-16 lg:pr-20 xl:pr-24 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base sm:text-lg lg:text-xl text-gray-900 bg-white appearance-none cursor-pointer hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl font-medium"
                                        >
                                            <option value="">-Select Option-</option>
                                            <option v-for="option in whenPlanningToRentOptions" :key="option" :value="option">{{ option }}</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 sm:pr-6 md:pr-8 lg:pr-10 xl:pr-12 pointer-events-none">
                                            <svg class="w-6 h-6 sm:w-7 sm:h-7 lg:w-8 lg:h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- What are your plans with your rental property? -->
                                <div class="bg-gray-50 rounded-2xl p-3 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                                    <label class="flex items-center gap-2 text-base sm:text-lg lg:text-md text-gray-800 mb-3">
                                        What are your plans with your rental property? <span class="text-red-500 text-xl">*</span>
                                    </label>
                                    <div class="relative">
                                        <select
                                            v-model="formData.plansWithProperty"
                                            class="w-full p-2 pr-12 sm:pr-14 md:pr-16 lg:pr-20 xl:pr-24 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base sm:text-lg lg:text-xl text-gray-900 bg-white appearance-none cursor-pointer hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl font-medium"
                                        >
                                            <option value="">-Select Option-</option>
                                            <option v-for="option in plansWithPropertyOptions" :key="option" :value="option">{{ option }}</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 sm:pr-6 md:pr-8 lg:pr-10 xl:pr-12 pointer-events-none">
                                            <svg class="w-6 h-6 sm:w-7 sm:h-7 lg:w-8 lg:h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Aside from renting, are you considering selling your property? -->
                                <div class="bg-gray-50 rounded-2xl p-3 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                                    <label class="flex items-center gap-2 text-base sm:text-lg lg:text-md text-gray-800 mb-3">
                                        Aside from renting, are you considering selling your property? <span class="text-red-500 text-xl">*</span>
                                    </label>
                                    <div class="relative">
                                        <select
                                            v-model="formData.consideringSelling"
                                            class="w-full p-2 pr-12 sm:pr-14 md:pr-16 lg:pr-20 xl:pr-24 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base sm:text-lg lg:text-xl text-gray-900 bg-white appearance-none cursor-pointer hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl font-medium"
                                        >
                                            <option value="">-Select Option-</option>
                                            <option v-for="option in consideringSellingOptions" :key="option" :value="option">{{ option }}</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 sm:pr-6 md:pr-8 lg:pr-10 xl:pr-12 pointer-events-none">
                                            <svg class="w-6 h-6 sm:w-7 sm:h-7 lg:w-8 lg:h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- If you have a rent amount in mind... -->
                                <div class="bg-gray-50 rounded-2xl p-3 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                                    <label class="flex items-center gap-2 text-base sm:text-lg lg:text-md text-gray-800 mb-3">
                                        If you have a rent amount in mind, please share it here. This helps us understand your goals before preparing your evaluation. <span class="text-red-500 text-xl">*</span>
                                    </label>
                                    <div class="relative">
                                        <select
                                            v-model="formData.rentAmountInMind"
                                            class="w-full p-2 pr-12 sm:pr-14 md:pr-16 lg:pr-20 xl:pr-24 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base sm:text-lg lg:text-xl text-gray-900 bg-white appearance-none cursor-pointer hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl font-medium"
                                        >
                                            <option value="">-Select Option-</option>
                                            <option v-for="option in rentAmountInMindOptions" :key="option" :value="option">{{ option }}</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 sm:pr-6 md:pr-8 lg:pr-10 xl:pr-12 pointer-events-none">
                                            <svg class="w-6 h-6 sm:w-7 sm:h-7 lg:w-8 lg:h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Have you worked with a property manager before? -->
                                <div class="bg-gray-50 rounded-2xl p-3 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                                    <label class="flex items-center gap-2 text-base sm:text-lg lg:text-md text-gray-800 mb-3">
                                        Have you worked with a property manager before? <span class="text-red-500 text-xl">*</span>
                                    </label>
                                    <div class="relative">
                                        <select
                                            v-model="formData.workedWithPropertyManager"
                                            class="w-full p-2 pr-12 sm:pr-14 md:pr-16 lg:pr-20 xl:pr-24 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base sm:text-lg lg:text-xl text-gray-900 bg-white appearance-none cursor-pointer hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl font-medium"
                                        >
                                            <option value="">-Select Option-</option>
                                            <option v-for="option in workedWithPropertyManagerOptions" :key="option" :value="option">{{ option }}</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 sm:pr-6 md:pr-8 lg:pr-10 xl:pr-12 pointer-events-none">
                                            <svg class="w-6 h-6 sm:w-7 sm:h-7 lg:w-8 lg:h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Where did you hear about Orca Realty? -->
                                <div class="bg-gray-50 rounded-2xl p-3 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                                    <label class="flex items-center gap-2 text-base sm:text-lg lg:text-md text-gray-800 mb-3">
                                        Where did you hear about Orca Realty? <span class="text-red-500 text-xl">*</span>
                                    </label>
                                    <div class="relative">
                                        <select
                                            v-model="formData.whereHeardAboutOrca"
                                            class="w-full p-2 pr-12 sm:pr-14 md:pr-16 lg:pr-20 xl:pr-24 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base sm:text-lg lg:text-xl text-gray-900 bg-white appearance-none cursor-pointer hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl font-medium"
                                        >
                                            <option value="">-Select Option-</option>
                                            <option v-for="option in whereHeardAboutOrcaOptions" :key="option" :value="option">{{ option }}</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 sm:pr-6 md:pr-8 lg:pr-10 xl:pr-12 pointer-events-none">
                                            <svg class="w-6 h-6 sm:w-7 sm:h-7 lg:w-8 lg:h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Additional Information -->
                                <div class="bg-gray-50 rounded-2xl p-3 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                                    <label class="flex items-center gap-2 text-base sm:text-lg lg:text-md text-gray-800 mb-3">
                                        Please share additional information about your property and or anything you'd like to know or want us to know.
                                    </label>
                                    <textarea
                                        v-model="formData.additionalInformation"
                                        class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base sm:text-lg lg:text-xl text-gray-900 placeholder-gray-400 resize-y min-h-[140px] sm:min-h-[160px] lg:min-h-[180px] bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl font-medium"
                                        placeholder="Enter any additional information"
                                        rows="5"
                                    ></textarea>
                                </div>
                            </div>

                            <!-- Buttons - Fixed at bottom -->
                            <div class="flex-shrink-0 r-pt-3 sm:mt-8 pt-4 sm:pt-6 border-t border-gray-200 bg-white flex flex-col sm:flex-row justify-between gap-3 sm:gap-4">
                                <button
                                    @click="handleBack"
                                    class="group w-full sm:w-auto p-2 px-5 rounded-xl font-semibold text-sm sm:text-base md:text-lg bg-gray-100 hover:bg-gray-200 text-gray-700 transition-all duration-300 flex items-center justify-center gap-2 border-2 border-gray-200 hover:border-gray-300 active:scale-100 cursor-pointer"
                                >
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                    </svg>
                                    <span class="text-sm sm:text-base">Back</span>
                                </button>
                                <button
                                    @click="handleSubmit"
                                    class="group relative w-full sm:w-auto p-2 px-5 rounded-xl font-semibold text-sm sm:text-base md:text-lg bg-black hover:bg-gray-800 text-white shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 active:scale-100 flex items-center justify-center gap-2 cursor-pointer"
                                >
                                    <span class="text-sm sm:text-base">Submit Request</span>
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive } from 'vue';
import StepIndicator from '@/components/newbiz-organic/StepIndicator.vue';
import confetti from 'canvas-confetti';

const currentStep = ref(1);
const isSubmitted = ref(false);
const steps = [
    { number: 1, title: 'Property Location' },
    { number: 2, title: 'Property Information' },
];

const selectedCity = ref('');

const cities = [
    'Burnaby',
    'Coquitlam',
    'Delta',
    'Fraser Valley',
    'Kelowna',
    'Langley',
    'Maple Ridge',
    'New Westminster',
    'North Vancouver',
    'Pitt Meadows',
    'Port Coquitlam',
    'Port Moody',
    'Richmond',
    'Surrey',
    'Vancouver',
    'West Vancouver',
    'White Rock',
    'Other City (Not listed in option)',
];

const bestDescPropertyOptions = [
    'House',
    'Top of House',
    'Basement or Garden-Level Suite',
    'Townhouse',
    'Condo',
];

const whenPlanningToRentOptions = [
    'Immediately (within 30 days)',
    'Within the next 1-3 Months',
    'More than 3 Months from now',
    'Not sure yet/just exploring options',
];

const plansWithPropertyOptions = [
    'Rent short-term (less than 1 Year)',
    'Rent medium-term (1-5 Years)',
    'Rent long-term (5+ Years)',
    'I\'m undecided/just gathering information',
];

const consideringSellingOptions = [
    'Yes, I am considering selling now (within the next 3 months)',
    'Possibly, within the next 1-2 years',
    'No, I\'m focused on renting',
    'I\'m not sure yet. I just want information',
];

const rentAmountInMindOptions = [
    'Less than $2,000',
    '$2,000 - $2,999',
    '$3,000 - $4,999',
    '$5,000+',
    'I\'m not sure yet',
];

const workedWithPropertyManagerOptions = [
    'Yes, currently with one but looking to switch',
    'Yes, in the past',
    'No, I\'ve always managed myself',
    'No, this is my first time renting',
];

const whereHeardAboutOrcaOptions = [
    'BARK',
    'Craiglist',
    'Direct Searched Orca Website',
    'Facebook Ads',
    'Facebook Page',
    'Google Search (General Results)',
    'Orca Car',
    'Orca Yard Sign',
    'Referred By Another Landlord',
    'Referred By a Realtor',
    'Referred By an Orca Tenant',
    'Referred By a Friend',
    'YELP',
    'Other',
];

const formData = reactive({
    name: '',
    email: '',
    phoneNumber: '',
    rentalPropertyAddress: '',
    cityOfRentalProperty: '',
    bestDescProperty:'',
    estimatedSquareFootage: '',
    numberOfBedrooms: '',
    whenPlanningToRent: '',
    plansWithProperty: '',
    consideringSelling: '',
    rentAmountInMind: '',
    workedWithPropertyManager: '',
    whereHeardAboutOrca: '',
    additionalInformation: '',
});

const handleDataChange = (field, value) => {
    formData[field] = value;
};

const handleNext = () => {
    if (currentStep.value === 1 && selectedCity.value) {
        // Populate cityOfRentalProperty with selectedCity when moving to step 2
        formData.cityOfRentalProperty = selectedCity.value;
        if (currentStep.value < steps.length) {
            currentStep.value++;
        }
    } else if (currentStep.value > 1) {
        if (currentStep.value < steps.length) {
            currentStep.value++;
        }
    }
};

const handleBack = () => {
    if (currentStep.value > 1) {
        currentStep.value--;
    }
};

const handleSubmit = () => {
    
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
    
    // Show success message
    isSubmitted.value = true;
    
    // You can add API call here
};
</script>

<style scoped>
/* Edge browser compatibility fixes for padding and margin */
/* Ensure box-sizing is applied */
* {
    box-sizing: border-box;
}

/* Explicit styles for Edge browser compatibility */
.success-message-container {
    padding: 2rem !important;
    box-sizing: border-box !important;
}

@media (min-width: 640px) {
    .success-message-container {
        padding: 3rem !important;
    }
}

@media (min-width: 768px) {
    .success-message-container {
        padding: 4rem !important;
    }
}
</style>

