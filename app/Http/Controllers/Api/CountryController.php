<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CountryController extends Controller
{
    public function index()
    {
        try {
            $countries = Country::select(['id', 'name', 'avatar'])->get();

            return response()->json([
                'message' => 'countries data',
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

    public function show($id)
    {
        try {
            $country = Country::findOrFail($id);
            $rooms = $country->rooms()->select(['id', 'name', 'avatar', 'is_home', 'is_favorite'])->paginate(10);

            return response()->json([
                'message' => 'all rooms in country',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $rooms
            ]);
        } catch (Exception $e) {
            return response()->json([
                'massege' => $e,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ]);
        }
    }
}
