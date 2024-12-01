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

    public function agency()
    {
        try {
            $agencies = Agency::select('id', 'name_en', 'name_ar', 'avatar')->isHome()->isActive()->take(10)->get();

            return response()->json([
                'message' => 'home agency data',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $agencies
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

    public function ads()
    {
        try {
            $ads = Ads::select('id', 'name_en', 'name_ar', 'avatar')->isHome()->isActive()->take(10)->get();
            return response()->json([
                'message' => 'home ads data',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $ads
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

    public function countries()
    {
        try {
            $countries = Country::select('id', 'name_en', 'name_ar', 'avatar')->isActive()->take(10)->get();

            return response()->json([
                'message' => 'home countries data',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $countries
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

    public function rooms()
    {
        try {
            $rooms = Room::select('id', 'name', 'avatar', 'country_id')->isHome()->isActive()->take(10)->get();

            return response()->json([
                'message' => 'home rooms data',
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
