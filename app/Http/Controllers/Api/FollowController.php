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
}
