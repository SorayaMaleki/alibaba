<?php

namespace App\Services;

use App\Models\Article;
use App\Repositories\ArticleRepositoryInterface;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class ArticleService
 *
 * @package App\Services
 */
class ArticleService implements ArticleInterface
{
    protected $user;

    /**
     * ArticleService constructor.
     *
     * @param ArticleRepositoryInterface $articleRepository
     */
    public function __construct(
        public ArticleRepositoryInterface $articleRepository,
    )
    {
    }

    /**
     * Create a new article.
     *
     * @param array $payload
     * @return Model
     * @throws Exception
     */
    public function createArticle(array $payload): Model
    {
        $payload["status"] = "draft";
        $payload["user_id"] = $this->getUser()->id;
        return $this->articleRepository->create($payload);
    }

    /**
     * Get all articles based on user role.
     *
     * @return Collection
     * @throws Exception
     */
    public function getAllArticles(): Collection
    {
        if ($this->getUser()->is_admin) {
            return $this->articleRepository->all();
        }
        return $this->getUser()->articles()->get();
    }

    /**
     * Find an article by ID.
     *
     * @param Article $article
     * @return Model
     */
    public function findArticle(Article $article): Model
    {
        return $this->articleRepository->find($article);
    }

    /**
     * Update an existing article. status will be draft after update
     *
     * @param array $payload
     * @param Article $article
     * @return Model
     * @throws Exception
     */
    public function updateArticle(array $payload, Article $article): Model
    {
        $payload["status"] = "draft";
        $payload["user_id"] = $this->getUser()->id;
        $payload["publish_date"] = null;
        return $this->articleRepository->update($payload, $article);
    }

    /**
     * Delete an article by ID.
     *
     * @param Article $article
     * @return bool
     */
    public function deleteArticle(Article $article): bool
    {
        return $this->articleRepository->delete($article);
    }

    /**
     * Approve an article for publishing.
     *
     * @param Article $article
     * @return Model
     */
    public function approveArticle(Article $article): Model
    {
        $payload["status"] = "published";
        $payload["publish_date"] = now();
        return $this->articleRepository->update($payload, $article);
    }

    /**
     * Get all articles based on user role.
     *
     * @return Collection
     * @throws Exception
     */
    public function getTrashedArticles(): Collection
    {
        return $this->articleRepository->trashed();
    }

    /**
     * Restore an article for publishing.
     *
     * @param  $articleId
     * @return bool
     */
    public function restoreArticle($articleId): bool
    {
        return $this->articleRepository->restore($articleId);
    }
    /**
     * Get the authenticated user.
     * @throws Exception
     */
    private function getUser(): Authenticatable
    {
        $user = Auth::user();
        if (!$user) {
            throw new Exception('User not authenticated');
        }
        return $user;
    }
}
