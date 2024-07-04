<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;

class ImportLW implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        try{

           // VendorPercentage & VendorPrice & Price/// 
            $vendorPrice = str_replace("£","",$row[9]);
            $VendorPercentage = 5;
            $percentageToAdd = ($vendorPrice / 100) * $VendorPercentage; 
            $yourPrice = $vendorPrice + $percentageToAdd;
            // VendorPercentage & VendorPrice & Price/// 

            $product = Product::firstOrNew([
                'product_code' => $row[1],
                'vendor_id' => 7,
            ]);

            $product->fill([
                "product_code" => $row[1],
                'title' => $row[2],
                "supplier_barcode" => $row[3],
                "vendor_price"=>$vendorPrice,
                "price"=>$yourPrice,
                "vendor_percentage"=>$VendorPercentage,
                "colour" => $row[11],
                "specification" =>$row[14],
                "overview" => $row[16],
                "long_description" => $row[17],
                "catalogue" => $row[18],
                "height" => $row[41],
                "depth" => $row[42],
                "width" => $row[43],
                "inner_carton_length" => $row[71],
                "inner_carton_width" => $row[72],
                "inner_carton_height" => $row[73],
                "outer_carton_length" => $row[79],
                "outer_carton_width" => $row[80],
                "outer_carton_height" => $row[81],
                'vendor_id' => 7,
            ]);
            $product->save();

            return $product;
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
