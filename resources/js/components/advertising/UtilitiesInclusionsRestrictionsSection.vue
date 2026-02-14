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
                    <h3 class="text-lg font-semibold text-black">Utilities, Inclusions, Restrictions</h3>
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
                <!-- Property Details - Utilities -->
                <div class="space-y-3 bg-white rounded-2xl p-3 border border-gray-100 shadow-sm">
                    <h5 class="text-gray-800 font-medium mb-4">Property Details <span class="text-red-500">*</span></h5>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                        <div>
                            <label class="block mb-2 text-gray-800">Water</label>
                            <div class="relative">
                                <select
                                    :value="utilities.water || ''"
                                    @change="handleDataChange('utilities.water', $event.target.value)"
                                    :class="['w-full p-2 pr-12 sm:pr-14 md:pr-16 lg:pr-20 xl:pr-24 border-2 rounded-xl focus:ring-4 transition-all duration-300 text-base text-gray-900 bg-white appearance-none cursor-pointer hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl', validationErrors['utilities.water'] ? 'border-red-500 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200 focus:ring-black/10 focus:border-black']"
                                >
                                    <option value="">-- Select --</option>
                                    <option value="Included in Rent">Included in Rent</option>
                                    <option value="Not Included in Rent">Not Included in Rent</option>
                                    <option value="Split">Split</option>
                                    <option value="Not applicable to the property">Not applicable to the property</option>
                                    <option value="Other">Other</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                            <p v-if="validationErrors['utilities.water']" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors['utilities.water']) ? validationErrors['utilities.water'][0] : validationErrors['utilities.water'] }}</p>
                            <div v-if="d.utilities?.water === 'Split'" class="mt-3 space-y-2">
                                <div class="flex items-center gap-2 text-red-500 text-xs">
                                    <span>i.e 30 - (Tenant is responsible for 30% of the utility)</span>
                                </div>
                                <input
                                    type="text"
                                    :value="d.utilities?.waterSplitDetail || ''"
                                    @input="handleDataChange('utilities.waterSplitDetail', $event.target.value)"
                                    placeholder=""
                                    class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base  text-gray-900 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                />
                            </div>
                            <div v-if="d.utilities?.water === 'Other'" class="mt-3">
                                <label class="block mb-2 text-xs text-red-500">Please Specify</label>
                                <input
                                    type="text"
                                    :value="d.utilities?.waterOtherDetail || ''"
                                    @input="handleDataChange('utilities.waterOtherDetail', $event.target.value)"
                                    class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                />
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-gray-800">Electricity</label>
                            <div class="relative">
                                <select
                                    :value="utilities.electricity || ''"
                                    @change="handleDataChange('utilities.electricity', $event.target.value)"
                                    :class="['w-full p-2 pr-12 sm:pr-14 md:pr-16 lg:pr-20 xl:pr-24 border-2 rounded-xl focus:ring-4 transition-all duration-300 text-base text-gray-900 bg-white appearance-none cursor-pointer hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl', validationErrors['utilities.electricity'] ? 'border-red-500 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200 focus:ring-black/10 focus:border-black']"
                                >
                                    <option value="">-- Select --</option>
                                    <option value="Included in Rent">Included in Rent</option>
                                    <option value="Not Included in Rent">Not Included in Rent</option>
                                    <option value="Split">Split</option>
                                    <option value="Not applicable to the property">Not applicable to the property</option>
                                    <option value="Other">Other</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                            <p v-if="validationErrors['utilities.electricity']" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors['utilities.electricity']) ? validationErrors['utilities.electricity'][0] : validationErrors['utilities.electricity'] }}</p>
                            <div v-if="d.utilities?.electricity === 'Split'" class="mt-3 space-y-2">
                                <div class="flex items-center gap-2 text-red-500 text-xs">
                                    <span>i.e 30 - (Tenant is responsible for 30% of the utility)</span>
                                </div>
                                <input
                                    type="text"
                                    :value="d.utilities?.electricitySplitDetail || ''"
                                    @input="handleDataChange('utilities.electricitySplitDetail', $event.target.value)"
                                    placeholder=""
                                    class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                />
                            </div>
                            <div v-if="d.utilities?.electricity === 'Other'" class="mt-3">
                                <label class="block mb-2 text-xs text-red-500">Please Specify</label>
                                <input
                                    type="text"
                                    :value="d.utilities?.electricityOtherDetail || ''"
                                    @input="handleDataChange('utilities.electricityOtherDetail', $event.target.value)"
                                    class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                />
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-gray-800">Gas</label>
                            <div class="relative">
                                <select
                                    :value="utilities.gas || ''"
                                    @change="handleDataChange('utilities.gas', $event.target.value)"
                                    :class="['w-full p-2 pr-12 sm:pr-14 md:pr-16 lg:pr-20 xl:pr-24 border-2 rounded-xl focus:ring-4 transition-all duration-300 text-base text-gray-900 bg-white appearance-none cursor-pointer hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl', validationErrors['utilities.gas'] ? 'border-red-500 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200 focus:ring-black/10 focus:border-black']"
                                >
                                    <option value="">-- Select --</option>
                                    <option value="Included in Rent">Included in Rent</option>
                                    <option value="Not Included in Rent">Not Included in Rent</option>
                                    <option value="Split">Split</option>
                                    <option value="Not applicable to the property">Not applicable to the property</option>
                                    <option value="Other">Other</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                            <p v-if="validationErrors['utilities.gas']" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors['utilities.gas']) ? validationErrors['utilities.gas'][0] : validationErrors['utilities.gas'] }}</p>
                            <div v-if="d.utilities?.gas === 'Split'" class="mt-3 space-y-2">
                                <div class="flex items-center gap-2 text-red-500 text-xs">
                                    <span>i.e 30 - (Tenant is responsible for 30% of the utility)</span>
                                </div>
                                <input
                                    type="text"
                                    :value="d.utilities?.gasSplitDetail || ''"
                                    @input="handleDataChange('utilities.gasSplitDetail', $event.target.value)"
                                    placeholder=""
                                    class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                />
                            </div>
                            <div v-if="d.utilities?.gas === 'Other'" class="mt-3">
                                <label class="block mb-2 text-xs text-red-500">Please Specify</label>
                                <input
                                    type="text"
                                    :value="d.utilities?.gasOtherDetail || ''"
                                    @input="handleDataChange('utilities.gasOtherDetail', $event.target.value)"
                                    class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                />
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-gray-800">Heat</label>
                            <div class="relative">
                                <select
                                    :value="utilities.heat || ''"
                                    @change="handleDataChange('utilities.heat', $event.target.value)"
                                    :class="['w-full p-2 pr-12 sm:pr-14 md:pr-16 lg:pr-20 xl:pr-24 border-2 rounded-xl focus:ring-4 transition-all duration-300 text-base text-gray-900 bg-white appearance-none cursor-pointer hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl', validationErrors['utilities.heat'] ? 'border-red-500 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200 focus:ring-black/10 focus:border-black']"
                                >
                                    <option value="">-- Select --</option>
                                    <option value="Included in Rent">Included in Rent</option>
                                    <option value="Not Included in Rent">Not Included in Rent</option>
                                    <option value="Split">Split</option>
                                    <option value="Not applicable to the property">Not applicable to the property</option>
                                    <option value="Other">Other</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                            <p v-if="validationErrors['utilities.heat']" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors['utilities.heat']) ? validationErrors['utilities.heat'][0] : validationErrors['utilities.heat'] }}</p>
                            <div v-if="d.utilities?.heat === 'Split'" class="mt-3 space-y-2">
                                <div class="flex items-center gap-2 text-red-500 text-xs">
                                    <span>i.e 30 - (Tenant is responsible for 30% of the utility)</span>
                                </div>
                                <input
                                    type="text"
                                    :value="d.utilities?.heatSplitDetail || ''"
                                    @input="handleDataChange('utilities.heatSplitDetail', $event.target.value)"
                                    placeholder=""
                                    class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl "
                                />
                            </div>
                            <div v-if="d.utilities?.heat === 'Other'" class="mt-3">
                                <label class="block mb-2 text-xs text-red-500">Please Specify</label>
                                <input
                                    type="text"
                                    :value="d.utilities?.heatOtherDetail || ''"
                                    @input="handleDataChange('utilities.heatOtherDetail', $event.target.value)"
                                    class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base text-gray-900 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inclusions checklist -->
                <div class="space-y-3 bg-white rounded-2xl p-3 border border-gray-100 shadow-sm">
                    <label class="block text-gray-800 font-medium">Kindly tick utilities/other items INCLUDED with the rental property.</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <label
                            v-for="label in inclusionsOptions"
                            :key="label"
                            class="flex items-center gap-3 text-gray-800 cursor-pointer"
                        >
                            <input
                                type="checkbox"
                                class="w-5 h-5 accent-black cursor-pointer focus:ring-black/10"
                                :checked="(d.utilities?.inclusions || []).includes(label)"
                                @change="handleInclusionChange(label, $event.target.checked)"
                            />
                            <span>{{ label }}</span>
                        </label>
                    </div>
                    <!-- Other items details (shown when Other is selected) -->
                    <div v-if="(d.utilities?.inclusions || []).includes('Other')" class="mt-4 space-y-2 pt-4 border-t border-gray-200">
                        <label class="block text-gray-800 font-medium">Please provide details about the other items <span class="text-red-500">*</span></label>
                        <textarea
                            :value="d.utilities?.inclusionsOtherDetail || ''"
                            @input="handleDataChange('utilities.inclusionsOtherDetail', $event.target.value)"
                            placeholder="Enter details about other items"
                            rows="4"
                            :class="['w-full p-2 border-2 rounded-xl focus:ring-4 transition-all duration-300 text-base text-gray-900 placeholder-gray-400 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl resize-y', validationErrors['utilities.inclusionsOtherDetail'] ? 'border-red-500 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200 focus:ring-black/10 focus:border-black']"
                        ></textarea>
                        <p v-if="validationErrors['utilities.inclusionsOtherDetail']" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors['utilities.inclusionsOtherDetail']) ? validationErrors['utilities.inclusionsOtherDetail'][0] : validationErrors['utilities.inclusionsOtherDetail'] }}</p>
                    </div>
                </div>

                <!-- Furnishings -->
                <div class="space-y-3 bg-white rounded-2xl p-3 border border-gray-100 shadow-sm">
                    <h5 class="text-gray-800 font-medium mb-4">The Property is <span class="text-red-500">*</span></h5>
                    
                    <p class="text-sm text-red-500">For furnished homes the home owner must provide Orca Realty a detailed inventory list of which furniture will be included in the rent</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 r-mt-1">
                        <label
                            v-for="label in ['Unfurnished', 'Furnished']"
                            :key="label"
                            class="flex items-center gap-3 text-gray-800 cursor-pointer"
                        >
                            <input
                                type="radio"
                                name="furnishing"
                                class="w-5 h-5 accent-black cursor-pointer"
                                :checked="d.utilities?.furnishing === label"
                                @change="handleDataChange('utilities.furnishing', label)"
                            />
                            <span>{{ label }}</span>
                        </label>
                    </div>
                    <p v-if="validationErrors['utilities.furnishing']" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors['utilities.furnishing']) ? validationErrors['utilities.furnishing'][0] : validationErrors['utilities.furnishing'] }}</p>
                </div>

                <!-- Pets -->
                <div class="space-y-3 bg-white rounded-2xl p-3 border border-gray-100 shadow-sm">
                    <h5 class="text-gray-800 font-medium">Are Cats or Dogs allowed?</h5>
                    <div class="relative">
                            <select
                                :value="d.utilities?.pets || ''"
                                @change="handleDataChange('utilities.pets', $event.target.value)"
                                class="w-full p-2 pr-12 sm:pr-14 md:pr-16 lg:pr-20 xl:pr-24 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base  text-gray-900 bg-white appearance-none cursor-pointer hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl"
                            >
                                <option value="">-- Select --</option>
                                <option value="Yes, with owners approval">Yes, with owners approval</option>
                                <option value="No">No</option>
                                <option value="Other">Other</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    <div v-if="d.utilities?.pets === 'Other'" class="mt-3 space-y-2">
                        <label class="block mb-2 text-gray-800">Please explain</label>
                        <p class="text-red-500 text-sm">Help us understand why you chose this option. (i.e strata rules / allergies or if one or the other is allowed, etc.)</p>
                        <textarea
                            :value="d.utilities?.petsOtherDetail || ''"
                            @input="handleDataChange('utilities.petsOtherDetail', $event.target.value)"
                            rows="4"
                            class="w-full p-2 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-black/10 focus:border-black transition-all duration-300 text-base sm:text-lg lg:text-xl text-gray-900 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl font-medium resize-y"
                        ></textarea>
                    </div>
                </div>

                <!-- Property Type -->
                <div class="space-y-2 r-mt-3">
                    <label class="block text-gray-800 font-medium">Type of Property <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <label
                            v-for="label in ['House', 'Apartment/Condo', 'Townhouse', 'Other']"
                            :key="label"
                            class="flex items-center gap-3 text-gray-800 cursor-pointer"
                        >
                            <input
                                type="radio"
                                name="propertyType"
                                class="w-5 h-5 accent-black cursor-pointer"
                                :checked="d.utilities?.propertyType === label"
                                @change="handleDataChange('utilities.propertyType', label)"
                            />
                            <span>{{ label }}</span>
                        </label>
                    </div>
                    <p v-if="validationErrors['utilities.propertyType']" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors['utilities.propertyType']) ? validationErrors['utilities.propertyType'][0] : validationErrors['utilities.propertyType'] }}</p>
                    <div v-if="d.utilities?.propertyType === 'Other'" class="mt-3 space-y-2">
                        <label class="block mb-2 text-gray-800">Property Type <span class="text-red-500">*</span></label>
                        <p class="text-red-500 text-sm">Please provide the Property Type</p>
                        <textarea
                            :value="d.utilities?.propertyTypeOtherDetail || ''"
                            @input="handleDataChange('utilities.propertyTypeOtherDetail', $event.target.value)"
                            rows="4"
                            :class="['w-full p-2 border-2 rounded-xl focus:ring-4 transition-all duration-300 text-base text-gray-900 bg-white hover:border-gray-400 hover:shadow-lg shadow-md focus:shadow-xl resize-y', validationErrors['utilities.propertyTypeOtherDetail'] ? 'border-red-500 focus:ring-red-500/20 focus:border-red-500' : 'border-gray-200 focus:ring-black/10 focus:border-black']"
                        ></textarea>
                        <p v-if="validationErrors['utilities.propertyTypeOtherDetail']" class="mt-1 text-sm text-red-600">{{ Array.isArray(validationErrors['utilities.propertyTypeOtherDetail']) ? validationErrors['utilities.propertyTypeOtherDetail'][0] : validationErrors['utilities.propertyTypeOtherDetail'] }}</p>
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
                Occupancy and Property Availability
            </button>

            <button
                v-if="onNext"
                @click="onNext"
                class="r-p-3 cursor-pointer bg-black hover:bg-gray-800 text-white px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl font-semibold flex items-center gap-2 transition-colors duration-200 shadow-lg hover:shadow-xl"
            >
                Other Details
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';

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

const inclusionsOptions = [
    'Stove/Oven/Fridge',
    'Dishwasher',
    'Washer',
    'Dryer',
    'Microwave',
    'Garburator',
    'Window coverings (blinds, curtains)',
    'Pool',
    'Air Conditioning',
    'Cable',
    'Wifi',
    'Central Vacuum',
    'BBQ allowed',
    'Other',
];

// Make computed properties more explicit to ensure reactivity
const utilities = computed(() => {
    return props.formData?.utilities || {};
});

const d = computed(() => props.formData || {});

const handleDataChange = (path, value) => {
    emit('data-change', path, value);
};

const handleInclusionChange = (label, checked) => {
    const prev = d.value.utilities?.inclusions || [];
    const next = checked ? [...prev, label] : prev.filter(x => x !== label);
    handleDataChange('utilities.inclusions', next);
};
</script>

