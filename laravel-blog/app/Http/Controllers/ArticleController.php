<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use Illuminate\Auth\Events\Validated;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // vraag: wat is het nut van onderstaande policy?
        Gate::authorize('viewAny', Article::class);

        return view('articles.index', [
            'articles' => Article::where('user_id', Auth::id())
                                ->withCount('comments')
                                ->latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Article::class);

        return view('articles.create', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleStoreRequest $request)
    {
        Gate::authorize('create', Article::class);

        $validated = $request->validated();

        if (isset($validated['image'])) {
            $validated['image_path'] = $validated['image']->store('images');
        }

        /*
         * use make() to get an unsaved instance of Article, so we can add the correct
         * sponsored_untill date & time without an extra query
         */
        $article = $request->user()->articles()->make();
        $article->fill($validated);
        $article->sponsored_untill = now();
        $article->save();

        if (isset($validated['categories'])) {
            $article->categories()->attach($validated['categories']);
        }

        if ($validated['is_sponsored_content']) {
            return redirect()->route('sponsor.show', $article);
        }

        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        Gate::authorize('view', $article);

        return view('articles.view', [
            'article' => $article,
            'comments' => $article->comments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        Gate::authorize('update', $article);

        return view('articles.edit', [
            'article' => $article,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleUpdateRequest $request, Article $article)
    {
        Gate::authorize('update', $article);

        $validated = $request->validated();

        if (isset($validated['image'])) {
            if (isset($article->image_path)) {
                Storage::delete($article->image_path);
            }
            $validated['image_path'] = $validated['image']->store('images');
        }

        $article->update($validated);

        // we need to check if the categories key exists, it might not if the user hasn't selected any
        if (isset($validated['categories'])) {
            $article->categories()->sync($validated['categories']);
        } else {
            $article->categories()->detach();
        }

        if ($validated['is_sponsored_content']) {
            return redirect()->route('sponsor.show', $article);
        }

        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        Gate::authorize('delete', $article);

        $article->delete();

        return redirect()->route('articles.index');
    }

    /**
     * Show the form for sponsoring an article.
     */
    public function showSponsor(Article $article)
    {
        Gate::authorize('update', $article);

        return view('articles.sponsor', [
            'article' => $article,
        ]);
    }

    /**
     * Sponsor an article
     */
    public function updateSponsor(Article $article)
    {
        Gate::authorize('update', $article);

        $article->sponsored_untill = now()->addMonth();
        $article->save();

        return redirect()->route('articles.index');
    }
}
