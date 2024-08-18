<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Privacy;
use Illuminate\Http\Request;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class PrivacyController extends Controller
{
    public function show()
    {
        try {
            $privacy = Privacy::first();
            return response()->json([
                'message' => 'Privacy data',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $privacy
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
