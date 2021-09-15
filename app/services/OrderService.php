<?php


namespace App\Services;


use App\Models\Order;
use Illuminate\Support\Collection;

class OrderService
{
    public function calcBill(Collection $lneTotalData)
    {
        return number_format($lneTotalData->sum(), '2', '.', '');
    }

    public function appendDatatoModel(Order $order, array $data = [])
    {
        foreach ($data as $key => $value) {
            $order[$key] = $value;
        }
        return $order;
    }
}
