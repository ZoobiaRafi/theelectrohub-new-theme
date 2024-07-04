<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;

class ImportScollmore implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $product = Product::firstOrNew([
            'product_code' => $row[0],
            'vendor_id' => 5,
        ]);

        $product->fill([
            "title" => $row[1],
            "long_description" => $row[2],
            "category_level_1" => $row[3],
            "category_level_2" => $row[4],
            "category_level_3" => $row[5],
            "outer_carton_quantity" => $row[6],
            "inner_carton_quantity" => $row[7],
            "luckins_code" => $row[8],
            "commodity_code" => $row[9],
            "selling_factor" => $row[10],
            "trade_price" => $row[11],
            "product_barcode" => $row[12],
            "inner_barcode" => $row[13],
            "outer_barcode" => $row[14],
            "net_weight" => $row[15],
            "gross_weight" => $row[16],
            "inner_carton_weight" => $row[17],
            "outer_carton_weight" => $row[18],
            "product_length" => $row[19],
            "product_width" => $row[20],
            "product_height" => $row[21],
            "inner_carton_length" => $row[22],
            "inner_carton_width" => $row[23],
            "inner_carton_height" => $row[24],
            "outer_carton_length" => $row[25],
            "outer_carton_width" => $row[26],
            "outer_carton_height" => $row[27],
            "image" => $row[28],
            "vendor_id" => 5,
        ]);

        $product->save();

        return $product;
    }
}