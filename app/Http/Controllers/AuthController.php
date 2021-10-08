<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('apptoken')->plainTextToken;

        return response([
            'data' => $user,
            'meta' => [
                'token' => $token
            ]
        ], 201);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Could not find you with these credials'
            ], 401);
        }

        $token = $user->createToken('apptoken')->plainTextToken;

        return response([
            'data' => $user,
            'meta' => [
                'token' => $token
            ],
        ], 201);
    }

    public function logout() {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'logged out'
        ]);
    }
}
