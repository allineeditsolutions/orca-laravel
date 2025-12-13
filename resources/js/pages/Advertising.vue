<template>
    <div class="min-h-screen bg-gray-50 flex items-start justify-center px-2 sm:px-4 pt-2 pb-4 sm:pb-8 md:pb-12">
        <!-- Step Indicator -->
        <StepIndicator v-if="!isSubmitted" :steps="steps" :current-step="currentStep" />
        
        <div :class="['w-full max-w-6xl lg:max-w-7xl', isSubmitted ? 'mt-0' : 'mt-32 sm:mt-36 md:mt-[120px] lg:mt-[110px]']">
            <!-- Main Form Content - Centered -->
            <div class="" 
                 style="scrollbar-width: thin; scrollbar-color: #9ca3af #f3f4f6;" >
                    <div v-if="currentStep === 1" class="p-4 space-y-5 sm:space-y-6 md:space-y-2 ">
                        <OwnerInformationSection
                            :form-data="formData"
                            :validation-errors="validationErrors"
                            @data-change="handleDataChange"
                        />
                        <PointOfContactSection
                            :form-data="formData"
                            :validation-errors="validationErrors"
                            @data-change="handleDataChange"
                        />
                        <MailingInformationSection
                            :form-data="formData"
                            :validation-errors="validationErrors"
                            @data-change="handleDataChange"
                        />
                    </div>
                    <div v-if="currentStep === 2" class="p-4 space-y-5 sm:space-y-6 md:space-y-8">
                        <RentalPropertyInformationSection 
                            :on-back="handleBack" 
                            :on-next="handleNext" 
                            :form-data="formData"
                            :validation-errors="validationErrors"
                            @data-change="handleDataChange" 
                        />
                    </div>
                    <div v-if="currentStep === 3" class="p-4 space-y-5 sm:space-y-6 md:space-y-8">
                        <OccupancyAvailabilitySection 
                            :on-back="handleBack" 
                            :on-next="handleNext" 
                            :form-data="formData"
                            :validation-errors="validationErrors"
                            @data-change="handleDataChange" 
                        />
                    </div>
                    <div v-if="currentStep === 4" class="p-4 space-y-5 sm:space-y-6 md:space-y-8">
                        <UtilitiesInclusionsRestrictionsSection 
                            :on-back="handleBack" 
                            :on-next="handleNext" 
                            :form-data="formData"
                            :validation-errors="validationErrors"
                            @data-change="handleDataChange" 
                        />
                    </div>
                    <div v-if="currentStep === 5" class="p-4 space-y-5 sm:space-y-6 md:space-y-8">
                        <OtherDetailsSection 
                            :on-back="handleBack" 
                            :on-next="handleNext" 
                            :form-data="formData" 
                            :validation-errors="validationErrors"
                            @data-change="handleDataChange"
                            @clear-error="clearValidationError"
                        />
                    </div>
                    <div v-if="currentStep === 6" class="p-4 space-y-5 sm:space-y-6 md:space-y-8">
                        <ReviewSection 
                            :data="formData" 
                            :on-back="handleBack" 
                            @submit="handleSubmit" 
                        />
                    </div>
                </div>


                <div v-if="currentStep === 1" class="flex-shrink-0 r-mt-3 r-pt-3 sm:mt-6 pt-4 sm:pt-6 border-t border-gray-200 bg-white flex flex-col sm:flex-row justify-between gap-3 sm:gap-4">
                    <p></p>
                    <button
                        @click="handleNext"
                        class="p-4 cursor-pointer bg-black hover:bg-gray-800 text-white px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl font-semibold flex items-center gap-2 transition-colors duration-200 shadow-lg hover:shadow-xl"
                    >
                        Rental Property Information & Features
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, computed } from 'vue';
import StepIndicator from '@/components/advertising/StepIndicator.vue';
import OwnerInformationSection from '@/components/advertising/OwnerInformationSection.vue';
import PointOfContactSection from '@/components/advertising/PointOfContactSection.vue';
import MailingInformationSection from '@/components/advertising/MailingInformationSection.vue';
import RentalPropertyInformationSection from '@/components/advertising/RentalPropertyInformationSection.vue';
import OccupancyAvailabilitySection from '@/components/advertising/OccupancyAvailabilitySection.vue';
import UtilitiesInclusionsRestrictionsSection from '@/components/advertising/UtilitiesInclusionsRestrictionsSection.vue';
import OtherDetailsSection from '@/components/advertising/OtherDetailsSection.vue';
import ReviewSection from '@/components/advertising/ReviewSection.vue';

