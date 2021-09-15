<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'orderdetails';
    protected $appends = ['line_total'];
    const ATTRIBUTES
    = [
        'quantityOrdered',
        'priceEach',
        'orderLineNumber',
    ];

    public function getLineTotalAttribute()
    {
        return number_format($this->priceEach * $this->quantityOrdered, '2', '.', '');
    }
}
