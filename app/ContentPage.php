<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Slug;

class ContentPage extends Model
{
    use Loggable,SoftDeletes,Slug;
}
