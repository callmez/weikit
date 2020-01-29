<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="L5 OpenApi",
 *      description="L5 Swagger OpenApi description",
 *      @OA\Contact(
 *          email="darius@matulionis.lt"
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
