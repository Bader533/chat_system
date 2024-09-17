<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('dashboard.auth.sign-in');
    }

    public function login(Request $request)
    {
        // Validate the request
        $validator = Validator($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }

        // Retrieve the user by email
        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        // Check if user type is valid
        if ($user->type !== 0 && $user->type !== 1) {
            return response()->json(['message' => 'User not found'], Response::HTTP_FORBIDDEN);
        }

        // Prepare credentials for authentication
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        // Attempt to authenticate
        if (Auth::guard('web')->attempt($credentials)) {
            return response()->json(['message' => 'Logged In Successfully'], Response::HTTP_OK);
        } else {
            // Authentication failed
            return response()->json(['message' => 'Login Failed'], Response::HTTP_BAD_REQUEST);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        return redirect()->route('login');
    }
}
