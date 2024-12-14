<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GlaTeam;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GlaTeamController extends Controller
{
    public function index()
    {
        try {
            $teams = GlaTeam::isActive()->select('id', 'title_en', 'title_ar', 'description_en', 'description_ar', 'created_at')
                ->paginate(10);

            return response()->json([
                'message' => 'all gla teams',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $teams
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
            $team = GlaTeam::isActive()->find($id);

            if (!$team) {
                return response()->json([
                    'massege' => 'The team not exist',
                    'code' => Response::HTTP_BAD_REQUEST,
                    'error' => true,
                    'data' => []
                ], Response::HTTP_BAD_REQUEST);
            }

            return response()->json([
                'message' => 'gla team data',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $team
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
