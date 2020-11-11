<?php

namespace App\Http\Controllers\Snippets;

use App\Step;
use App\Snippet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StepController extends Controller
{
    public function update(Snippet $snippet , Step $step, Request $request)
    {
        //authorize!

        $step->update($request->only('title', 'body'));
    }
}
