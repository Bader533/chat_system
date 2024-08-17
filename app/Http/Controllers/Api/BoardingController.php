<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Boarding;
use Illuminate\Http\Request;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class BoardingController extends Controller
{
    public function index()
    {
        try {
            $boardings = Boarding::where('status', 1)->get();
            return response()->json([
                'message' => 'on boardng data',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $boardings
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
