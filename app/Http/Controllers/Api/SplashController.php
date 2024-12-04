<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SplashController extends Controller
{
    /**
     * Check if the server is running and database connection is working.
     *
     * @return JsonResponse
     */
    public function check(): JsonResponse
    {
        try {
            // check connection with database
            DB::connection()->getPdo();

            return response()->json([
                'status' => 'success',
                'message' => 'Server is running and database connection is healthy.',
                'timestamp' => now()->toDateTimeString(),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Server is running, but database connection failed.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function checkApp(): JsonResponse
    {
        $isInMaintenance = File::exists(storage_path('framework/down'));

        return response()->json([
            'status' => $isInMaintenance ? 0 : 1, // 0: Maintenance, 1: Running
            'message' => $isInMaintenance ? 'Application is in maintenance mode.' : 'Application is running.',
            'timestamp' => now()->toDateTimeString(),
        ]);
    }
}
