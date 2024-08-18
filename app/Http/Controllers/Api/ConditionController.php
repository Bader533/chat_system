<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Condition;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class ConditionController extends Controller
{
    public function show()
    {
        try {
            $condition = Condition::first();
            return response()->json([
                'message' => 'terms and Condition data',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $condition
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
