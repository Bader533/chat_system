<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GlaEvent;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GlaEventController extends Controller
{
    public function index()
    {
        try {
            $events = GlaEvent::isActive()->select('id', 'title_en', 'title_ar', 'description_en', 'description_ar', 'created_at')
                ->paginate(10);

            return response()->json([
                'message' => 'get all gla events',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $events
            ]);
        } catch (Exception $e) {
            return response()->json([
                'massege' => 'An error occurred' . $e,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ]);
        }
    }

    public function show($id)
    {
        try {
            $event = GlaEvent::isActive()->find($id);

            if (!$event) {
                return response()->json([
                    'massege' => 'The event not exist',
                    'code' => Response::HTTP_BAD_REQUEST,
                    'error' => true,
                    'data' => []
                ], Response::HTTP_BAD_REQUEST);
            }

            return response()->json([
                'message' => 'gla event data',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $event
            ]);
        } catch (Exception $e) {
            return response()->json([
                'massege' => 'An error occurred' . $e,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ]);
        }
    }
}
