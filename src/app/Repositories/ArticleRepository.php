<?php

namespace App\Repositories;

use App\Models\Article;
use App\Repositories\base\BaseRepository;

class ArticleRepository extends BaseRepository implements ArticleRepositoryInterface
{
    /**
     * Binds the model to Contact class.
     * @param Article $model
     */
    public function __construct(Article $model)
    {
        $this->model = $model;
    }
}
