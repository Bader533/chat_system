<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * search for active users
     */
    public function search(Request $request)
    {
        try {
            $query = $request->get('search');
            $users = User::select('id', 'name', 'avatar')->isActive()->where('name', 'like', '%' . $query . '%')->get();
            return response()->json([
                'message' => 'search result on user',
                'code' => Response::HTTP_OK,
                'error' => false,
                'data' => $users
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

    /**
     * show current user data
     */
    public function show()
    {
        try {

            $user = User::getUser();
            $data['user'] = $user;
            $data['followers_count'] = $user->followers()->count();
            $data['following_count'] =  $user->following()->count();
            return response()->json([
                'message' => 'current user data',
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

    public function follow(Request $request)
    {
        try {
            Follow::create($request->all());
            return response()->json([
                'message' => __('created_successfully'),
                'code' => Response::HTTP_OK,
                'error' => false,
                'data' => []
            ]);
        } catch (Exception $e) {
            if ($e->getCode() == 23000) { // رمز الخطأ الخاص بانتهاك قيد التكامل (مثل قيد فريد)
                return response()->json([
                    'massege' => __('created_successfully'),
                    'code' => Response::HTTP_OK,
                    'error' => false,
                    'data' => []
                ]);
            }
            return response()->json([
                'massege' => 'An error occurred' . $e,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ]);
        }
    }
}
