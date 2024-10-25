<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\Category;

class HomeServer extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $selectedCategoryID = $request->query("category");
        if (isset($selectedCategoryID)) {
            $articles =  Category::find($selectedCategoryID)->articles()->with(['user:id,name', 'categories:id,name'])->latest()->paginate(10);
        } else {
            $articles =  Article::with(['user:id,name', 'categories:id,name'])->latest()->paginate(10);
        }

        return view('home', [
            'articles' => $articles,
            'categories' => Category::all(),
            'selectedCategoryID' => $selectedCategoryID,
        ]);
    }
}
