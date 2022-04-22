<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::whereEmail($request->email);
        abort_unless($user->exists(), 401, "Wrong Credentials");
        $user = $user->first();
        abort_unless(Hash::check($request->password, $user->password), 401, "Wrong Credentials");

        //idealy i would make a cron job to remove expired tokens or use passport
        //but for the sake of simplicity that works:)
        $user->tokens()->delete();
        $token = $user->createToken($request->userAgent());
        return ['user' => $user, 'token' => $token->plainTextToken];
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        $token = $user->createToken($request->userAgent());
        return ['user' => $user, 'token' => $token->plainTextToken];
    }

    public function me(Request $request)
    {
        return $request->user();
    }
}
