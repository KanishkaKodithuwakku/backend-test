<?php


namespace App\Repository\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Repository\OrderRepositoryInterface;
use App\Models\Order;

class OrderRepository extends BaseEloquentRepository implements OrderRepositoryInterface
{
    protected $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    

}
