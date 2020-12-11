<?php

namespace App\Http\Controllers\Auth;
use Google2FA;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            "email" => "required|email",
            "password" => "required|min:8"
        ]);

        if (!$token = auth()->attempt($request->only("email", "password"))) {
            return response()->json([
                "errors" => [
                    'email' => [
                        "could not sign you in with those details"
                    ],
                    'password' => [
                        "maybe your password is wrong"
                    ]
                ]
            ], 422);
        }

        $user = $request->user();
        if ($user->google2fa_enabled && !$request->otp) {
            return response([
                'reason' => [
                    'REQUIRES_OTP'
                ]
            ], 401);
        }
        if ($user->google2fa_enabled && $request->otp) {
            if (!Google2FA::verifyKey($user->google2fa_secret, $request->otp)) {
                return response([
                    'reason' => [
                        'INCORRECT_OTP'
                    ]
                ], 401);
            }
        }

        return response()->json([
            "data" => compact("token")
        ]);
    }
}
