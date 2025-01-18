<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Kreait\Firebase\Auth;

class VerifyFirebaseToken
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $idToken = $request->bearerToken();
        set_time_limit(60);
        if (!$idToken) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        try {
            $verifiedToken = $this->auth->verifyIdToken($idToken);
            $request->attributes->add(['firebase_user' => $verifiedToken->claims()]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Invalid Token'], 401);
        }

        return $next($request);
    }
}
