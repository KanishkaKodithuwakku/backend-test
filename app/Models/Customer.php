<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'customerNumber';

    public function orders(){
        return $this->hasMany(Order::class, 'customerNumber');
    }

    public function payment(){
        return $this->hasMany(Payment::class,'customerNumber');
    }
}
