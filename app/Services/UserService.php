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

    public function register(array $data)
    {
        $user = new User($data);
        if (!$user->save()) {
            throw new \Exception('register failed');
        }
        $this->sendRegisteredMail($user);
        return $user;
    }

    public function sendRegisteredMail(User $user)
    {

    }
}
