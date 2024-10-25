<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
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
        Gate::authorize('viewAny', Article::class);

        return view('articles.index', [
            'articles' => Article::with(['categories'])->where('user_id', Auth::id())->latest()->paginate(10),
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
    public function store(ArticleRequest $request)
    {
        Gate::authorize('create', Article::class);

        $validated = $request->validated();

        if (isset($validated['image'])) {
            $validated['image_path'] = $validated['image']->store('images');
        }

        $article = $request->user()->articles()->create($validated);

        if (isset($validated['categories'])) {
            $article->categories()->attach($validated['categories']);
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
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        Gate::authorize('update', $article);

        return view('articles.edit', [
            'article' => $article->load('categories'),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        Gate::authorize('update', $article);

        $validated = $request->validated();

        if (isset($validated['image'])) {
            Storage::delete($article->image_path);
            $validated['image_path'] = $validated['image']->store('images');
        }

        $article->update($validated);

        // we need to check if the categories key exists, it might not if the user hasn't selected any
        if (isset($validated['categories'])) {
            $article->categories()->sync($validated['categories']);
        } else {
            $article->categories()->detach();
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
}
