<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any articles.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        // Allow all users to view articles
        return true;
    }

    /**
     * Determine whether the user can view a specific article.
     *
     * @param User $user
     * @param Article $article
     * @return bool
     */
    public function view(User $user, Article $article): bool
    {
        // Allow admins or the article owner to view an article
        return $user->is_admin || $user->id === $article->user_id;
    }

    /**
     * Determine whether the user can create articles.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        // Allow all users to create articles
        return true;
    }

    /**
     * Determine whether the user can update a specific article.
     *
     * @param User $user
     * @param Article $article
     * @return bool
     */
    public function update(User $user, Article $article): bool
    {
        // Allow only the article owner to update an article
        return $user->id === $article->user_id;
    }

    /**
     * Determine whether the user can delete articles.
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user): bool
    {
        // Allow only admins to delete articles
        return $user->is_admin;
    }

    /**
     * Determine whether the user can restore a specific article.
     *
     * @param User $user
     * @return bool
     */
    public function restore(User $user): bool
    {
        // Allow only admins to restore an article
        return $user->is_admin;
    }

    /**
     * Determine whether the user can approve articles.
     *
     * @param User $user
     * @return bool
     */
    public function approve(User $user): bool
    {
        // Allow only admins to approve articles
        return $user->is_admin;
    }
}
