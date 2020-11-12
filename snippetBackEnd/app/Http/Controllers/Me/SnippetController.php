<?php

namespace App\Http\Controllers\Me;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\Snippets\SnippetTransformer;

class SnippetController extends Controller
{

    public function __construct()
    {
        $this->middleware(['jwt.auth']);
    }

    public function index(Request $request)
    {
        return fractal()->collection($request->user()->snippets)
        ->transformWith(new SnippetTransformer())
        ->toArray();
    }
}
