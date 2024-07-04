<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;


class ContactU extends Model
{
    use Loggable , SoftDeletes;
    protected $table = 'contact_us'; 
    
    public function topic_detail(){
        return $this->belongsTo(ContactusTopic::class , 'topic');
    }

    public function status_detail(){
        return $this->belongsTo(ContactUsStatus::class , 'status');
    }
}
