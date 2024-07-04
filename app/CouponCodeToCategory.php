<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;


class CouponCodeToCategory extends Model
{
    use Loggable;
    public function category(){
        return $this->belongsTo(Category::class , 'cat_id');
    }   
}
