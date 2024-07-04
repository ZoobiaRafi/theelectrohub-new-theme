<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use Loggable,SoftDeletes;

    public function category(){
        return $this->hasMany(FaqsToCategory::class , 'faq_id');
    }

    public function product(){
        return $this->hasMany(FaqsToProduct::class , 'faq_id');
    }
}
