<?php

namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    
    public function loginByPassword(User $user, $password)
    {
        if (! Hash::check($password, $user->password)) {
            throw new \Exception('login failed');
        }
        return $user->createToken($user->username);
    }
}
