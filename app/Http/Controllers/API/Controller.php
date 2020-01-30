<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="API",
 *      description="API",
 *      @OA\Contact(
 *          email="callme-z@qq.com"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 */
class Controller extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:airlock');
    }
}
