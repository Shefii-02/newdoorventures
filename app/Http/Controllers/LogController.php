<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogController extends Controller
{
    public function logValidationError(Request $request)
    {
        date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)

        // Log the response data from the client
        Log::notice("message");('Validation failed: Property/Property error');
        Log::info("message");('Time ' . date('d-m-Y H:i:s'));
        Log::error('Validation Errors: ' . json_encode($request->response));

        return response()->json(['message' => 'Logged successfully'], 200);
    }
}


