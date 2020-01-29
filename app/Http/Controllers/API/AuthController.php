<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;


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

    public function login(Request $request)
    {
        $user = User::where('username', $request->post('username'))->firstOrFail();
        $token = $this->userService->loginByPassword($user, $request->post('password'));
        return [ 'access_token' => $token->plainTextToken ];
    }
//
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'username' => $request->get('username'),
            'email'    => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);
        $user->sendActiveMail();
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;

        return response()->json([
            'token' => $token,
        ]);
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
