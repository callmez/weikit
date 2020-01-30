<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;


/**
 * @OA\Tag(
 *     name="Auth",
 *     description="验证",
 * )
 */
class AuthController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('auth:airlock')->except([
            'login',
            'register',
            'forgetPassword',
            'resetPassword',
            'resetPasswordByToken',
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/login",
     *     operationId="login",
     *     tags={"Auth"},
     *     summary="用户密码登录",
     *     description="提交账号密码登录",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="username",
     *                     description="用户名",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     description="密码",
     *                     type="string",
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="成功登录"
     *     ),
     * )
     */
    public function login(Request $request)
    {
        $user = User::where('username', $request->post('username'))->firstOrFail();
        $token = $this->userService->loginByPassword($user, $request->post('password'));

        return ['access_token' => $token->plainTextToken];
    }

    /**
     * @OA\Post(
     *     path="/api/v1/register",
     *     operationId="register",
     *     tags={"Auth"},
     *     summary="用户注册",
     *     description="用户注册",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="username",
     *                     description="用户名",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     description="邮箱",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     description="密码",
     *                     type="string",
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="成功登录"
     *     ),
     * )
     */
    public function register(RegisterRequest $request)
    {
        $user = $this->userService->register([
            'username' => $request->get('username'),
            'email'    => $request->get('email'),
            'password' => $request->get('password'),
        ]);

        return $user;
    }
//
//    public function reset(Request $request)
//    {
//        return $request->get('email') ?
//            $this->resetPasswordByToken($request) :
//            $this->resetPassword($request);
//    }
//
//    public function resetPasswordByToken(Request $request)
//    {
//        $this->validate($request, [
//            'token'    => 'required',
//            'email'    => 'required|email',
//            'password' => 'required|confirmed|min:6',
//        ]);
//        $this->broker()->reset(
//            $this->credentials($request), function ($user, $password) {
//            $user->password = Hash::make($password);
//            $user->setRememberToken(Str::random(60));
//            $user->save();
//            event(new PasswordReset($user));
//        }
//        );
//
//        return response()->json();
//    }
//
//    public function resetPassword(Request $request)
//    {
//        $request->validate([
//            'old_password' => 'required|hash:' . auth()->user()->password,
//            'password'     => 'required|different:old_password|confirmed',
//        ], [
//            'old_password.hash' => '旧密码输入错误！',
//        ], [
//            'old_password' => '旧密码',
//        ]);
//        auth()->user()->update([
//            'password' => bcrypt($request->get('password')),
//        ]);
//
//        return response()->json();
//    }
}
