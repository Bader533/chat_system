<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    public function showUser()
    {
        $user = auth()->user();
        try {
            return response()->json([
                'message' => 'user data details',
                'code' => Response::HTTP_OK,
                'error' => false,
                'data' => $user
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

    public function followers()
    {
        try {
            $user = auth()->user;

            $followersCount = $user->followers()->count();
            return response()->json([
                'message' => 'user followers count',
                'code' => Response::HTTP_OK,
                'error' => false,
                'data' => $followersCount
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

    public function following()
    {
        try {
            $user = auth()->user;

            $followingCount = $user->following()->count();
            return response()->json([
                'message' => 'user following count',
                'code' => Response::HTTP_OK,
                'error' => false,
                'data' => $followingCount
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