const currentStep = ref(4);
const isSubmitted = ref(false);
const isSubmitting = ref(false);
const validationErrors = ref({});

const formData = reactive({
    // Owner Information
    businessLegalName: 'ABC Property Holdings Inc.',
    ownerEmail: 'john.smith@example.com',
    phone: '(604) 555-0123',
    firstName: 'John',
    lastName: 'Smith',
    dateOfBirth: '1985-05-15',
    residentStatus: 'Resident',
    coOwners: [],
    
    // Point of Contact
    pointOfContact: 'Same as Main Owner',
    otherPointOfContact: '',
    pointOfContactFirstName: '',
    pointOfContactEmail: '',
    pointOfContactPhone: '',
    
    // Mailing Information
    unitSuite: 'Suite 201',
    streetAddress: '123 Main Street',
    city: 'Vancouver',
    province: 'British Columbia',
    postalCode: 'V6B 1A1',

    // Step 2 - Rental Property Information & Features
    rental: {
        unitSuite: '',
        streetAddress: '',
        city: '',
        province: '',
        postalCode: '',
        neighborhood: '',
        yearBuilt: '',
        totalFloorArea: '',
        keys: '',
        keysOther: '',
        bedrooms: '',
        bathrooms: '',
        den: '',
        balconypatio: '',
        storage: '',
        fireplaceTypes: [],
        alarmCode: '',
        parking: {},
        parkingLevelStall: '',
        laundry: '',
        heating: [],
        heatingType: '',
    },

    // Step 3 - Occupancy & Availability
    occupancy: {
        availableAsap: '',
        renovationPlans: '',
        fixedTermOnly: '',
        boostAd: '',
        anticipatedDate: '',
        rentalTerm: '',
        tenantVacatingDate: '',
        tenants: [],
        availabilityInfo: '',
        shortTermAvailabilityInfo: '',
        expectedRenovations: '',
        fixedTermTenancyDescription: '',
    },

    // Step 4 - Utilities/Inclusions/Restrictions
    utilities: {
        water: '',
        electricity: '',
        electricitySplitDetail: '',
        gas: '',
        heat: '',
        inclusions: [],
        furnishing: '',
        pets: '',
        propertyType: '',
    },

    // Step 5 - Other Details
    other: {
        strataCompany: '',
        strataManagerName: '',
        strataPhone: '',
        strataEmail: '',
        buildingManagerName: '',
        buildingManagerPhone: '',
        buildingManagerEmail: '',
        moveInFees: '',
        amenities: [],
        signUpFront: '',
        maintenance: [],
        maintenanceFrequencies: {},
        sprinklersService: '',
        hasSelfContainedSuite: '',
        suiteBedrooms: '',
        suiteTenanted: '',
        suiteTenants: [],
        suiteOtherDetails: '',
        fuseBox: '',
        amenitiesFloor: '',
        bikeStorageLocation: '',
        garbageInfo: '',
        mainWaterline: '',
        amenitiesNotes: '',
        virtualTour: '',
        listingUrl: '',
    },
});

// Computed property for step 5 title based on property type
const getStep5Title = (propertyType) => {
    if (propertyType === 'House') {
        return 'House Details';
    } else if (propertyType === 'Apartment/Condo') {
        return 'Apartment/Condo Details';
    } else if (propertyType === 'Townhouse') {
        return 'Townhouse Details';
    }
    return 'Other Details';
};

