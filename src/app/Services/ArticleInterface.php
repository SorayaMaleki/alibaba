<?php

namespace App\Services;
use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;

interface ArticleInterface
{

    public function createArticle(array $payload);

    public function getAllArticles();

    public function findArticle(Article $article);

    public function updateArticle(array $payload,Article $article);

    public function deleteArticle(Article $article);

    public function approveArticle(Article $article);
    public function getTrashedArticles();
    public function restoreArticle($articleId);
}
