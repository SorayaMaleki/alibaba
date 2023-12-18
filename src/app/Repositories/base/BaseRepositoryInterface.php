<?php

namespace App\Repositories\base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Find entity by id.
     *
     * @param int $model
     * @return Model
     */
    public function find(Model $model): Model;

    /**
     * @param Model $model
     * @return bool
     */
    public function delete(Model $model): bool;

    /**
     * @param array $payload
     * @param Model $model
     * @return Model
     */
    public function update(array $payload, Model $model): Model;


    /**
     *
     * @return Collection
     */
    public function trashed(): Collection;

    /**
     * Restore the given model instance
     *
     * @param  $id
     * @return bool
     */
    public function restore($id): bool;
}