// Computed steps array that updates based on property type
const steps = computed(() => {
    const propertyType = formData.utilities?.propertyType || '';
    return [
        { number: 1, title: 'Homeowner Detail' },
        { number: 2, title: 'Rental Property Information & Features' },
        { number: 3, title: 'Occupancy and Property Availability' },
        { number: 4, title: 'Utilities, Inclusions, Restrictions' },
        { number: 5, title: getStep5Title(propertyType) },
        { number: 6, title: 'Review' },
    ];
});

const handleDataChange = (path, value) => {
    const keys = path.split('.');
    let obj = formData;
    for (let i = 0; i < keys.length - 1; i++) {
        const k = keys[i];
        if (!obj[k] || typeof obj[k] !== 'object') {
            obj[k] = {};
        }
        obj = obj[k];
    }
    obj[keys[keys.length - 1]] = value;
    
    // Clear validation error for this field when user starts typing
    const errorKey = path;
    if (validationErrors.value[errorKey]) {
        delete validationErrors.value[errorKey];
    }
};

const validateStep1 = () => {
    const errors = {};
    
    // Owner Information - Required fields
    if (!formData.ownerEmail || formData.ownerEmail.trim() === '') {
        errors.ownerEmail = 'Owner Email is required';
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.ownerEmail)) {
        errors.ownerEmail = 'Please enter a valid email address';
    }
    
    if (!formData.phone || formData.phone.trim() === '') {
        errors.phone = 'Phone is required';
    }
    
    if (!formData.firstName || formData.firstName.trim() === '') {
        errors.firstName = 'First Name is required';
    }
    
    if (!formData.lastName || formData.lastName.trim() === '') {
        errors.lastName = 'Last Name is required';
    }
    
    if (!formData.dateOfBirth || formData.dateOfBirth.trim() === '') {
        errors.dateOfBirth = 'Date of Birth is required';
    }
    
    if (!formData.residentStatus || formData.residentStatus.trim() === '') {
        errors.residentStatus = 'Resident Status is required';
    }
    
    // Point of Contact - If "Other(Specify)" is selected, validate other contact fields
    if (formData.pointOfContact === 'Other(Specify)') {
        if (!formData.pointOfContactFirstName || formData.pointOfContactFirstName.trim() === '') {
            errors.pointOfContactFirstName = 'First Name is required';
        }
        if (!formData.pointOfContactEmail || formData.pointOfContactEmail.trim() === '') {
            errors.pointOfContactEmail = 'Email Address is required';
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.pointOfContactEmail)) {
            errors.pointOfContactEmail = 'Please enter a valid email address';
        }
        if (!formData.pointOfContactPhone || formData.pointOfContactPhone.trim() === '') {
            errors.pointOfContactPhone = 'Phone is required';
        }
    }
    
    // Mailing Information - Required fields
    if (!formData.streetAddress || formData.streetAddress.trim() === '') {
        errors.streetAddress = 'Street Address is required';
    }
    
    if (!formData.city || formData.city.trim() === '') {
        errors.city = 'City is required';
    }
    
    if (!formData.province || formData.province.trim() === '') {
        errors.province = 'Province is required';
    }
    
    if (!formData.postalCode || formData.postalCode.trim() === '') {
        errors.postalCode = 'Postal / ZIP Code is required';
    }
    
    validationErrors.value = errors;
    return Object.keys(errors).length === 0;
};

