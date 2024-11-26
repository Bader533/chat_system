<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

class FirebaseController extends Controller
{
    protected $firebaseAuth;

    public function __construct()
    {
        // إنشاء كائن Firebase باستخدام Factory
        $firebase = (new Factory)
            ->withServiceAccount('C:/wamp64/www/chat_system/storage/app/d9c4826a33.json') // استدعاء ملف الاعتماد من firebase.php
            ->withProjectId(config('firebase.database.project_id')); // استدعاء projectId

        // إنشاء كائن Auth من Firebase
        $this->firebaseAuth = $firebase->createAuth();
    }

    public function loginWithGoogle(Request $request)
    {
        $idToken = $request->header('Authorization') ?? $request->input('idToken');

        try {
            $verifiedIdToken = $this->firebaseAuth->verifyIdToken($idToken);
            $uid = $verifiedIdToken->claims()->get('sub');
            $user = $this->firebaseAuth->getUser($uid);

            return response()->json([
                'success' => true,
                'user' => $user
            ]);
        } catch (FailedToVerifyToken $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid token',
            ], 401);
        }
    }
}
