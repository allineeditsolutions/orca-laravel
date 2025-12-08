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
        <div v-if="!isSubmitted" class="border border-gray-100 rounded-2xl bg-gray-50 shadow-sm hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center justify-between p-4 bg-white border-b border-gray-200">
                <div class="flex items-center gap-3 r-p-3">
                    <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm3 1h6v4H7V5zm6 6H7v2h6v-2z" clip-rule="evenodd" />
                    </svg>
                    <h3 class="text-lg font-semibold text-black">Review</h3>
                </div>
            </div>
            <div class="space-y-4 p-2 lg:p-4 ">
                <!-- Owner Information Section -->
                <div v-if="hasOwnerInfo" class="bg-white rounded-2xl border border-gray-100 shadow-sm">
                    <div 
                        class="flex items-center justify-between p-4 cursor-pointer hover:bg-gray-50 transition-colors border-b border-gray-200"
                        @click="isOwnerOpen = !isOwnerOpen"
                    >
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            <h4 class="text-lg font-semibold text-gray-900">Owner Information</h4>
                        </div>
                        <button
                            type="button"
                            class="flex items-center gap-2 text-black hover:text-gray-700 font-medium text-sm"
                            @click.stop="isOwnerOpen = !isOwnerOpen"
                        >
                            <svg
                                :class="`w-5 h-5 transform transition-transform duration-200 text-gray-400 ${isOwnerOpen ? 'rotate-180' : ''}`"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>
                    <div v-if="isOwnerOpen" class="p-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Business Legal Name</label>
                            <div class="text-gray-900 font-medium">{{ data.businessLegalName || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                            <div class="text-gray-900 font-medium">{{ data.firstName || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                            <div class="text-gray-900 font-medium">{{ data.lastName || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                            <div class="text-gray-900 font-medium">{{ data.dateOfBirth || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Owner Email</label>
                            <div class="text-gray-900 font-medium">{{ data.ownerEmail || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                            <div class="text-gray-900 font-medium">{{ data.phone || 'N/A' }}</div>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Point of Contact Section -->
                <div v-if="hasPointOfContact" class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-3 mb-4 pb-3 border-b border-gray-200">
                        <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                        </svg>
                        <h4 class="text-lg font-semibold text-gray-900">Point of Contact</h4>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Point of Contact</label>
                            <div class="text-gray-900 font-medium">{{ data.pointOfContact || 'N/A' }}</div>
                        </div>
                        <div v-if="data.pointOfContact === 'Other(Specify)'" class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                            <div class="text-gray-900 font-medium">{{ data.pointOfContactFirstName || 'N/A' }}</div>
                        </div>
                        <div v-if="data.pointOfContact === 'Other(Specify)'" class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <div class="text-gray-900 font-medium">{{ data.pointOfContactEmail || 'N/A' }}</div>
                        </div>
                        <div v-if="data.pointOfContact === 'Other(Specify)'" class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                            <div class="text-gray-900 font-medium">{{ data.pointOfContactPhone || 'N/A' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Mailing Information Section -->
                <div v-if="hasMailingInfo" class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-3 mb-4 pb-3 border-b border-gray-200">
                        <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                        <h4 class="text-lg font-semibold text-gray-900">Mailing Information</h4>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Street Address</label>
                            <div class="text-gray-900 font-medium">{{ data.streetAddress || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                            <div class="text-gray-900 font-medium">{{ data.city || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Province</label>
                            <div class="text-gray-900 font-medium">{{ data.province || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                            <div class="text-gray-900 font-medium">{{ data.postalCode || 'N/A' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Rental Property Information Section -->
                <div v-if="hasRentalInfo" class="bg-white rounded-2xl border border-gray-100 shadow-sm">
                    <div 
                        class="flex items-center justify-between p-4 cursor-pointer hover:bg-gray-50 transition-colors border-b border-gray-200"
                        @click="isRentalOpen = !isRentalOpen"
                    >
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            <h4 class="text-lg font-semibold text-gray-900">Rental Property Information</h4>
                        </div>
                        <button
                            type="button"
                            class="flex items-center gap-2 text-black hover:text-gray-700 font-medium text-sm"
                            @click.stop="isRentalOpen = !isRentalOpen"
                        >
                            <svg
                                :class="`w-5 h-5 transform transition-transform duration-200 text-gray-400 ${isRentalOpen ? 'rotate-180' : ''}`"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>
                    <div v-if="isRentalOpen" class="p-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Unit & Suite</label>
                            <div class="text-gray-900 font-medium">{{ data.rental?.unitSuite || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Street Address</label>
                            <div class="text-gray-900 font-medium">{{ data.rental?.streetAddress || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                            <div class="text-gray-900 font-medium">{{ data.rental?.city || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Province</label>
                            <div class="text-gray-900 font-medium">{{ data.rental?.province || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                            <div class="text-gray-900 font-medium">{{ data.rental?.postalCode || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Neighborhood</label>
                            <div class="text-gray-900 font-medium">{{ data.rental?.neighborhood || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Year Built</label>
                            <div class="text-gray-900 font-medium">{{ data.rental?.yearBuilt || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Total Floor Area</label>
                            <div class="text-gray-900 font-medium">{{ data.rental?.totalFloorArea ? `${data.rental.totalFloorArea} sq. ft.` : 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Keys</label>
                            <div class="text-gray-900 font-medium">{{ data.rental?.keys || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Bedrooms</label>
                            <div class="text-gray-900 font-medium">{{ data.rental?.bedrooms || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Bathrooms</label>
                            <div class="text-gray-900 font-medium">{{ data.rental?.bathrooms || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Den</label>
                            <div class="text-gray-900 font-medium">{{ data.rental?.den || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Balcony/Patio</label>
                            <div class="text-gray-900 font-medium">{{ data.rental?.balconypatio || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Storage</label>
                            <div class="text-gray-900 font-medium">{{ data.rental?.storage || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alarm Code</label>
                            <div class="text-gray-900 font-medium">{{ data.rental?.alarmCode || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Parking Level/Stall</label>
                            <div class="text-gray-900 font-medium">{{ data.rental?.parkingLevelStall || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Laundry</label>
                            <div class="text-gray-900 font-medium">{{ data.rental?.laundry || 'N/A' }}</div>
                        </div>
                    </div>
                    <div v-if="data.rental?.parking && Object.keys(data.rental.parking).length > 0" class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Parking</label>
                        <div class="flex flex-wrap gap-2">
                            <span v-for="(count, type) in data.rental.parking" :key="type" class="px-3 py-1 bg-gray-100 text-gray-800 rounded-lg text-sm">{{ type }}: {{ count }}</span>
                        </div>
                    </div>
                    <div v-if="data.rental?.fireplaceTypes && data.rental.fireplaceTypes.length > 0" class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fireplace Types</label>
                        <div class="flex flex-wrap gap-2">
                            <span v-for="item in data.rental.fireplaceTypes" :key="item" class="px-3 py-1 bg-gray-100 text-gray-800 rounded-lg text-sm">{{ item }}</span>
                        </div>
                    </div>
                    <div v-if="data.rental?.heating && data.rental.heating.length > 0" class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Heating</label>
                        <div class="flex flex-wrap gap-2">
                            <span v-for="item in data.rental.heating" :key="item" class="px-3 py-1 bg-gray-100 text-gray-800 rounded-lg text-sm">{{ item }}</span>
                        </div>
                    </div>
                    <div v-if="data.rental?.heatingType" class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Heating Type</label>
                        <div class="text-gray-900 font-medium">{{ data.rental.heatingType }}</div>
                    </div>
                    </div>
                </div>

                <!-- Occupancy & Availability Section -->
                <div v-if="hasOccupancyInfo" class="bg-white rounded-2xl border border-gray-100 shadow-sm">
                    <div 
                        class="flex items-center justify-between p-4 cursor-pointer hover:bg-gray-50 transition-colors border-b border-gray-200"
                        @click="isOccupancyOpen = !isOccupancyOpen"
                    >
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                            <h4 class="text-lg font-semibold text-gray-900">Occupancy & Availability</h4>
                        </div>
                        <button
                            type="button"
                            class="flex items-center gap-2 text-black hover:text-gray-700 font-medium text-sm"
                            @click.stop="isOccupancyOpen = !isOccupancyOpen"
                        >
                            <svg
                                :class="`w-5 h-5 transform transition-transform duration-200 text-gray-400 ${isOccupancyOpen ? 'rotate-180' : ''}`"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>
                    <div v-if="isOccupancyOpen" class="p-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Property Currently</label>
                            <div class="text-gray-900 font-medium">{{ data.occupancy?.availableAsap || 'N/A' }}</div>
                        </div>
                        <div v-if="data.occupancy?.availableAsap === 'Tenant Occupied'" class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tenant Vacating Date</label>
                            <div class="text-gray-900 font-medium">{{ data.occupancy?.tenantVacatingDate || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Renovation Plans</label>
                            <div class="text-gray-900 font-medium">{{ data.occupancy?.renovationPlans || 'N/A' }}</div>
                        </div>
                        <div v-if="data.occupancy?.renovationPlans === 'Yes'" class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Expected Renovations</label>
                            <div class="text-gray-900 font-medium">{{ data.occupancy?.expectedRenovations || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Fixed Term Only</label>
                            <div class="text-gray-900 font-medium">{{ data.occupancy?.fixedTermOnly || 'N/A' }}</div>
                        </div>
                        <div v-if="data.occupancy?.fixedTermOnly === 'Yes'" class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Fixed Term Tenancy Description</label>
                            <div class="text-gray-900 font-medium">{{ data.occupancy?.fixedTermTenancyDescription || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Boost Ad</label>
                            <div class="text-gray-900 font-medium">{{ data.occupancy?.boostAd || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Anticipated Date</label>
                            <div class="text-gray-900 font-medium">{{ data.occupancy?.anticipatedDate || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Rental Term</label>
                            <div class="text-gray-900 font-medium">{{ data.occupancy?.rentalTerm || 'N/A' }}</div>
                        </div>
                        <div v-if="data.occupancy?.rentalTerm === 'Short-term, less than 1 year'" class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Short-term Availability Info</label>
                            <div class="text-gray-900 font-medium">{{ data.occupancy?.shortTermAvailabilityInfo || 'N/A' }}</div>
                        </div>
                        <div v-if="data.occupancy?.rentalTerm === 'Long-term, 1 year +'" class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Availability Info</label>
                            <div class="text-gray-900 font-medium">{{ data.occupancy?.availabilityInfo || 'N/A' }}</div>
                        </div>
                    </div>
                    <div v-if="tenants.length > 0 && tenants[0].name" class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Current Tenants</label>
                        <div v-for="(tenant, index) in tenants" :key="index" class="mb-3 p-3 bg-gray-50 rounded-lg">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <div class="mb-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                    <div class="text-gray-900 font-medium">{{ tenant.name || 'N/A' }}</div>
                                </div>
                                <div class="mb-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                    <div class="text-gray-900 font-medium">{{ tenant.phone || 'N/A' }}</div>
                                </div>
                                <div class="mb-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <div class="text-gray-900 font-medium">{{ tenant.email || 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Utilities, Inclusions, Restrictions Section -->
                <div v-if="hasUtilitiesInfo" class="bg-white rounded-2xl border border-gray-100 shadow-sm">
                    <div 
                        class="flex items-center justify-between p-4 cursor-pointer hover:bg-gray-50 transition-colors border-b border-gray-200"
                        @click="isUtilitiesOpen = !isUtilitiesOpen"
                    >
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                            </svg>
                            <h4 class="text-lg font-semibold text-gray-900">Utilities, Inclusions, Restrictions</h4>
                        </div>
                        <button
                            type="button"
                            class="flex items-center gap-2 text-black hover:text-gray-700 font-medium text-sm"
                            @click.stop="isUtilitiesOpen = !isUtilitiesOpen"
                        >
                            <svg
                                :class="`w-5 h-5 transform transition-transform duration-200 text-gray-400 ${isUtilitiesOpen ? 'rotate-180' : ''}`"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>
                    <div v-if="isUtilitiesOpen" class="p-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Water</label>
                            <div class="text-gray-900 font-medium">{{ data.utilities?.water || 'N/A' }}</div>
                        </div>
                        <div v-if="data.utilities?.water === 'Other'" class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Water Other Detail</label>
                            <div class="text-gray-900 font-medium">{{ data.utilities?.waterOtherDetail || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Electricity</label>
                            <div class="text-gray-900 font-medium">{{ data.utilities?.electricity || 'N/A' }}</div>
                        </div>
                        <div v-if="data.utilities?.electricity === 'Other'" class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Electricity Other Detail</label>
                            <div class="text-gray-900 font-medium">{{ data.utilities?.electricityOtherDetail || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Gas</label>
                            <div class="text-gray-900 font-medium">{{ data.utilities?.gas || 'N/A' }}</div>
                        </div>
                        <div v-if="data.utilities?.gas === 'Other'" class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Gas Other Detail</label>
                            <div class="text-gray-900 font-medium">{{ data.utilities?.gasOtherDetail || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Heat</label>
                            <div class="text-gray-900 font-medium">{{ data.utilities?.heat || 'N/A' }}</div>
                        </div>
                        <div v-if="data.utilities?.heat === 'Other'" class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Heat Other Detail</label>
                            <div class="text-gray-900 font-medium">{{ data.utilities?.heatOtherDetail || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Furnishing</label>
                            <div class="text-gray-900 font-medium">{{ data.utilities?.furnishing || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pets Allowed</label>
                            <div class="text-gray-900 font-medium">{{ data.utilities?.pets || 'N/A' }}</div>
                        </div>
                        <div v-if="data.utilities?.pets === 'Yes'" class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pet Restrictions</label>
                            <div class="text-gray-900 font-medium">{{ data.utilities?.petRestrictions || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Property Type</label>
                            <div class="text-gray-900 font-medium">{{ data.utilities?.propertyType || 'N/A' }}</div>
                        </div>
                        <div v-if="data.utilities?.propertyType === 'Condo'" class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Condo Restrictions</label>
                            <div class="text-gray-900 font-medium">{{ data.utilities?.condoRestrictions || 'N/A' }}</div>
                        </div>
                    </div>
                    <div v-if="data.utilities?.inclusions && data.utilities.inclusions.length > 0" class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Inclusions</label>
                        <div class="flex flex-wrap gap-2">
                            <span v-for="item in data.utilities.inclusions" :key="item" class="px-3 py-1 bg-gray-100 text-gray-800 rounded-lg text-sm">{{ item }}</span>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Other Details Section -->
                <div v-if="hasOtherInfo" class="bg-white rounded-2xl border border-gray-100 shadow-sm">
                    <div 
                        class="flex items-center justify-between p-4 cursor-pointer hover:bg-gray-50 transition-colors border-b border-gray-200"
                        @click="isOtherOpen = !isOtherOpen"
                    >
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                            <h4 class="text-lg font-semibold text-gray-900">Other Details</h4>
                        </div>
                        <button
                            type="button"
                            class="flex items-center gap-2 text-black hover:text-gray-700 font-medium text-sm"
                            @click.stop="isOtherOpen = !isOtherOpen"
                        >
                            <svg
                                :class="`w-5 h-5 transform transition-transform duration-200 text-gray-400 ${isOtherOpen ? 'rotate-180' : ''}`"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>
                    <div v-if="isOtherOpen" class="p-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Name of Strata Property Management Company</label>
                            <div class="text-gray-900 font-medium">{{ data.other?.strataCompany || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Strata Manager Name</label>
                            <div class="text-gray-900 font-medium">{{ data.other?.strataManagerName || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Strata Phone</label>
                            <div class="text-gray-900 font-medium">{{ data.other?.strataPhone || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Strata Email Address</label>
                            <div class="text-gray-900 font-medium">{{ data.other?.strataEmail || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Building Manager Name</label>
                            <div class="text-gray-900 font-medium">{{ data.other?.buildingManagerName || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Building Manager Phone</label>
                            <div class="text-gray-900 font-medium">{{ data.other?.buildingManagerPhone || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Building Manager Email Address</label>
                            <div class="text-gray-900 font-medium">{{ data.other?.buildingManagerEmail || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Move In Fees</label>
                            <div class="text-gray-900 font-medium">{{ formatCurrency(data.other?.moveInFees) || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Has Self-Contained Suite</label>
                            <div class="text-gray-900 font-medium">{{ data.other?.hasSelfContainedSuite || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Is Suite Tenanted</label>
                            <div class="text-gray-900 font-medium">{{ data.other?.suiteTenanted || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Suite Bedrooms</label>
                            <div class="text-gray-900 font-medium">{{ data.other?.suiteBedrooms || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Inground Sprinklers that need servicing?</label>
                            <div class="text-gray-900 font-medium">{{ data.other?.sprinklersService || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Fuse Box</label>
                            <div class="text-gray-900 font-medium">{{ data.other?.fuseBox || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">What floor are the amenities on?</label>
                            <div class="text-gray-900 font-medium">{{ data.other?.amenitiesFloor || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Which Floor/Stall/Locker is the Bike Storage at?</label>
                            <div class="text-gray-900 font-medium">{{ data.other?.bikeStorageLocation || 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Is it okay to put a sign up front?</label>
                            <div class="text-gray-900 font-medium">{{ data.other?.signUpFront || 'N/A' }}</div>
                        </div>
                    </div>
                    <div v-if="data.other?.amenities && data.other.amenities.length > 0" class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Amenities</label>
                        <div class="flex flex-wrap gap-2">
                            <span v-for="item in data.other.amenities" :key="item" class="px-3 py-1 bg-gray-100 text-gray-800 rounded-lg text-sm">{{ item }}</span>
                        </div>
                    </div>
                    <div v-if="data.other?.amenitiesOtherDetail" class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Utilities/Other Items Details</label>
                        <div class="p-3 bg-gray-50 rounded-lg text-gray-900 whitespace-pre-wrap">{{ data.other.amenitiesOtherDetail }}</div>
                    </div>
                    <div v-if="data.other?.maintenance && data.other.maintenance.length > 0" class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Maintenance</label>
                        <div v-for="(item, index) in data.other.maintenance" :key="index" class="mb-2 p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-gray-800">{{ item }}</span>
                                <span v-if="data.other?.maintenanceFrequencies?.[item]" class="text-sm text-gray-600">{{ data.other.maintenanceFrequencies[item] }}</span>
                            </div>
                        </div>
                    </div>
                    <div v-if="suiteTenants.length > 0 && suiteTenants[0].name" class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Self-Contained Suite Tenants</label>
                        <div v-for="(tenant, index) in suiteTenants" :key="index" class="mb-3 p-3 bg-gray-50 rounded-lg">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <div class="mb-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                    <div class="text-gray-900 font-medium">{{ tenant.name || 'N/A' }}</div>
                                </div>
                                <div class="mb-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                    <div class="text-gray-900 font-medium">{{ tenant.phone || 'N/A' }}</div>
                                </div>
                                <div class="mb-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <div class="text-gray-900 font-medium">{{ tenant.email || 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="data.other?.suiteOtherDetails" class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Other details about the suite</label>
                        <div class="p-3 bg-gray-50 rounded-lg text-gray-900 whitespace-pre-wrap">{{ data.other.suiteOtherDetails }}</div>
                    </div>
                    <div v-if="data.other?.garbageInfo" class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Garbage: Location, Disposal & Restrictions</label>
                        <div class="text-gray-900 font-medium">{{ data.other.garbageInfo || 'N/A' }}</div>
                    </div>
                    <div v-if="data.other?.amenitiesNotes" class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Any information about the location of the building amenities?</label>
                        <div class="p-3 bg-gray-50 rounded-lg text-gray-900 whitespace-pre-wrap">{{ data.other.amenitiesNotes }}</div>
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
const isOwnerOpen = ref(true);
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