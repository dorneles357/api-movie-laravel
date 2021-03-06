<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register()
    {
        $validator = validator()->make(request()->all(), [
            'name' => 'string|required',
            'email' => 'email|required',
            'password' => 'string|min:6',
            'passwordConf' => 'required|same:password',

        ]);

        if($validator->fails()){
            return response()->json([
                'error' => 'Registration faild'
            ]);
        }

        $user = User::create([
            'name' => request()->get('name'),
            'email' => request()->get('email'),
            'password' => bcrypt(request()->get('password'))
        ]);

        return response()->json([
            'message'=> 'User created',
            'user'=> $user
        ]);

    }

    public function login(Request $request)
    {
        $token = auth()->attempt([
            'email'=> $request->email, 
            'password'=> $request->password,]);

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }


        return $this->respondWithToken($token);
    }  

    public function me()
    {
        return response()->json(auth()->user());
    
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 60
        ]);
    }

}