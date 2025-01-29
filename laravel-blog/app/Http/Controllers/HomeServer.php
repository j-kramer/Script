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
    // TODO: overweeg om homecontroller af te schaffen en alles via de articles controller te doen.
    // voor filteren van categorieen, search etc. kun je dit evt. met model scope doen:
    // https://medium.com/@luckys383/laravel-common-filters-using-model-scope-372111e66063
    public function __invoke(Request $request)
    {

        $request->merge([
            'onlyPremium' => $request->boolean('onlyPremium'),
            'ignoreSponsored' => $request->boolean('ignoreSponsored'),
        ]);

        $validated = $request->validate([
            'category' => 'nullable|exists:categories,id',
            'search' => 'nullable|string|max:255',
            'onlyPremium' => 'boolean',
            'ignoreSponsored' => 'boolean',
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
                    ->when(!$validated['ignoreSponsored'], function(Builder $query, bool $ignoreSponsored) {
                        $query->orderBySponsored();
                    }, fn ($q) => $q->latest())
                    ->withCount('comments')
                    ->paginate(10)
                    ->withQueryString();

        //save the data from the query string so we can use the old() method in blade
        request()->flash();

        return view('home', [
            'articles' => $articles,
            'categories' => Category::all(),
        ]);
    }
}