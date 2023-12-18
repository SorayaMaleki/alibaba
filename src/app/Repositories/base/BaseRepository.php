<?php

namespace App\Repositories\base;

use App\Models\Article;
use App\Traits\Models\Findable;
use App\Traits\Models\Listable;
use App\Traits\Models\Paginatable;
use App\Traits\Models\Syncable;
use App\Traits\Models\Updatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(protected Model $model)
    {
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all()->sortByDesc('id');
    }

    /**
     * Find entity by id.
     *
     * @param Model $model
     * @return Model
     */
    public function find(Model $model): Model
    {
        return $model;
    }

    /**
     * update given model
     *
     * @param array $payload
     * @param Model $model
     * @return Model
     */
    public function update(array $payload, Model $model): Model
    {
        $model->update($payload);
        return $model;
    }

    /**
     * delete model
     *
     * @param Model $model
     * @return bool
     */
    public function delete(Model $model): bool
    {
        return $model->delete();
    }

    /**
     * Returns Trashed items
     * @return Collection
     */
    public function trashed(): Collection
    {
        return $this->model->onlyTrashed()->get();
    }

    /**
     * Restore Trashed items
     * @param $id
     * @return bool
     */
    public function restore($id): bool
    {
        return $this->model->withTrashed()->find($id)->restore();
    }

}
