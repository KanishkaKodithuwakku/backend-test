<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $primaryKey = ['customerNumber','checkNumber'];

    public function customer(){
        return $this->belongsTo(Customer::class,'customerNumber');
    }
}
