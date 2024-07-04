<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Wishlist extends Model
{
    use SoftDeletes,Loggable;
    
    public function user_detail(){
        return $this->belongsTo(User::class , 'user_id');
    }

    public function product_detail(){
        return $this->belongsTo(Product::class , 'product_id');
    }
}
