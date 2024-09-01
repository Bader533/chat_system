<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Agency;
use App\Models\Country;
use App\Models\Room;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $data['agency'] = Agency::select('id', 'name', 'avatar')->isHome()->isActive()->take(10)->get();
            $data['ads'] = Ads::select('id', 'name', 'avatar')->isHome()->isActive()->take(10)->get();
            $data['countries'] = Country::select('id', 'name', 'avatar')->isActive()->take(10)->get();
            $data['rooms'] = Room::select('id', 'name', 'avatar', 'country_id')->isHome()->isActive()->take(10)->get();

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
