<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\User\User as UserResource;
use Str;
use App\Models\User as User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function store(RegisterRequest $request){
        $user= User::create( [
            'slug' => Str::random(6),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'is_email_verified' => 0,
            'password' => bcrypt($request->input('password')),
        ]);
        return new UserResource($user);
    }
  
}
