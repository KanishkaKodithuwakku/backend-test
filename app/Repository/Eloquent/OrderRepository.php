<?php


namespace App\Repository\Eloquent;

use Illuminate\Database\Eloquent\Model;


class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

}
