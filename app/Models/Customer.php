<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $primaryKey = 'customerNumber';

    public function orders(){
        return $this->belongsTo(Order::class, 'customerNumber', 'customerNumber');
    }
}
