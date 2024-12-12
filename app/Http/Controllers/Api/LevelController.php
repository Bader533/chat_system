<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LevelApiRequest;
use App\Models\Level;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LevelController extends Controller
{
    public function index()
    {
        try {
            $levels = Level::isActive()
                ->paginate(8)
                ->through(fn($level) => $level->makeHidden(['created_at', 'updated_at', 'status', 'point_status', 'slug']));


            return response()->json([
                'message' => 'all levels data',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $levels
            ], Response::HTTP_ACCEPTED);
        } catch (Exception $e) {
            return response()->json([
                'massege' => $e,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $level = Level::isActive()->findOrFail($id);
            $data = $level->makeHidden(['created_at', 'updated_at', 'status', 'point_status', 'slug']);


            return response()->json([
                'message' => 'level data',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $data
            ], Response::HTTP_ACCEPTED);
        } catch (Exception $e) {
            return response()->json([
                'massege' => $e,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function openNewLevel($levelId)
    {
        try {

            $level = Level::isActive()->findOrFail($levelId);
            $user = auth()->user();

            $userDiamonds = $user->total_diamonds;
            $userGold = $user->total_gold;
            $userSilver = $user->total_silver;
            if (!$user->levels()->wherePivot('level_id', $levelId)->exists()) {
                if ($userDiamonds >= $level->diamonds && $userGold >= $level->gold && $userSilver >= $level->silver) {
                    $user->levels()->attach($level->id, [
                        'score' => 0,
                        'completed' => false
                    ]);

                    return response()->json([
                        'message' => 'The new Level Opened',
                        'code' => Response::HTTP_ACCEPTED,
                        'error' => false,
                        'data' => []
                    ], Response::HTTP_ACCEPTED);
                }
            } else {
                return response()->json([
                    'message' => 'This level is already opened',
                    'code' => Response::HTTP_ACCEPTED,
                    'error' => false,
                    'data' => []
                ], Response::HTTP_ACCEPTED);
            }

            return response()->json([
                'message' => 'The required number must be achieved',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => []
            ], Response::HTTP_ACCEPTED);
            //
        } catch (Exception $e) {
            return response()->json([
                'massege' => $e,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function increaseScore(LevelApiRequest $request)
    {
        try {
            $level_id = $request->input('levelId');
            $points = $request->input('points');

            $user = auth()->user();

            $levelData = $user->levels()->where('level_id', $level_id)->first();

            if (!$levelData) {
                return response()->json([
                    'message' => 'Level not found for this user.',
                    'code' => Response::HTTP_NOT_FOUND,
                    'error' => true,
                    'data' => []
                ], Response::HTTP_NOT_FOUND);
            }

            if ($levelData->point_status != 0) {
                $newScore = $levelData->pivot->score + $points;

                // تحديث النقاط
                $user->levels()->updateExistingPivot($level_id, ['score' => $newScore]);

                if ($newScore >= $levelData->point) {
                    $user->levels()->updateExistingPivot($level_id, ['completed' => true]);

                    return response()->json([
                        'message' => 'This Level Completed',
                        'code' => Response::HTTP_ACCEPTED,
                        'error' => false,
                        'data' => [
                            'level_id' => $level_id,
                            'new_score' => $newScore,
                            'completed' => true,
                        ]
                    ], Response::HTTP_ACCEPTED);
                }

                return response()->json([
                    'message' => 'The Score added',
                    'code' => Response::HTTP_ACCEPTED,
                    'error' => false,
                    'data' => [
                        'level_id' => $level_id,
                        'new_score' => $newScore,
                        'completed' => false,
                    ]
                ], Response::HTTP_ACCEPTED);
            }

            return response()->json([
                'message' => 'Point status is inactive.',
                'code' => Response::HTTP_BAD_REQUEST,
                'error' => true,
                'data' => []
            ], Response::HTTP_BAD_REQUEST);
            //
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
