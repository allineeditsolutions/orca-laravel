<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PropertyDetailsController;
use App\Http\Controllers\ScheduleVisitController;
use App\Http\Controllers\NewbizRequestController;

// Example API routes
Route::get('/test', function () {
    return response()->json([
        'message' => 'Hello from Laravel API!',
        'status' => 'success',
        'timestamp' => now()->toDateTimeString(),
    ]);
});

Route::get('/user', function () {
    return response()->json([
        'message' => 'User endpoint - this would return user data',
        'status' => 'success',
    ]);
});

// ComplyCube Verification Routes
Route::post('/complycube/create-verification-token', function (Illuminate\Http\Request $request) {
    $apiKey = config('services.complycube.api_key');
    $baseUrl = config('services.complycube.base_url', 'https://api.complycube.com/v1');
    
    if (!$apiKey) {
        return response()->json([
            'error' => 'ComplyCube API key not configured',
            'status' => 'error',
        ], 500);
    }
    
    $firstName = $request->input('firstName', '');
    $lastName = $request->input('lastName', '');
    $email = $request->input('email', '');
    $dateOfBirth = $request->input('dateOfBirth', '');
    
    try {
        // Create client
        $clientResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json',
        ])->post($baseUrl . '/clients', [
            'type' => 'person',
            'email' => $email,
            'personDetails' => [
                'firstName' => $firstName,
                'lastName' => $lastName,
                'dob' => $dateOfBirth,
            ],
        ]);
        
        if (!$clientResponse->successful()) {
            return response()->json([
                'error' => 'Failed to create client',
                'status' => 'error',
            ], 500);
        }
        
        $clientData = $clientResponse->json();
        
        // Create document check
        $checkResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json',
        ])->post($baseUrl . '/checks', [
            'client' => $clientData['id'],
            'type' => 'document',
        ]);
        
        if (!$checkResponse->successful()) {
            return response()->json([
                'error' => 'Failed to create check',
                'status' => 'error',
            ], 500);
        }
        
        $checkData = $checkResponse->json();
        
        return response()->json([
            'status' => 'success',
            'client_id' => $clientData['id'],
            'check_id' => $checkData['id'],
            'token' => $checkData['token'] ?? null,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'status' => 'error',
        ], 500);
    }
});

// Property Details Routes
Route::post('/property-details', [PropertyDetailsController::class, 'store']);

// Schedule Visit Routes
Route::post('/schedule-visits', [ScheduleVisitController::class, 'store']);

// Newbiz Request Routes
Route::post('/newbiz-requests', [NewbizRequestController::class, 'store']);

// Settings Routes
Route::get('/settings/{var}', function ($var) {
    try {
        $setting = DB::table('settings_json')
            ->where('vars', $var)
            ->first();
        
        if (!$setting) {
            return response()->json([
                'success' => false,
                'message' => 'Setting not found',
            ], 404);
        }
        
        // Return the value field (common column names: value, val, setting_value)
        $value = $setting->value ?? $setting->val ?? $setting->setting_value ?? null;
        
        return response()->json([
            'success' => true,
            'value' => $value,
            'data' => $setting,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to fetch setting',
            'error' => $e->getMessage()
        ], 500);
    }
});

