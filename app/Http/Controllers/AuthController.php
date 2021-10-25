<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   public function register(Request $request)
   {

      $user = User::create([
         'name' => $request->name,
         'email' => $request->email,
         'password' => bcrypt($request->password)
      ]);

      return new UserResource($user);

   }

    public function login(UserLoginRequest $request)
    {
        if(!auth()->attempt($request->only('email', 'password'))) {
            //throw new AuthenticationException();
            return response([
                'data' => 'Could not find you with these credials'
            ], 401);
        }

        return new UserResource(auth()->user());
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();
        return response([
            'data' => 'logged out'
        ]);
    }
}
