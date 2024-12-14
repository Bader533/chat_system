<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(UserRequest $request)
    {
        try {
            $user = new User();
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->phone = $request->get('phone');
            $user->status = 1;
            $user->type = 2; //user
            $user->password = Hash::make($request->get('password'));
            $isSaved = $user->save();
            return response()->json([
                'massege' => $isSaved ? 'Register sucessfully' : 'Registration failed !',
                'status' => $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
                'error' => false,
                'data' => $user
            ]);
        } catch (Exception $e) {
            return response()->json([
                'massege' => 'An error occurred',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ]);
        }
    }

    public function loginPersonal(UserRequest $request)
    {
        try {
            $user = User::where('email', $request->get('email'))->first();


            if ($user && Hash::check($request->get('password'), $user->password) && $user->status == 1) {
                $token = $user->createToken('user')->accessToken;
                $user->setAttribute('token', $token);

                return response()->json([
                    'message' => 'Logged in successfully',
                    'status' => Response::HTTP_OK,
                    'error' => false,
                    'data' => $user
                ]);
            } else {
                return response()->json([
                    'message' => 'Login failed, wrong credentials or inactive user',
                    'status' => Response::HTTP_BAD_REQUEST,
                    'error' => true,
                    'data' => []
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An error occurred: ' . $e->getMessage(),
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ]);
        }
    }

    public function storePhoneNumber(UserRequest $request)
    {
        $user = auth()->user->update([
            'phone' => $request->phone
        ]);

        return response()->json([
            'message' => 'add user phone number successfully',
            'code' => Response::HTTP_ACCEPTED,
            'error' => false,
            'data' => $user
        ]);
    }

    public function logout(Request $request)
    {
        try {
            $revoked = auth('api')->user()->token()->revoke();
            return response()->json(
                [
                    'status' => $revoked,
                    'message' => $revoked ? 'Logged out successfully' : 'Logout failed!',
                ],
                $revoked ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
            return response()->json([
                'message' => $revoked ? 'Logged out successfully' : 'Logout failed!',
                'status' => Response::HTTP_BAD_REQUEST,
                'error' => true,
                'data' => []
            ]);
        } catch (Exception $e) {
            return response()->json([
                'massege' => 'An error occurred',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ]);
        }
    }
}
