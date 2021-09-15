<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productline extends Model
{
    protected $table = 'productlines';
    protected $primaryKey = 'productLine';

    public function products(){
        return $this->hasMany(Product::class, 'productLine');
    }
}