const validateStep2 = () => {
    const errors = {};
    const rental = formData.rental || {};
    
    // Address fields - Required
    if (!rental.streetAddress || rental.streetAddress.trim() === '') {
        errors['rental.streetAddress'] = 'Street Address is required';
    }
    
    if (!rental.city || rental.city.trim() === '') {
        errors['rental.city'] = 'City is required';
    }
    
    if (!rental.province || rental.province.trim() === '') {
        errors['rental.province'] = 'Province is required';
    }
    
    if (!rental.postalCode || rental.postalCode.trim() === '') {
        errors['rental.postalCode'] = 'Postal / ZIP Code is required';
    }
    
    // Total Floor Area - Required
    if (!rental.totalFloorArea || rental.totalFloorArea.trim() === '') {
        errors['rental.totalFloorArea'] = 'Total Floor Area is required';
    }
    
    // Keys - Required
    if (!rental.keys || rental.keys.trim() === '') {
        errors['rental.keys'] = 'Keys information is required';
    }
    
    // If keys is "Other", validate keysOther
    if (rental.keys === 'Other' && (!rental.keysOther || rental.keysOther.trim() === '')) {
        errors['rental.keysOther'] = 'Please provide details about key access';
    }
    
    // Property Details - Required
    const bedrooms = rental.bedrooms !== undefined && rental.bedrooms !== null ? String(rental.bedrooms) : '';
    if (!bedrooms || bedrooms.trim() === '') {
        errors['rental.bedrooms'] = 'Bedrooms is required';
    }
    
    const bathrooms = rental.bathrooms !== undefined && rental.bathrooms !== null ? String(rental.bathrooms) : '';
    if (!bathrooms || bathrooms.trim() === '') {
        errors['rental.bathrooms'] = 'Bathrooms is required';
    }
    
    const den = rental.den !== undefined && rental.den !== null ? String(rental.den) : '';
    if (!den || den.trim() === '') {
        errors['rental.den'] = 'Den is required';
    }
    
    // Note: featureKeyMap uses 'balconypatio' (all lowercase)
    const balconyPatio = rental.balconypatio || rental.balconyPatio || '';
    if (!balconyPatio || String(balconyPatio).trim() === '') {
        errors['rental.balconypatio'] = 'Balcony/Patio is required';
    }
    
    const storage = rental.storage !== undefined && rental.storage !== null ? String(rental.storage) : '';
    if (!storage || storage.trim() === '') {
        errors['rental.storage'] = 'Storage is required';
    }
    
    // Laundry - Required
    if (!rental.laundry || rental.laundry.trim() === '') {
        errors['rental.laundry'] = 'Laundry is required';
    }
    
    // Heating - Required (at least one must be selected)
    if (!rental.heating || !Array.isArray(rental.heating) || rental.heating.length === 0) {
        errors['rental.heating'] = 'At least one heating type is required';
    }
    
    // If heating includes "Other", validate heatingType
    if (rental.heating && Array.isArray(rental.heating) && rental.heating.includes('Other')) {
        if (!rental.heatingType || rental.heatingType.trim() === '') {
            errors['rental.heatingType'] = 'Heating Type is required';
        }
    }
    
    validationErrors.value = errors;
    return Object.keys(errors).length === 0;
};

