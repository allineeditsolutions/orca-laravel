<template>
    <div class="space-y-6">
        <!-- Success Message -->
        <div v-if="isSubmitted" class="space-y-6">
            <!-- Submission Success Section -->
            <div class="border border-gray-100 rounded-2xl bg-white shadow-sm hover:shadow-md transition-shadow duration-300">
                <div class="p-6 sm:p-8 md:p-10">
                    <div class="flex items-center gap-3 mb-4">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 md:w-8 md:h-8 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                        </svg>
                        <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-green-600">
                            Your Rental Property Detail has been successfully submitted.
                        </h2>
                    </div>
                    <p class="text-sm sm:text-base md:text-lg text-gray-900 leading-relaxed">
                        Please check your email inbox to confirm that your property detail has been submitted properly. Should you encounter any issues or require further assistance, please do not hesitate to contact us. Thank you for choosing Orca Realty.
                    </p>
                </div>
            </div>

            <!-- ID Verification Section -->
            <div class="border border-gray-100 rounded-2xl bg-white shadow-sm hover:shadow-md transition-shadow duration-300">
                <div class="p-6 sm:p-8 md:p-10">
                    <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-900 mb-4">
                        ID Verification for Owner
                    </h3>
                    <p class="text-sm sm:text-base md:text-lg text-red-500 mb-2">
                        Please submit your ID verification below. Only takes 1-2 minutes if you have a smart phone and photo ID - Press the button below and it will sync with your smartphone.
                    </p>
                    <p class="text-xs sm:text-sm md:text-base text-red-500 mb-6">
                        (If you don't have it handy, you can send it later at secureddocuments@orcarealty.ca)
                    </p>
                    <button
                        @click="handleStartVerification"
                        :disabled="isVerifying"
                        class="flex items-center gap-3 bg-green-600 hover:bg-green-700 disabled:bg-gray-400 disabled:cursor-not-allowed text-white font-semibold px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl transition-colors duration-200 shadow-lg hover:shadow-xl"
                    >
                        <svg v-if="!isVerifying" class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <svg v-else class="w-5 h-5 sm:w-6 sm:h-6 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="text-sm sm:text-base md:text-lg">{{ isVerifying ? 'Starting Verification...' : 'Start Verification for Main-Owner' }}</span>
                    </button>
                    <!-- ComplyCube Verification Container -->
                    <div id="complycube-verification-container" class="mt-4"></div>
                </div>
            </div>
        </div>

        <!-- Review Content -->
        <div v-if="!isSubmitted" class="relative overflow-hidden">
            <!-- Elegant Header with Gradient -->
            <div class="relative bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-white rounded-t-2xl shadow-xl">
                <div class="absolute inset-0 bg-black/20"></div>
                <div class="relative flex items-center justify-between p-6 sm:p-8">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-white/10 backdrop-blur-sm rounded-xl">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm3 1h6v4H7V5zm6 6H7v2h6v-2z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl sm:text-3xl font-bold">Review Your Information</h3>
                            <p class="text-sm sm:text-base text-gray-300 mt-1">Please review all details before submitting</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Content Container with Elegant Background -->
            <div class="bg-gradient-to-br from-gray-50 via-white to-gray-50 p-4 sm:p-6 lg:p-8 space-y-6 rounded-b-2xl shadow-xl">
                <!-- Homeowner Detail Section (Collapsible) -->
                <div v-if="hasOwnerInfo || hasPointOfContact || hasMailingInfo" class="group bg-white rounded-xl border border-gray-200 shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <div 
                        class="flex items-center justify-between p-5 cursor-pointer bg-gradient-to-r from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 transition-all duration-300 border-b border-gray-200"
                        @click="isHomeownerOpen = !isHomeownerOpen"
                    >
                        <div class="flex items-center gap-4">
                            <div class="p-2.5 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg shadow-md">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900">Homeowner Detail</h4>
                        </div>
                        <button
                            type="button"
                            class="flex items-center gap-2 text-gray-600 hover:text-gray-900 font-medium text-sm transition-colors"
                            @click.stop="isHomeownerOpen = !isHomeownerOpen"
                        >
                            <span class="hidden sm:inline">{{ isHomeownerOpen ? 'Hide' : 'Show' }}</span>
                            <svg
                                :class="`w-5 h-5 transform transition-transform duration-300 text-gray-500 ${isHomeownerOpen ? 'rotate-180' : ''}`"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>
                    <div v-if="isHomeownerOpen" class="p-6 bg-white space-y-6">
                        <!-- Owner Information Subsection -->
                        <div v-if="hasOwnerInfo" class="space-y-4">
                            <h5 class="text-lg font-bold text-gray-900 flex items-center gap-2 pb-2 border-b border-gray-200">
                                <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                Owner Information
                            </h5>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div class="mb-4">
                                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Business Legal Name</label>
                                    <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.businessLegalName || 'N/A' }}</div>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">First Name</label>
                                    <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.firstName || 'N/A' }}</div>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Last Name</label>
                                    <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.lastName || 'N/A' }}</div>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Date of Birth</label>
                                    <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.dateOfBirth || 'N/A' }}</div>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Owner Email</label>
                                    <div class="text-base font-semibold text-blue-600 bg-blue-50 px-4 py-2.5 rounded-lg border border-blue-200">{{ data.ownerEmail || 'N/A' }}</div>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Phone</label>
                                    <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.phone || 'N/A' }}</div>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Resident Status</label>
                                    <div class="inline-block px-4 py-2 bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 font-semibold rounded-lg border border-green-200">{{ data.residentStatus || 'N/A' }}</div>
                                </div>
                            </div>
                            <div v-if="data.coOwners && data.coOwners.length > 0" class="mt-6 pt-6 border-t border-gray-200">
                                <label class="block text-sm font-bold text-gray-900 mb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                    </svg>
                                    Co-Owners
                                </label>
                                <div v-for="(coOwner, index) in data.coOwners" :key="index" class="mb-4 p-5 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-xl border border-indigo-200 shadow-sm hover:shadow-md transition-shadow">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="mb-3">
                                            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">First Name</label>
                                            <div class="text-base font-semibold text-gray-900">{{ coOwner.firstName || 'N/A' }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Last Name</label>
                                            <div class="text-base font-semibold text-gray-900">{{ coOwner.lastName || 'N/A' }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Date of Birth</label>
                                            <div class="text-base font-semibold text-gray-900">{{ coOwner.dateOfBirth || 'N/A' }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Email</label>
                                            <div class="text-base font-semibold text-blue-600">{{ coOwner.ownerEmail || 'N/A' }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Phone</label>
                                            <div class="text-base font-semibold text-gray-900">{{ coOwner.phone || 'N/A' }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Resident Status</label>
                                            <div class="inline-block px-3 py-1 bg-green-100 text-green-800 font-semibold rounded-lg text-sm">{{ coOwner.residentStatus || 'N/A' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Point of Contact Subsection -->
                        <div v-if="hasPointOfContact" class="space-y-4 pt-4 border-t border-gray-200">
                            <h5 class="text-lg font-bold text-gray-900 flex items-center gap-2 pb-2 border-b border-gray-200">
                                <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                                Point of Contact
                            </h5>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div class="mb-4">
                                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Point of Contact</label>
                                    <div class="inline-block px-4 py-2 bg-gradient-to-r from-purple-100 to-pink-100 text-purple-800 font-semibold rounded-lg border border-purple-200">{{ data.pointOfContact || 'N/A' }}</div>
                                </div>
                                <div v-if="data.pointOfContact === 'Other(Specify)'" class="mb-4">
                                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">First Name</label>
                                    <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.pointOfContactFirstName || 'N/A' }}</div>
                                </div>
                                <div v-if="data.pointOfContact === 'Other(Specify)'" class="mb-4">
                                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Email</label>
                                    <div class="text-base font-semibold text-blue-600 bg-blue-50 px-4 py-2.5 rounded-lg border border-blue-200">{{ data.pointOfContactEmail || 'N/A' }}</div>
                                </div>
                                <div v-if="data.pointOfContact === 'Other(Specify)'" class="mb-4">
                                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Phone</label>
                                    <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.pointOfContactPhone || 'N/A' }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Mailing Information Subsection -->
                        <div v-if="hasMailingInfo" class="space-y-4 pt-4 border-t border-gray-200">
                            <h5 class="text-lg font-bold text-gray-900 flex items-center gap-2 pb-2 border-b border-gray-200">
                                <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                                Mailing Information
                            </h5>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div class="mb-4">
                                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Unit & Suite</label>
                                    <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.unitSuite || 'N/A' }}</div>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Street Address</label>
                                    <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.streetAddress || 'N/A' }}</div>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">City</label>
                                    <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.city || 'N/A' }}</div>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Province</label>
                                    <div class="inline-block px-4 py-2 bg-gradient-to-r from-emerald-100 to-teal-100 text-emerald-800 font-semibold rounded-lg border border-emerald-200">{{ data.province || 'N/A' }}</div>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Postal Code</label>
                                    <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200 font-mono">{{ data.postalCode || 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rental Property Information Section -->
                <div v-if="hasRentalInfo" class="group bg-white rounded-xl border border-gray-200 shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <div 
                        class="flex items-center justify-between p-5 cursor-pointer bg-gradient-to-r from-orange-50 to-amber-50 hover:from-orange-100 hover:to-amber-100 transition-all duration-300 border-b border-gray-200"
                        @click="isRentalOpen = !isRentalOpen"
                    >
                        <div class="flex items-center gap-4">
                            <div class="p-2.5 bg-gradient-to-br from-orange-500 to-amber-600 rounded-lg shadow-md">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900">Rental Property Information</h4>
                        </div>
                        <button
                            type="button"
                            class="flex items-center gap-2 text-gray-600 hover:text-gray-900 font-medium text-sm transition-colors"
                            @click.stop="isRentalOpen = !isRentalOpen"
                        >
                            <span class="hidden sm:inline">{{ isRentalOpen ? 'Hide' : 'Show' }}</span>
                            <svg
                                :class="`w-5 h-5 transform transition-transform duration-300 text-gray-500 ${isRentalOpen ? 'rotate-180' : ''}`"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>
                    <div v-if="isRentalOpen" class="p-6 bg-white">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Unit & Suite</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.rental?.unitSuite || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Street Address</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.rental?.streetAddress || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">City</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.rental?.city || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Province</label>
                            <div class="inline-block px-4 py-2 bg-gradient-to-r from-orange-100 to-amber-100 text-orange-800 font-semibold rounded-lg border border-orange-200">{{ data.rental?.province || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Postal Code</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200 font-mono">{{ data.rental?.postalCode || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Neighborhood</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.rental?.neighborhood || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Year Built</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.rental?.yearBuilt || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Total Floor Area</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.rental?.totalFloorArea ? `${data.rental.totalFloorArea} sq. ft.` : 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Keys</label>
                            <div class="inline-block px-4 py-2 bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800 font-semibold rounded-lg border border-blue-200">{{ data.rental?.keys || 'N/A' }}</div>
                        </div>
                        <div v-if="data.rental?.keys === 'Other'" class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Keys Other Detail</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.rental?.keysOther || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Bedrooms</label>
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-pink-100 to-rose-100 text-pink-800 font-bold text-lg rounded-xl border border-pink-200">{{ data.rental?.bedrooms || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Bathrooms</label>
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-cyan-100 to-blue-100 text-cyan-800 font-bold text-lg rounded-xl border border-cyan-200">{{ data.rental?.bathrooms || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Den</label>
                            <div class="inline-block px-4 py-2 bg-gradient-to-r from-purple-100 to-pink-100 text-purple-800 font-semibold rounded-lg border border-purple-200">{{ data.rental?.den || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Balcony/Patio</label>
                            <div class="inline-block px-4 py-2 bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 font-semibold rounded-lg border border-green-200">{{ data.rental?.balconypatio || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Storage</label>
                            <div class="inline-block px-4 py-2 bg-gradient-to-r from-yellow-100 to-amber-100 text-yellow-800 font-semibold rounded-lg border border-yellow-200">{{ data.rental?.storage || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Alarm Code</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200 font-mono">{{ data.rental?.alarmCode || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Parking Level/Stall</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.rental?.parkingLevelStall || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Laundry</label>
                            <div class="inline-block px-4 py-2 bg-gradient-to-r from-teal-100 to-cyan-100 text-teal-800 font-semibold rounded-lg border border-teal-200">{{ data.rental?.laundry || 'N/A' }}</div>
                        </div>
                    </div>
                    <div v-if="data.rental?.parking && Object.keys(data.rental.parking).length > 0" class="mt-6 pt-6 border-t border-gray-200">
                        <label class="block text-sm font-bold text-gray-900 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                            </svg>
                            Parking
                        </label>
                        <div class="flex flex-wrap gap-2">
                            <span v-for="(count, type) in data.rental.parking" :key="type" class="px-4 py-2 bg-gradient-to-r from-orange-100 to-amber-100 text-orange-800 font-semibold rounded-lg text-sm border border-orange-200 shadow-sm">{{ type }}: {{ count }}</span>
                        </div>
                    </div>
                    <div v-if="data.rental?.fireplaceTypes && data.rental.fireplaceTypes.length > 0" class="mt-6 pt-6 border-t border-gray-200">
                        <label class="block text-sm font-bold text-gray-900 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.16-.85-.36-1.9-.617-3.1a23.05 23.05 0 00-1.582-4.144 1 1 0 00-1.45-.384c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.16-.85-.36-1.9-.617-3.1a23.05 23.05 0 00-1.582-4.144 1 1 0 00-1.45-.384c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.16-.85-.36-1.9-.617-3.1a23.05 23.05 0 00-1.582-4.144z" clip-rule="evenodd" />
                            </svg>
                            Fireplace Types
                        </label>
                        <div class="flex flex-wrap gap-2">
                            <span v-for="item in data.rental.fireplaceTypes" :key="item" class="px-4 py-2 bg-gradient-to-r from-red-100 to-rose-100 text-red-800 font-semibold rounded-lg text-sm border border-red-200 shadow-sm">{{ item }}</span>
                        </div>
                    </div>
                    <div v-if="data.rental?.heating && data.rental.heating.length > 0" class="mt-6 pt-6 border-t border-gray-200">
                        <label class="block text-sm font-bold text-gray-900 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                            </svg>
                            Heating
                        </label>
                        <div class="flex flex-wrap gap-2">
                            <span v-for="item in data.rental.heating" :key="item" class="px-4 py-2 bg-gradient-to-r from-yellow-100 to-amber-100 text-yellow-800 font-semibold rounded-lg text-sm border border-yellow-200 shadow-sm">{{ item }}</span>
                        </div>
                    </div>
                    <div v-if="data.rental?.heatingType" class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Heating Type</label>
                        <div class="text-gray-900 font-medium">{{ data.rental.heatingType }}</div>
                    </div>
                    </div>
                </div>

                <!-- Occupancy & Availability Section -->
                <div v-if="hasOccupancyInfo" class="group bg-white rounded-xl border border-gray-200 shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <div 
                        class="flex items-center justify-between p-5 cursor-pointer bg-gradient-to-r from-rose-50 to-pink-50 hover:from-rose-100 hover:to-pink-100 transition-all duration-300 border-b border-gray-200"
                        @click="isOccupancyOpen = !isOccupancyOpen"
                    >
                        <div class="flex items-center gap-4">
                            <div class="p-2.5 bg-gradient-to-br from-rose-500 to-pink-600 rounded-lg shadow-md">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900">Occupancy & Availability</h4>
                        </div>
                        <button
                            type="button"
                            class="flex items-center gap-2 text-gray-600 hover:text-gray-900 font-medium text-sm transition-colors"
                            @click.stop="isOccupancyOpen = !isOccupancyOpen"
                        >
                            <span class="hidden sm:inline">{{ isOccupancyOpen ? 'Hide' : 'Show' }}</span>
                            <svg
                                :class="`w-5 h-5 transform transition-transform duration-300 text-gray-500 ${isOccupancyOpen ? 'rotate-180' : ''}`"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>
                    <div v-if="isOccupancyOpen" class="p-6 bg-white">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Property Currently</label>
                            <div class="inline-block px-4 py-2 bg-gradient-to-r from-rose-100 to-pink-100 text-rose-800 font-semibold rounded-lg border border-rose-200">{{ data.occupancy?.availableAsap || 'N/A' }}</div>
                        </div>
                        <div v-if="data.occupancy?.availableAsap === 'Tenant Occupied'" class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Tenant Vacating Date</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.occupancy?.tenantVacatingDate || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Renovation Plans</label>
                            <div class="inline-block px-4 py-2 bg-gradient-to-r from-amber-100 to-yellow-100 text-amber-800 font-semibold rounded-lg border border-amber-200">{{ data.occupancy?.renovationPlans || 'N/A' }}</div>
                        </div>
                        <div v-if="data.occupancy?.renovationPlans === 'No'" class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Availability Date</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.occupancy?.availabilityDate || 'N/A' }}</div>
                        </div>
                        <div v-if="data.occupancy?.renovationPlans === 'Yes'" class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Expected Renovations</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.occupancy?.expectedRenovations || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Fixed Term Only</label>
                            <div class="inline-block px-4 py-2 bg-gradient-to-r from-violet-100 to-purple-100 text-violet-800 font-semibold rounded-lg border border-violet-200">{{ data.occupancy?.fixedTermOnly || 'N/A' }}</div>
                        </div>
                        <div v-if="data.occupancy?.fixedTermOnly === 'Yes'" class="mb-4 md:col-span-2">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Fixed Term Tenancy Description</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.occupancy?.fixedTermTenancyDescription || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Boost Ad</label>
                            <div class="inline-block px-4 py-2 bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 font-semibold rounded-lg border border-green-200">{{ data.occupancy?.boostAd || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Anticipated Date</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.occupancy?.anticipatedDate || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Rental Term</label>
                            <div class="inline-block px-4 py-2 bg-gradient-to-r from-indigo-100 to-blue-100 text-indigo-800 font-semibold rounded-lg border border-indigo-200">{{ data.occupancy?.rentalTerm || 'N/A' }}</div>
                        </div>
                        <div v-if="data.occupancy?.rentalTerm === 'Short-term, less than 1 year'" class="mb-4 md:col-span-2">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Short-term Availability Info</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.occupancy?.shortTermAvailabilityInfo || 'N/A' }}</div>
                        </div>
                        <div v-if="data.occupancy?.rentalTerm === 'Other'" class="mb-4 md:col-span-2">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Availability Info</label>
                            <div class="p-4 bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg text-gray-900 whitespace-pre-wrap border border-gray-200">{{ data.occupancy?.availabilityInfo || 'N/A' }}</div>
                        </div>
                    </div>
                    <div v-if="tenants.length > 0 && tenants[0].name" class="mt-6 pt-6 border-t border-gray-200">
                        <label class="block text-sm font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-rose-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                            </svg>
                            Current Tenants
                        </label>
                        <div v-for="(tenant, index) in tenants" :key="index" class="mb-4 p-5 bg-gradient-to-br from-rose-50 to-pink-50 rounded-xl border border-rose-200 shadow-sm hover:shadow-md transition-shadow">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="mb-3">
                                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Name</label>
                                    <div class="text-base font-semibold text-gray-900">{{ tenant.name || 'N/A' }}</div>
                                </div>
                                <div class="mb-3">
                                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Phone</label>
                                    <div class="text-base font-semibold text-gray-900">{{ tenant.phone || 'N/A' }}</div>
                                </div>
                                <div class="mb-3">
                                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Email</label>
                                    <div class="text-base font-semibold text-blue-600">{{ tenant.email || 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Utilities, Inclusions, Restrictions Section -->
                <div v-if="hasUtilitiesInfo" class="group bg-white rounded-xl border border-gray-200 shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <div 
                        class="flex items-center justify-between p-5 cursor-pointer bg-gradient-to-r from-cyan-50 to-blue-50 hover:from-cyan-100 hover:to-blue-100 transition-all duration-300 border-b border-gray-200"
                        @click="isUtilitiesOpen = !isUtilitiesOpen"
                    >
                        <div class="flex items-center gap-4">
                            <div class="p-2.5 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg shadow-md">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900">Utilities, Inclusions, Restrictions</h4>
                        </div>
                        <button
                            type="button"
                            class="flex items-center gap-2 text-gray-600 hover:text-gray-900 font-medium text-sm transition-colors"
                            @click.stop="isUtilitiesOpen = !isUtilitiesOpen"
                        >
                            <span class="hidden sm:inline">{{ isUtilitiesOpen ? 'Hide' : 'Show' }}</span>
                            <svg
                                :class="`w-5 h-5 transform transition-transform duration-300 text-gray-500 ${isUtilitiesOpen ? 'rotate-180' : ''}`"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>
                    <div v-if="isUtilitiesOpen" class="p-6 bg-white">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Water</label>
                            <div class="inline-block px-4 py-2 bg-gradient-to-r from-blue-100 to-cyan-100 text-blue-800 font-semibold rounded-lg border border-blue-200">{{ data.utilities?.water || 'N/A' }}</div>
                        </div>
                        <div v-if="data.utilities?.water === 'Split'" class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Water Split Detail</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.utilities?.waterSplitDetail || 'N/A' }}</div>
                        </div>
                        <div v-if="data.utilities?.water === 'Other'" class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Water Other Detail</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.utilities?.waterOtherDetail || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Electricity</label>
                            <div class="inline-block px-4 py-2 bg-gradient-to-r from-yellow-100 to-amber-100 text-yellow-800 font-semibold rounded-lg border border-yellow-200">{{ data.utilities?.electricity || 'N/A' }}</div>
                        </div>
                        <div v-if="data.utilities?.electricity === 'Split'" class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Electricity Split Detail</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.utilities?.electricitySplitDetail || 'N/A' }}</div>
                        </div>
                        <div v-if="data.utilities?.electricity === 'Other'" class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Electricity Other Detail</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.utilities?.electricityOtherDetail || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Gas</label>
                            <div class="inline-block px-4 py-2 bg-gradient-to-r from-orange-100 to-red-100 text-orange-800 font-semibold rounded-lg border border-orange-200">{{ data.utilities?.gas || 'N/A' }}</div>
                        </div>
                        <div v-if="data.utilities?.gas === 'Split'" class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Gas Split Detail</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.utilities?.gasSplitDetail || 'N/A' }}</div>
                        </div>
                        <div v-if="data.utilities?.gas === 'Other'" class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Gas Other Detail</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.utilities?.gasOtherDetail || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Heat</label>
                            <div class="inline-block px-4 py-2 bg-gradient-to-r from-red-100 to-rose-100 text-red-800 font-semibold rounded-lg border border-red-200">{{ data.utilities?.heat || 'N/A' }}</div>
                        </div>
                        <div v-if="data.utilities?.heat === 'Split'" class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Heat Split Detail</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.utilities?.heatSplitDetail || 'N/A' }}</div>
                        </div>
                        <div v-if="data.utilities?.heat === 'Other'" class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Heat Other Detail</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.utilities?.heatOtherDetail || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Furnishing</label>
                            <div class="inline-block px-4 py-2 bg-gradient-to-r from-purple-100 to-pink-100 text-purple-800 font-semibold rounded-lg border border-purple-200">{{ data.utilities?.furnishing || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Pets Allowed</label>
                            <div class="inline-block px-4 py-2 bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 font-semibold rounded-lg border border-green-200">{{ data.utilities?.pets || 'N/A' }}</div>
                        </div>
                        <div v-if="data.utilities?.pets === 'Yes'" class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Pet Restrictions</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.utilities?.petRestrictions || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Property Type</label>
                            <div class="inline-block px-4 py-2 bg-gradient-to-r from-indigo-100 to-violet-100 text-indigo-800 font-semibold rounded-lg border border-indigo-200">{{ data.utilities?.propertyType || 'N/A' }}</div>
                        </div>
                        <div v-if="data.utilities?.propertyType === 'Condo'" class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Condo Restrictions</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.utilities?.condoRestrictions || 'N/A' }}</div>
                        </div>
                        <div v-if="data.utilities?.propertyType === 'Other'" class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Property Type Other Detail</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.utilities?.propertyTypeOtherDetail || 'N/A' }}</div>
                        </div>
                    </div>
                    <div v-if="data.utilities?.inclusions && data.utilities.inclusions.length > 0" class="mt-6 pt-6 border-t border-gray-200">
                        <label class="block text-sm font-bold text-gray-900 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-cyan-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            Inclusions
                        </label>
                        <div class="flex flex-wrap gap-2">
                            <span v-for="item in data.utilities.inclusions" :key="item" class="px-4 py-2 bg-gradient-to-r from-cyan-100 to-blue-100 text-cyan-800 font-semibold rounded-lg text-sm border border-cyan-200 shadow-sm">{{ item }}</span>
                        </div>
                    </div>
                    <div v-if="data.utilities?.inclusions && data.utilities.inclusions.includes('Other') && data.utilities?.inclusionsOtherDetail" class="mt-6 pt-6 border-t border-gray-200">
                        <label class="block text-sm font-bold text-gray-900 mb-2">Inclusions Other Detail</label>
                        <div class="p-4 bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg text-gray-900 whitespace-pre-wrap border border-gray-200">{{ data.utilities.inclusionsOtherDetail }}</div>
                    </div>
                    </div>
                </div>

                <!-- Other Details Section -->
                <div v-if="hasOtherInfo" class="group bg-white rounded-xl border border-gray-200 shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <div 
                        class="flex items-center justify-between p-5 cursor-pointer bg-gradient-to-r from-slate-50 to-gray-50 hover:from-slate-100 hover:to-gray-100 transition-all duration-300 border-b border-gray-200"
                        @click="isOtherOpen = !isOtherOpen"
                    >
                        <div class="flex items-center gap-4">
                            <div class="p-2.5 bg-gradient-to-br from-slate-500 to-gray-600 rounded-lg shadow-md">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900">Other Details</h4>
                        </div>
                        <button
                            type="button"
                            class="flex items-center gap-2 text-gray-600 hover:text-gray-900 font-medium text-sm transition-colors"
                            @click.stop="isOtherOpen = !isOtherOpen"
                        >
                            <span class="hidden sm:inline">{{ isOtherOpen ? 'Hide' : 'Show' }}</span>
                            <svg
                                :class="`w-5 h-5 transform transition-transform duration-300 text-gray-500 ${isOtherOpen ? 'rotate-180' : ''}`"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>
                    <div v-if="isOtherOpen" class="p-6 bg-white">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Name of Strata Property Management Company</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.other?.strataCompany || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Strata Manager Name</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.other?.strataManagerName || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Strata Phone</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.other?.strataPhone || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Strata Email Address</label>
                            <div class="text-base font-semibold text-blue-600 bg-blue-50 px-4 py-2.5 rounded-lg border border-blue-200">{{ data.other?.strataEmail || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Building Manager Name</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.other?.buildingManagerName || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Building Manager Phone</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.other?.buildingManagerPhone || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Building Manager Email Address</label>
                            <div class="text-base font-semibold text-blue-600 bg-blue-50 px-4 py-2.5 rounded-lg border border-blue-200">{{ data.other?.buildingManagerEmail || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Move In Fees</label>
                            <div class="text-base font-semibold text-green-700 bg-green-50 px-4 py-2.5 rounded-lg border border-green-200">{{ formatCurrency(data.other?.moveInFees) || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Has Self-Contained Suite</label>
                            <div class="inline-block px-4 py-2 bg-gradient-to-r from-cyan-100 to-blue-100 text-cyan-800 font-semibold rounded-lg border border-cyan-200">{{ data.other?.hasSelfContainedSuite || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Is Suite Tenanted</label>
                            <div class="inline-block px-4 py-2 bg-gradient-to-r from-teal-100 to-emerald-100 text-teal-800 font-semibold rounded-lg border border-teal-200">{{ data.other?.suiteTenanted || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Suite Bedrooms</label>
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-indigo-100 to-purple-100 text-indigo-800 font-bold text-lg rounded-xl border border-indigo-200">{{ data.other?.suiteBedrooms || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Inground Sprinklers that need servicing?</label>
                            <div class="inline-block px-4 py-2 bg-gradient-to-r from-emerald-100 to-green-100 text-emerald-800 font-semibold rounded-lg border border-emerald-200">{{ data.other?.sprinklersService || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Fuse Box</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.other?.fuseBox || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">What floor are the amenities on?</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.other?.amenitiesFloor || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Which Floor/Stall/Locker is the Bike Storage at?</label>
                            <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.other?.bikeStorageLocation || 'N/A' }}</div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Is it okay to put a sign up front?</label>
                            <div class="inline-block px-4 py-2 bg-gradient-to-r from-lime-100 to-green-100 text-lime-800 font-semibold rounded-lg border border-lime-200">{{ data.other?.signUpFront || 'N/A' }}</div>
                        </div>
                    </div>
                    <div v-if="data.other?.amenities && data.other.amenities.length > 0" class="mt-6 pt-6 border-t border-gray-200">
                        <label class="block text-sm font-bold text-gray-900 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-slate-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 01.787 1.838l-7 3a1 1 0 000 1.84l7 3a1 1 0 00.788 0l7-3a1 1 0 000-1.838l-1.94-.831a1 1 0 01.787-1.838l4 1.714a1 1 0 11-.788-1.838l-4-1.714a1 1 0 01-.356-.257l-1.94-.831a1 1 0 010-1.838l7-3z" />
                            </svg>
                            Amenities
                        </label>
                        <div class="flex flex-wrap gap-2">
                            <span v-for="item in data.other.amenities" :key="item" class="px-4 py-2 bg-gradient-to-r from-slate-100 to-gray-100 text-slate-800 font-semibold rounded-lg text-sm border border-slate-200 shadow-sm">{{ item }}</span>
                        </div>
                    </div>
                    <div v-if="data.other?.amenitiesOtherDetail" class="mt-6 pt-6 border-t border-gray-200">
                        <label class="block text-sm font-bold text-gray-900 mb-2">Utilities/Other Items Details</label>
                        <div class="p-4 bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg text-gray-900 whitespace-pre-wrap border border-gray-200">{{ data.other.amenitiesOtherDetail }}</div>
                    </div>
                    <div v-if="data.other?.maintenance && data.other.maintenance.length > 0" class="mt-6 pt-6 border-t border-gray-200">
                        <label class="block text-sm font-bold text-gray-900 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-slate-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                            </svg>
                            Maintenance
                        </label>
                        <div v-for="(item, index) in data.other.maintenance" :key="index" class="mb-3 p-4 bg-gradient-to-br from-slate-50 to-gray-50 rounded-lg border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex items-center justify-between">
                                <span class="font-semibold text-gray-800">{{ item }}</span>
                                <span v-if="data.other?.maintenanceFrequencies?.[item]" class="px-3 py-1 bg-slate-100 text-slate-700 font-medium rounded-lg text-sm border border-slate-200">{{ data.other.maintenanceFrequencies[item] }}</span>
                            </div>
                        </div>
                    </div>
                    <div v-if="suiteTenants.length > 0 && suiteTenants[0].name" class="mt-6 pt-6 border-t border-gray-200">
                        <label class="block text-sm font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-slate-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                            </svg>
                            Self-Contained Suite Tenants
                        </label>
                        <div v-for="(tenant, index) in suiteTenants" :key="index" class="mb-4 p-5 bg-gradient-to-br from-slate-50 to-gray-50 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="mb-3">
                                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Name</label>
                                    <div class="text-base font-semibold text-gray-900">{{ tenant.name || 'N/A' }}</div>
                                </div>
                                <div class="mb-3">
                                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Phone</label>
                                    <div class="text-base font-semibold text-gray-900">{{ tenant.phone || 'N/A' }}</div>
                                </div>
                                <div class="mb-3">
                                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Email</label>
                                    <div class="text-base font-semibold text-blue-600">{{ tenant.email || 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="data.other?.suiteOtherDetails" class="mt-6 pt-6 border-t border-gray-200">
                        <label class="block text-sm font-bold text-gray-900 mb-2">Other details about the suite</label>
                        <div class="p-4 bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg text-gray-900 whitespace-pre-wrap border border-gray-200">{{ data.other.suiteOtherDetails }}</div>
                    </div>
                    <div v-if="data.other?.garbageInfo" class="mt-6 pt-6 border-t border-gray-200">
                        <label class="block text-sm font-bold text-gray-900 mb-2">Garbage: Location, Disposal & Restrictions</label>
                        <div class="text-base font-semibold text-gray-900 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200">{{ data.other.garbageInfo || 'N/A' }}</div>
                    </div>
                    <div v-if="data.other?.amenitiesNotes" class="mt-6 pt-6 border-t border-gray-200">
                        <label class="block text-sm font-bold text-gray-900 mb-2">Any information about the location of the building amenities?</label>
                        <div class="p-4 bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg text-gray-900 whitespace-pre-wrap border border-gray-200">{{ data.other.amenitiesNotes }}</div>
                    </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div v-if="!hasAnyData" class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="text-gray-600 text-lg">No data to review yet. Please fill out the form sections above.</p>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div v-if="!isSubmitted" class="flex-shrink-0 r-mt-3 r-pt-3 sm:mt-6 pt-4 sm:pt-6 border-t border-gray-200 bg-white flex flex-col sm:flex-row justify-between gap-3 sm:gap-4">
            <button
                v-if="onBack"
                @click="onBack"
                class="r-p-3 cursor-pointer bg-white text-black border border-gray-300 hover:bg-gray-50 px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl font-semibold flex items-center gap-2 transition-colors duration-200 shadow-sm hover:shadow-md"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Other Details
            </button>

            <button
                v-if="onSubmit"
                @click="handleSubmit"
                :disabled="isSubmitted"
                class="r-p-3 cursor-pointer bg-black hover:bg-gray-800 disabled:bg-gray-400 disabled:cursor-not-allowed text-white px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl font-semibold flex items-center gap-2 transition-colors duration-200 shadow-lg hover:shadow-xl"
            >
                Submit
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import confetti from 'canvas-confetti';

const props = defineProps({
    onBack: Function,
    onSubmit: Function,
    onStartVerification: Function,
    data: {
        type: Object,
        default: () => ({}),
    },
});

const emit = defineEmits(['submit', 'start-verification']);

const isSubmitted = ref(false);
const isVerifying = ref(false);

// Collapsible section states
const isHomeownerOpen = ref(true);
const isRentalOpen = ref(true);
const isOccupancyOpen = ref(true);
const isUtilitiesOpen = ref(true);
const isOtherOpen = ref(true);

// Computed properties to check if sections have data
const hasOwnerInfo = computed(() => {
    return props.data?.firstName || props.data?.lastName || props.data?.ownerEmail || props.data?.phone || props.data?.businessLegalName;
});

const hasPointOfContact = computed(() => {
    return props.data?.pointOfContact || (props.data?.pointOfContact === 'Other(Specify)' && (props.data?.pointOfContactFirstName || props.data?.pointOfContactEmail || props.data?.pointOfContactPhone));
});

const hasMailingInfo = computed(() => {
    return props.data?.streetAddress || props.data?.city || props.data?.province || props.data?.postalCode;
});

const hasRentalInfo = computed(() => {
    return props.data?.rental?.streetAddress || props.data?.rental?.city || props.data?.rental?.province || props.data?.rental?.rent;
});

const hasOccupancyInfo = computed(() => {
    return props.data?.occupancy?.availableAsap || props.data?.occupancy?.renovationPlans || props.data?.occupancy?.fixedTermOnly || props.data?.occupancy?.boostAd || props.data?.occupancy?.anticipatedDate || props.data?.occupancy?.rentalTerm || props.data?.occupancy?.tenants?.length > 0;
});

const hasUtilitiesInfo = computed(() => {
    return props.data?.utilities?.water || props.data?.utilities?.electricity || props.data?.utilities?.gas || props.data?.utilities?.heat || props.data?.utilities?.inclusions?.length > 0;
});

const hasOtherInfo = computed(() => {
    return props.data?.other?.strataCompany || props.data?.other?.strataManagerName || props.data?.other?.buildingManagerName || props.data?.other?.amenities?.length > 0 || props.data?.other?.maintenance?.length > 0 || props.data?.other?.suiteTenants?.length > 0 || props.data?.other?.fuseBox || props.data?.other?.garbageInfo || props.data?.other?.amenitiesNotes;
});

const hasAnyData = computed(() => {
    return hasOwnerInfo.value || hasPointOfContact.value || hasMailingInfo.value || hasRentalInfo.value || hasOccupancyInfo.value || hasUtilitiesInfo.value || hasOtherInfo.value;
});

// Handle tenants array
const tenants = computed(() => {
    const occupancy = props.data?.occupancy || {};
    if (Array.isArray(occupancy.tenants)) {
        return occupancy.tenants.length > 0 ? occupancy.tenants : [];
    }
    if (occupancy.tenantName || occupancy.tenantPhone || occupancy.tenantEmail) {
        return [{
            name: occupancy.tenantName || '',
            phone: occupancy.tenantPhone || '',
            email: occupancy.tenantEmail || ''
        }];
    }
    return [];
});

// Handle suite tenants array
const suiteTenants = computed(() => {
    const other = props.data?.other || {};
    if (Array.isArray(other.suiteTenants)) {
        return other.suiteTenants.length > 0 ? other.suiteTenants : [];
    }
    if (other.suiteTenantName || other.suiteTenantPhone || other.suiteTenantEmail) {
        return [{
            name: other.suiteTenantName || '',
            phone: other.suiteTenantPhone || '',
            email: other.suiteTenantEmail || ''
        }];
    }
    return [];
});

const formatCurrency = (value) => {
    if (!value) return '';
    const num = parseFloat(value);
    if (isNaN(num)) return value;
    return new Intl.NumberFormat('en-CA', { style: 'currency', currency: 'CAD' }).format(num);
};

const handleSubmit = () => {
    // Prevent double submission
    if (isSubmitted.value) {
        return;
    }

    isSubmitted.value = true;

    
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
    
    // Emit submit event to parent (this will trigger the API call)
    emit('submit');
};

const handleStartVerification = async () => {
    if (isVerifying.value) return;
    
    try {
        isVerifying.value = true;
        
        // Get owner information from form data
        const firstName = props.data?.firstName || '';
        const lastName = props.data?.lastName || '';
        const email = props.data?.ownerEmail || '';
        const dateOfBirth = props.data?.dateOfBirth || '';
        
        if (!firstName || !lastName || !email || !dateOfBirth) {
            alert('Please complete owner information (First Name, Last Name, Email, and Date of Birth) before starting verification.');
            isVerifying.value = false;
            return;
        }
        
        // Emit start-verification event to parent
        emit('start-verification');
        
        // Also call the onStartVerification prop if provided
        if (props.onStartVerification) {
            props.onStartVerification();
        }
        
        // Call backend API to create ComplyCube client and check
        const response = await fetch('/api/complycube/create-verification-token', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
            },
            body: JSON.stringify({
                firstName,
                lastName,
                email,
                dateOfBirth,
            }),
        });
        
        const data = await response.json();
        
        if (!response.ok || data.status !== 'success') {
            throw new Error(data.error || 'Failed to create verification session');
        }
        
        // Load ComplyCube Web SDK if not already loaded
        if (!window.ComplyCube) {
            const script = document.createElement('script');
            script.src = 'https://complycube.com/js/complycube-sdk.min.js';
            script.onload = () => {
                initializeComplyCube(data.token);
            };
            script.onerror = () => {
                isVerifying.value = false;
                alert('Failed to load ComplyCube SDK. Please try again.');
            };
            document.head.appendChild(script);
        } else {
            initializeComplyCube(data.token);
        }
    } catch (error) {
        console.error('Error starting verification:', error);
        isVerifying.value = false;
        alert('Failed to start verification. Please try again or contact support.');
    }
};

const initializeComplyCube = (token) => {
    if (!window.ComplyCube) {
        console.error('ComplyCube SDK not loaded');
        isVerifying.value = false;
        return;
    }
    
    try {
        // Initialize ComplyCube SDK
        const complycube = new window.ComplyCube({
            token: token,
            onComplete: (result) => {
                isVerifying.value = false;
                // Handle successful verification
                if (result.status === 'complete') {
                    alert('Verification completed successfully!');
                }
            },
            onError: (error) => {
                console.error('Verification error:', error);
                isVerifying.value = false;
                alert('An error occurred during verification. Please try again.');
            },
            onUserClosed: () => {
                isVerifying.value = false;
            },
        });
        
        // Open the verification widget
        complycube.mount('#complycube-verification-container');
    } catch (error) {
        console.error('Error initializing ComplyCube:', error);
        isVerifying.value = false;
        alert('Failed to initialize verification. Please try again.');
    }
};
</script>

<!-- Review Field Component -->