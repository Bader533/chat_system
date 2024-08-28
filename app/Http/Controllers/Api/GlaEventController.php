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
            $events = GlaEvent::isActive()->select('id', 'title', 'description')->take(10)->get();

            return response()->json([
                'message' => 'gla events data',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $events
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
            $event = GlaEvent::isActive()->findOrFail($id);

            return response()->json([
                'message' => 'gla event data',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $event
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
