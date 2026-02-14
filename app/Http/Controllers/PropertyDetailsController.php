<?php

namespace App\Http\Controllers;

use App\Models\PropertyDetails;
use App\Models\RentalConsultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PropertyDetailsController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'request_id' => 'nullable|string|max:255',
            'business_legal_name' => 'nullable|string|max:255',
            'owner_email' => 'nullable|email|max:255',
            'owner_phone' => 'nullable|string|max:50',
            'owner_fname' => 'nullable|string|max:255',
            'owner_lname' => 'nullable|string|max:255',
            'homeowner_detail' => 'nullable|array',
            'rental_info_features' => 'nullable|array',
            'occupancy_availability' => 'nullable|array',
            'utilities_inc_restrictions' => 'nullable|array',
            'other_details' => 'nullable|array',
            'status' => 'nullable|string|in:draft,submitted,reviewed,published',
            'csnare_url' => 'nullable|url|max:500',
            'followers' => 'nullable|string|max:255',
            'pd_status' => 'nullable|string|max:255',
            'contract_status' => 'nullable|string|max:255',
            'pod_id' => 'nullable|integer',
            'pd_id' => 'nullable|string|max:255',
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
            
            // Generate unique request_id if not provided
            if (empty($validatedData['request_id'])) {
                $validatedData['request_id'] = Str::random(12);
            }

            // Default contract_status when submitting property details
            if (empty($validatedData['contract_status'])) {
                $validatedData['contract_status'] = 'NotStarted';
            }

            // Default pd_status when submitting property details
            if (empty($validatedData['pd_status'])) {
                $validatedData['pd_status'] = 'New';
            }
            
            $propertyDetails = PropertyDetails::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Property details saved successfully',
                'data' => $propertyDetails
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save property details',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function validateNewBizRefId(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ref_id' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $refId = $request->input('ref_id');
            
            // Check if the ref_id exists in newbiz_requests table's pdform_link column
            $exists = RentalConsultation::where('pdform_link', $refId)->exists();

            if (!$exists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid NewBizRefId. This reference ID does not exist in our system.',
                    'valid' => false
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'NewBizRefId is valid',
                'valid' => true
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to validate NewBizRefId',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
