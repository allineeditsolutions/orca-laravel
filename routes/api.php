<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\PropertyDetailsController;

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

