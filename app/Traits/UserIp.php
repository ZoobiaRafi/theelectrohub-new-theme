<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait UserIp {

    protected static function bootUserIp()
    {
        static::creating(function ($model) {
            $clientIP = $_SERVER['REMOTE_ADDR'];
            $model->ip_address = $clientIP;
        });
    }
}