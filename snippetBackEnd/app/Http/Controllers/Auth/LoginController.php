<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            "email" => "required|email",
            "password" => "required"
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

        return response()->json([
            "data" => compact("token")
        ]);
    }
}
