<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): Response|JsonResponse
    {
        $request->authenticate();

        // Get the authenticated user
        $user = Auth::user();

        // Create a Sanctum token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return the user and token as a JSON response
        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        // Revoke the user's current token
        $request->user()->currentAccessToken()->delete();

        // Return a no-content response
        return response()->noContent();
    }
}
