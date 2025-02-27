<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function me(Request $request)
    {
        return response()->json([
            'user' => new UserResource(Auth::user()),
        ]);
    }

    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => ['required', 'string', 'email'],
                'password' => ['required', 'string'],
            ],
        );

        if (Auth::attempt($credentials, $request->boolean('rememberMe'))) {
            $request->session()->regenerate();

            return response()->json([
                'user' => new UserResource(Auth::user()),
            ]);
        }

        return throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.',
        ],
        );
    }

    public function logout(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
