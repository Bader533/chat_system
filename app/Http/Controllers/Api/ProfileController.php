<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    public function showUser()
    {
        $user = auth()->user();
        $data['user'] = $user->only('id', 'name', 'email', 'phone', 'avatar_url');
        $data['followers_count'] = $user->followers()->count();
        $data['following_count'] =  $user->following()->count();
        $data['posts'] =  $user->posts()->count();
        $data['level_completed_count'] = $user->levels()->wherePivot('completed', '1')->count() ?? 0;
        $data['diamond_count'] = $user->wallet->diamonds ?? 0;
        $data['gold_count'] = $user->wallet->gold ?? 0;
        $data['silver_count'] = $user->wallet->silver ?? 0;

        try {
            return response()->json([
                'message' => 'user data details',
                'code' => Response::HTTP_OK,
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

    public function followersData()
    {
        try {
            $user = auth()->user();
            $followers = $user->followers;
            return response()->json([
                'message' => 'user followers data',
                'code' => Response::HTTP_OK,
                'error' => false,
                'data' => $followers
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

    public function followingData()
    {
        try {
            $user = auth()->user();

            $following = $user->following;
            return response()->json([
                'message' => 'user following data',
                'code' => Response::HTTP_OK,
                'error' => false,
                'data' => $following
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

    public function userPosts()
    {
        try {
            $user = auth()->user();

            $posts = $user->posts;
            return response()->json([
                'message' => 'user posts',
                'code' => Response::HTTP_OK,
                'error' => false,
                'data' => $posts
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

    public function userWallet()
    {
        try {
            $user = auth()->user()->load('wallet.transactions.agency');
            $data['wallet'] = $user->wallet ?? null;

            return response()->json([
                'message' => 'user wallet and transactions',
                'code' => Response::HTTP_OK,
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

    // public function userDiamonds()
    // {
    //     try {
    //         $user = auth()->user();

    //         $data = $user->total_diamonds;
    //         return response()->json([
    //             'message' => 'user posts',
    //             'code' => Response::HTTP_OK,
    //             'error' => false,
    //             'data' => $data
    //         ]);
    //     } catch (Exception $e) {
    //         return response()->json([
    //             'massege' => 'An error occurred',
    //             'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
    //             'error' => true,
    //             'data' => []
    //         ]);
    //     }
    // }

    // public function userGold()
    // {
    //     try {
    //         $user = auth()->user();

    //         $data = $user->total_gold;
    //         return response()->json([
    //             'message' => 'user posts',
    //             'code' => Response::HTTP_OK,
    //             'error' => false,
    //             'data' => $data
    //         ]);
    //     } catch (Exception $e) {
    //         return response()->json([
    //             'massege' => 'An error occurred',
    //             'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
    //             'error' => true,
    //             'data' => []
    //         ]);
    //     }
    // }

    public function update(ProfileRequest $request)
    {
        try {
            $user = auth()->user();

            $validatedData = $request->validated();

            $user->update($validatedData);
            $user->updateAvatar($request);

            $data = $user->only('id', 'name', 'email', 'phone', 'avatar', 'avatar_url');

            return response()->json([
                'message' => 'user posts',
                'code' => Response::HTTP_OK,
                'error' => false,
                'data' => $data
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

    public function userDetails()
    {
        $user = auth()->user();
        $data['user'] = $user->only('id', 'name', 'email', 'phone', 'avatar_url', 'created_at');

        try {
            return response()->json([
                'message' => 'user data details',
                'code' => Response::HTTP_OK,
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

    public function currentUserLevel()
    {
        $user = auth()->user();
        $data['level'] = $user->levels()
            ->wherePivot('completed', '0')
            ->get(['levels.id as level_id', 'levels.name_en', 'levels.name_ar', 'avatar', 'user_levels.user_id']);

        try {
            return response()->json([
                'message' => 'user data details',
                'code' => Response::HTTP_OK,
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
