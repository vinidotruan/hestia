<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        User::create($request->all());
        return response()->json([
            'data' => 'User created'
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken('login');
            return response()->json([
                'token' => $token->plainTextToken
            ]);
        }

        return response()->json([
            'error' => 'Wrong credentials'
        ], 403);
    }

}
