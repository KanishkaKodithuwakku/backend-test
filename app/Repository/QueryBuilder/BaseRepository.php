<?php

namespace App\Repository\QueryBuilder;

use App\Exceptions\DataNotFoundException;
use App\Repository\QueryBuilderRepositoryInterface;
use Illuminate\Support\Facades\DB;

class BaseRepository implements QueryBuilderRepositoryInterface
{
    protected $table;

    public function __contruct(string $table)
    {
        $this->table = $table;
    }

    public function fetchQuery(
        array $condition,
        array $columns = ['*'],
        array $relations = null
    ) {
        $query = DB::table($this->table)
            ->select($columns)
            ->where($condition['key'], $condition['operator'],
                $condition['value']);

        if ($relations > 0) {
            for ($i = 0; $i < count($relations); $i++) {
                $query->join($relations[$i]['table'], $relations[$i]['keys'][0],
                    '=', $relations[$i]['keys'][1]);
            }
        }

        $query = $query->select($columns)
            ->where($condition['key'], $condition['operator'],
                $condition['value']);

        return $query;
    }

    public function findById(
        array $condition,
        array $columns = ['*'],
        array $relations = null
    ) {
        $query = $this->fetchQuery($condition, $columns, $relations);

        $results = $query->first();

        return $results;
    }

    public function findAllById(
        array $condition,
        array $columns = ['*'],
        array $relations = null
    ) {
        $query = $this->fetchQuery($condition, $columns, $relations);

        $results = $query->get();

       
        return $results;
    }
}
