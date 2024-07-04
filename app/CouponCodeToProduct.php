<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class CouponCodeToProduct extends Model
{
    use Loggable;
    public function product(){
        return $this->belongsTo(Product::class , 'product_id');
    } 
}
