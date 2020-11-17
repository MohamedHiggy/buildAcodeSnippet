<?php

namespace App\Http\Controllers\Auth\Otp;

use Google2FA;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class OtpController extends Controller
{
    public function __construct()
    {
        $this->middleware(['jwt.auth']);
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $user->update([
            'google2fa_secret' => $secret = Google2FA::generateSecretKey()
        ]);
        return response()->json([
            "data" => Google2FA::getQRCodeInline(
                'mohamedHiggy',
                $user->email,
                $user->google2fa_secret
            )
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'otp' => 'required',
        ]);

        $user = $request->user();

        if (!Google2FA::verifyKey($user->google2fa_secret, $request->otp)) {
            return response()->json([
                "errors" => [
                    'reason' => 'incorrect code'
                ]
            ], 401);
        }
        $user->update([
            'google2fa_enabled' => true,
        ]);
    }

    public function destroy(Request $request)
    {
        $user = $request->user();

        $this->validate($request, [
            'password' => [
                'required',
                function ($attribute, $value, $fail) use ($request, $user) {
                    if (!Hash::check($request->password, $user->password)) {
                        $fail('Incorrect password');
                    }
                }
            ]
        ]);

        $user->update([
            'google2fa_secret' => null,
            'google2fa_enabled' => false,
        ]);
    }
}
