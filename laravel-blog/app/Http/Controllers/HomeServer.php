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
        $category = $request->query("category");
        if (isset($category)) {
            $articles =  Category::find($category)->articles()->latest()->paginate(10);
        } else {
            $articles =  Article::latest()->paginate(10);
        }

        //save the data from the query string so we can use the old() method in blade
        request()->flash();

        return view('home', [
            'articles' => $articles,
            'categories' => Category::all(),
        ]);
    }
}