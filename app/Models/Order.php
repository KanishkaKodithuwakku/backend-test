<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'orderNumber';

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerNumber','customerNumber');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'orderdetails','orderNumber','productCode')
            ->withPivot(OrderDetail::ATTRIBUTES)
            ->using(OrderDetail::class);
    }
}
