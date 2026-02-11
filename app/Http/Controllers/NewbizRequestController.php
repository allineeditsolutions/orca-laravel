<?php

namespace App\Http\Controllers;
use App\Models\RentalConsultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class NewbizRequestController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tenant_id' => 'nullable|integer',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:50',
            'rental_property_address' => 'required|string',
            'city_of_rental_property' => 'required|string|max:255',
            'best_desc_property' => 'nullable|string|max:255',
            'estimated_square_footage' => 'nullable|integer|min:0',
            'number_of_bedrooms' => 'nullable|integer|min:0',
            'when_planning_to_rent' => 'nullable|string|max:255',
            'plans_with_property' => 'nullable|string|max:255',
            'considering_selling' => 'nullable|string|max:255',
            'rent_amount_in_mind' => 'nullable|string|max:255',
            'worked_with_property_manager' => 'nullable|string|max:255',
            'where_heard_about_orca' => 'nullable|string|max:255',
            'additional_information' => 'nullable|string',
            'additional_data' => 'nullable|array',
            'pod_id' => 'nullable|integer',
            'bdm_id' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $validatedData = $validator->validated();
            $validatedData['pdform_link'] = Str::random(12);

            $newbizRequest = RentalConsultation::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Newbiz request saved successfully',
                'data' => $newbizRequest
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save newbiz request',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
