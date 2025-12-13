<template>
    <div class="space-y-6">
        <div class="border border-gray-100 rounded-2xl bg-gray-50 shadow-sm hover:shadow-md transition-shadow duration-300">
            <div
                class="flex items-center justify-between p-4 bg-white border-b border-gray-200 cursor-pointer hover:bg-gray-50 transition-colors"
                @click="isOpen = !isOpen"
            >
                <div class="flex items-center gap-3 r-p-3">
                    <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm3 1h6v4H7V5zm6 6H7v2h6v-2z" clip-rule="evenodd" />
                    </svg>
                    <h3 class="text-lg font-semibold text-black">Rental Property Information & Features</h3>
                </div>
                <button
                    type="button"
                    class="flex items-center gap-2 text-black hover:text-gray-700 font-medium text-sm r-mr-3"
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
            <div v-if="isOpen" class="p-2 lg:p-5 space-y-5 sm:space-y-3">
                <!-- Address Row 1 -->
                <div class="space-y-3 bg-white rounded-2xl p-3 border border-gray-100 shadow-sm ">
                    <label class="flex items-center gap-3 text-base sm:text-lg lg:text-md text-gray-800">
                        <input type="checkbox" class="w-5 h-5 accent-black cursor-pointer focus:ring-black/10" :checked="sameAsMailing" @change="sameAsMailing = $event.target.checked" />
                        <span>Same as Mailing Address</span>
                    </label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                        <div>
                            <label class="block mb-2 text-gray-800">Unit & Suite #1</label>
                            <input
                                :value="d.unitSuite || ''"
                                @input="handleDataChange('rental.unitSuite', $event.target.value)"
                                class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                            />
                        </div>

                        <div>
                            <label class="block mb-2 text-gray-800">Street Address <span class="text-red-500">*</span></label>
                            <input
                                :value="d.streetAddress || ''"
                                @input="handleDataChange('rental.streetAddress', $event.target.value)"
                                :class="['w-full p-2 border-2 rounded-xl focus:ring-4 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl', validationErrors['rental.streetAddress'] ? 'border-red-500' : 'border-gray-200 focus:ring-black/10']"
                            />
                            <p v-if="validationErrors['rental.streetAddress']" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors['rental.streetAddress']) ? validationErrors['rental.streetAddress'][0] : validationErrors['rental.streetAddress'] }}</p>
                        </div>
                        <div>
                            <label class="block mb-2 text-gray-800">City <span class="text-red-500">*</span></label>
                            <input
                                :value="d.city || ''"
                                @input="handleDataChange('rental.city', $event.target.value)"
                                :class="['w-full p-2 border-2 rounded-xl focus:ring-4 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl', validationErrors['rental.city'] ? 'border-red-500' : 'border-gray-200 focus:ring-black/10']"
                            />
                            <p v-if="validationErrors['rental.city']" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors['rental.city']) ? validationErrors['rental.city'][0] : validationErrors['rental.city'] }}</p>
                        </div>
                        <div>
                            <label class="block mb-2 text-gray-800">Province <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select
                                    :value="d.province || ''"
                                    @change="handleDataChange('rental.province', $event.target.value)"
                                    :class="['w-full p-2 pr-12 sm:pr-14 md:pr-16 lg:pr-20 xl:pr-24 border-2 rounded-xl focus:ring-4 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white appearance-none cursor-pointer hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl', validationErrors['rental.province'] ? 'border-red-500' : 'border-gray-200 focus:ring-black/10']"
                                >
                                    <option value="">Select Province</option>
                                    <option v-for="p in provinces" :key="p" :value="p">{{ p }}</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 sm:pr-6 md:pr-8 lg:pr-17 xl:pr-3 pointer-events-none">
                                    <svg class="w-6 h-6 sm:w-7 sm:h-7 lg:w-8 lg:h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                            <p v-if="validationErrors['rental.province']" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors['rental.province']) ? validationErrors['rental.province'][0] : validationErrors['rental.province'] }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                        <div>
                            <label class="block mb-2 text-gray-800">Postal / ZIP Code <span class="text-red-500">*</span></label>
                            <input
                                :value="d.postalCode || ''"
                                @input="handleDataChange('rental.postalCode', $event.target.value)"
                                :class="['w-full p-2 border-2 rounded-xl focus:ring-4 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl', validationErrors['rental.postalCode'] ? 'border-red-500' : 'border-gray-200 focus:ring-black/10']"
                            />
                            <p v-if="validationErrors['rental.postalCode']" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors['rental.postalCode']) ? validationErrors['rental.postalCode'][0] : validationErrors['rental.postalCode'] }}</p>
                        </div>
                        <div>
                            <label class="block mb-2 text-gray-800">Neighborhood</label>
                            <input
                                :value="d.neighborhood || ''"
                                @input="handleDataChange('rental.neighborhood', $event.target.value)"
                                class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                            />
                        </div>

                        <div>
                            <label class="block mb-2 text-gray-800">Year Built</label>
                            <input
                                :value="d.yearBuilt || ''"
                                @input="handleDataChange('rental.yearBuilt', $event.target.value)"
                                class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                            />
                        </div>
                        <div>
                            <label class="block mb-2 text-gray-800">Total Floor Area (sq. ft.) <span class="text-red-500">*</span></label>
                            <input
                                :value="d.totalFloorArea || ''"
                                @input="handleDataChange('rental.totalFloorArea', $event.target.value)"
                                :class="['w-full p-2 border-2 rounded-xl focus:ring-4 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl', validationErrors['rental.totalFloorArea'] ? 'border-red-500' : 'border-gray-200 focus:ring-black/10']"
                            />
                            <p v-if="validationErrors['rental.totalFloorArea']" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors['rental.totalFloorArea']) ? validationErrors['rental.totalFloorArea'][0] : validationErrors['rental.totalFloorArea'] }}</p>
                        </div>
                    </div>
                </div>


                <!-- Keys -->
                <div class="space-y-3 bg-white rounded-2xl p-3 border border-gray-100 shadow-sm">
                    <h5 class="block text-gray-800 font-medium">Keys: if keys are provided, please explain our access to the keys. <span class="text-red-500">*</span></h5>
                    <p class="text-red-400 text-sm sm:text-base">We will need to be provided a set of keys and FOBs to facilitate a smooth access to the unit for viewings.</p>
                  
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 ">
                        <label
                            v-for="opt in ['Orca will pick up the key','Owner will drop off the keys at the Orca office']"
                            :key="opt"
                            class="flex items-center gap-3 text-gray-800"
                        >
                            <input
                                type="radio"
                                name="keys"
                                :value="opt"
                                :checked="(d.keys || '') === opt"
                                @change="handleDataChange('rental.keys', $event.target.value)"
                                class="w-5 h-5"
                            />
                            <span>{{ opt }}</span>
                        </label>
                        <label
                            class="flex items-center gap-3 text-gray-800"
                        >
                            <input
                                type="radio"
                                name="keys"
                                value="Other"
                                :checked="(d.keys || '') === 'Other'"
                                @change="handleDataChange('rental.keys', $event.target.value)"
                                class="w-5 h-5"
                            />
                            <span>Other</span>
                           
                        </label>
                    </div>
                    <div v-if="(d.keys || '') === 'Owner will drop off the keys at the Orca office'" class="">
                        <a
                            href="https://www.google.com/maps/place/Orca+Realty+Inc/@49.2646912,-123.0173043,17z/data=!3m2!4b1!5s0x548673755d87ee15:0xe1b64059410f4aa8!4m6!3m5!1s0x548673b431db1767:0x69c0f29159ec5745!8m2!3d49.2646912!4d-123.0147294!16s%2Fg%2F11b6xky108?coh=219816&entry=tts&g_ep=EgoyMDI0MDYxMS4wKgBIAVAD"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="text-blue-600 hover:text-blue-800 underline text-sm sm:text-base"
                        >
                            Drop off at Unit 201 - 3997 Henning Dr - Burnaby, BC, V5C 6N5 Canada
                        </a>
                    </div>
                    <div v-if="(d.keys || '') === 'Other'" class="">
                        <input
                            :value="d.keysOther || ''"
                            @input="handleDataChange('rental.keysOther', $event.target.value)"
                            placeholder="(e.g. currently overseas, contact my brother to deliver keys, keys)"
                            :class="['w-full p-2 border-2 rounded-xl focus:ring-4 focus:border-black transition-all duration-300 text-base sm:text-lg lg:text-xl text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl', validationErrors['rental.keysOther'] ? 'border-red-500' : 'border-gray-200 focus:ring-black/10']"
                        />
                        <p v-if="validationErrors['rental.keysOther']" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors['rental.keysOther']) ? validationErrors['rental.keysOther'][0] : validationErrors['rental.keysOther'] }}</p>
                    </div>
                    <p v-if="validationErrors['rental.keys'] && (d.keys || '') !== 'Other'" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors['rental.keys']) ? validationErrors['rental.keys'][0] : validationErrors['rental.keys'] }}</p>
                </div>

                <!-- Property Details -->
                <div class="space-y-3 bg-white rounded-2xl p-3 border border-gray-100 shadow-sm">
                    <label class=" text-gray-800 font-medium ">Property Details <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
                        <div v-for="label in ['Bedrooms','Bathrooms','Den','Balcony/Patio','Storage']" :key="label">
                            <label class="block mb-2 text-gray-800">{{ label }}</label>
                            <div class="relative">
                                <select
                                    :value="(d[featureKeyMap[label]] || '')"
                                    @change="handleDataChange(`rental.${featureKeyMap[label]}`, $event.target.value)"
                                    :class="['w-full p-2 pr-12 sm:pr-14 md:pr-16 lg:pr-20 xl:pr-24 border-2 rounded-xl focus:ring-4 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white appearance-none cursor-pointer hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl', validationErrors[`rental.${featureKeyMap[label]}`] ? 'border-red-500' : 'border-gray-200 focus:ring-black/10']"
                                >
                                    <option value="">Select</option>
                                    <option v-for="n in (['Den','Balcony/Patio','Storage'].includes(label) ? ['Yes','No'] : ['0','1','2','3','4','5','6','7','8','9','10+'])" :key="n" :value="n">{{ n }}</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 sm:pr-6 md:pr-8 lg:pr-17 xl:pr-3 pointer-events-none">
                                    <svg class="w-6 h-6 sm:w-7 sm:h-7 lg:w-8 lg:h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                            <p v-if="validationErrors[`rental.${featureKeyMap[label]}`]" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors[`rental.${featureKeyMap[label]}`]) ? validationErrors[`rental.${featureKeyMap[label]}`][0] : validationErrors[`rental.${featureKeyMap[label]}`] }}</p>
                        </div>
                    </div>
                </div>
                <!-- Fireplace -->
                <div class="space-y-3 bg-white rounded-2xl p-3 border border-gray-100 shadow-sm">
                    <label class="block text-gray-800 font-medium ">Type of Fireplace</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 ">
                        <label
                            v-for="label in ['Gas Fireplace','Wood Fireplace','Electric Fireplace','Not Available For This Property']"
                            :key="label"
                            class="flex items-center gap-3 text-gray-800"
                        >
                            <input
                                type="checkbox"
                                class="w-5 h-5 accent-black cursor-pointer focus:ring-black/10"
                                :checked="(d.fireplaceTypes || []).includes(label)"
                                @change="handleFireplaceChange(label, $event.target.checked)"
                            />
                            <span>{{ label }}</span>
                        </label>
                    </div>
                </div>

                <!-- Alarm Code -->
                <div class="space-y-3 bg-white rounded-2xl p-3 border border-gray-100 shadow-sm">
                    <label class="block mb-2 text-gray-800">Alarm Code <span class="text-red-400 text-sm sm:text-base">If available, please provide code below.</span></label>
                    <input
                        :value="d.alarmCode || ''"
                        @input="handleDataChange('rental.alarmCode', $event.target.value)"
                        class="w-full p-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                    />
                </div>

                <!-- Parking -->
                <div class="space-y-3 bg-white rounded-2xl p-3 border border-gray-100 shadow-sm">
                    <label class="block text-gray-800 font-medium">Parking <span class="text-red-400 text-sm sm:text-base">Please select all that applies</span></label>
                    <div class="space-y-4">
                        <div v-for="label in ['Underground','Attached/Detached Garage','Street','Carport']" :key="label" class="space-y-2">
                            <label class="flex items-center gap-3 text-gray-800">
                                <input
                                    type="checkbox"
                                    class="w-5 h-5 accent-black cursor-pointer focus:ring-black/10"
                                    :checked="isParkingChecked(label)"
                                    @change="handleParkingChange(label, $event.target.checked)"
                                />
                                <span>{{ label }}</span>
                                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </label>
                            <div v-if="isParkingChecked(label)" class="ml-8 space-y-2">
                                <input
                                    :value="getParkingCount(label) || ''"
                                    @input="handleParkingCountChange(label, $event.target.value)"
                                    placeholder="Enter the number of parking in this area (1-3)"
                                    type="number"
                                    class="w-full  p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                />
                                <!-- Parking Level & Stall # (shown when Underground is selected) -->
                                <div v-if="label === 'Underground'" class="space-y-2 mt-3">
                                    <label class="block text-gray-800 font-medium">Parking Level & Stall #</label>
                                    <p class="text-red-500 text-sm sm:text-base">Please provide the Parking Level & Stall Number</p>
                                    <input
                                        :value="d.parkingLevelStall || ''"
                                        @input="handleDataChange('rental.parkingLevelStall', $event.target.value)"
                                        placeholder="Enter parking level and stall number"
                                        class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Laundry -->
                <div class="space-y-3 bg-white rounded-2xl p-3 border border-gray-100 shadow-sm ">
                    <label class="block mb-2 text-gray-800">Laundry <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select
                            :value="d.laundry || ''"
                            @change="handleDataChange('rental.laundry', $event.target.value)"
                            :class="['w-full p-2 pr-12 sm:pr-14 md:pr-16 lg:pr-20 xl:pr-24 border-2 rounded-xl focus:ring-4 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white appearance-none cursor-pointer hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl', validationErrors['rental.laundry'] ? 'border-red-500' : 'border-gray-200 focus:ring-black/10']"
                        >
                            <option value="">Select</option>
                            <option v-for="o in ['In-Suite','Shared','None']" :key="o" :value="o">{{ o }}</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 sm:pr-6 md:pr-8 lg:pr-17 xl:pr-3 pointer-events-none">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 lg:w-8 lg:h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    <p v-if="validationErrors['rental.laundry']" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors['rental.laundry']) ? validationErrors['rental.laundry'][0] : validationErrors['rental.laundry'] }}</p>
                </div>

                <!-- Heating -->
                <div class="space-y-3 bg-white rounded-2xl p-3 border border-gray-100 shadow-sm">
                    <label class="block text-gray-800 font-medium">Heating of property</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <label
                            v-for="label in ['Forced Air','Radiant Hot water','Electric Baseboard','Other']"
                            :key="label"
                            class="flex items-center gap-3 text-gray-800"
                        >
                            <input
                                type="checkbox"
                                class="w-5 h-5 accent-black cursor-pointer focus:ring-black/10"
                                :checked="(d.heating || []).includes(label)"
                                @change="handleHeatingChange(label, $event.target.checked)"
                            />
                            <span>{{ label }}</span>
                        </label>
                    </div>
                    <!-- Heating Type (shown when Other is selected) -->
                    <div v-if="(d.heating || []).includes('Other')" class="space-y-2 mt-4 pt-4 border-t border-gray-200">
                        <label class="block text-gray-800 font-medium">Heating Type: <span class="text-red-500">*</span></label>
                        <p class="text-red-500 text-sm sm:text-base">Please provide the heating type</p>
                        <textarea
                            :value="d.heatingType || ''"
                            @input="handleDataChange('rental.heatingType', $event.target.value)"
                            placeholder="Enter heating type"
                            rows="4"
                            :class="['w-full p-2 border-2 rounded-xl focus:ring-4 focus:border-black transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl resize-y', validationErrors['rental.heatingType'] ? 'border-red-500' : 'border-gray-200 focus:ring-black/10']"
                        ></textarea>
                        <p v-if="validationErrors['rental.heatingType']" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors['rental.heatingType']) ? validationErrors['rental.heatingType'][0] : validationErrors['rental.heatingType'] }}</p>
                    </div>
                    <p v-if="validationErrors['rental.heating']" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors['rental.heating']) ? validationErrors['rental.heating'][0] : validationErrors['rental.heating'] }}</p>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex-shrink-0  r-pt-3 sm:mt-6 pt-4 sm:pt-6 border-t border-gray-200 bg-white flex flex-col sm:flex-row justify-between gap-3 sm:gap-4">
            <button
                v-if="onBack"
                @click="onBack"
                class="r-p-3 cursor-pointer bg-white text-black border border-gray-300 hover:bg-gray-50 px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl font-semibold flex items-center gap-2 transition-colors duration-200 shadow-sm hover:shadow-md"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Homeowner Details
            </button>

            <button
                v-if="onNext"
                @click="onNext"
                class="r-p-3 cursor-pointer bg-black hover:bg-gray-800 text-white px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl font-semibold flex items-center gap-2 transition-colors duration-200 shadow-lg hover:shadow-xl"
            >
                Occupancy and Property Availability
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue';

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

