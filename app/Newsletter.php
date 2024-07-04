<?php

namespace App;

use App\Traits\UserIp;
use Illuminate\Database\Eloquent\Model;


class Newsletter extends Model
{
    use UserIp;
}
