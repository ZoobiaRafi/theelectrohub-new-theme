<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderStatus extends Model
{
    use Loggable,SoftDeletes;

    public function getOrders($startdate , $enddate = null , $type , $status){
        $query = Order::where('status', $status)->whereDate('created_at', '>=', $startdate);
        if ($enddate) {
            $query->whereDate('created_at', '<', $enddate);
        }
        if($type == "amount"){
            return $query->sum('order_total');
        }
        else if($type == "count"){
            return $query->count();
        }
        return 0;
    }
}
