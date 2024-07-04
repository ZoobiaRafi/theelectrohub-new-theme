<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait UserId {

    protected static function bootUserId()
    {
        static::creating(function ($model) {
            $model->created_by = Auth()->user()->id;
        });
    }
}