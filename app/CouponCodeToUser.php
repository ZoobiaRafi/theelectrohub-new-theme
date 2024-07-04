<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class CouponCodeToUser extends Model
{
    use Loggable;
    protected $table = 'coupon_code_to_user';
    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }
}
