<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Room;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $data['ads'] = Ads::select('id', 'name', 'avatar')->take(10)->get();
            $data['rooms'] = Room::select('id', 'name', 'avatar', 'country_id')->take(10)->get();

            return response()->json([
                'message' => 'home page data',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $data
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
