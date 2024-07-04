<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Traits\UserId;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class CouponCode extends Model
{
    use UserId,SoftDeletes,Loggable;

    public function user_detail(){
        return $this->belongsTo(User::class , 'created_by');
    }

    public function category_detail(){
        return $this->hasMany(CouponCodeToCategory::class , 'coupon_id');
    }

    public function product_detail(){
        return $this->hasMany(CouponCodeToProduct::class , 'coupon_id');
    }

    public function user(){
        return $this->hasMany(CouponCodeToUser::class , 'coupon_id');
    }

    public function coupon_code_to_categories(){
        return $this->hasMany(CouponCodeToCategory::class , 'coupon_id');
    }
}
