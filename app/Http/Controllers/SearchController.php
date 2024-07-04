<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SearchController extends Controller
{
    //
    public function suggestions(Request $request)
    {
        
        $input = $request->input('query');
        $cacheKey = 'suggestions_' . md5($input);
        $all_suggestions = Cache::remember($cacheKey . date('d-m-Y'), 86400, function() use ($input) {
            return Product::whereHas('product_to_category')->where(function($query) use ($input) {
                $query->where('title', 'LIKE', '%'.$input.'%')->orWhere('product_code', 'LIKE', '%'.$input.'%');
            })->where('status', 1)->take(10)->get();
        });
        
        $all_suggestions;
        $suggestions = [];
        foreach ($all_suggestions as $suggestion) {
            $categoryDetails = $suggestion->product_to_category ? $suggestion->product_to_category->first() ? $suggestion->product_to_category->first()->category_detail: '' : '';
    
            $routeParameters = [
                $categoryDetails->parent_info->grand_parent_info->slug ?? null,
                $categoryDetails->parent_info->slug ?? null,
                $categoryDetails->slug ?? null,
                $suggestion->slug
            ];
    
            $routeParameters = array_filter($routeParameters);
    
            $suggestions[] = [
                "title" => $suggestion->title,
                "slug" => url('/' . implode('/', $routeParameters))
            ];
        }
    
        if ($all_suggestions->isEmpty()) {
            $suggestions[] = [
                "title" => "No products found for " . $input,
                "slug" => "javascript:void(0);"
            ];
        } else {
            $suggestions[] = [
                "title" => "View All Products for " . $input,
                "slug" => url('/search/' . $input)
            ];
        }
    
        return response()->json([
            "status" => "success",
            "data" => $suggestions
        ]);
    }    
}
