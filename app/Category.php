<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Slug;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Category extends Model
{
    use Slug,SoftDeletes,Loggable;
    protected $fillable = [
        'title',
        'image',
        'status'
    ];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->where('status' , 1);
    }   
    public function parent_category_detail(){
        return $this->belongsTo(Category::class , "cat_id");
    }
    
    public function product_to_category(){
        return $this->hasMany(ProductToCategory::class , 'cat_id');
    }

    public function sub_categories()
    {
        return $this->children()->where('status', 1);
    }
    public function grand_parent_info()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public static function getNestedCategories()
    {
        return static::whereHas('sub_categories')->whereNull('parent_id')->where('status', 1)->get();
    }
    // public $additional_attributes = ['title_with_category'];
    
    // public function getTitleWithCategoryAttribute()
    // {
    //     if(isset($this->parent_category_detail) || (isset($this->child_category_detail))) {
    //         return "{$this->parent_category_detail->title} --> {$this->title} --> {$this->child_category_detail->title}";
    //     } 
    //     else {
    //         return "{$this->title}";
    //     }
    // }
    public $additional_attributes = ['title_with_category'];

    public function getTitleWithCategoryAttribute($value)
    {
        if ($this->parent_info) {
            if ($this->parent_info->parent_info) {
                return $this->parent_info->parent_info->title . ' - ' . $this->parent_info->title . ' - ' . $this->attributes['title'];
            }
            return $this->parent_info->title . ' - ' . $this->attributes['title'];
        }

        return $this->attributes['title'];
    }

    public function parent_info()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function getAllChildCategories()
    {
        return $this->children()->with('getAllChildCategories')->where('status', 1)->get();
    }
    
     public function products(){
        return $this->hasMany(ProductToCategory::class , 'cat_id');
    }
}
