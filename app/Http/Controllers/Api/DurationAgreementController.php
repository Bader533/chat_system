<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DurationAgreement;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class DurationAgreementController extends Controller
{
    public function show()
    {
        try {
            $duration = DurationAgreement::first();
            return response()->json([
                'message' => 'terms and Condition data',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $duration
            ]);
        } catch (Exception $e) {
            return response()->json([
                'massege' => 'An error occurred',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ]);
        }
    }
}
