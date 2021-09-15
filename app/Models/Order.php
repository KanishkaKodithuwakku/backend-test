<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'orderNumber';


    public function customer(){
        return $this->belongsTo(Customer::class,'customerNumber');
    }

    public function orderdetails(){
        return $this->hasMany(OrderDetail::class,'orderNumber');
    }

}


