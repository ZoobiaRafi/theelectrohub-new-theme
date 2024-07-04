<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class SpecificationCategory extends Model
{
    public function specifications(){
        return $this->hasMany(ProductSpecification::class, 'spec_id' , 'id');
    }
}
