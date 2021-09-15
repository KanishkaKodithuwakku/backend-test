<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'productCode';
    protected $keyType = 'string';
    
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'orderdetails','productCode','orderNumber')
            ->withPivot('quantityOrdered', 'priceEach', 'orderLineNumber');
    }


}
