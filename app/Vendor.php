<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use Loggable , SoftDeletes;

    public function products()
    {
        return $this->hasMany(Product::class, 'vendor_id');
    }
}