const validateStep3 = () => {
    const errors = {};
    const occupancy = formData.occupancy || {};
    
    // The property is currently - Required
    if (!occupancy.availableAsap || occupancy.availableAsap.trim() === '') {
        errors['occupancy.availableAsap'] = 'The property is currently is required';
    }
    
    // If Tenant Occupied, validate tenant vacating date and tenant information
    if (occupancy.availableAsap === 'Tenant Occupied') {
        if (!occupancy.tenantVacatingDate || occupancy.tenantVacatingDate.trim() === '') {
            errors['occupancy.tenantVacatingDate'] = 'When is the current Tenant vacating is required';
        }
        
        // Validate tenants array
        const tenants = occupancy.tenants || [];
        if (!Array.isArray(tenants) || tenants.length === 0) {
            // If no tenants, add a general error
            errors['occupancy.tenants.0.name'] = 'At least one tenant is required';
        } else {
            tenants.forEach((tenant, index) => {
                if (!tenant || !tenant.name || tenant.name.trim() === '') {
                    errors[`occupancy.tenants.${index}.name`] = 'Tenant Name is required';
                }
                if (!tenant || !tenant.phone || tenant.phone.trim() === '') {
                    errors[`occupancy.tenants.${index}.phone`] = 'Tenant Phone is required';
                }
                if (!tenant || !tenant.email || tenant.email.trim() === '') {
                    errors[`occupancy.tenants.${index}.email`] = 'Tenant Email Address is required';
                } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(tenant.email)) {
                    errors[`occupancy.tenants.${index}.email`] = 'Please enter a valid email address';
                }
            });
        }
    }
    
    // Is the property available to be rented ASAP? - Required
    if (!occupancy.renovationPlans || occupancy.renovationPlans.trim() === '') {
        errors['occupancy.renovationPlans'] = 'Is the property available to be rented ASAP is required';
    }
    
    // Anticipated occupancy date - Required
    if (!occupancy.anticipatedDate || occupancy.anticipatedDate.trim() === '') {
        errors['occupancy.anticipatedDate'] = 'Anticipated occupancy date for Tenants to move in is required';
    }
    
    // Is this going to be a long-term or short-term rental? - Required
    if (!occupancy.rentalTerm || occupancy.rentalTerm.trim() === '') {
        errors['occupancy.rentalTerm'] = 'Is this going to be a long-term or short-term rental is required';
    }
    
    // If rental term is "Other", validate availabilityInfo
    if (occupancy.rentalTerm === 'Other') {
        if (!occupancy.availabilityInfo || occupancy.availabilityInfo.trim() === '') {
            errors['occupancy.availabilityInfo'] = 'Availability is required';
        }
    }
    
    validationErrors.value = errors;
    return Object.keys(errors).length === 0;
};

const validateStep4 = () => {
    const errors = {};
    const utilities = formData.utilities || {};
    
    // Property Details - All utilities are required (water, electricity, gas, heat)
    if (!utilities.water || utilities.water.trim() === '') {
        errors['utilities.water'] = 'Water is required';
    }
    
    if (!utilities.electricity || utilities.electricity.trim() === '') {
        errors['utilities.electricity'] = 'Electricity is required';
    }
    
    if (!utilities.gas || utilities.gas.trim() === '') {
        errors['utilities.gas'] = 'Gas is required';
    }
    
    if (!utilities.heat || utilities.heat.trim() === '') {
        errors['utilities.heat'] = 'Heat is required';
    }
    
    // If inclusions includes "Other", validate inclusionsOtherDetail
    if (utilities.inclusions && Array.isArray(utilities.inclusions) && utilities.inclusions.includes('Other')) {
        if (!utilities.inclusionsOtherDetail || utilities.inclusionsOtherDetail.trim() === '') {
            errors['utilities.inclusionsOtherDetail'] = 'Please provide details about the other items is required';
        }
    }
    
    // The Property is (furnishing) - Required
    if (!utilities.furnishing || utilities.furnishing.trim() === '') {
        errors['utilities.furnishing'] = 'The Property is required';
    }
    
    // Type of Property - Required
    if (!utilities.propertyType || utilities.propertyType.trim() === '') {
        errors['utilities.propertyType'] = 'Type of Property is required';
    }
    
    // If propertyType is "Other", validate propertyTypeOtherDetail
    if (utilities.propertyType === 'Other') {
        if (!utilities.propertyTypeOtherDetail || utilities.propertyTypeOtherDetail.trim() === '') {
            errors['utilities.propertyTypeOtherDetail'] = 'Property Type is required';
        }
    }
    
    validationErrors.value = errors;
    return Object.keys(errors).length === 0;
};

