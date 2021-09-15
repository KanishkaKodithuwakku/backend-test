<?php

namespace App\Repository\QueryBuilder;

use App\Repository\QueryBuilderRepositoryInterface;

interface OrderRepositoryInterface extends QueryBuilderRepositoryInterface
{
    public function fetchOrderData(int $id);
}
