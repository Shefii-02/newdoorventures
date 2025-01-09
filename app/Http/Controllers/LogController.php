<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogController extends Controller
{
    public function logValidationError(Request $request)
    {
        // Log the response data from the client
        Log::error('Validation failed: Property error');
        Log::error('Validation Errors: ' . json_encode($request->response));

        return response()->json(['message' => 'Logged successfully'], 200);
    }
}