const handleNext = () => {
    // Validate step 1 before proceeding
    if (currentStep.value === 1) {
        if (!validateStep1()) {
            // Scroll to first error
            const firstErrorField = Object.keys(validationErrors.value)[0];
            const errorElement = document.querySelector(`[name="${firstErrorField}"]`) || 
                                document.querySelector(`input[placeholder*="${firstErrorField}"]`);
            if (errorElement) {
                errorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                errorElement.focus();
            }
            return;
        }
    }
    
    // Validate step 2 before proceeding
    if (currentStep.value === 2) {
        if (!validateStep2()) {
            // Scroll to first error
            const firstErrorField = Object.keys(validationErrors.value)[0];
            const errorElement = document.querySelector(`[name="${firstErrorField}"]`) || 
                                document.querySelector(`input[placeholder*="${firstErrorField}"]`) ||
                                document.querySelector(`select[placeholder*="${firstErrorField}"]`);
            if (errorElement) {
                errorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                errorElement.focus();
            }
            return;
        }
    }
    
    // Validate step 3 before proceeding
    if (currentStep.value === 3) {
        if (!validateStep3()) {
            // Scroll to first error
            const firstErrorField = Object.keys(validationErrors.value)[0];
            const errorElement = document.querySelector(`[name="${firstErrorField}"]`) || 
                                document.querySelector(`input[placeholder*="${firstErrorField}"]`) ||
                                document.querySelector(`select[placeholder*="${firstErrorField}"]`);
            if (errorElement) {
                errorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                errorElement.focus();
            }
            return;
        }
    }
    
    // Validate step 4 before proceeding
    if (currentStep.value === 4) {
        if (!validateStep4()) {
            // Scroll to first error
            const firstErrorField = Object.keys(validationErrors.value)[0];
            const errorElement = document.querySelector(`[name="${firstErrorField}"]`) || 
                                document.querySelector(`input[placeholder*="${firstErrorField}"]`) ||
                                document.querySelector(`select[placeholder*="${firstErrorField}"]`);
            if (errorElement) {
                errorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                errorElement.focus();
            }
            return;
        }
    }
    
    // Clear validation errors when moving to next step
    validationErrors.value = {};
    
    if (currentStep.value < steps.value.length) {
        currentStep.value++;
    }
};

const handleBack = () => {
    if (currentStep.value > 1) {
        currentStep.value--;
    }
};

const handleSubmit = async () => {
    // Prevent double submission
    if (isSubmitting.value) {
        return;
    }
    
    try {
        isSubmitting.value = true;
        
        // Prepare data for API
        const submitData = {
            business_legal_name: formData.businessLegalName,
            owner_email: formData.ownerEmail,
            owner_phone: formData.phone,
            owner_fname: formData.firstName,
            owner_lname: formData.lastName,
            homeowner_detail: {
                businessLegalName: formData.businessLegalName,
                ownerEmail: formData.ownerEmail,
                phone: formData.phone,
                firstName: formData.firstName,
                lastName: formData.lastName,
                dateOfBirth: formData.dateOfBirth,
                residentStatus: formData.residentStatus,
                coOwners: formData.coOwners,
                pointOfContact: formData.pointOfContact,
                otherPointOfContact: formData.otherPointOfContact,
                unitSuite: formData.unitSuite,
                streetAddress: formData.streetAddress,
                city: formData.city,
                province: formData.province,
                postalCode: formData.postalCode,
            },
            rental_info_features: formData.rental,
            occupancy_availability: formData.occupancy,
            utilities_inc_restrictions: formData.utilities,
            other_details: formData.other,
            status: 'submitted',
        };

        // Make API call
        const response = await fetch('/api/property-details', {
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
                isSubmitting.value = false;
                const errorMessages = Object.values(result.errors).flat().join('\n');
                alert('Validation errors:\n' + errorMessages);
                return;
            }
            throw new Error(result.message || 'Failed to save property details');
        }

        // Success
        isSubmitted.value = true;
    } catch (error) {
        console.error('Error submitting form:', error);
        alert('An error occurred while saving: ' + error.message);
    } finally {
        isSubmitting.value = false;
    }
};
</script>

