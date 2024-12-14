<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Http;

class FirebaseController extends Controller
// {
//     protected $firebaseAuth;
//     public function verifyToken(Request $request)
//     {
//         $request->validate([
//             'token' => 'required|string',
//             'provider' => 'required|string|in:google,facebook,apple',
//         ]);

//         $token = $request->input('token');
//         $provider = $request->input('provider');

//         switch ($provider) {
//             case 'google':
//                 return $this->verifyGoogleToken($token);
//             case 'facebook':
//                 return $this->verifyFacebookToken($token);
//             case 'apple':
//                 return $this->verifyAppleToken($token);
//             default:
//                 return response()->json(['error' => 'Invalid provider'], 400);
//         }
//     }

//     private function verifyGoogleToken($token)
//     {
//         $client = new \Google_Client(['client_id' => env('GOOGLE_CLIENT_ID')]);
//         $payload = $client->verifyIdToken($token);

//         if ($payload) {
//             return response()->json(['status' => 'valid', 'user' => $payload]);
//         } else {
//             return response()->json(['error' => 'Invalid Google token'], 401);
//         }
//     }

//     private function verifyFacebookToken($token)
//     {
//         $client = new Client();
//         $response = $client->get("https://graph.facebook.com/debug_token", [
//             'query' => [
//                 'input_token' => $token,
//                 'access_token' => env('FACEBOOK_APP_ACCESS_TOKEN'),
//             ],
//         ]);

//         $data = json_decode($response->getBody(), true);

//         if (isset($data['data']['is_valid']) && $data['data']['is_valid']) {
//             return response()->json(['status' => 'valid', 'user' => $data['data']]);
//         } else {
//             return response()->json(['error' => 'Invalid Facebook token'], 401);
//         }
//     }

//     private function verifyAppleToken($token)
//     {
//         try {
//             $appleKeyUrl = 'https://appleid.apple.com/auth/keys';
//             $client = new Client();
//             $response = $client->get($appleKeyUrl);
//             $keys = json_decode($response->getBody(), true)['keys'];

//             $decoded = JWT::decode($token, new Key($keys[0]['n'], $keys[0]['kty']));
//             return response()->json(['status' => 'valid', 'user' => $decoded]);
//         } catch (\Exception $e) {
//             return response()->json(['error' => 'Invalid Apple token'], 401);
//         }
//     }
// }
