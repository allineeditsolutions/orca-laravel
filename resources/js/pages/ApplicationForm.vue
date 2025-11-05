<template>
    <div class="min-h-screen bg-gray-50 flex items-start justify-center px-2 sm:px-4 pt-2 pb-4 sm:pb-8 md:pb-12">
        <!-- Step Indicator -->
        <StepIndicator v-if="!isSubmitted" :steps="steps" :current-step="currentStep" />
        
        <div :class="['w-full max-w-6xl lg:max-w-7xl', isSubmitted ? 'mt-0' : 'mt-32 sm:mt-36 md:mt-[120px] lg:mt-[110px]']">
            <!-- Success Message Screen -->
            <div v-if="isSubmitted" class="p-4 space-y-6">
                <!-- Submission Success Section -->
                <div class="border border-gray-100 rounded-2xl bg-white shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="p-6 sm:p-8 md:p-10">
                        <div class="flex items-center gap-3 mb-4">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 md:w-8 md:h-8 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                            </svg>
                            <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-green-600">
                                Your application form has been successfully submitted.
                            </h2>
                        </div>
                        <div class="space-y-2 text-sm sm:text-base md:text-lg text-gray-900 leading-relaxed">
                            <p>
                                Please check your sms inbox to confirm that your application has been submitted properly.
                            </p>
                            <p>
                                Should you encounter any issues or require further assistance, please do not hesitate to contact us.
                            </p>
                            <p>
                                Thank you for choosing Orca Realty.
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- REVIEW Button -->
                <div class="flex justify-start pt-4">
                    <button
                        @click="handleBack"
                        class="cursor-pointer bg-teal-700 hover:bg-teal-800 text-white px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl font-semibold flex items-center gap-2 transition-colors duration-200 shadow-lg hover:shadow-xl"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        REVIEW
                    </button>
                </div>
            </div>
            
            <!-- Main Form Content - Centered -->
            <div v-else class="" 
                 style="scrollbar-width: thin; scrollbar-color: #9ca3af #f3f4f6;" >
                <!-- Step 1: Acknowledgement -->
                <div v-if="currentStep === 1" class="p-4 space-y-5 sm:space-y-6 md:space-y-8">
                    <div class="bg-white rounded-lg shadow-lg p-6 sm:p-8 space-y-6">
                        <div class="space-y-4 text-center">
                            <h2 class="text-2xl sm:text-3xl font-bold text-red-600">IMPORTANT NOTICE:</h2>
                            <p class="text-gray-700 text-base sm:text-lg leading-relaxed">
                                Before proceeding, you <strong>MUST DOWNLOAD</strong> and <strong>READ</strong> the Rules of Renting in BC by clicking the button below. Once this application form is submitted, you will get a copy of this document signed by the Property Manager.
                            </p>
                            
                            <div class="flex justify-center py-4">
                                <a
                                    href="https://orcarealty.ca/wp-content/uploads/2021/12/disclosure-for-residential-tenancies.pdf"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="px-6 py-3 bg-pink-500 hover:bg-pink-600 text-white font-semibold rounded-lg shadow-md hover:shadow-xl transition-all duration-200"
                                >
                                    DOWNLOAD NOW
                                </a>
                            </div>
                            
                            <div class="flex items-start justify-center space-x-3 pt-2">
                                <input
                                    type="checkbox"
                                    id="acknowledgement"
                                    v-model="acknowledgementChecked"
                                    class="mt-1 w-5 h-5 text-teal-600 border-gray-300 rounded focus:ring-teal-500 focus:ring-2 cursor-pointer checked:bg-teal-600 checked:border-teal-600"
                                />
                                <label for="acknowledgement" class="text-gray-700 text-sm sm:text-base leading-relaxed cursor-pointer">
                                    I have downloaded and read the Rules of Renting document.<span class="text-red-500">*</span>
                                </label>
                            </div>
                            
                            <p v-if="!acknowledgementChecked" class="text-red-400 text-sm sm:text-base">
                                DOWNLOAD and READ the Rules of Renting
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Step 2: Applicant Details -->
                <div v-if="currentStep === 2" class="p-4 space-y-5 sm:space-y-4">
                    <div class="border border-gray-100 rounded-2xl bg-gray-50 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div
                            class="flex items-center justify-between p-4 bg-white border-b border-gray-200 cursor-pointer hover:bg-gray-50 transition-colors"
                            @click="isPropertyInfoOpen = !isPropertyInfoOpen"
                        >
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm3 1h6v4H7V5zm6 6H7v2h6v-2z" clip-rule="evenodd" />
                                </svg>
                                <h3 class="text-lg font-semibold text-black">Property Information</h3>
                            </div>
                            <button
                                type="button"
                                class="flex items-center gap-2 text-black hover:text-gray-700 font-medium text-sm r-mr-3"
                                @click.stop="isPropertyInfoOpen = !isPropertyInfoOpen"
                            >
                                <svg
                                    :class="`w-5 h-5 transform transition-transform duration-200 text-gray-400 ${isPropertyInfoOpen ? 'rotate-180' : ''}`"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                        <div v-if="isPropertyInfoOpen" class="p-2 lg:p-5 space-y-5 sm:space-y-3">
                            <div class="space-y-3">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block mb-2 text-gray-800 font-medium">Property ID</label>
                                        <p class="text-gray-900 text-base">{{ formData.propertyId || '12036' }}</p>
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-gray-800 font-medium">Property Address</label>
                                        <p class="text-gray-900 text-base">{{ formData.propertyAddress || '612036 66 Avenue Surrey' }}</p>
                                    </div>
                                </div>
                                <div class="space-y-3 pt-4">
                                    <div class="space-y-3">
                                        <label class="block text-gray-800 font-medium">Have you visited the property?</label>
                                        <div class="flex flex-col sm:flex-row gap-3">
                                            <button
                                                type="button"
                                                @click="formData.hasVisitedProperty = true"
                                                :class="[
                                                    'px-6 py-3 rounded-lg font-semibold transition-colors duration-200',
                                                    formData.hasVisitedProperty === true
                                                        ? 'bg-black hover:bg-gray-800 text-white shadow-md'
                                                        : 'bg-gray-200 hover:bg-gray-300 text-gray-700'
                                                ]"
                                            >
                                                Yes, I have visited the property.
                                            </button>
                                            <button
                                                type="button"
                                                @click="formData.hasVisitedProperty = false"
                                                :class="[
                                                    'px-6 py-3 rounded-lg font-semibold transition-colors duration-200',
                                                    formData.hasVisitedProperty === false
                                                        ? 'bg-gray-400 hover:bg-gray-500 text-white shadow-md'
                                                        : 'bg-gray-200 hover:bg-gray-300 text-gray-700'
                                                ]"
                                            >
                                                No, I have not visited the property.
                                            </button>
                                        </div>
                                        <p v-if="formData.hasVisitedProperty === false" class="text-red-600 text-sm sm:text-base pt-2">
                                            We require everyone to visit the property prior to sending an application. Please schedule a visit <a href="#" class="text-blue-600 underline hover:text-blue-800">here</a>.
                                        </p>
                                    </div>
                                    <div v-if="formData.hasVisitedProperty === true" class="space-y-2 pt-2">
                                        <label class="block text-gray-800 font-medium">
                                            When did you view this property?<span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input
                                                type="date"
                                                v-model="formData.propertyViewDate"
                                                class="w-full p-2 pr-10 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <p class="text-red-600 text-sm sm:text-base">
                                            (We recommend everybody to view the property before submitting an application)
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Main-Applicant Section -->
                    <div v-if="formData.hasVisitedProperty === true" class="border border-gray-100 rounded-2xl bg-gray-50 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div
                            class="flex items-center justify-between p-4 bg-white border-b border-gray-200 cursor-pointer hover:bg-gray-50 transition-colors"
                            @click="isMainApplicantOpen = !isMainApplicantOpen"
                        >
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                <div class="flex flex-col">
                                    <h3 class="text-lg font-semibold text-black">Main-Applicant</h3>
                                    <p class="text-red-600 text-sm">(Please enter your legal name as reflected on your I.D.)</p>
                                </div>
                            </div>
                            <button
                                type="button"
                                class="flex items-center gap-2 text-black hover:text-gray-700 font-medium text-sm r-mr-3"
                                @click.stop="isMainApplicantOpen = !isMainApplicantOpen"
                            >
                                <svg
                                    :class="`w-5 h-5 transform transition-transform duration-200 text-gray-400 ${isMainApplicantOpen ? 'rotate-180' : ''}`"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                        <div v-if="isMainApplicantOpen" class="p-2 lg:p-5 space-y-5 sm:space-y-3">
                            <!-- Error Message -->
                            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                                <p class="text-red-600 text-sm sm:text-base font-medium">
                                    We can't perform, credit check for this application, applicants doesn't have established credit history in Canada.
                                </p>
                            </div>
                            
                            <!-- Main Applicant Form Fields -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- Left Column -->
                                <div class="space-y-4">
                                    <div>
                                        <label class="block mb-2 text-gray-800 font-medium">First Name<span class="text-red-500">*</span></label>
                                        <input
                                            type="text"
                                            v-model="formData.mainApplicantFirstName"
                                            class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                        />
                                    </div>
                                    
                                    <div>
                                        <label class="block mb-2 text-gray-800 font-medium">Email Address<span class="text-red-500">*</span></label>
                                        <input
                                            type="email"
                                            v-model="formData.mainApplicantEmail"
                                            class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                        />
                                    </div>
                                    
                                    <div>
                                        <label class="block mb-2 text-gray-800 font-medium">Date of Birth<span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <input
                                                type="date"
                                                v-model="formData.mainApplicantDateOfBirth"
                                                class="w-full p-2 pr-10 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block mb-2 text-gray-800 font-medium">Street Address<span class="text-red-500">*</span></label>
                                        <input
                                            type="text"
                                            v-model="formData.mainApplicantStreetAddress"
                                            class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                        />
                                    </div>
                                    
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Province<span class="text-red-500">*</span></label>
                                            <div class="relative">
                                                <select
                                                    v-model="formData.mainApplicantProvince"
                                                    class="w-full p-2 pr-10 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl appearance-none"
                                                >
                                                    <option value="">Select Province</option>
                                                    <option value="AB">Alberta</option>
                                                    <option value="BC">British Columbia</option>
                                                    <option value="MB">Manitoba</option>
                                                    <option value="NB">New Brunswick</option>
                                                    <option value="NL">Newfoundland and Labrador</option>
                                                    <option value="NT">Northwest Territories</option>
                                                    <option value="NS">Nova Scotia</option>
                                                    <option value="NU">Nunavut</option>
                                                    <option value="ON">Ontario</option>
                                                    <option value="PE">Prince Edward Island</option>
                                                    <option value="QC">Quebec</option>
                                                    <option value="SK">Saskatchewan</option>
                                                    <option value="YT">Yukon</option>
                                                </select>
                                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Date Started Living<span class="text-red-500">*</span></label>
                                            <div class="relative">
                                                <input
                                                    type="date"
                                                    v-model="formData.mainApplicantDateStartedLiving"
                                                    class="w-full p-2 pr-10 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                />
                                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-red-600 text-sm sm:text-base mt-2">
                                        (Please ensure the address is not later than six (6) months.)
                                    </p>
                                </div>
                                
                                <!-- Right Column -->
                                <div class="space-y-4">
                                    <div>
                                        <label class="block mb-2 text-gray-800 font-medium">Last Name<span class="text-red-500">*</span></label>
                                        <input
                                            type="text"
                                            v-model="formData.mainApplicantLastName"
                                            class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                        />
                                    </div>
                                    
                                    <div>
                                        <label class="block mb-2 text-gray-800 font-medium">Phone Number<span class="text-red-500">*</span></label>
                                        <input
                                            type="tel"
                                            v-model="formData.mainApplicantPhone"
                                            placeholder="(000) 000-0000"
                                            class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                        />
                                    </div>
                                    
                                    <div>
                                        <label class="block mb-2 text-gray-800 font-medium">City<span class="text-red-500">*</span></label>
                                        <input
                                            type="text"
                                            v-model="formData.mainApplicantCity"
                                            class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                        />
                                    </div>
                                    
                                    <div>
                                        <label class="block mb-2 text-gray-800 font-medium">Postal/ZIP Code<span class="text-red-500">*</span></label>
                                        <input
                                            type="text"
                                            v-model="formData.mainApplicantPostalCode"
                                            class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Co-Applicants List -->
                    <div v-if="formData.hasVisitedProperty === true && formData.coApplicants && formData.coApplicants.length > 0" class="space-y-4">
                        <div
                            v-for="(coApplicant, index) in formData.coApplicants"
                            :key="index"
                            class="border border-gray-100 rounded-2xl bg-gray-50 shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden"
                        >
                            <div
                                :class="[
                                    'flex items-center justify-between p-4 bg-white cursor-pointer hover:bg-gray-50 transition-colors rounded-t-2xl',
                                    !coApplicant.isOpen ? 'border-b border-gray-100' : ''
                                ]"
                                @click="coApplicant.isOpen = !coApplicant.isOpen"
                            >
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                    <div class="flex flex-col">
                                        <h3 class="text-lg font-semibold text-black">Co-Applicant {{ index + 1 }}</h3>
                                        <p class="text-red-600 text-sm">(Please enter your legal name as reflected on your I.D.)</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button
                                        type="button"
                                        @click.stop="removeCoApplicant(index)"
                                        class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors"
                                        title="Remove Co-Applicant"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                    <button
                                        type="button"
                                        class="flex items-center gap-2 text-black hover:text-gray-700 font-medium text-sm r-mr-3"
                                        @click.stop="coApplicant.isOpen = !coApplicant.isOpen"
                                    >
                                        <svg
                                            :class="`w-5 h-5 transform transition-transform duration-200 text-gray-400 ${coApplicant.isOpen ? 'rotate-180' : ''}`"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div v-if="coApplicant.isOpen" class="p-2 lg:p-5 space-y-5 sm:space-y-3 rounded-b-2xl">
                                <!-- Error Message -->
                                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                                    <p class="text-red-600 text-sm sm:text-base font-medium">
                                        We can't perform, credit check for this application, applicants doesn't have established credit history in Canada.
                                    </p>
                            </div>
                                
                                <!-- Co-Applicant Form Fields -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <!-- Left Column -->
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">First Name<span class="text-red-500">*</span></label>
                                            <input
                                                type="text"
                                                v-model="coApplicant.firstName"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                        
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Email Address<span class="text-red-500">*</span></label>
                                            <input
                                                type="email"
                                                v-model="coApplicant.email"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                        
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Date of Birth<span class="text-red-500">*</span></label>
                                            <div class="relative">
                                                <input
                                                    type="date"
                                                    v-model="coApplicant.dateOfBirth"
                                                    class="w-full p-2 pr-10 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                />
                                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Street Address<span class="text-red-500">*</span></label>
                                            <input
                                                type="text"
                                                v-model="coApplicant.streetAddress"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                        
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Province<span class="text-red-500">*</span></label>
                                                <div class="relative">
                                                    <select
                                                        v-model="coApplicant.province"
                                                        class="w-full p-2 pr-10 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl appearance-none"
                                                    >
                                                        <option value="">Select Province</option>
                                                        <option value="AB">Alberta</option>
                                                        <option value="BC">British Columbia</option>
                                                        <option value="MB">Manitoba</option>
                                                        <option value="NB">New Brunswick</option>
                                                        <option value="NL">Newfoundland and Labrador</option>
                                                        <option value="NT">Northwest Territories</option>
                                                        <option value="NS">Nova Scotia</option>
                                                        <option value="NU">Nunavut</option>
                                                        <option value="ON">Ontario</option>
                                                        <option value="PE">Prince Edward Island</option>
                                                        <option value="QC">Quebec</option>
                                                        <option value="SK">Saskatchewan</option>
                                                        <option value="YT">Yukon</option>
                                                    </select>
                                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Date Started Living<span class="text-red-500">*</span></label>
                                                <div class="relative">
                                                    <input
                                                        type="date"
                                                        v-model="coApplicant.dateStartedLiving"
                                                        class="w-full p-2 pr-10 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                    />
                                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-red-600 text-sm sm:text-base mt-2">
                                            (Please ensure the address is not later than six (6) months.)
                                        </p>
                                    </div>
                                    
                                    <!-- Right Column -->
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Last Name<span class="text-red-500">*</span></label>
                                            <input
                                                type="text"
                                                v-model="coApplicant.lastName"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                        
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Phone Number<span class="text-red-500">*</span></label>
                                            <input
                                                type="tel"
                                                v-model="coApplicant.phone"
                                                placeholder="(000) 000-0000"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                        
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">City<span class="text-red-500">*</span></label>
                                            <input
                                                type="text"
                                                v-model="coApplicant.city"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                        
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Postal/ZIP Code<span class="text-red-500">*</span></label>
                                            <input
                                                type="text"
                                                v-model="coApplicant.postalCode"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Add Co-Applicant Button -->
                    <div v-if="formData.hasVisitedProperty === true" class="flex justify-start">
                        <button
                            type="button"
                            @click="addCoApplicant"
                            class="px-6 py-3 bg-black hover:bg-gray-800 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-colors duration-200 flex items-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Add Co-Applicant
                        </button>
                    </div>
                    
                    <!-- Point of Contact Section -->
                    <div v-if="formData.hasVisitedProperty === true" class="border border-gray-100 rounded-2xl bg-gray-50 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div
                            class="flex items-center justify-between p-4 bg-white border-b border-gray-200 cursor-pointer hover:bg-gray-50 transition-colors"
                            @click="isPointOfContactOpen = !isPointOfContactOpen"
                        >
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                <h3 class="text-lg font-semibold text-black">Point of Contact</h3>
                            </div>
                            <button
                                type="button"
                                class="flex items-center gap-2 text-black hover:text-gray-700 font-medium text-sm r-mr-3"
                                @click.stop="isPointOfContactOpen = !isPointOfContactOpen"
                            >
                                <svg
                                    :class="`w-5 h-5 transform transition-transform duration-200 text-gray-400 ${isPointOfContactOpen ? 'rotate-180' : ''}`"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                        <div v-if="isPointOfContactOpen" class="p-2 lg:p-5 space-y-5 sm:space-y-3">
                            <label class="block text-gray-800 font-medium">Select Point of Contact</label>
                            <div class="space-y-3">
                                <label class="flex items-center gap-3 text-gray-800">
                                    <input
                                        type="radio"
                                        name="pointOfContact"
                                        value="sameMain"
                                        v-model="formData.pointOfContact"
                                        class="w-5 h-5"
                                    />
                                    <span>Same as Main Applicant</span>
                                </label>
                                <label class="flex items-center gap-3 text-gray-800">
                                    <input
                                        type="radio"
                                        name="pointOfContact"
                                        value="sameCo"
                                        v-model="formData.pointOfContact"
                                        class="w-5 h-5"
                                    />
                                    <span>Same as Co-Applicant</span>
                                </label>
                                <label class="flex items-center gap-3 text-gray-800">
                                    <input
                                        type="radio"
                                        name="pointOfContact"
                                        value="both"
                                        v-model="formData.pointOfContact"
                                        class="w-5 h-5"
                                    />
                                    <span>Both Main & Co-Applicant</span>
                                </label>
                                <label class="flex items-center gap-3 text-gray-800">
                                    <input
                                        type="radio"
                                        name="pointOfContact"
                                        value="other"
                                        v-model="formData.pointOfContact"
                                        class="w-5 h-5"
                                    />
                                    <span>Other(Specify)</span>
                                </label>
                            </div>
                            <div v-if="formData.pointOfContact === 'other'" class="pt-4">
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block mb-2 text-gray-800 font-medium">First Name <span class="text-red-500">*</span></label>
                                        <input
                                            type="text"
                                            v-model="formData.pointOfContactFirstName"
                                            class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                        />
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-gray-800 font-medium">Email Address <span class="text-red-500">*</span></label>
                                        <input
                                            type="email"
                                            v-model="formData.pointOfContactEmail"
                                            class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                        />
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-gray-800 font-medium">Phone <span class="text-red-500">*</span></label>
                                        <input
                                            type="tel"
                                            v-model="formData.pointOfContactPhone"
                                            placeholder="(000) 000-0000"
                                            class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Emergency Contact Person Section -->
                    <div v-if="formData.hasVisitedProperty === true" class="border border-gray-100 rounded-2xl bg-gray-50 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div
                            class="flex items-center justify-between p-4 bg-white border-b border-gray-200 cursor-pointer hover:bg-gray-50 transition-colors"
                            @click="isEmergencyContactOpen = !isEmergencyContactOpen"
                        >
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                <h3 class="text-lg font-semibold text-black">Emergency Contact Person</h3>
                            </div>
                            <button
                                type="button"
                                class="flex items-center gap-2 text-black hover:text-gray-700 font-medium text-sm r-mr-3"
                                @click.stop="isEmergencyContactOpen = !isEmergencyContactOpen"
                            >
                                <svg
                                    :class="`w-5 h-5 transform transition-transform duration-200 text-gray-400 ${isEmergencyContactOpen ? 'rotate-180' : ''}`"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                        <div v-if="isEmergencyContactOpen" class="p-2 lg:p-5 space-y-5 sm:space-y-3">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Firstname <span class="text-red-500">*</span></label>
                                            <input
                                                type="text"
                                                v-model="formData.emergencyContactFirstName"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Lastname <span class="text-red-500">*</span></label>
                                            <input
                                                type="text"
                                                v-model="formData.emergencyContactLastName"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Phone Number <span class="text-red-500">*</span></label>
                                            <input
                                                type="tel"
                                                v-model="formData.emergencyContactPhone"
                                                placeholder="(000) 000-0000"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Email</label>
                                            <input
                                                type="email"
                                                v-model="formData.emergencyContactEmail"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                    </div>
                        </div>
                    </div>
                </div>
                
                <!-- Step 3: Employment -->
                <div v-if="currentStep === 3" class="p-4 space-y-5 sm:space-y-4">
                    <div class="border border-gray-100 rounded-2xl bg-gray-50 shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden">
                        <div
                            class="flex items-center justify-between p-4 bg-white border-b border-gray-200 cursor-pointer hover:bg-gray-50 transition-colors rounded-t-2xl"
                            @click="isEmploymentOpen = !isEmploymentOpen"
                        >
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                                <h3 class="text-lg font-semibold text-black">Main Applicant Employment Form</h3>
                            </div>
                            <button
                                type="button"
                                class="flex items-center gap-2 text-black hover:text-gray-700 font-medium text-sm r-mr-3"
                                @click.stop="isEmploymentOpen = !isEmploymentOpen"
                            >
                                <svg
                                    :class="`w-5 h-5 transform transition-transform duration-200 text-gray-400 ${isEmploymentOpen ? 'rotate-180' : ''}`"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                        <div v-if="isEmploymentOpen" class="p-2 lg:p-5 space-y-5 sm:space-y-3 rounded-b-2xl">
                            <p class="text-red-600 text-sm sm:text-base">Providing complete and accurate details increases your chances of Application Approval.</p>
                            <div class="space-y-4">
                                <div>
                                    <label class="block mb-2 text-gray-800 font-medium">Employment Status</label>
                                    <div class="relative">
                                        <select
                                            v-model="formData.employmentStatus"
                                            class="w-1/2 p-2 pr-10 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                        >
                                            <option value="">Select Employment Status</option>
                                            <option value="not-applicable">Not Applicable</option>
                                            <option value="employed">Employed</option>
                                            <option value="self-employed">Self-Employed</option>
                                        </select>
                                  
                                    </div>
                                </div>
                                
                                <div v-if="formData.employmentStatus === 'not-applicable'">
                                    <label class="block mb-2 text-gray-800 font-medium">Please help us understand why this information is not applicable.<span class="text-red-500">*</span></label>
                                    <textarea
                                        v-model="formData.employmentNotApplicableReason"
                                        rows="4"
                                        class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl resize-y"
                                        placeholder="Please explain why employment information is not applicable..."
                                    ></textarea>
                                </div>
                                
                                <!-- When Not Applicable: Show simplified layout -->
                                <template v-if="formData.employmentStatus === 'not-applicable'">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Linked In URL<span class="text-red-500">*</span></label>
                                            <input
                                                type="url"
                                                v-model="formData.linkedInUrls"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Previous Job Profile/Company URL<span class="text-red-500">*</span></label>
                                            <input
                                                type="url"
                                                v-model="formData.previousJobProfileUrl"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block mb-2 text-gray-800 font-medium">Do you have other sources of income?<span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <select
                                                v-model="formData.hasOtherIncome"
                                                class="w-full p-2 pr-10 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl appearance-none"
                                            >
                                                <option value="">Select</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div v-if="formData.hasOtherIncome === 'yes'">
                                        <label class="block mb-2 text-gray-800 font-medium">Please give us more details about your other source of income.<span class="text-red-500">*</span></label>
                                        <textarea
                                            v-model="formData.otherIncomeDetails"
                                            rows="4"
                                            class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl resize-y"
                                            placeholder="Please provide details about your other sources of income..."
                                        ></textarea>
                                    </div>
                                </template>
                                
                                <!-- When Employed: Show employment form -->
                                <div v-if="formData.employmentStatus === 'employed'">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <!-- Left Column -->
                                        <div class="space-y-4">
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Company/Organization<span class="text-red-500">*</span></label>
                                                <input
                                                    type="text"
                                                    v-model="formData.companyOrganization"
                                                    class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                />
                                            </div>
                                            
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Linked In URLs<span class="text-red-500">*</span></label>
                                                <input
                                                    type="url"
                                                    v-model="formData.linkedInUrls"
                                                    class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                />
                                            </div>
                                            
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Salary<span class="text-red-500">*</span></label>
                                                <div class="relative">
                                                    <input
                                                        type="number"
                                                        v-model.number="formData.salary"
                                                        min="0"
                                                        class="w-full p-2 pr-16 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                    />
                                                    <div class="absolute inset-y-0 right-0 flex items-center pr-2">
                                                        <button
                                                            type="button"
                                                            @click="formData.salary = (formData.salary || 0) + 1"
                                                            class="px-2 py-1 text-gray-600 hover:text-gray-800 border-l border-gray-200"
                                                        >
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                                            </svg>
                                                        </button>
                                                        <button
                                                            type="button"
                                                            @click="formData.salary = Math.max(0, (formData.salary || 0) - 1)"
                                                            class="px-2 py-1 text-gray-600 hover:text-gray-800 border-l border-gray-200"
                                                        >
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="pt-4">
                                                <h4 class="text-lg font-semibold text-gray-800 mb-4">Company Reference</h4>
                                                
                                                <div class="space-y-4">
                                                    <div>
                                                        <label class="block mb-2 text-gray-800 font-medium">First Name<span class="text-red-500">*</span></label>
                                                        <input
                                                            type="text"
                                                            v-model="formData.companyReferenceFirstName"
                                                            class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                        />
                                                    </div>
                                                    
                                                    <div>
                                                        <label class="block mb-2 text-gray-800 font-medium">Last Name<span class="text-red-500">*</span></label>
                                                        <input
                                                            type="text"
                                                            v-model="formData.companyReferenceLastName"
                                                            class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                        />
                                                    </div>
                                                    
                                                    <div>
                                                        <label class="block mb-2 text-gray-800 font-medium">Position</label>
                                                        <input
                                                            type="text"
                                                            v-model="formData.companyReferencePosition"
                                                            class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                        />
                                                    </div>
                                                    
                                                    <div>
                                                        <label class="block mb-2 text-gray-800 font-medium">Email Address</label>
                                                        <input
                                                            type="email"
                                                            v-model="formData.companyReferenceEmail"
                                                            class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                        />
                                                    </div>
                                                    
                                                    <div>
                                                        <label class="block mb-2 text-gray-800 font-medium">Phone Number<span class="text-red-500">*</span></label>
                                                        <input
                                                            type="tel"
                                                            v-model="formData.companyReferencePhone"
                                                            placeholder="(000) 000-0000"
                                                            class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Do you have other sources of income?<span class="text-red-500">*</span></label>
                                                <div class="relative">
                                                    <select
                                                        v-model="formData.hasOtherIncome"
                                                        class="w-full p-2 pr-10 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl appearance-none"
                                                    >
                                                        <option value="">Select</option>
                                                        <option value="yes">Yes</option>
                                                        <option value="no">No</option>
                                                    </select>
                                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div v-if="formData.hasOtherIncome === 'yes'">
                                                <label class="block mb-2 text-gray-800 font-medium">Please give us more details about your other source of income.<span class="text-red-500">*</span></label>
                                                <textarea
                                                    v-model="formData.otherIncomeDetails"
                                                    rows="4"
                                                    class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl resize-y"
                                                    placeholder="Please provide details about your other sources of income..."
                                                ></textarea>
                                            </div>
                                            
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Current Pay stub</label>
                                                <div class="space-y-2">
                                                    <div class="flex items-center gap-2">
                                                        <input
                                                            type="file"
                                                            ref="payStubInput"
                                                            @change="handlePayStubChange"
                                                            accept=".pdf,.jpg,.jpeg,.png"
                                                            class="hidden"
                                                            id="payStubInput"
                                                        />
                                                        <label
                                                            for="payStubInput"
                                                            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg cursor-pointer transition-colors duration-200"
                                                        >
                                                            Choose File
                                                        </label>
                                                        <span class="text-gray-600 text-sm">{{ formData.payStubFileName || 'No file chosen' }}</span>
                                                    </div>
                                                    <p class="text-red-600 text-sm">
                                                        (If you don't have it handy, you can send it later at secureddocuments@orcarealty.ca)
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Right Column -->
                                        <div class="space-y-4">
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Job Title<span class="text-red-500">*</span></label>
                                                <input
                                                    type="text"
                                                    v-model="formData.jobTitle"
                                                    class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                />
                                            </div>
                                            
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Job Profile/Company URL<span class="text-red-500">*</span></label>
                                                <input
                                                    type="url"
                                                    v-model="formData.jobProfileUrl"
                                                    class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                />
                                            </div>
                                            
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Start Date<span class="text-red-500">*</span></label>
                                                <div class="relative">
                                                    <input
                                                        type="date"
                                                        v-model="formData.jobStartDate"
                                                        class="w-full p-2 pr-10 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                    />
                                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- When Self-Employed: Show business form -->
                                <div v-if="formData.employmentStatus === 'self-employed'">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <!-- Left Column -->
                                        <div class="space-y-4">
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Business Name<span class="text-red-500">*</span></label>
                                                <input
                                                    type="text"
                                                    v-model="formData.businessName"
                                                    class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                />
                                            </div>
                                            
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Business Linked In URL<span class="text-red-500">*</span></label>
                                                <input
                                                    type="url"
                                                    v-model="formData.businessLinkedInUrl"
                                                    class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                />
                                            </div>
                                            
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Please give us more information about your business.<span class="text-red-500">*</span></label>
                                                <textarea
                                                    v-model="formData.businessInformation"
                                                    rows="4"
                                                    class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl resize-y"
                                                    placeholder="Please provide information about your business..."
                                                ></textarea>
                                            </div>
                                            
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Proof of Company Ownership & Current Tax Return</label>
                                                <div class="space-y-2">
                                                    <div class="flex items-center gap-2">
                                                        <input
                                                            type="file"
                                                            ref="businessProofInput"
                                                            @change="handleBusinessProofChange"
                                                            accept=".pdf,.jpg,.jpeg,.png"
                                                            class="hidden"
                                                            id="businessProofInput"
                                                        />
                                                        <label
                                                            for="businessProofInput"
                                                            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg cursor-pointer transition-colors duration-200"
                                                        >
                                                            Choose File
                                                        </label>
                                                        <span class="text-gray-600 text-sm">{{ formData.businessProofFileName || 'No file chosen' }}</span>
                                                    </div>
                                                    <p class="text-red-600 text-sm">
                                                        (If you don't have it handy, you can send it later at secureddocuments@orcarealty.ca)
                                                    </p>
                                                </div>
                                            </div>
                                            
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Do you have other sources of income?<span class="text-red-500">*</span></label>
                                                <div class="relative">
                                                    <select
                                                        v-model="formData.hasOtherIncome"
                                                        class="w-full p-2 pr-10 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl appearance-none"
                                                    >
                                                        <option value="">Select</option>
                                                        <option value="yes">Yes</option>
                                                        <option value="no">No</option>
                                                    </select>
                                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div v-if="formData.hasOtherIncome === 'yes'">
                                                <label class="block mb-2 text-gray-800 font-medium">Please give us more details about your other source of income.<span class="text-red-500">*</span></label>
                                                <textarea
                                                    v-model="formData.otherIncomeDetails"
                                                    rows="4"
                                                    class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl resize-y"
                                                    placeholder="Please provide details about your other sources of income..."
                                                ></textarea>
                                            </div>
                                        </div>
                                        
                                        <!-- Right Column -->
                                        <div class="space-y-4">
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Number of Years in Business<span class="text-red-500">*</span></label>
                                                <div class="relative">
                                                    <input
                                                        type="number"
                                                        v-model.number="formData.yearsInBusiness"
                                                        min="0"
                                                        class="w-full p-2 pr-16 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                    />
                                                    <div class="absolute inset-y-0 right-0 flex items-center pr-2">
                                                        <button
                                                            type="button"
                                                            @click="formData.yearsInBusiness = (formData.yearsInBusiness || 0) + 1"
                                                            class="px-2 py-1 text-gray-600 hover:text-gray-800 border-l border-gray-200"
                                                        >
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                                            </svg>
                                                        </button>
                                                        <button
                                                            type="button"
                                                            @click="formData.yearsInBusiness = Math.max(0, (formData.yearsInBusiness || 0) - 1)"
                                                            class="px-2 py-1 text-gray-600 hover:text-gray-800 border-l border-gray-200"
                                                        >
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Business Profile/Business URL<span class="text-red-500">*</span></label>
                                                <input
                                                    type="url"
                                                    v-model="formData.businessProfileUrl"
                                                    class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Step 4: References -->
                <div v-if="currentStep === 4" class="p-4 space-y-4">
                    <!-- Main Applicant Current Residence -->
                    <div class="border border-gray-100 rounded-2xl bg-gray-50 shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden">
                        <div
                            class="flex items-center justify-between p-4 bg-white cursor-pointer hover:bg-gray-50 transition-colors rounded-t-2xl"
                            @click="isCurrentResidenceOpen = !isCurrentResidenceOpen"
                        >
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                </svg>
                                <h3 class="text-lg font-semibold text-black">Main Applicant Current Residence</h3>
                            </div>
                            <svg
                                :class="`w-5 h-5 transform transition-transform duration-200 text-gray-400 ${isCurrentResidenceOpen ? 'rotate-180' : ''}`"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                        <div v-if="isCurrentResidenceOpen" class="p-2 lg:p-5 space-y-5 sm:space-y-3 rounded-b-2xl">
                            <div class="space-y-4">
                                <p class="text-red-600 text-sm sm:text-base">Providing complete and accurate details increases your chances of Application Approval.</p>
                                <div class="flex items-center gap-2">
                                    <h4 class="text-base font-semibold text-gray-800">Landlord Details</h4>
                                    <label class="flex items-center gap-2 text-gray-700">
                                        <input
                                            type="checkbox"
                                            v-model="formData.currentResidenceNotApplicable"
                                            class="w-4 h-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500"
                                        />
                                        <span class="text-sm">Not Applicable</span>
                                    </label>
                                </div>
                                
                                <!-- When Not Applicable is checked -->
                                <template v-if="formData.currentResidenceNotApplicable">
                                    <div>
                                        <label class="block mb-2 text-gray-800 font-medium">Please help us understand why this information is not applicable.<span class="text-red-500">*</span></label>
                                        <textarea
                                            v-model="formData.currentResidenceNotApplicableReason"
                                            rows="4"
                                            class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl resize-y"
                                            placeholder="Please explain why landlord information is not applicable..."
                                        ></textarea>
                                    </div>
                                    
                                    <div>
                                        <label class="block mb-2 text-gray-800 font-medium">Reason for moving.<span class="text-red-500">*</span></label>
                                        <textarea
                                            v-model="formData.currentResidenceReasonForMoving"
                                            rows="4"
                                            class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl resize-y"
                                            placeholder="Please provide reason for moving..."
                                        ></textarea>
                                    </div>
                                </template>
                                
                                <!-- When Not Applicable is NOT checked - Show full form -->
                                <template v-if="!formData.currentResidenceNotApplicable">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <!-- Left Column -->
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">From Date<span class="text-red-500">*</span></label>
                                            <div class="relative">
                                                <input
                                                    type="date"
                                                    v-model="formData.currentResidenceFromDate"
                                                    class="w-full p-2 pr-10 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                />
                                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">First Name<span class="text-red-500">*</span></label>
                                            <input
                                                type="text"
                                                v-model="formData.currentResidenceFirstName"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                        
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Unit Address<span class="text-red-500">*</span></label>
                                            <input
                                                type="text"
                                                v-model="formData.currentResidenceUnitAddress"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                        
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">City<span class="text-red-500">*</span></label>
                                            <input
                                                type="text"
                                                v-model="formData.currentResidenceCity"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                        
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Postal/ZIP code<span class="text-red-500">*</span></label>
                                            <input
                                                type="text"
                                                v-model="formData.currentResidencePostalCode"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                        
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Phone Number<span class="text-red-500">*</span></label>
                                            <input
                                                type="tel"
                                                v-model="formData.currentResidencePhone"
                                                placeholder="(000) 000-0000"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                    </div>
                                    
                                    <!-- Right Column -->
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">To Date<span class="text-red-500">*</span></label>
                                            <div class="relative">
                                                <input
                                                    type="date"
                                                    v-model="formData.currentResidenceToDate"
                                                    class="w-full p-2 pr-10 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                />
                                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Last Name<span class="text-red-500">*</span></label>
                                            <input
                                                type="text"
                                                v-model="formData.currentResidenceLastName"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                        
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Street Address<span class="text-red-500">*</span></label>
                                            <input
                                                type="text"
                                                v-model="formData.currentResidenceStreetAddress"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                        
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Province<span class="text-red-500">*</span></label>
                                            <div class="relative">
                                                <select
                                                    v-model="formData.currentResidenceProvince"
                                                    class="w-full p-2 pr-10 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl appearance-none"
                                                >
                                                    <option value="">Select Province</option>
                                                    <option value="AB">Alberta</option>
                                                    <option value="BC">British Columbia</option>
                                                    <option value="MB">Manitoba</option>
                                                    <option value="NB">New Brunswick</option>
                                                    <option value="NL">Newfoundland and Labrador</option>
                                                    <option value="NT">Northwest Territories</option>
                                                    <option value="NS">Nova Scotia</option>
                                                    <option value="NU">Nunavut</option>
                                                    <option value="ON">Ontario</option>
                                                    <option value="PE">Prince Edward Island</option>
                                                    <option value="QC">Quebec</option>
                                                    <option value="SK">Saskatchewan</option>
                                                    <option value="YT">Yukon</option>
                                                </select>
                                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Email Address</label>
                                            <input
                                                type="email"
                                                v-model="formData.currentResidenceEmail"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                    </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block mb-2 text-gray-800 font-medium">Reason for moving.<span class="text-red-500">*</span></label>
                                        <textarea
                                            v-model="formData.currentResidenceReasonForMoving"
                                            rows="4"
                                            class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl resize-y"
                                            placeholder="Please provide reason for moving..."
                                        ></textarea>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Main Applicant Previous Residence -->
                    <div class="border border-gray-100 rounded-2xl bg-gray-50 shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden">
                        <div
                            class="flex items-center justify-between p-4 bg-white cursor-pointer hover:bg-gray-50 transition-colors rounded-t-2xl"
                            @click="isPreviousResidenceOpen = !isPreviousResidenceOpen"
                        >
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                </svg>
                                <h3 class="text-lg font-semibold text-black">Main Applicant Previous Residence</h3>
                            </div>
                            <svg
                                :class="`w-5 h-5 transform transition-transform duration-200 text-gray-400 ${isPreviousResidenceOpen ? 'rotate-180' : ''}`"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                        <div v-if="isPreviousResidenceOpen" class="p-2 lg:p-5 space-y-5 sm:space-y-3 rounded-b-2xl">
                            <div class="space-y-4">
                                <p class="text-red-600 text-sm sm:text-base">Providing complete and accurate details increases your chances of Application Approval.</p>
                                <div class="flex items-center gap-2">
                                    <h4 class="text-base font-semibold text-gray-800">Landlord Details</h4>
                                    <label class="flex items-center gap-2 text-gray-700">
                                        <input
                                            type="checkbox"
                                            v-model="formData.previousResidenceNotApplicable"
                                            class="w-4 h-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500"
                                        />
                                        <span class="text-sm">Not Applicable</span>
                                    </label>
                                </div>
                                
                                <!-- When Not Applicable is checked -->
                                <template v-if="formData.previousResidenceNotApplicable">
                                    <div>
                                        <label class="block mb-2 text-gray-800 font-medium">Please help us understand why this information is not applicable.<span class="text-red-500">*</span></label>
                                        <textarea
                                            v-model="formData.previousResidenceNotApplicableReason"
                                            rows="4"
                                            class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl resize-y"
                                            placeholder="Please explain why landlord information is not applicable..."
                                        ></textarea>
                                    </div>
                                    
                                    <div>
                                        <label class="block mb-2 text-gray-800 font-medium">Reason for moving.<span class="text-red-500">*</span></label>
                                        <textarea
                                            v-model="formData.previousResidenceReasonForMoving"
                                            rows="4"
                                            class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl resize-y"
                                            placeholder="Please provide reason for moving..."
                                        ></textarea>
                                    </div>
                                </template>
                                
                                <!-- When Not Applicable is NOT checked - Show full form -->
                                <template v-if="!formData.previousResidenceNotApplicable">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <!-- Left Column -->
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">From Date<span class="text-red-500">*</span></label>
                                            <div class="relative">
                                                <input
                                                    type="date"
                                                    v-model="formData.previousResidenceFromDate"
                                                    class="w-full p-2 pr-10 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                />
                                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">First Name<span class="text-red-500">*</span></label>
                                            <input
                                                type="text"
                                                v-model="formData.previousResidenceFirstName"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                        
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Unit Address<span class="text-red-500">*</span></label>
                                            <input
                                                type="text"
                                                v-model="formData.previousResidenceUnitAddress"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                        
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">City<span class="text-red-500">*</span></label>
                                            <input
                                                type="text"
                                                v-model="formData.previousResidenceCity"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                        
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Postal/ZIP code<span class="text-red-500">*</span></label>
                                            <input
                                                type="text"
                                                v-model="formData.previousResidencePostalCode"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                        
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Phone Number<span class="text-red-500">*</span></label>
                                            <input
                                                type="tel"
                                                v-model="formData.previousResidencePhone"
                                                placeholder="(000) 000-0000"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                    </div>
                                    
                                    <!-- Right Column -->
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">To Date<span class="text-red-500">*</span></label>
                                            <div class="relative">
                                                <input
                                                    type="date"
                                                    v-model="formData.previousResidenceToDate"
                                                    class="w-full p-2 pr-10 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                />
                                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Last Name<span class="text-red-500">*</span></label>
                                            <input
                                                type="text"
                                                v-model="formData.previousResidenceLastName"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                        
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Street Address<span class="text-red-500">*</span></label>
                                            <input
                                                type="text"
                                                v-model="formData.previousResidenceStreetAddress"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                        
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Province<span class="text-red-500">*</span></label>
                                            <div class="relative">
                                                <select
                                                    v-model="formData.previousResidenceProvince"
                                                    class="w-full p-2 pr-10 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl appearance-none"
                                                >
                                                    <option value="">Select Province</option>
                                                    <option value="AB">Alberta</option>
                                                    <option value="BC">British Columbia</option>
                                                    <option value="MB">Manitoba</option>
                                                    <option value="NB">New Brunswick</option>
                                                    <option value="NL">Newfoundland and Labrador</option>
                                                    <option value="NT">Northwest Territories</option>
                                                    <option value="NS">Nova Scotia</option>
                                                    <option value="NU">Nunavut</option>
                                                    <option value="ON">Ontario</option>
                                                    <option value="PE">Prince Edward Island</option>
                                                    <option value="QC">Quebec</option>
                                                    <option value="SK">Saskatchewan</option>
                                                    <option value="YT">Yukon</option>
                                                </select>
                                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Email Address</label>
                                            <input
                                                type="email"
                                                v-model="formData.previousResidenceEmail"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                    </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block mb-2 text-gray-800 font-medium">Reason for moving.<span class="text-red-500">*</span></label>
                                        <textarea
                                            v-model="formData.previousResidenceReasonForMoving"
                                            rows="4"
                                            class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl resize-y"
                                            placeholder="Please provide reason for moving..."
                                        ></textarea>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Guarantor Section -->
                    <div class="border border-gray-100 rounded-2xl bg-gray-50 shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden">
                        <div
                            class="flex items-center justify-between p-4 bg-white cursor-pointer hover:bg-gray-50 transition-colors rounded-t-2xl"
                            @click="isGuarantorOpen = !isGuarantorOpen"
                        >
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                <h3 class="text-lg font-semibold text-black">Guarantor</h3>
                            </div>
                            <svg
                                :class="`w-5 h-5 transform transition-transform duration-200 text-gray-400 ${isGuarantorOpen ? 'rotate-180' : ''}`"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                        <div v-if="isGuarantorOpen" class="p-2 lg:p-5 space-y-5 sm:space-y-3 rounded-b-2xl">
                            <div class="space-y-4">
                                <p class="text-red-600 text-sm sm:text-base">Providing complete and accurate details increases your chances of Application Approval.</p>
                                <div>
                                    <label class="block mb-4 text-gray-800 font-medium">Are you able to add a local guarantor to strengthen your application?</label>
                                    <div class="space-y-3">
                                        <label class="flex items-center gap-3 text-gray-800">
                                            <input
                                                type="radio"
                                                name="hasGuarantor"
                                                value="yes"
                                                v-model="formData.hasGuarantor"
                                                class="w-5 h-5"
                                            />
                                            <span>Yes</span>
                                        </label>
                                        <label class="flex items-center gap-3 text-gray-800">
                                            <input
                                                type="radio"
                                                name="hasGuarantor"
                                                value="no"
                                                v-model="formData.hasGuarantor"
                                                class="w-5 h-5"
                                            />
                                            <span>No</span>
                                        </label>
                                    </div>
                                </div>
                                
                                <!-- When Yes is selected, show guarantor fields -->
                                <div v-if="formData.hasGuarantor === 'yes'">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <!-- Left Column -->
                                        <div class="space-y-4">
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Guarantor Name<span class="text-red-500">*</span></label>
                                                <input
                                                    type="text"
                                                    v-model="formData.guarantorName"
                                                    class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                />
                                            </div>
                                            
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Email<span class="text-red-500">*</span></label>
                                                <input
                                                    type="email"
                                                    v-model="formData.guarantorEmail"
                                                    class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                />
                                            </div>
                                            
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Street Address<span class="text-red-500">*</span></label>
                                                <input
                                                    type="text"
                                                    v-model="formData.guarantorStreetAddress"
                                                    class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                />
                                            </div>
                                            
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Province<span class="text-red-500">*</span></label>
                                                <div class="relative">
                                                    <select
                                                        v-model="formData.guarantorProvince"
                                                        class="w-full p-2 pr-10 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl appearance-none"
                                                    >
                                                        <option value="">Select Province</option>
                                                        <option value="AB">Alberta</option>
                                                        <option value="BC">British Columbia</option>
                                                        <option value="MB">Manitoba</option>
                                                        <option value="NB">New Brunswick</option>
                                                        <option value="NL">Newfoundland and Labrador</option>
                                                        <option value="NT">Northwest Territories</option>
                                                        <option value="NS">Nova Scotia</option>
                                                        <option value="NU">Nunavut</option>
                                                        <option value="ON">Ontario</option>
                                                        <option value="PE">Prince Edward Island</option>
                                                        <option value="QC">Quebec</option>
                                                        <option value="SK">Saskatchewan</option>
                                                        <option value="YT">Yukon</option>
                                                    </select>
                                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Postal Code<span class="text-red-500">*</span></label>
                                                <input
                                                    type="text"
                                                    v-model="formData.guarantorPostalCode"
                                                    class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                />
                                            </div>
                                        </div>
                                        
                                        <!-- Right Column -->
                                        <div class="space-y-4">
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Phone Number<span class="text-red-500">*</span></label>
                                                <input
                                                    type="tel"
                                                    v-model="formData.guarantorPhone"
                                                    placeholder="(000) 000-0000"
                                                    class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                />
                                            </div>
                                            
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Date of Birth<span class="text-red-500">*</span></label>
                                                <div class="relative">
                                                    <input
                                                        type="date"
                                                        v-model="formData.guarantorDateOfBirth"
                                                        class="w-full p-2 pr-10 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                    />
                                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">City<span class="text-red-500">*</span></label>
                                                <input
                                                    type="text"
                                                    v-model="formData.guarantorCity"
                                                    class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                />
                                            </div>
                                            
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Country<span class="text-red-500">*</span></label>
                                                <input
                                                    type="text"
                                                    v-model="formData.guarantorCountry"
                                                    class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Step 5: Other Occupants -->
                <div v-if="currentStep === 5" class="p-4 space-y-4">
                    <div class="border border-gray-100 rounded-2xl bg-gray-50 shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden">
                        <div
                            class="flex items-center justify-between p-4 bg-white cursor-pointer hover:bg-gray-50 transition-colors rounded-t-2xl"
                            @click="isOtherOccupantsOpen = !isOtherOccupantsOpen"
                        >
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                <h3 class="text-lg font-semibold text-black">Other Occupants</h3>
                            </div>
                            <svg
                                :class="`w-5 h-5 transform transition-transform duration-200 text-gray-400 ${isOtherOccupantsOpen ? 'rotate-180' : ''}`"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                        <div v-if="isOtherOccupantsOpen" class="p-2 lg:p-5 space-y-5 sm:space-y-3 rounded-b-2xl">
                            <!-- Other Occupants Details -->
                            <div class="space-y-4">
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                    <h3 class="text-lg font-semibold text-gray-800">Other Occupants Details</h3>
                                </div>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block mb-2 text-gray-800 font-medium">Preferred Date of Occupancy<span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <input
                                                type="date"
                                                v-model="formData.preferredDateOfOccupancy"
                                                class="w-full p-2 pr-10 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block mb-2 text-gray-800 font-medium">Any of the occupants smoke?<span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <select
                                                v-model="formData.occupantsSmoke"
                                                class="w-full p-2 pr-10 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl appearance-none"
                                            >
                                                <option value="">Select</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Additional Adult Occupants -->
                            <div class="space-y-4 pt-4 border-t border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-800">Additional Adult Occupants</h3>
                                <p class="text-sm text-gray-600">Enter the details of any additional adults that will be occupying the home.</p>
                                
                                <!-- Number of Adults -->
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-800 font-medium">Number of Adults ({{ formData.adultOccupants.length }})</span>
                                    <button
                                        type="button"
                                        @click="addAdultOccupant"
                                        class="px-4 py-2 bg-black hover:bg-gray-800 text-white rounded-lg font-semibold transition-colors duration-200 shadow-md hover:shadow-lg"
                                    >
                                        Add Adult
                                    </button>
                                </div>
                                
                                <!-- Adult Occupants List -->
                                <div v-for="(adult, index) in formData.adultOccupants" :key="index" class="border border-gray-200 rounded-lg p-4 space-y-4 bg-white">
                                    <div class="flex items-center justify-between">
                                        <h4 class="font-semibold text-gray-800">Adult {{ index + 1 }}</h4>
                                        <button
                                            type="button"
                                            @click="removeAdultOccupant(index)"
                                            class="text-red-600 hover:text-red-800 font-medium text-sm"
                                        >
                                            Remove
                                        </button>
                                    </div>
                                    <p class="text-red-600 text-sm sm:text-base">Providing complete and accurate details increases your chances of Application Approval.</p>
                                    
                                    <!-- Row 1: First Name, Last Name, Date of Birth -->
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">First Name<span class="text-red-500">*</span></label>
                                            <input
                                                type="text"
                                                v-model="adult.firstName"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Last Name<span class="text-red-500">*</span></label>
                                            <input
                                                type="text"
                                                v-model="adult.lastName"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Date of Birth<span class="text-red-500">*</span></label>
                                            <div class="relative">
                                                <input
                                                    type="date"
                                                    v-model="adult.dateOfBirth"
                                                    class="w-full p-2 pr-10 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                />
                                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Row 2: Relationship, Phone Number, Email Address -->
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Relationship<span class="text-red-500">*</span></label>
                                            <div class="relative">
                                                <select
                                                    v-model="adult.relationship"
                                                    class="w-full p-2 pr-10 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl appearance-none"
                                                >
                                                    <option value="">Select Relationship</option>
                                                    <option value="Spouse">Spouse</option>
                                                    <option value="Partner">Partner</option>
                                                    <option value="Child">Child</option>
                                                    <option value="Parent">Parent</option>
                                                    <option value="Sibling">Sibling</option>
                                                    <option value="Friend">Friend</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Phone Number<span class="text-red-500">*</span></label>
                                            <input
                                                type="tel"
                                                v-model="adult.phone"
                                                placeholder="(000) 000-0000"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Email Address</label>
                                            <input
                                                type="email"
                                                v-model="adult.email"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Number of Children -->
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-800 font-medium">Number of Children ({{ formData.childOccupants.length }})</span>
                                    <button
                                        type="button"
                                        @click="addChildOccupant"
                                        class="px-4 py-2 bg-black hover:bg-gray-800 text-white rounded-lg font-semibold transition-colors duration-200 shadow-md hover:shadow-lg"
                                    >
                                        Add Child
                                    </button>
                                </div>
                                
                                <!-- Child Occupants List -->
                                <div v-for="(child, index) in formData.childOccupants" :key="index" class="border border-gray-200 rounded-lg p-4 space-y-4 bg-white">
                                    <div class="flex items-center justify-between">
                                        <h4 class="font-semibold text-gray-800">Child {{ index + 1 }}</h4>
                                        <button
                                            type="button"
                                            @click="removeChildOccupant(index)"
                                            class="text-red-600 hover:text-red-800 font-medium text-sm"
                                        >
                                            Remove
                                        </button>
                                    </div>
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">First Name<span class="text-red-500">*</span></label>
                                            <input
                                                type="text"
                                                v-model="child.firstName"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Last Name<span class="text-red-500">*</span></label>
                                            <input
                                                type="text"
                                                v-model="child.lastName"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-gray-800 font-medium">Age<span class="text-red-500">*</span></label>
                                            <input
                                                type="text"
                                                v-model="child.age"
                                                class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                            />
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Pets Section -->
                                <div class="space-y-4">
                                    <div class="flex items-center gap-3">
                                        <label class="flex items-center gap-2 text-gray-800 font-medium">
                                            <input
                                                type="checkbox"
                                                v-model="formData.hasPets"
                                                class="w-4 h-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500"
                                            />
                                            <span>Do you have any pets?</span>
                                        </label>
                                    </div>
                                    
                                    <div v-if="formData.hasPets" class="flex items-center justify-between">
                                        <span class="text-gray-800 font-medium">Number of Pets ({{ formData.pets.length }})</span>
                                        <button
                                            type="button"
                                            @click="addPet"
                                            class="px-4 py-2 bg-black hover:bg-gray-800 text-white rounded-lg font-semibold transition-colors duration-200 shadow-md hover:shadow-lg"
                                        >
                                            Add Pet
                                        </button>
                                    </div>
                                    
                                    <!-- Pets List -->
                                    <div v-if="formData.hasPets" v-for="(pet, index) in formData.pets" :key="index" class="border border-gray-200 rounded-lg p-4 space-y-4 bg-white">
                                        <div class="flex items-center justify-between">
                                            <h4 class="font-semibold text-gray-800">Pet {{ index + 1 }}</h4>
                                            <button
                                                type="button"
                                                @click="removePet(index)"
                                                class="text-red-600 hover:text-red-800 font-medium text-sm"
                                            >
                                                Remove
                                            </button>
                                        </div>
                                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Pet Breed<span class="text-red-500">*</span></label>
                                                <input
                                                    type="text"
                                                    v-model="pet.breed"
                                                    class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                />
                                            </div>
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Pet Types<span class="text-red-500">*</span></label>
                                                <div class="relative">
                                                    <select
                                                        v-model="pet.type"
                                                        class="w-full p-2 pr-10 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl appearance-none"
                                                    >
                                                        <option value="">Select Pet Types</option>
                                                        <option value="Dog">Dog</option>
                                                        <option value="Cat">Cat</option>
                                                        <option value="Bird">Bird</option>
                                                        <option value="Rabbit">Rabbit</option>
                                                        <option value="Hamster">Hamster</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div v-if="pet.type === 'Other'" class="mt-2">
                                                    <label class="block mb-2 text-gray-800 font-medium">Please specify<span class="text-red-500">*</span></label>
                                                    <input
                                                        type="text"
                                                        v-model="pet.otherType"
                                                        class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                        placeholder="Enter pet type"
                                                    />
                                                </div>
                                            </div>
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Weight<span class="text-red-500">*</span></label>
                                                <input
                                                    type="text"
                                                    v-model="pet.weight"
                                                    placeholder="e.g., 25 lbs"
                                                    class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                />
                                            </div>
                                            <div>
                                                <label class="block mb-2 text-gray-800 font-medium">Age<span class="text-red-500">*</span></label>
                                                <input
                                                    type="text"
                                                    v-model="pet.age"
                                                    placeholder="e.g., 2 years"
                                                    class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Step 6: Consent -->
                <div v-if="currentStep === 6" class="p-4 space-y-5 sm:space-y-6 md:space-y-8">
                    <div class="bg-white rounded-lg shadow-lg p-6 sm:p-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Consent</h2>
                        <p class="text-lg text-gray-600 mb-6">Consent Form</p>
                        
                        <div class="space-y-6">
                            <!-- Credit History Section -->
                            <div class="w-1/2">
                                <label class="block mb-2 text-gray-800 font-semibold">Do you have established credit history in Canada?<span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <select
                                        v-model="formData.hasCreditHistory"
                                        class="w-full p-2 pr-10 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl appearance-none"
                                    >
                                        <option value="">Select</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                                
                                <!-- When "No" is selected -->
                                <div v-if="formData.hasCreditHistory === 'no'" class="mt-4 space-y-3">
                                    <p class="text-red-600 text-sm">If Canada is not your country of origin, and you do not have an established credit history, please upload your local credit report.</p>
                                    
                                    <div>
                                        <label class="block mb-2 text-gray-800 font-medium">Upload Credit Report</label>
                                        <div class="flex items-center gap-4">
                                            <input
                                                type="file"
                                                @change="handleCreditReportChange"
                                                accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                                                class="block w-full text-sm text-gray-900 border-2 border-gray-200 rounded-lg cursor-pointer bg-white hover:border-gray-400 focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 file:cursor-pointer"
                                            />
                                            <span v-if="formData.creditReportFileName" class="text-sm text-gray-600">{{ formData.creditReportFileName }}</span>
                                        </div>
                                    </div>
                                    
                                    <p class="text-red-600 text-sm">(If you don't have it handy, you can send it later at secureddocuments@orcarealty.ca)</p>
                                </div>
                            </div>
                            
                            <!-- General Comments Section -->
                            <div class="w-1/2">
                                <label class="block mb-2 text-gray-800 font-semibold">General Comments<span class="text-red-500">*</span></label>
                                <p class="text-red-600 text-sm mb-3">General Comments*
                                    Could you please write down a couple of sentences describing who you are: (Example - we are a family of 4! I'm a practicing attorney at ________ Law firm and my wife is a project manager at _______. Our two kids aged 6 and 9 attend _______ school and we have a 3 year old Border Collie.)
                                    </p>
                                <textarea
                                    v-model="formData.generalComments"
                                    rows="6"
                                    class="w-full p-2 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl resize-y"
                                    placeholder="Please provide general comments about yourself..."
                                ></textarea>
                            </div>
                            
                            <!-- Consent/Authorization Text -->
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <p class="text-sm text-gray-700 leading-relaxed">
                                    I confirm that all information stated on this application is true. I authorize the Landlord / agent to obtain and share with staff / Landlords the information / reports / enquiries to verify your information is true, accurate and complete but limited to credit reporting agencies and any reference or employment checks deemed necessary. I understand the information provided is private and will not be circulated. I understand that the acceptance of this application is not on a first come first serve basis yet based solely on the landlord's approval.
                                </p>
                            </div>
                            
                            <!-- Agreement Checkbox -->
                            <div>
                                <label class="flex items-center gap-3 text-gray-800 font-medium">
                                    <input
                                        type="checkbox"
                                        v-model="formData.consentAgreement"
                                        class="w-5 h-5 text-teal-600 border-gray-300 rounded focus:ring-teal-500"
                                    />
                                    <span>I agree with these terms.<span class="text-red-500">*</span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Step 7: Review -->
                <div v-if="currentStep === 7" class="p-4 space-y-4">
                    <div class="border border-gray-100 rounded-2xl bg-gray-50 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between p-4 bg-white border-b border-gray-200 rounded-t-2xl">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm3 1h6v4H7V5zm6 6H7v2h6v-2z" clip-rule="evenodd" />
                                </svg>
                                <h3 class="text-lg font-semibold text-black">Review</h3>
                            </div>
                        </div>
                        <div class="space-y-4 p-2 lg:p-4">
                            <!-- Property Information Section -->
                            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm">
                                <div 
                                    class="flex items-center justify-between p-4 cursor-pointer hover:bg-gray-50 transition-colors border-b border-gray-200"
                                    @click="isReviewPropertyOpen = !isReviewPropertyOpen"
                                >
                                    <div class="flex items-center gap-3">
                                        <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                        </svg>
                                        <h4 class="text-lg font-semibold text-gray-900">Property Information</h4>
                                    </div>
                                    <svg
                                        :class="`w-5 h-5 transform transition-transform duration-200 text-gray-400 ${isReviewPropertyOpen ? 'rotate-180' : ''}`"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <div v-if="isReviewPropertyOpen" class="p-5">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Property ID</label>
                                            <div class="text-gray-900 font-medium">{{ formData.propertyId || 'N/A' }}</div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Property Address</label>
                                            <div class="text-gray-900 font-medium">{{ formData.propertyAddress || 'N/A' }}</div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Have Visited Property</label>
                                            <div class="text-gray-900 font-medium">{{ formData.hasVisitedProperty === true ? 'Yes' : formData.hasVisitedProperty === false ? 'No' : 'N/A' }}</div>
                                        </div>
                                        <div v-if="formData.propertyViewDate">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Property View Date</label>
                                            <div class="text-gray-900 font-medium">{{ formData.propertyViewDate || 'N/A' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Point of Contact Section -->
                            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm">
                                <div 
                                    class="flex items-center justify-between p-4 cursor-pointer hover:bg-gray-50 transition-colors border-b border-gray-200"
                                    @click="isReviewPointOfContactOpen = !isReviewPointOfContactOpen"
                                >
                                    <div class="flex items-center gap-3">
                                        <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                        </svg>
                                        <h4 class="text-lg font-semibold text-gray-900">Point of Contact</h4>
                                    </div>
                                    <svg
                                        :class="`w-5 h-5 transform transition-transform duration-200 text-gray-400 ${isReviewPointOfContactOpen ? 'rotate-180' : ''}`"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <div v-if="isReviewPointOfContactOpen" class="p-5">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Point of Contact</label>
                                            <div class="text-gray-900 font-medium">{{ formData.pointOfContact || 'N/A' }}</div>
                                        </div>
                                        <div v-if="formData.pointOfContactFirstName">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                            <div class="text-gray-900 font-medium">{{ formData.pointOfContactFirstName || 'N/A' }}</div>
                                        </div>
                                        <div v-if="formData.pointOfContactEmail">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                            <div class="text-gray-900 font-medium">{{ formData.pointOfContactEmail || 'N/A' }}</div>
                                        </div>
                                        <div v-if="formData.pointOfContactPhone">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                            <div class="text-gray-900 font-medium">{{ formData.pointOfContactPhone || 'N/A' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Emergency Contact Section -->
                            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm">
                                <div 
                                    class="flex items-center justify-between p-4 cursor-pointer hover:bg-gray-50 transition-colors border-b border-gray-200"
                                    @click="isReviewEmergencyContactOpen = !isReviewEmergencyContactOpen"
                                >
                                    <div class="flex items-center gap-3">
                                        <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                        </svg>
                                        <h4 class="text-lg font-semibold text-gray-900">Emergency Contact</h4>
                                    </div>
                                    <svg
                                        :class="`w-5 h-5 transform transition-transform duration-200 text-gray-400 ${isReviewEmergencyContactOpen ? 'rotate-180' : ''}`"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <div v-if="isReviewEmergencyContactOpen" class="p-5">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                            <div class="text-gray-900 font-medium">{{ formData.emergencyContactFirstName || 'N/A' }}</div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                            <div class="text-gray-900 font-medium">{{ formData.emergencyContactLastName || 'N/A' }}</div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                            <div class="text-gray-900 font-medium">{{ formData.emergencyContactPhone || 'N/A' }}</div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                            <div class="text-gray-900 font-medium">{{ formData.emergencyContactEmail || 'N/A' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Co-Applicants Section -->
                            <div v-if="formData.coApplicants && formData.coApplicants.length > 0" class="bg-white rounded-2xl border border-gray-100 shadow-sm">
                                <div 
                                    class="flex items-center justify-between p-4 cursor-pointer hover:bg-gray-50 transition-colors border-b border-gray-200"
                                    @click="isReviewCoApplicantsOpen = !isReviewCoApplicantsOpen"
                                >
                                    <div class="flex items-center gap-3">
                                        <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                        </svg>
                                        <h4 class="text-lg font-semibold text-gray-900">Co-Applicants ({{ formData.coApplicants.length }})</h4>
                                    </div>
                                    <svg
                                        :class="`w-5 h-5 transform transition-transform duration-200 text-gray-400 ${isReviewCoApplicantsOpen ? 'rotate-180' : ''}`"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <div v-if="isReviewCoApplicantsOpen" class="p-5 space-y-4">
                                    <div v-for="(coApplicant, index) in formData.coApplicants" :key="index" class="border border-gray-200 rounded-lg p-4">
                                        <h5 class="font-semibold text-gray-900 mb-3">Co-Applicant {{ index + 1 }}</h5>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                                <div class="text-gray-900 font-medium">{{ coApplicant.firstName || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                                <div class="text-gray-900 font-medium">{{ coApplicant.lastName || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                                <div class="text-gray-900 font-medium">{{ coApplicant.email || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                                <div class="text-gray-900 font-medium">{{ coApplicant.phone || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                                                <div class="text-gray-900 font-medium">{{ coApplicant.dateOfBirth || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Street Address</label>
                                                <div class="text-gray-900 font-medium">{{ coApplicant.streetAddress || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                                <div class="text-gray-900 font-medium">{{ coApplicant.city || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Province</label>
                                                <div class="text-gray-900 font-medium">{{ coApplicant.province || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                                                <div class="text-gray-900 font-medium">{{ coApplicant.postalCode || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Date Started Living</label>
                                                <div class="text-gray-900 font-medium">{{ coApplicant.dateStartedLiving || 'N/A' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Main Applicant Section -->
                            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm">
                                <div 
                                    class="flex items-center justify-between p-4 cursor-pointer hover:bg-gray-50 transition-colors border-b border-gray-200"
                                    @click="isReviewMainApplicantOpen = !isReviewMainApplicantOpen"
                                >
                                    <div class="flex items-center gap-3">
                                        <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                        </svg>
                                        <h4 class="text-lg font-semibold text-gray-900">Main Applicant</h4>
                                    </div>
                                    <svg
                                        :class="`w-5 h-5 transform transition-transform duration-200 text-gray-400 ${isReviewMainApplicantOpen ? 'rotate-180' : ''}`"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <div v-if="isReviewMainApplicantOpen" class="p-5">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                            <div class="text-gray-900 font-medium">{{ formData.mainApplicantFirstName || 'N/A' }}</div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                            <div class="text-gray-900 font-medium">{{ formData.mainApplicantLastName || 'N/A' }}</div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                            <div class="text-gray-900 font-medium">{{ formData.mainApplicantEmail || 'N/A' }}</div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                            <div class="text-gray-900 font-medium">{{ formData.mainApplicantPhone || 'N/A' }}</div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                                            <div class="text-gray-900 font-medium">{{ formData.mainApplicantDateOfBirth || 'N/A' }}</div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Street Address</label>
                                            <div class="text-gray-900 font-medium">{{ formData.mainApplicantStreetAddress || 'N/A' }}</div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                            <div class="text-gray-900 font-medium">{{ formData.mainApplicantCity || 'N/A' }}</div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Province</label>
                                            <div class="text-gray-900 font-medium">{{ formData.mainApplicantProvince || 'N/A' }}</div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                                            <div class="text-gray-900 font-medium">{{ formData.mainApplicantPostalCode || 'N/A' }}</div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Date Started Living</label>
                                            <div class="text-gray-900 font-medium">{{ formData.mainApplicantDateStartedLiving || 'N/A' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Employment Section -->
                            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm">
                                <div 
                                    class="flex items-center justify-between p-4 cursor-pointer hover:bg-gray-50 transition-colors border-b border-gray-200"
                                    @click="isReviewEmploymentOpen = !isReviewEmploymentOpen"
                                >
                                    <div class="flex items-center gap-3">
                                        <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                                            <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                                        </svg>
                                        <h4 class="text-lg font-semibold text-gray-900">Employment</h4>
                                    </div>
                                    <svg
                                        :class="`w-5 h-5 transform transition-transform duration-200 text-gray-400 ${isReviewEmploymentOpen ? 'rotate-180' : ''}`"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <div v-if="isReviewEmploymentOpen" class="p-5">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Employment Status</label>
                                            <div class="text-gray-900 font-medium">{{ formData.employmentStatus || 'N/A' }}</div>
                                        </div>
                                        
                                        <!-- Not Applicable -->
                                        <template v-if="formData.employmentStatus === 'not-applicable'">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Reason</label>
                                                <div class="text-gray-900 font-medium">{{ formData.employmentNotApplicableReason || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Linked In URL</label>
                                                <div class="text-gray-900 font-medium">{{ formData.linkedInUrls || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Previous Job Profile/Company URL</label>
                                                <div class="text-gray-900 font-medium">{{ formData.previousJobProfileUrl || 'N/A' }}</div>
                                            </div>
                                        </template>
                                        
                                        <!-- Self-Employed -->
                                        <template v-if="formData.employmentStatus === 'self-employed'">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Business Name</label>
                                                <div class="text-gray-900 font-medium">{{ formData.businessName || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Business Linked In URL</label>
                                                <div class="text-gray-900 font-medium">{{ formData.businessLinkedInUrl || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Business Information</label>
                                                <div class="text-gray-900 font-medium">{{ formData.businessInformation || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Proof of Company Ownership & Current Tax Return</label>
                                                <div class="text-gray-900 font-medium">{{ formData.businessProofFileName || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Number of Years in Business</label>
                                                <div class="text-gray-900 font-medium">{{ formData.yearsInBusiness || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Business Profile/Business URL</label>
                                                <div class="text-gray-900 font-medium">{{ formData.businessProfileUrl || 'N/A' }}</div>
                                            </div>
                                        </template>
                                        
                                        <!-- Employed -->
                                        <template v-if="formData.employmentStatus === 'employed'">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Company/Organization</label>
                                                <div class="text-gray-900 font-medium">{{ formData.companyOrganization || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Linked In URLs</label>
                                                <div class="text-gray-900 font-medium">{{ formData.linkedInUrls || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Salary</label>
                                                <div class="text-gray-900 font-medium">{{ formData.salary || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Job Title</label>
                                                <div class="text-gray-900 font-medium">{{ formData.jobTitle || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Job Profile/Company URL</label>
                                                <div class="text-gray-900 font-medium">{{ formData.jobProfileUrl || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                                                <div class="text-gray-900 font-medium">{{ formData.jobStartDate || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Company Reference - First Name</label>
                                                <div class="text-gray-900 font-medium">{{ formData.companyReferenceFirstName || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Company Reference - Last Name</label>
                                                <div class="text-gray-900 font-medium">{{ formData.companyReferenceLastName || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Company Reference - Position</label>
                                                <div class="text-gray-900 font-medium">{{ formData.companyReferencePosition || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Company Reference - Email</label>
                                                <div class="text-gray-900 font-medium">{{ formData.companyReferenceEmail || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Company Reference - Phone</label>
                                                <div class="text-gray-900 font-medium">{{ formData.companyReferencePhone || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Current Pay stub</label>
                                                <div class="text-gray-900 font-medium">{{ formData.payStubFileName || 'N/A' }}</div>
                                            </div>
                                        </template>
                                        
                                        <div v-if="formData.hasOtherIncome">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Do you have other sources of income?</label>
                                            <div class="text-gray-900 font-medium">{{ formData.hasOtherIncome || 'N/A' }}</div>
                                        </div>
                                        <div v-if="formData.hasOtherIncome === 'yes' && formData.otherIncomeDetails">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Other Income Details</label>
                                            <div class="text-gray-900 font-medium">{{ formData.otherIncomeDetails || 'N/A' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- References Section -->
                            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm">
                                <div 
                                    class="flex items-center justify-between p-4 cursor-pointer hover:bg-gray-50 transition-colors border-b border-gray-200"
                                    @click="isReviewReferencesOpen = !isReviewReferencesOpen"
                                >
                                    <div class="flex items-center gap-3">
                                        <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                        </svg>
                                        <h4 class="text-lg font-semibold text-gray-900">References</h4>
                                    </div>
                                    <svg
                                        :class="`w-5 h-5 transform transition-transform duration-200 text-gray-400 ${isReviewReferencesOpen ? 'rotate-180' : ''}`"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <div v-if="isReviewReferencesOpen" class="p-5 space-y-4">
                                    <!-- Current Residence -->
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <h5 class="font-semibold text-gray-900 mb-3">Current Residence</h5>
                                        <div v-if="formData.currentResidenceNotApplicable" class="space-y-2">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Not Applicable Reason</label>
                                                <div class="text-gray-900 font-medium">{{ formData.currentResidenceNotApplicableReason || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Reason for moving</label>
                                                <div class="text-gray-900 font-medium">{{ formData.currentResidenceReasonForMoving || 'N/A' }}</div>
                                            </div>
                                        </div>
                                        <div v-else class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">From Date</label>
                                                <div class="text-gray-900 font-medium">{{ formData.currentResidenceFromDate || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">To Date</label>
                                                <div class="text-gray-900 font-medium">{{ formData.currentResidenceToDate || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Landlord First Name</label>
                                                <div class="text-gray-900 font-medium">{{ formData.currentResidenceFirstName || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Landlord Last Name</label>
                                                <div class="text-gray-900 font-medium">{{ formData.currentResidenceLastName || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Unit Address</label>
                                                <div class="text-gray-900 font-medium">{{ formData.currentResidenceUnitAddress || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Street Address</label>
                                                <div class="text-gray-900 font-medium">{{ formData.currentResidenceStreetAddress || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                                <div class="text-gray-900 font-medium">{{ formData.currentResidenceCity || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Province</label>
                                                <div class="text-gray-900 font-medium">{{ formData.currentResidenceProvince || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                                                <div class="text-gray-900 font-medium">{{ formData.currentResidencePostalCode || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                                <div class="text-gray-900 font-medium">{{ formData.currentResidencePhone || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                                <div class="text-gray-900 font-medium">{{ formData.currentResidenceEmail || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Reason for moving</label>
                                                <div class="text-gray-900 font-medium">{{ formData.currentResidenceReasonForMoving || 'N/A' }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Previous Residence -->
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <h5 class="font-semibold text-gray-900 mb-3">Previous Residence</h5>
                                        <div v-if="formData.previousResidenceNotApplicable" class="space-y-2">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Not Applicable Reason</label>
                                                <div class="text-gray-900 font-medium">{{ formData.previousResidenceNotApplicableReason || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Reason for moving</label>
                                                <div class="text-gray-900 font-medium">{{ formData.previousResidenceReasonForMoving || 'N/A' }}</div>
                                            </div>
                                        </div>
                                        <div v-else class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">From Date</label>
                                                <div class="text-gray-900 font-medium">{{ formData.previousResidenceFromDate || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">To Date</label>
                                                <div class="text-gray-900 font-medium">{{ formData.previousResidenceToDate || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Landlord First Name</label>
                                                <div class="text-gray-900 font-medium">{{ formData.previousResidenceFirstName || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Landlord Last Name</label>
                                                <div class="text-gray-900 font-medium">{{ formData.previousResidenceLastName || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Unit Address</label>
                                                <div class="text-gray-900 font-medium">{{ formData.previousResidenceUnitAddress || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Street Address</label>
                                                <div class="text-gray-900 font-medium">{{ formData.previousResidenceStreetAddress || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                                <div class="text-gray-900 font-medium">{{ formData.previousResidenceCity || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Province</label>
                                                <div class="text-gray-900 font-medium">{{ formData.previousResidenceProvince || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                                                <div class="text-gray-900 font-medium">{{ formData.previousResidencePostalCode || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                                <div class="text-gray-900 font-medium">{{ formData.previousResidencePhone || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                                <div class="text-gray-900 font-medium">{{ formData.previousResidenceEmail || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Reason for moving</label>
                                                <div class="text-gray-900 font-medium">{{ formData.previousResidenceReasonForMoving || 'N/A' }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Guarantor -->
                                    <div v-if="formData.hasGuarantor === 'yes'" class="border border-gray-200 rounded-lg p-4">
                                        <h5 class="font-semibold text-gray-900 mb-3">Guarantor</h5>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                                <div class="text-gray-900 font-medium">{{ formData.guarantorName || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                                <div class="text-gray-900 font-medium">{{ formData.guarantorEmail || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Street Address</label>
                                                <div class="text-gray-900 font-medium">{{ formData.guarantorStreetAddress || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                                <div class="text-gray-900 font-medium">{{ formData.guarantorCity || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Province</label>
                                                <div class="text-gray-900 font-medium">{{ formData.guarantorProvince || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                                                <div class="text-gray-900 font-medium">{{ formData.guarantorPostalCode || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                                <div class="text-gray-900 font-medium">{{ formData.guarantorPhone || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                                                <div class="text-gray-900 font-medium">{{ formData.guarantorDateOfBirth || 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                                <div class="text-gray-900 font-medium">{{ formData.guarantorCountry || 'N/A' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Other Occupants Section -->
                            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm">
                                <div 
                                    class="flex items-center justify-between p-4 cursor-pointer hover:bg-gray-50 transition-colors border-b border-gray-200"
                                    @click="isReviewOtherOccupantsOpen = !isReviewOtherOccupantsOpen"
                                >
                                    <div class="flex items-center gap-3">
                                        <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                        </svg>
                                        <h4 class="text-lg font-semibold text-gray-900">Other Occupants</h4>
                                    </div>
                                    <svg
                                        :class="`w-5 h-5 transform transition-transform duration-200 text-gray-400 ${isReviewOtherOccupantsOpen ? 'rotate-180' : ''}`"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <div v-if="isReviewOtherOccupantsOpen" class="p-5 space-y-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Preferred Date of Occupancy</label>
                                            <div class="text-gray-900 font-medium">{{ formData.preferredDateOfOccupancy || 'N/A' }}</div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Any of the occupants smoke?</label>
                                            <div class="text-gray-900 font-medium">{{ formData.occupantsSmoke || 'N/A' }}</div>
                                        </div>
                                    </div>

                                    <!-- Adult Occupants -->
                                    <div v-if="formData.adultOccupants && formData.adultOccupants.length > 0">
                                        <h5 class="font-semibold text-gray-900 mb-3">Adult Occupants ({{ formData.adultOccupants.length }})</h5>
                                        <div class="space-y-3">
                                            <div v-for="(adult, index) in formData.adultOccupants" :key="index" class="border border-gray-200 rounded-lg p-4">
                                                <h6 class="font-medium text-gray-900 mb-2">Adult {{ index + 1 }}</h6>
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-1">Relationship</label>
                                                        <div class="text-gray-900 font-medium">{{ adult.relationship || 'N/A' }}</div>
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                                        <div class="text-gray-900 font-medium">{{ adult.firstName || 'N/A' }}</div>
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                                        <div class="text-gray-900 font-medium">{{ adult.lastName || 'N/A' }}</div>
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                                        <div class="text-gray-900 font-medium">{{ adult.phone || 'N/A' }}</div>
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                                                        <div class="text-gray-900 font-medium">{{ adult.dateOfBirth || 'N/A' }}</div>
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                                        <div class="text-gray-900 font-medium">{{ adult.email || 'N/A' }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Child Occupants -->
                                    <div v-if="formData.childOccupants && formData.childOccupants.length > 0">
                                        <h5 class="font-semibold text-gray-900 mb-3">Child Occupants ({{ formData.childOccupants.length }})</h5>
                                        <div class="space-y-3">
                                            <div v-for="(child, index) in formData.childOccupants" :key="index" class="border border-gray-200 rounded-lg p-4">
                                                <h6 class="font-medium text-gray-900 mb-2">Child {{ index + 1 }}</h6>
                                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                                        <div class="text-gray-900 font-medium">{{ child.firstName || 'N/A' }}</div>
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                                        <div class="text-gray-900 font-medium">{{ child.lastName || 'N/A' }}</div>
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-1">Age</label>
                                                        <div class="text-gray-900 font-medium">{{ child.age || 'N/A' }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pets -->
                                    <div v-if="formData.hasPets && formData.pets && formData.pets.length > 0">
                                        <h5 class="font-semibold text-gray-900 mb-3">Pets ({{ formData.pets.length }})</h5>
                                        <div class="space-y-3">
                                            <div v-for="(pet, index) in formData.pets" :key="index" class="border border-gray-200 rounded-lg p-4">
                                                <h6 class="font-medium text-gray-900 mb-2">Pet {{ index + 1 }}</h6>
                                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-1">Pet Breed</label>
                                                        <div class="text-gray-900 font-medium">{{ pet.breed || 'N/A' }}</div>
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-1">Pet Types</label>
                                                        <div class="text-gray-900 font-medium">{{ pet.type === 'Other' ? pet.otherType : pet.type || 'N/A' }}</div>
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-1">Weight</label>
                                                        <div class="text-gray-900 font-medium">{{ pet.weight || 'N/A' }}</div>
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-1">Age</label>
                                                        <div class="text-gray-900 font-medium">{{ pet.age || 'N/A' }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Consent Section -->
                            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm">
                                <div 
                                    class="flex items-center justify-between p-4 cursor-pointer hover:bg-gray-50 transition-colors border-b border-gray-200"
                                    @click="isReviewConsentOpen = !isReviewConsentOpen"
                                >
                                    <div class="flex items-center gap-3">
                                        <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        <h4 class="text-lg font-semibold text-gray-900">Consent</h4>
                                    </div>
                                    <svg
                                        :class="`w-5 h-5 transform transition-transform duration-200 text-gray-400 ${isReviewConsentOpen ? 'rotate-180' : ''}`"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <div v-if="isReviewConsentOpen" class="p-5">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Do you have established credit history in Canada?</label>
                                            <div class="text-gray-900 font-medium">{{ formData.hasCreditHistory || 'N/A' }}</div>
                                        </div>
                                        <div v-if="formData.hasCreditHistory === 'no' && formData.creditReportFileName">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Credit Report File</label>
                                            <div class="text-gray-900 font-medium">{{ formData.creditReportFileName || 'N/A' }}</div>
                                        </div>
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">General Comments</label>
                                            <div class="text-gray-900 font-medium whitespace-pre-wrap">{{ formData.generalComments || 'N/A' }}</div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">I agree with these terms</label>
                                            <div class="text-gray-900 font-medium">{{ formData.consentAgreement ? 'Yes' : 'No' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Submission Instructions Section -->
                    <div class="bg-white rounded-lg shadow-lg p-6 sm:p-8 space-y-4 mt-4 text-center">
                        <h3 class="text-lg font-bold text-gray-800">Before Submitting your application, please review your entries carefully.</h3>
                        <p class="text-gray-700">Please send your application by clicking the "Submit Application Form" button below.</p>
                        <p class="text-gray-700">On the following page, you will be asked to verify your I.D.</p>
                        
                        <div class="flex justify-center pt-4">
                            <button
                                type="button"
                                @click="handleSubmitApplication"
                                :disabled="!formData.consentAgreement"
                                :class="[
                                    'px-6 py-3 sm:px-8 sm:py-3.5 rounded-xl font-semibold flex items-center gap-2 transition-colors duration-200 shadow-lg hover:shadow-xl',
                                    formData.consentAgreement
                                        ? 'cursor-pointer bg-teal-700 hover:bg-teal-800 text-white'
                                        : 'cursor-not-allowed bg-gray-300 text-gray-500'
                                ]"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Submit Application Form
                            </button>
                        </div>
                </div>
            </div>
        </div>
        
        <!-- Navigation Buttons -->
            <div v-if="currentStep === 1" class="flex-shrink-0 mt-3 sm:mt-6 pt-4 sm:pt-6 border-t border-gray-200 bg-white flex flex-col sm:flex-row justify-end gap-3 sm:gap-4">
                <button
                    @click="handleNext"
                    :disabled="!acknowledgementChecked"
                    :class="[
                        'p-4 cursor-pointer px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl font-semibold flex items-center gap-2 transition-colors duration-200 shadow-lg hover:shadow-xl',
                        acknowledgementChecked 
                            ? 'bg-black hover:bg-gray-800 text-white' 
                            : 'bg-gray-300 text-gray-500 cursor-not-allowed'
                    ]"
                >
                    APPLICANT DETAILS
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
            
            <!-- Navigation for Step 2 -->
            <div v-if="currentStep === 2" class="flex-shrink-0  r-pt-3 sm:mt-6 pt-4 sm:pt-6 border-t border-gray-200 bg-white flex flex-col sm:flex-row justify-between gap-3 sm:gap-4">
                <button
                    @click="handleBack"
                    class="r-p-3 cursor-pointer bg-white text-black border border-gray-300 hover:bg-gray-50 px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl font-semibold flex items-center gap-2 transition-colors duration-200 shadow-sm hover:shadow-md"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    ACKNOWLEDGEMENT
                </button>
                <button
                    @click="handleNext"
                    class="r-p-3 cursor-pointer bg-black hover:bg-gray-800 text-white px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl font-semibold flex items-center gap-2 transition-colors duration-200 shadow-lg hover:shadow-xl"
                >
                    EMPLOYMENT
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
            
            <!-- Navigation for Step 3 -->
            <div v-if="currentStep === 3" class="flex-shrink-0  r-pt-3 sm:mt-6 pt-4 sm:pt-6 border-t border-gray-200 bg-white flex flex-col sm:flex-row justify-between gap-3 sm:gap-4">
                <button
                    @click="handleBack"
                    class="r-p-3 cursor-pointer bg-black hover:bg-gray-800 text-white px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl font-semibold flex items-center gap-2 transition-colors duration-200 shadow-lg hover:shadow-xl"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    APPLICANT DETAILS
                </button>
                <button
                    @click="handleNext"
                    class="r-p-3 cursor-pointer bg-black hover:bg-gray-800 text-white px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl font-semibold flex items-center gap-2 transition-colors duration-200 shadow-lg hover:shadow-xl"
                >
                    REFERENCES
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
            
            <!-- Navigation for Step 4 -->
            <div v-if="currentStep === 4" class="flex-shrink-0  r-pt-3 sm:mt-6 pt-4 sm:pt-6 border-t border-gray-200 bg-white flex flex-col sm:flex-row justify-between gap-3 sm:gap-4">
                <button
                    @click="handleBack"
                    class="r-p-3 cursor-pointer bg-black hover:bg-gray-800 text-white px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl font-semibold flex items-center gap-2 transition-colors duration-200 shadow-lg hover:shadow-xl"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    EMPLOYMENT
                </button>
                <button
                    @click="handleNext"
                    class="r-p-3 cursor-pointer bg-black hover:bg-gray-800 text-white px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl font-semibold flex items-center gap-2 transition-colors duration-200 shadow-lg hover:shadow-xl"
                >
                    OTHER OCCUPANTS
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
            
            <!-- Navigation for Step 5 -->
            <div v-if="currentStep === 5" class="flex-shrink-0  r-pt-3 sm:mt-6 pt-4 sm:pt-6 border-t border-gray-200 bg-white flex flex-col sm:flex-row justify-between gap-3 sm:gap-4">
                <button
                    @click="handleBack"
                    class="r-p-3 cursor-pointer bg-black hover:bg-gray-800 text-white px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl font-semibold flex items-center gap-2 transition-colors duration-200 shadow-lg hover:shadow-xl"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    REFERENCES
                </button>
                <button
                    @click="handleNext"
                    class="r-p-3 cursor-pointer bg-black hover:bg-gray-800 text-white px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl font-semibold flex items-center gap-2 transition-colors duration-200 shadow-lg hover:shadow-xl"
                >
                    CONSENT
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
            
            <!-- Navigation for Step 6 -->
            <div v-if="currentStep === 6" class="flex-shrink-0  r-pt-3 sm:mt-6 pt-4 sm:pt-6 border-t border-gray-200 bg-white flex flex-col sm:flex-row justify-between gap-3 sm:gap-4">
                <button
                    @click="handleBack"
                    class="r-p-3 cursor-pointer bg-black hover:bg-gray-800 text-white px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl font-semibold flex items-center gap-2 transition-colors duration-200 shadow-lg hover:shadow-xl"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    OTHER OCCUPANTS
                </button>
                <button
                    @click="handleNext"
                    :disabled="!formData.consentAgreement"
                    :class="[
                        'r-p-3 px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl font-semibold flex items-center gap-2 transition-colors duration-200 shadow-lg hover:shadow-xl',
                        formData.consentAgreement
                            ? 'cursor-pointer bg-black hover:bg-gray-800 text-white'
                            : 'cursor-not-allowed bg-gray-300 text-gray-500'
                    ]"
                >
                    REVIEW
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
            
            <!-- Navigation for other steps -->
            <div v-if="currentStep > 6 && currentStep < steps.length" class="flex-shrink-0  r-pt-3 sm:mt-6 pt-4 sm:pt-6 border-t border-gray-200 bg-white flex flex-col sm:flex-row justify-between gap-3 sm:gap-4">
                <button
                    @click="handleBack"
                    class="r-p-3 cursor-pointer bg-white text-black border border-gray-300 hover:bg-gray-50 px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl font-semibold flex items-center gap-2 transition-colors duration-200 shadow-sm hover:shadow-md"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back
                </button>
                <button
                    @click="handleNext"
                    class="r-p-3 cursor-pointer bg-black hover:bg-gray-800 text-white px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl font-semibold flex items-center gap-2 transition-colors duration-200 shadow-lg hover:shadow-xl"
                >
                    Next
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive } from 'vue';
import confetti from 'canvas-confetti';
import StepIndicator from '@/components/advertising/StepIndicator.vue';

const currentStep = ref(1);
const isSubmitted = ref(false);
const acknowledgementChecked = ref(false);
const isPropertyInfoOpen = ref(true);
const isMainApplicantOpen = ref(true);
const isPointOfContactOpen = ref(true);
const isEmergencyContactOpen = ref(true);
const isEmploymentOpen = ref(true);
const isCurrentResidenceOpen = ref(true);
const isPreviousResidenceOpen = ref(true);
const isGuarantorOpen = ref(true);
const isOtherOccupantsOpen = ref(true);
// Review Section Collapsible States
const isReviewPropertyOpen = ref(true);
const isReviewPointOfContactOpen = ref(true);
const isReviewEmergencyContactOpen = ref(true);
const isReviewCoApplicantsOpen = ref(true);
const isReviewMainApplicantOpen = ref(true);
const isReviewEmploymentOpen = ref(true);
const isReviewReferencesOpen = ref(true);
const isReviewOtherOccupantsOpen = ref(true);
const isReviewConsentOpen = ref(true);

const formData = reactive({
    propertyId: '12036',
    propertyAddress: '612036 66 Avenue Surrey',
    hasVisitedProperty: null,
    propertyViewDate: '',
    pointOfContact: '',
    pointOfContactFirstName: '',
    pointOfContactEmail: '',
    pointOfContactPhone: '',
    emergencyContactFirstName: '',
    emergencyContactLastName: '',
    emergencyContactPhone: '',
    emergencyContactEmail: '',
    coApplicants: [],
    // Main Applicant Data
    mainApplicantFirstName: '',
    mainApplicantLastName: '',
    mainApplicantEmail: '',
    mainApplicantPhone: '',
    mainApplicantDateOfBirth: '',
    mainApplicantStreetAddress: '',
    mainApplicantCity: '',
    mainApplicantProvince: '',
    mainApplicantPostalCode: '',
    mainApplicantDateStartedLiving: '',
    // Employment Data
    employmentStatus: '',
    employmentNotApplicableReason: '',
    companyOrganization: '',
    linkedInUrls: '',
    previousJobProfileUrl: '',
    salary: 0,
    jobTitle: '',
    jobProfileUrl: '',
    jobStartDate: '',
    companyReferenceFirstName: '',
    companyReferenceLastName: '',
    companyReferencePosition: '',
    companyReferenceEmail: '',
    companyReferencePhone: '',
    hasOtherIncome: '',
    otherIncomeDetails: '',
    payStubFileName: '',
    // Self-Employed Data
    businessName: '',
    businessLinkedInUrl: '',
    businessInformation: '',
    businessProofFileName: '',
    yearsInBusiness: 0,
    businessProfileUrl: '',
    // References Data - Current Residence
    currentResidenceNotApplicable: false,
    currentResidenceNotApplicableReason: '',
    currentResidenceFromDate: '',
    currentResidenceToDate: '',
    currentResidenceFirstName: '',
    currentResidenceLastName: '',
    currentResidenceUnitAddress: '',
    currentResidenceStreetAddress: '',
    currentResidenceCity: '',
    currentResidenceProvince: '',
    currentResidencePostalCode: '',
    currentResidencePhone: '',
    currentResidenceEmail: '',
    currentResidenceReasonForMoving: '',
    // References Data - Previous Residence
    previousResidenceNotApplicable: false,
    previousResidenceNotApplicableReason: '',
    previousResidenceFromDate: '',
    previousResidenceToDate: '',
    previousResidenceFirstName: '',
    previousResidenceLastName: '',
    previousResidenceUnitAddress: '',
    previousResidenceStreetAddress: '',
    previousResidenceCity: '',
    previousResidenceProvince: '',
    previousResidencePostalCode: '',
    previousResidencePhone: '',
    previousResidenceEmail: '',
    previousResidenceReasonForMoving: '',
    // Guarantor Data
    hasGuarantor: '',
    guarantorName: '',
    guarantorEmail: '',
    guarantorStreetAddress: '',
    guarantorProvince: '',
    guarantorPostalCode: '',
    guarantorPhone: '',
    guarantorDateOfBirth: '',
    guarantorCity: '',
    guarantorCountry: '',
    // Other Occupants Data
    preferredDateOfOccupancy: '',
    occupantsSmoke: '',
    adultOccupants: [],
    childOccupants: [],
    hasPets: false,
    pets: [],
    // Consent Data
    hasCreditHistory: '',
    creditReportFileName: '',
    generalComments: '',
    consentAgreement: false,
});

const addCoApplicant = () => {
    formData.coApplicants.push({
        isOpen: true,
        firstName: '',
        lastName: '',
        email: '',
        phone: '',
        dateOfBirth: '',
        streetAddress: '',
        city: '',
        province: '',
        postalCode: '',
        dateStartedLiving: '',
    });
};

const removeCoApplicant = (index) => {
    formData.coApplicants.splice(index, 1);
};

const addAdultOccupant = () => {
    formData.adultOccupants.push({
        relationship: '',
        firstName: '',
        lastName: '',
        phone: '',
        dateOfBirth: '',
        email: '',
    });
};

const removeAdultOccupant = (index) => {
    formData.adultOccupants.splice(index, 1);
};

const addChildOccupant = () => {
    formData.childOccupants.push({
        firstName: '',
        lastName: '',
        age: '',
    });
};

const removeChildOccupant = (index) => {
    formData.childOccupants.splice(index, 1);
};

const addPet = () => {
    formData.pets.push({
        type: '',
        breed: '',
        weight: '',
        age: '',
        otherType: '',
    });
};

const removePet = (index) => {
    formData.pets.splice(index, 1);
};

const handlePayStubChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        formData.payStubFileName = file.name;
    }
};

const handleBusinessProofChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        formData.businessProofFileName = file.name;
    }
};

const handleCreditReportChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        formData.creditReportFileName = file.name;
    }
};

const steps = [
    { number: 1, title: 'ACKNOWLEDGEMENT' },
    { number: 2, title: 'APPLICANT DETAILS' },
    { number: 3, title: 'EMPLOYMENT' },
    { number: 4, title: 'REFERENCES' },
    { number: 5, title: 'OTHER OCCUPANTS' },
    { number: 6, title: 'CONSENT' },
    { number: 7, title: 'REVIEW' },
];

const handleNext = () => {
    if (currentStep.value < steps.length) {
        currentStep.value++;
    }
};

const handleBack = () => {
    if (isSubmitted.value) {
        // If on success screen, go back to Review step
        isSubmitted.value = false;
        currentStep.value = 7;
    } else if (currentStep.value > 1) {
        currentStep.value--;
    }
};

const handleSubmitApplication = () => {
    if (formData.consentAgreement) {
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
        
        // TODO: Submit application form - API call here
        // Set submitted state to show success screen
        isSubmitted.value = true;
    }
};
</script>

