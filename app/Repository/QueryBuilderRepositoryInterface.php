<?php

namespace App\Repository;

interface QueryBuilderRepositoryInterface
{
    public function findById(
        array $condition,
        array $columns = ['*'],
        array $relations = null
    );

    public function findAllById(
        array $condition,
        array $columns = ['*'],
        array $relations = null
    );
}
