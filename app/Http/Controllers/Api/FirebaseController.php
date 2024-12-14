<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

class FirebaseController extends Controller
{
    protected $firebaseAuth;

    // public function __construct()
    // {
    //     // إنشاء كائن Firebase باستخدام Factory
    //     $firebase = (new Factory)
    //         ->withServiceAccount('C:/wamp64/www/chat_system/storage/app/d9c4826a33.json') // استدعاء ملف الاعتماد من firebase.php
    //         ->withProjectId(config('firebase.database.project_id')); // استدعاء projectId

    //     // إنشاء كائن Auth من Firebase
    //     $this->firebaseAuth = $firebase->createAuth();
    // }

    // public function loginWithGoogle(Request $request)
    // {
    //     $idToken = $request->header('Authorization') ?? $request->input('idToken');

    //     try {
    //         $verifiedIdToken = $this->firebaseAuth->verifyIdToken($idToken);
    //         $uid = $verifiedIdToken->claims()->get('sub');
    //         $user = $this->firebaseAuth->getUser($uid);

    //         return response()->json([
    //             'success' => true,
    //             'user' => $user
    //         ]);
    //     } catch (FailedToVerifyToken $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Invalid token',
    //         ], 401);
    //     }
    // }

    // public function loginWithFirebase(Request $request)
    // {
    //     $idToken = $request->token;

    //     $googleKeys = json_decode(file_get_contents('https://www.googleapis.com/oauth2/v1/certs'), true);
    //     try {
    //         $decoded = JWT::decode($idToken, JWK::parseKeySet($googleKeys), ['RS256']);

    //         // تحقق من وجود المستخدم
    //         $user = \App\Models\User::updateOrCreate(
    //             ['email' => $decoded->email],
    //             [
    //                 'name' => $decoded->name ?? $decoded->email,
    //                 'provider_id' => $decoded->sub,
    //                 'provider_name' => 'firebase',
    //                 'avatar' => $decoded->picture ?? null,
    //             ]
    //         );

    //         $token = $user->createToken('auth_token')->plainTextToken;

    //         return response()->json([
    //             'access_token' => $token,
    //             'token_type' => 'Bearer',
    //             'user' => $user,
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Invalid token'], 401);
    //     }
    // }

    public function loginWithFirebase(Request $request)
    {
        $idToken = $request->token;
        $provider = $request->provider;

        if (!$idToken || !$provider) {
            return response()->json(['error' => 'Token and provider are required'], 400);
        }

        $googleKeys = cache()->remember('google_oauth_keys', 60, function () {
            return json_decode(file_get_contents('https://www.googleapis.com/oauth2/v1/certs'), true);
        });

        try {
            $decoded = JWT::decode($idToken, JWK::parseKeySet($googleKeys), ['RS256']);

            $user = \App\Models\User::updateOrCreate(
                ['email' => $decoded->email],
                [
                    'name' => $decoded->name,
                    'email' => $decoded->email,
                    // 'provider_id' => $decoded->sub,
                    // 'provider_name' => $provider,
                    // 'avatar' => $decoded->picture ?? null,
                ]
            );

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
            ]);
        } catch (\Firebase\JWT\ExpiredException $e) {
            return response()->json(['error' => 'Token expired'], 401);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid token: ' . $e->getMessage()], 401);
        }
    }
}
