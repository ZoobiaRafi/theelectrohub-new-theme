<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Product;
use App\Category;
use App\ProductToCategory;

class UpdateCategoryImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        try {
            $product = Product::where('product_code', $row[0])->first();
            
            $categoryCodes = explode('/', $row[1]);
            
            foreach ($categoryCodes as $code) {
                $category = Category::where('code', $code)->first();

                if ($category) {
                    $productToCategory = ProductToCategory::where('cat_id' , $category->id)->where('product_id' , $product->id)->first();
                    if(!$productToCategory){
                        $productToCategory = new ProductToCategory();
                    }
                    $productToCategory->cat_id = $category->id;
                    $productToCategory->product_id = $product->id;
                    $productToCategory->save();
                }
            }
            
            return $product;
        } catch (\Exception $e) {
            // Log or handle the exception appropriately
            return $e->getMessage();
        }
    }

}
