<?php


namespace App\Repository\Eloquent;

use App\Repository\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(
        array $columns = ['*'],
        array $relations = []
    ): Collection {

        $results = $this->model->select($columns)->with($relations)->get();

        return $results;
    }

    public function findById(
        $id,
        array $columns = ['*'],
        array $relations = []
    ): Model {

        $results = $this->model->select($columns)->with($relations)->find($id);

        return $this->model->select($columns)->with($relations)->find($id);
    }
}
