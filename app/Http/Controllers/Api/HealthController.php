<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HealthController extends Controller
{
    public function index(Request $request)
    {
        $dbConnected = false;

        try {
            DB::connection()->getPdo();
            $dbConnected = true;
        } catch (\Exception $e) {
            $dbConnected = false;
        }

        $response = [
            'status' => $dbConnected ? 'ok' : 'error',
            'message' => $dbConnected
                ? 'Hunt-me Job API is running'
                : 'Database connection failed',
            'db_connected' => $dbConnected,
            'timestamp' => Carbon::now()->toIso8601String(),
            'base_url' => URL::to('/'),
        ];

        return response()->json($response);
    }
}