const isOpen = ref(true);
const sameAsMailing = ref(false);

// Watch for checkbox changes and copy mailing address to rental address
watch(sameAsMailing, (checked) => {
    if (checked) {
        // Copy mailing address fields to rental address fields
        if (props.formData.unitSuite) {
            emit('data-change', 'rental.unitSuite', props.formData.unitSuite);
        }
        if (props.formData.streetAddress) {
            emit('data-change', 'rental.streetAddress', props.formData.streetAddress);
        }
        if (props.formData.city) {
            emit('data-change', 'rental.city', props.formData.city);
        }
        if (props.formData.province) {
            emit('data-change', 'rental.province', props.formData.province);
        }
        if (props.formData.postalCode) {
            emit('data-change', 'rental.postalCode', props.formData.postalCode);
        }
    } else {
        // Clear rental address fields when unchecked
        emit('data-change', 'rental.unitSuite', '');
        emit('data-change', 'rental.streetAddress', '');
        emit('data-change', 'rental.city', '');
        emit('data-change', 'rental.province', '');
        emit('data-change', 'rental.postalCode', '');
    }
});

const provinces = [
    'Alberta',
    'British Columbia',
    'Manitoba',
    'New Brunswick',
    'Newfoundland and Labrador',
    'Northwest Territories',
    'Nova Scotia',
    'Nunavut',
    'Ontario',
    'Prince Edward Island',
    'Quebec',
    'Saskatchewan',
    'Yukon',
];

