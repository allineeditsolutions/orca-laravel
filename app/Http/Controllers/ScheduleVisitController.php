<?php

namespace App\Http\Controllers;

use App\Models\ScheduleVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleVisitController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tenant_id' => 'nullable|integer|exists:tenants,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'move_in_date' => 'nullable|date',
            'preferred_communication' => 'nullable|array',
            'preferred_communication.*' => 'string|in:Phone Call,SMS,Email',
            'availability' => 'nullable|array',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $scheduleVisit = ScheduleVisit::create($validator->validated());

            return response()->json([
                'success' => true,
                'message' => 'Visit request saved successfully',
                'data' => $scheduleVisit
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save visit request',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
