<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Article $article): Response
    {
        $is_premium_content = $article->is_premium_content;
        if (!$is_premium_content) {
            return Response::allow();
        }
        return isset($user) && ($user->has_premium || $article->user()->is($user))
                ? Response::allow()
                : Response::deny('Only registered users with premium can read this article.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Article $article): bool
    {
        return $article->user()->is($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Article $article): bool
    {
        return $article->user()->is($user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Article $article): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Article $article): bool
    {
        //
    }
}
