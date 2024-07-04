<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DNS2D;

trait Slug
{

    protected static function bootSlug()
    {
        static::creating(function ($model) {
            $model->title = str_replace('&', 'and', $model->title);
            $slug = Str::slug($model->title);
            $model->slug = static::generateUniqueSlug($slug);
        });

        static::updating(function ($model) {
            $model->title = str_replace('&', 'and', $model->title);
            $slug = Str::slug($model->title);
            $model->slug = static::generateUniqueSlug($slug, $model->id);
        });
    }

    protected static function generateUniqueSlug($slug, $id = null)
    {
        $newSlug = $slug;
        $count = 1;

        while (static::where('slug', $newSlug)->where('id', '!=', $id)->exists()) {
            $newSlug = $slug . '-' . $count;
            $count++;
        }

        return $newSlug;
    }
}
