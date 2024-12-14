<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TokenController extends Controller
{
    // public function refreshToken(Request $request)
    // {
    //     $request->validate([
    //         'refresh_token' => 'required',
    //     ]);

    //     $http = new Client;

    //     try {
    //         $response = $http->post(env('APP_URL') . '/oauth/token', [
    //             'form_params' => [
    //                 'grant_type' => 'refresh_token',
    //                 'refresh_token' => $request->refresh_token,
    //                 'client_id' => env('PASSPORT_CLIENT_ID'),
    //                 'client_secret' => env('PASSPORT_CLIENT_SECRET'),
    //                 'scope' => '',
    //             ],
    //         ]);

    //         return json_decode((string) $response->getBody(), true);
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => 'فشل في تجديد التوكن'], 500);
    //     }
    // }
}
