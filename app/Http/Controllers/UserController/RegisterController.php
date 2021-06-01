<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

use App\Models\User as User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request){
        $user= User::create( [
            'slug' => $request->input('slug'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'is_email_verified' => 0,
            'password' => $request->input('password'),

        ]);

        return response()->json(['msg'=> $user],201);
    }
}
