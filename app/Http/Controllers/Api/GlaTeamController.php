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
            $teams = GlaTeam::isActive()->select('id', 'title', 'description')->take(10)->get();

            return response()->json([
                'message' => 'gla teams data',
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
            $team = GlaTeam::isActive()->findOrFail($id);

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
