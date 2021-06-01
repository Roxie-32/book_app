<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
        'slug'=>$this->slug,
        'username'=>$this->username,
        'email'=>$this->email,
        'is_email_verified'=>$this->is_email_verified,
        'password'=>$this->password,
        ];
    }
}
