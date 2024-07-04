<?php

namespace App;

use App\Traits\RefKey;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes , RefKey;
    public function status_detail(){
        return $this->belongsTo(OrderStatus::class , 'status');
    }

    public function order_products(){
        return $this->hasMany(OrderProduct::class , 'order_no' , 'order_no');
    }

    public function customer_detail(){
        return $this->hasMany(User::class , 'user_id');
    }
}
