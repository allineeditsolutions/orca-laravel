<template>
    <div class="space-y-6">
        <!-- Occupancy -->
        <div class="border border-gray-100 rounded-2xl bg-gray-50 shadow-sm hover:shadow-md transition-shadow duration-300">
            <div
                class="flex items-center justify-between p-4 bg-white border-b border-gray-200 cursor-pointer hover:bg-gray-50 transition-colors"
                @click="isOccupancyOpen = !isOccupancyOpen"
            >
                <div class="flex items-center gap-3 r-p-3">
                    <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm3 1h6v4H7V5zm6 6H7v2h6v-2z" clip-rule="evenodd" />
                    </svg>
                    <h3 class="text-lg font-semibold text-black">Occupancy</h3>
                </div>
                <button
                    type="button"
                    class="flex items-center gap-2 text-black hover:text-gray-700 font-medium text-sm r-mr-3"
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
            <div v-if="isOccupancyOpen" class="p-2 lg:p-5 space-y-5 sm:space-y-3">
                <div class="space-y-3 bg-white rounded-2xl p-3 border border-gray-100 shadow-sm">
                    <label class="block mb-2 text-gray-800">The property is currently <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select
                            :value="d.occupancy?.availableAsap || ''"
                            @change="handleDataChange('occupancy.availableAsap', $event.target.value)"
                            :class="['w-full p-2 pr-12 sm:pr-14 md:pr-16 lg:pr-20 xl:pr-24 border-2 rounded-xl focus:ring-4 transition-all duration-300 text-base text-gray-900 bg-white appearance-none cursor-pointer hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl', validationErrors['occupancy.availableAsap'] ? 'border-red-500 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200 focus:ring-black/10 focus:border-black']"
                        >
                            <option value="">-- Select --</option>
                            <option v-for="opt in ['Owner Occupied', 'Tenant Occupied', 'Vacant']" :key="opt" :value="opt">{{ opt }}</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    <p v-if="validationErrors['occupancy.availableAsap']" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors['occupancy.availableAsap']) ? validationErrors['occupancy.availableAsap'][0] : validationErrors['occupancy.availableAsap'] }}</p>

                    <div v-if="d.occupancy?.availableAsap === 'Tenant Occupied'" class="space-y-4 mt-2 lg:mt-6">
                        <div>
                            <label class="block mb-2 text-gray-800">When is the current Tenant vacating? <span class="text-red-500">*</span></label>
                            <DatePicker
                                :modelValue="d.occupancy?.tenantVacatingDate ? new Date(d.occupancy.tenantVacatingDate) : null"
                                @update:modelValue="handleTenantVacatingDateChange"
                                dateFormat="yy-mm-dd"
                                placeholder="Select tenant vacating date"
                                :minDate="new Date()"
                                fluid
                                showIcon
                                :class="['w-full lg:w-60', validationErrors['occupancy.tenantVacatingDate'] ? 'border-red-500' : '']"
                                :manualInput="false"
                            />
                            <p v-if="validationErrors['occupancy.tenantVacatingDate']" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors['occupancy.tenantVacatingDate']) ? validationErrors['occupancy.tenantVacatingDate'][0] : validationErrors['occupancy.tenantVacatingDate'] }}</p>
                        </div>

                        <p class="text-red-500 text-sm sm:text-base">If currently Tenanted, please provide the Tenant Name and Contact Information</p>

                        <!-- Tenant Collapsible Section -->
                        <div class="border border-gray-100 rounded-2xl bg-gray-50 shadow-sm hover:shadow-md transition-shadow duration-300">
                            <div
                                class="flex items-center justify-between p-4 bg-white border-b border-gray-200 cursor-pointer hover:bg-gray-50 transition-colors"
                                @click="isTenantOpen = !isTenantOpen"
                            >
                                <div class="flex items-center gap-3 r-p-3">
                                    <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                    <h3 class="text-lg font-semibold text-black">Tenant</h3>
                                </div>
                                <button
                                    type="button"
                                    class="flex items-center gap-2 text-black hover:text-gray-700 font-medium text-sm r-mr-3"
                                    @click.stop="isTenantOpen = !isTenantOpen"
                                >
                                    <div class="bg-red-500 text-white p-1 rounded">
                                        <svg
                                            :class="`w-4 h-4 transform transition-transform duration-200 ${isTenantOpen ? 'rotate-180' : ''}`"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </button>
                            </div>

                            <!-- Tenant Occupied Section -->
                            <div v-if="isTenantOpen" class="p-6 space-y-5 sm:space-y-3">
                                <div v-for="(tenant, index) in tenants" :key="index" class="space-y-4" :class="{ 'pt-5 mt-5 border-t border-gray-200': index > 0 }">
                                    <div class="flex items-center justify-between mb-2">
                                        <h4 class="text-gray-800 font-medium">Tenant {{ index + 1 }}</h4>
                                        <button
                                            v-if="tenants.length > 1"
                                            type="button"
                                            @click="removeTenant(index)"
                                            class="flex items-center gap-2 text-red-500 hover:text-red-700 font-medium text-sm px-3 py-1 rounded-lg hover:bg-red-50 transition-colors"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Remove
                                        </button>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 sm:gap-6 md:gap-6 lg:gap-3">
                                        <div class="bg-gray-50 rounded-2xl p-3 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                                            <label class="flex items-center gap-2 text-base sm:text-lg lg:text-md text-gray-800 mb-2">
                                                Tenant Name <span class="text-red-500 text-xl">*</span>
                                            </label>
                                            <input
                                                type="text"
                                                :value="tenant.name || ''"
                                                @input="handleTenantChange(index, 'name', $event.target.value)"
                                                placeholder="Tenant Name"
                                                :class="['w-full p-2 border-2 rounded-xl focus:ring-4 transition-all duration-300 text-base sm:text-lg lg:text-xl text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl', validationErrors[`occupancy.tenants.${index}.name`] ? 'border-red-500 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200 focus:ring-black/10 focus:border-black']"
                                            />
                                            <p v-if="validationErrors[`occupancy.tenants.${index}.name`]" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors[`occupancy.tenants.${index}.name`]) ? validationErrors[`occupancy.tenants.${index}.name`][0] : validationErrors[`occupancy.tenants.${index}.name`] }}</p>
                                        </div>
                                        <div class="bg-gray-50 rounded-2xl p-3 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                                            <label class="flex items-center gap-2 text-base sm:text-lg lg:text-md text-gray-800 mb-2">
                                                Tenant Phone <span class="text-red-500 text-xl">*</span>
                                            </label>
                                            <input
                                                type="tel"
                                                :value="tenant.phone || ''"
                                                @input="handleTenantPhoneChange(index, $event.target.value)"
                                                placeholder="(000) 000-0000"
                                                :class="['w-full p-2 border-2 rounded-xl focus:ring-4 transition-all duration-300 text-base sm:text-lg lg:text-xl text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl', validationErrors[`occupancy.tenants.${index}.phone`] ? 'border-red-500 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200 focus:ring-black/10 focus:border-black']"
                                            />
                                            <p v-if="validationErrors[`occupancy.tenants.${index}.phone`]" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors[`occupancy.tenants.${index}.phone`]) ? validationErrors[`occupancy.tenants.${index}.phone`][0] : validationErrors[`occupancy.tenants.${index}.phone`] }}</p>
                                        </div>
                                        <div class="bg-gray-50 rounded-2xl p-3 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                                            <label class="flex items-center gap-2 text-base sm:text-lg lg:text-md text-gray-800 mb-2">
                                                Tenant Email Address <span class="text-red-500 text-xl">*</span>
                                            </label>
                                            <input
                                                type="email"
                                                :value="tenant.email || ''"
                                                @input="handleTenantChange(index, 'email', $event.target.value)"
                                                placeholder="Tenant Email Address"
                                                :class="['w-full p-2 border-2 rounded-xl focus:ring-4 transition-all duration-300 text-base sm:text-lg lg:text-xl text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl', validationErrors[`occupancy.tenants.${index}.email`] ? 'border-red-500 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200 focus:ring-black/10 focus:border-black']"
                                            />
                                            <p v-if="validationErrors[`occupancy.tenants.${index}.email`]" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors[`occupancy.tenants.${index}.email`]) ? validationErrors[`occupancy.tenants.${index}.email`][0] : validationErrors[`occupancy.tenants.${index}.email`] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <button
                                    type="button"
                                    @click="addTenant"
                                    class="flex items-center gap-2 text-gray-700 hover:text-gray-900 font-medium text-sm px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50 transition-colors bg-white cursor-pointer"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Add Another Tenant
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>

        <!-- Property Availability -->
        <div class="border border-gray-100 rounded-2xl bg-gray-50 shadow-sm hover:shadow-md transition-shadow duration-300">
            <div
                class="flex items-center justify-between p-4 bg-white border-b border-gray-200 cursor-pointer hover:bg-gray-50 transition-colors"
                @click="isAvailabilityOpen = !isAvailabilityOpen"
            >
                <div class="flex items-center gap-3 r-p-3">
                    <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm3 1h6v4H7V5zm6 6H7v2h6v-2z" clip-rule="evenodd" />
                    </svg>
                    <h3 class="text-lg font-semibold text-black">Property Availability</h3>
                </div>
                <button
                    type="button"
                    class="flex items-center gap-2 text-black hover:text-gray-700 font-medium text-sm r-mr-3"
                    @click.stop="isAvailabilityOpen = !isAvailabilityOpen"
                >
                    <svg
                        :class="`w-5 h-5 transform transition-transform duration-200 text-gray-400 ${isAvailabilityOpen ? 'rotate-180' : ''}`"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>
            <div v-if="isAvailabilityOpen" class="p-6 space-y-5 sm:space-y-3">
                <!-- Current Plan Row -->
                <div>
                    <p class="text-gray-800 font-medium mb-4">Current Plan <span class="text-red-500">*</span></p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-3">
                        <div class="bg-white rounded-2xl p-3 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300 ">
                            <label class="block mb-2 text-gray-800">Is the property available to be rented ASAP?</label>
                            <div class="relative">
                                <select
                                    :value="d.occupancy?.renovationPlans || ''"
                                    @change="handleDataChange('occupancy.renovationPlans', $event.target.value)"
                                    :class="['w-full p-2 pr-12 sm:pr-14 md:pr-16 lg:pr-20 xl:pr-24 border-2 rounded-xl focus:ring-4 transition-all duration-300 text-base text-gray-900 bg-white appearance-none cursor-pointer hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl', validationErrors['occupancy.renovationPlans'] ? 'border-red-500 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200 focus:ring-black/10 focus:border-black']"
                                >
                                    <option value="">-- Select --</option>
                                    <option v-for="o in yesNoOptions" :key="o" :value="o">{{ o }}</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                            <p v-if="validationErrors['occupancy.renovationPlans']" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors['occupancy.renovationPlans']) ? validationErrors['occupancy.renovationPlans'][0] : validationErrors['occupancy.renovationPlans'] }}</p>
                            <div v-if="d.occupancy?.renovationPlans === 'No'" class="mt-4">
                                <label class="block mb-2 text-gray-800">Availability Date</label>
                                <div class="relative">
                                    <input
                                        type="date"
                                        :value="d.occupancy?.availabilityDate || ''"
                                        @change="handleDataChange('occupancy.availabilityDate', $event.target.value)"
                                        class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white appearance-none cursor-pointer hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-2xl p-3 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                            <label class="block mb-2 text-gray-800">Are there any immediate plans for renovation on the property?</label>
                            <div class="relative">
                                <select
                                    :value="d.occupancy?.fixedTermOnly || ''"
                                    @change="handleDataChange('occupancy.fixedTermOnly', $event.target.value)"
                                    class="w-full p-2 pr-12 sm:pr-14 md:pr-16 lg:pr-20 xl:pr-24 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white appearance-none cursor-pointer hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                >
                                    <option value="">-- Select --</option>
                                    <option v-for="o in yesNoOptions" :key="o" :value="o">{{ o }}</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                            <div v-if="d.occupancy?.fixedTermOnly === 'Yes'" class="mt-4">
                                <label class="block mb-2 text-gray-800">Describe expected renovations</label>
                                <div class="relative">
                                    <textarea
                                        :value="d.occupancy?.expectedRenovations || ''"
                                        @input="handleDataChange('occupancy.expectedRenovations', $event.target.value)"
                                        rows="4"
                                        class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white appearance-none cursor-pointer hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl resize-y"
                                    ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-2xl p-3 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                            <label class="block mb-2 text-gray-800">Do you need a single, fixed-term Tenancy? Meaning you will move back into the home with 100% certainty after this first fixed term? (usually 1 year)</label>
                            <div class="relative">
                                <select
                                    :value="d.occupancy?.boostAd || ''"
                                    @change="handleDataChange('occupancy.boostAd', $event.target.value)"
                                    class="w-full p-2 pr-12 sm:pr-14 md:pr-16 lg:pr-20 xl:pr-24 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white appearance-none cursor-pointer hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                >
                                    <option value="">-- Select --</option>
                                    <option v-for="o in yesNoOptions" :key="o" :value="o">{{ o }}</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                            <div v-if="d.occupancy?.boostAd === 'Yes'" class="mt-4">
                                <label class="block mb-2 text-gray-800">Fixed-term Tenancy Description</label>
                                <div class="relative">
                                    <textarea
                                        :value="d.occupancy?.fixedTermTenancyDescription || ''"
                                        @input="handleDataChange('occupancy.fixedTermTenancyDescription', $event.target.value)"
                                        rows="4"
                                        class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white appearance-none cursor-pointer hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl resize-y"
                                    ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-2xl p-3 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                            <label class="block mb-2 text-gray-800">Do you wish to boost and highlight your advertisement on some of the online classified platforms? $200 - (100% optional but recommended)</label>
                            <div class="relative">
                                <select
                                    class="w-full p-2 pr-12 sm:pr-14 md:pr-16 lg:pr-20 xl:pr-24 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white appearance-none cursor-pointer hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                >
                                    <option value="">-- Select --</option>
                                    <option v-for="o in yesNoOptions" :key="o" :value="o">{{ o }}</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Anticipated occupancy date -->
                    <div class="space-y-3 bg-white rounded-2xl p-3 border border-gray-100 shadow-sm">
                        <label class="block mb-2 text-gray-800">Anticipated occupancy date for Tenants to move in <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <DatePicker
                                :modelValue="d.occupancy?.anticipatedDate ? new Date(d.occupancy.anticipatedDate) : null"
                                @update:modelValue="handleAnticipatedDateChange"
                                dateFormat="yy-mm-dd"
                                placeholder="Select anticipated occupancy date"
                                :minDate="new Date()"
                                fluid
                                :class="['w-full', validationErrors['occupancy.anticipatedDate'] ? 'border-red-500' : '']"
                                :manualInput="false"
                            />
                        </div>
                        <p v-if="validationErrors['occupancy.anticipatedDate']" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors['occupancy.anticipatedDate']) ? validationErrors['occupancy.anticipatedDate'][0] : validationErrors['occupancy.anticipatedDate'] }}</p>
                    </div>

                <!-- Long vs Short term -->
                <div class="space-y-3 bg-white rounded-2xl p-3 border border-gray-100 shadow-sm">
                    <label class="block mb-3 text-gray-800">Is this going to be a long-term or short-term rental? <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <label
                            v-for="label in ['Long-term, 1 year +', 'Short-term, less than 1 year', 'Other']"
                            :key="label"
                            class="flex items-center gap-3 text-gray-800 cursor-pointer"
                        >
                            <input
                                type="radio"
                                name="term"
                                class="w-5 h-5"
                                :checked="d.occupancy?.rentalTerm === label"
                                @change="handleDataChange('occupancy.rentalTerm', label)"
                            />
                            <span>{{ label }}</span>
                        </label>
                    </div>
                    <p v-if="validationErrors['occupancy.rentalTerm']" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors['occupancy.rentalTerm']) ? validationErrors['occupancy.rentalTerm'][0] : validationErrors['occupancy.rentalTerm'] }}</p>
                    <div v-if="d.occupancy?.rentalTerm === 'Short-term, less than 1 year'" class="mt-4">
                        <label class="block mb-2 text-gray-800">Please provide the property availability information.</label>
                        <div class="relative">
                            <input
                                type="text"
                                :value="d.occupancy?.shortTermAvailabilityInfo || ''"
                                @input="handleDataChange('occupancy.shortTermAvailabilityInfo', $event.target.value)"
                                class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base sm:text-lg lg:text-xl text-gray-900 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl font-medium"
                            />
                        </div>
                    </div>
                    <!-- Availability (shown when Other is selected) -->
                    <div v-if="d.occupancy?.rentalTerm === 'Other'" class="mt-4 space-y-2">
                        <label class="block text-gray-800 font-medium">Availability: <span class="text-red-500">*</span></label>
                        <p class="text-red-500 text-sm sm:text-base">Please provide the property availability information.</p>
                        <textarea
                            :value="d.occupancy?.availabilityInfo || ''"
                            @input="handleDataChange('occupancy.availabilityInfo', $event.target.value)"
                            placeholder="Enter property availability information"
                            rows="4"
                            :class="['w-full p-2 border-2 rounded-xl focus:ring-4 transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl resize-y', validationErrors['occupancy.availabilityInfo'] ? 'border-red-500 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200 focus:ring-black/10 focus:border-black']"
                        ></textarea>
                        <p v-if="validationErrors['occupancy.availabilityInfo']" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors['occupancy.availabilityInfo']) ? validationErrors['occupancy.availabilityInfo'][0] : validationErrors['occupancy.availabilityInfo'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex-shrink-0 r-mt-3 r-pt-3 sm:mt-6 pt-4 sm:pt-6 border-t border-gray-200 bg-white flex flex-col sm:flex-row justify-between gap-3 sm:gap-4">
            <button
                v-if="onBack"
                @click="onBack"
                class="r-p-3 cursor-pointer bg-white text-black border border-gray-300 hover:bg-gray-50 px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl font-semibold flex items-center gap-2 transition-colors duration-200 shadow-sm hover:shadow-md"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Rental Property Information & Features
            </button>

            <button
                v-if="onNext"
                @click="onNext"
                class="r-p-3 cursor-pointer bg-black hover:bg-gray-800 text-white px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl font-semibold flex items-center gap-2 transition-colors duration-200 shadow-lg hover:shadow-xl"
            >
                Utilities, Inclusions, Restrictions
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import DatePicker from 'primevue/datepicker';

const props = defineProps({
    onBack: Function,
    onNext: Function,
    formData: {
        type: Object,
        default: () => ({}),
    },
    validationErrors: {
        type: Object,
        default: () => ({}),
    },
});

const emit = defineEmits(['data-change']);

const isOccupancyOpen = ref(true);
const isAvailabilityOpen = ref(true);
const isTenantOpen = ref(true);

const yesNoOptions = ['Yes', 'No'];

const d = computed(() => props.formData || {});

// Handle tenants array - convert from old format if needed
const tenants = computed(() => {
    const occupancy = d.value.occupancy || {};
    
    // If tenants array already exists, use it
    if (Array.isArray(occupancy.tenants)) {
        return occupancy.tenants.length > 0 ? occupancy.tenants : [{ name: '', phone: '', email: '' }];
    }
    
    // If old format exists (single tenant fields), convert to array
    if (occupancy.tenantName || occupancy.tenantPhone || occupancy.tenantEmail) {
        return [{
            name: occupancy.tenantName || '',
            phone: occupancy.tenantPhone || '',
            email: occupancy.tenantEmail || ''
        }];
    }
    
    // Default: return array with one empty tenant
    return [{ name: '', phone: '', email: '' }];
});

const handleDataChange = (path, value) => {
    emit('data-change', path, value);
};

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

const handleTenantChange = (index, field, value) => {
    const currentTenants = [...tenants.value];
    currentTenants[index] = {
        ...currentTenants[index],
        [field]: value
    };
    emit('data-change', 'occupancy.tenants', currentTenants);
};

const handleTenantPhoneChange = (index, value) => {
    const formatted = formatPhoneNumber(value);
    handleTenantChange(index, 'phone', formatted);
};

const addTenant = () => {
    const currentTenants = [...tenants.value];
    currentTenants.push({ name: '', phone: '', email: '' });
    emit('data-change', 'occupancy.tenants', currentTenants);
};

const removeTenant = (index) => {
    const currentTenants = [...tenants.value];
    currentTenants.splice(index, 1);
    emit('data-change', 'occupancy.tenants', currentTenants);
};

const handleAnticipatedDateChange = (date) => {
    if (date) {
        // Format date as YYYY-MM-DD
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        const formattedDate = `${year}-${month}-${day}`;
        emit('data-change', 'occupancy.anticipatedDate', formattedDate);
    } else {
        emit('data-change', 'occupancy.anticipatedDate', '');
    }
};

const handleTenantVacatingDateChange = (date) => {
    if (date) {
        // Format date as YYYY-MM-DD
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        const formattedDate = `${year}-${month}-${day}`;
        emit('data-change', 'occupancy.tenantVacatingDate', formattedDate);
    } else {
        emit('data-change', 'occupancy.tenantVacatingDate', '');
    }
};
</script>

