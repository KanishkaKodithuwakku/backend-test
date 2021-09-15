<?php


namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface
{
    public function all(
        array $columns = ['*'],
        array $relations = []
    ): Collection;

    public function findById(
        $id,
        array $columns = ['*'],
        array $relations = []
    ): Model;

}
