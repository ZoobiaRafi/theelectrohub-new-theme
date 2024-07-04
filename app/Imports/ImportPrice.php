<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;

class ImportPrice implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        try {

            // VendorPercentage & VendorPrice & Price/// 
            $id = $row[0];
            $vendorPrice = str_replace("£","",$row[2]);
            $VendorPercentage = $row[3];
            $percentageToAdd = ($vendorPrice / 100) * $VendorPercentage; 
            $yourPrice = $vendorPrice + $percentageToAdd;
            // VendorPercentage & VendorPrice & Price/// 

            $product = Product::firstOrNew([
                'id' => $row[0],
            ]);
        
                $product->fill([
                    "vendor_price" => $vendorPrice,
                    "vendor_percentage" => $VendorPercentage,
                    "price" => $yourPrice,
                ]);
                $product->save();

            return $product;
        } catch(\Exception $e) {
            return $e->getMessage();
        }
        
    }
}
