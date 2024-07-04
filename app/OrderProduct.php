<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProduct extends Model
{
    use SoftDeletes;

    public function product_detail(){
        return $this->belongsTo(Product::class , 'product_id');
    }
}
