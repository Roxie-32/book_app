<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\User\User as UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Str;


class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        $user= User::create( [
            'slug' => Str::random(6),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'is_email_verified' => 0,
            'password' => bcrypt($request->input('password')),
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response= [
            'user' => $user,
            'token'=> $token
        ];
  
        return response($response, 201);
    }

    public function login(LoginRequest $request){
      
        //Check email

        $user= User::where('email', $request['email'])->first();

        //Check Password
        if(!$user || !Hash::check($request['password'], $user->password) ){
            return response([
                'message'=>'Invalid Credentials'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response= [
            'user' => $user,
            'token'=> $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return [
            'message'=> 'Logged out'
        ];
    }
       
}
