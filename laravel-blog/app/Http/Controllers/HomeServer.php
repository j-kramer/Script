<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;

class HomeServer extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('home', [
            'articles' => Article::with(['user', 'categories'])->latest()->get(),
        ]);
    }
}
