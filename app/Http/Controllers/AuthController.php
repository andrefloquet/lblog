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
   // 
   public function register(Request $request)
   {

      $user = User::create([
         'name' => $request->name,
         'email' => $request->email,
         'password' => bcrypt($request->password)
      ]);

      return new UserResource($user);
      
    //   $token = $user->createToken('mytoken')->plainTextToken;

    //   return response([
    //      'user' => $user,
    //      'token' => $token
    //   ], 201); 
   }

    public function login(UserLoginRequest $request)
    {
       /*
        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Could not find you with these credials'
            ], 401);
        }

        $token = $user->createToken('apptoken')->plainTextToken;
        */
        if(!auth()->attempt($request->only('email', 'password'))) {
            //throw new AuthenticationException();
            return response([
                'message' => 'Could not find you with these credials'
            ], 401);
        }

        return new UserResource(auth()->user());

        /*
        return response([
            'data' => $user,
            'meta' => [
                'token' => $token
            ],
        ], 201);
        */
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();
        //$request->user()->currentAccessToken()->delete();
        //auth()->logout();
        //auth()->guard('web')->logout();
        return response([
            'message' => 'logged out'
        ]);
    }
    
    public function test(Request $request) {
       return response(['message' => 'test 1']);
    }
}
