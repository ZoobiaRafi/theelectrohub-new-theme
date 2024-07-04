<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ProductToCategory extends Model
{
    protected $fillable = [
        'cat_id',
        'product_id',
    ];

    public function product_detail(){
        return $this->belongsTo(Product::class , "product_id");
    }

    public function category_detail(){
        return $this->belongsTo(Category::class , "cat_id");
    }
}
