<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Contracts\Database\Eloquent\Builder;

class HomeServer extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $request->merge([
            'onlyPremium' => $request->boolean('onlyPremium'),
        ]);

        $validated = $request->validate([
            'category' => 'nullable|exists:categories,id',
            'search' => 'nullable|string|max:255',
            'onlyPremium' => 'nullable|boolean',
        ]);

        $articles = Article::query()
                    ->when($validated['category'] ?? null, function(Builder $query, int $category) {
                        $query->inCategory($category);
                    })
                    ->when($validated['search'] ?? null, function(builder $query, string $searchTerm) {
                        $query->searchTitle($searchTerm);
                    })
                    ->when($validated['onlyPremium'], function(Builder $query, bool $onlyPremium) {
                        $query->whereIsPremiumContent($onlyPremium);
                    })
                    ->latest()
                    ->paginate(10)->withQueryString();

        //save the data from the query string so we can use the old() method in blade
        request()->flash();

        return view('home', [
            'articles' => $articles,
            'categories' => Category::all(),
        ]);
    }
}