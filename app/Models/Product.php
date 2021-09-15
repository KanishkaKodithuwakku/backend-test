<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'productCode';

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'orderdetails','productCode');
    }

    public function productLine(){
        return $this->belongsTo(ProductLine::class,'productLine');
    }


}
