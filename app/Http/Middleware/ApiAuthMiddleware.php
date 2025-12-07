<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class ApiAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Access token is required'
            ], 401);
        }

        $user = User::where('api_token', $token)->first();
        
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid access token'
            ], 401);
        }

        // Attach user to request
        auth()->setUser($user);

        return $next($request);
    }
}