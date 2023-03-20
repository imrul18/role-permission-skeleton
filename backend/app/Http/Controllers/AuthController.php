<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
            return response()->json('Invalid Credential', 401);

        $user = auth()->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        $data['userData'] = $user;
        $data['accessToken'] = $token;

        return response()->json($data);
    }
}
