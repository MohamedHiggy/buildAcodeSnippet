<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignOutController extends Controller
{
    public function __construct()
    {
        $this->middleware(['jwt.auth']);
    }

    public function __invoke(Request $request)
    {
        auth()->logout();
    }
}