const d = computed(() => props.formData?.rental || {});

const featureKeyMap = {
    Bedrooms: 'bedrooms',
    Bathrooms: 'bathrooms',
    Den: 'den',
    'Balcony/Patio': 'balconypatio',
    Storage: 'storage',
};

const handleDataChange = (path, value) => {
    emit('data-change', path, value);
};

const handleFireplaceChange = (label, checked) => {
    const prev = (d.value.fireplaceTypes || []);
    const notAvailableLabel = 'Not Available For This Property';
    
    if (label === notAvailableLabel) {
        // If "Not Available For This Property" is checked, uncheck all others
        if (checked) {
            emit('data-change', 'rental.fireplaceTypes', [notAvailableLabel]);
        } else {
            // If unchecked, just remove it
            emit('data-change', 'rental.fireplaceTypes', []);
        }
    } else {
        // If any other option is checked, uncheck "Not Available For This Property"
        if (checked) {
            const next = prev.filter(x => x !== notAvailableLabel);
            next.push(label);
            emit('data-change', 'rental.fireplaceTypes', next);
        } else {
            // If unchecked, just remove it
            const next = prev.filter(x => x !== label);
            emit('data-change', 'rental.fireplaceTypes', next);
        }
    }
};

const isParkingChecked = (label) => {
    const parking = d.value.parking || {};
    return parking[label] !== undefined && parking[label] !== null;
};

const getParkingCount = (label) => {
    const parking = d.value.parking || {};
    return parking[label] || '';
};

const handleParkingChange = (label, checked) => {
    const prev = d.value.parking || {};
    const next = { ...prev };
    if (checked) {
        next[label] = prev[label] || '';
    } else {
        delete next[label];
    }
    emit('data-change', 'rental.parking', next);
};

const handleParkingCountChange = (label, value) => {
    const prev = d.value.parking || {};
    const next = { ...prev, [label]: value };
    emit('data-change', 'rental.parking', next);
};

const handleHeatingChange = (label, checked) => {
    const prev = (d.value.heating || []);
    const next = checked ? [...prev, label] : prev.filter(x => x !== label);
    emit('data-change', 'rental.heating', next);
};
</script>

