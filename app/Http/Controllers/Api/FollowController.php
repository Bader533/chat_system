<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FollowRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FollowController extends Controller
{
    public function index(FollowRequest $request)
    {
        try {

            $query = $request->input('search');
            $type = $request->input('type');
            $user = User::getUser();

            if ($type == 'followers') {
                $data = $user->followers();
            } elseif ($type == 'following') {
                $data = $user->following();
            }

            if ($query == null) {
                $users = $data->get();
            } else {
                $users = $data->where('name', 'like', '%' . $query . '%')
                    ->get();
            }


            return response()->json([
                'message' => $type . ' user data',
                'code' => Response::HTTP_OK,
                'error' => false,
                'data' => $users
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

    public function followUser(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $currentUser = auth()->user();

        if ($currentUser->isFollowing($user)) {
            return response()->json(['message' => 'أنت تتابع هذا المستخدم بالفعل'], 400);
        }

        $currentUser->follow($user);

        return response()->json(['message' => 'تمت المتابعة بنجاح']);
    }

    public function unfollowUser(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $currentUser = auth()->user();

        if (!$currentUser->isFollowing($user)) {
            return response()->json(['message' => 'أنت لا تتابع هذا المستخدم'], 400);
        }

        $currentUser->unfollow($user);

        return response()->json(['message' => 'تم إلغاء المتابعة بنجاح']);
    }
}
