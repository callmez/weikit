<?php

namespace App\Http\Controllers;

use App\Models\User;

class TestController extends Controller
{
    public function index()
    {
        $user =  User::cachedFind(1);
//        return 'hello world';

        return '<html><head><title>hello</title></head><body>123</body></html>';
    }
}
