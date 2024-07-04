<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;

class ImportSaxbe implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        try{

        // $url = ;
        // $image = file_get_contents($url);
        // $pathInfo = pathinfo($url);sa w
        // $extension = $pathInfo['extension';
        // $random = Str::random(50);
        // $publicPath = public_path('images/product/' . $random . '.' .  $extension);
        // file_put_contents($publicPath, $image);

        $specification[] = [
            "colorfinish" =>  $row[22],
            "iprating" => $row[23],
            "operatingvolatge" => $row[24],
            "commoditycode" => $row[25],
            "countryoforigin" => $row[26] 
        ];

        $imagearray = array();
        for ($i = 5; $i <= 14; $i++) {
            if (!empty($row[$i])) {
                $imagearray[] = $row[$i];
            }
        }
        $imagearray = implode(',', $imagearray);

        $pdfarray = array();
        for ($i = 15; $i <= 17; $i++) {
            if (!empty($row[$i])) {
                $pdfarray[] = $row[$i];
            }
        }
        $pdfarray = implode(',', $pdfarray);

        $specificarray = array();
        for($i = 20; $i <= 21; $i++) {
            if(!empty($row[$i])){
                $specificarray[] = $row[$i];
            }
        }
        $specificarray = implode(',', $specificarray);

        // VendorPercentage & VendorPrice & Price/// 
        $vendorPrice = $row[3];
        $VendorPercentage = 5;
        $percentageToAdd = ($vendorPrice / 100) * $VendorPercentage; 
        $yourPrice = $vendorPrice + $percentageToAdd;
        // VendorPercentage & VendorPrice & Price/// 

        $product = Product::firstOrNew([
            'product_code' => $row[1],
            'vendor_id' => 6,
        ]);
    
            $product->fill([
              "product_code"=>$row[1],
              "title"=>$row[2],
              "vendor_price"=>$vendorPrice,
              "price"=>$yourPrice,
              "vendor_percentage"=>$VendorPercentage,
              "stock_level"=>$row[4],
              "uploader_image" => $imagearray,
              "pdf"=>$pdfarray,
              "long_description"=>$row[18],
              "overview"=>$row[19],
              "specific_download"=>$specificarray,
              "specification"=> $specification,
              "dimension_unpacked_height"=>$row[27],
              "dimension_unpacked_width"=>$row[28],
              "dimension_unpacked_dipth"=>$row[29],
              "link"=>$row[36],
              "stock_status"=>$row[37],
              "vendor_id"=>6,
            ]);
            // dd($specificarray);
            // var_dump($product);
            $product->save();
            
            return $product;
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
