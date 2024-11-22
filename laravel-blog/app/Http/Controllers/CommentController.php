<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Article;
use App\Models\Comment;

use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Article $article)
    {
        return redirect()->route('articles.show', $article)->withFragment('comments');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Article $article)
    {
        Gate::authorize('create', Comment::class);

        return view('comments.create', compact('article'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request, Article $article)
    {
        Gate::authorize('create', Comment::class);

        $validated = $request->validated();

        $comment = $article->comments()->make();
        $comment->fill($validated);
        $comment->user_id = $request->user()->id;
        $comment->save();

        return redirect()->route('articles.show', $article)->withFragment($comment->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return redirect()->route('articles.show', $comment->article)->withFragment($comment->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        Gate::authorize('update', $comment);

        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        Gate::authorize('update', $comment);

        $validated = $request->validated();

        $comment->update($validated);

        return redirect()->route('articles.show', $comment->article)->withFragment($comment->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        Gate::authorize('delete', $comment);

        $comment->delete();

        return redirect()->back()->withFragment('comments');
    }
}
