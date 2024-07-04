<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;


class TempCart extends Model
{
    use Loggable;
    public function cart_info(){
        return $this->hasMany(CartInfo::class, 'cart_id');
    }

    public function product_detail(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
