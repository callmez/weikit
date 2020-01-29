<?php

namespace App\Http\Controllers;

use App\Models\User;

class TestController extends Controller
{

    /**
     * @OA\Get(
     *      path="/projects",
     *      operationId="getProjectsList",
     *      tags={"Projects"},
     *      summary="Get list of projects",
     *      description="Returns list of projects",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     *
     * Returns list of projects
     */
    public function index()
    {
        $user =  User::cachedFind(1);
//        return 'hello world';

        return '<html><head><title>hello</title></head><body>123</body></html>';
    }
}
