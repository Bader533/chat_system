<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoomTypeController extends Controller
{
    public function index()
    {
        try {

            $rooms = RoomType::isActive()->select(['id', 'name_en', 'name_ar', 'avatar'])->get();
            return response()->json([
                'message' => 'all rooms type',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $rooms
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
