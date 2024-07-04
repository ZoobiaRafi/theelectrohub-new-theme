<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;

class ImportMla implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // 'image' => 'images/product/' . $random . '.' .  $extension,
        // $url = $row[21];
        // $image = file_get_contents($url);

        // $pathInfo = pathinfo($url);
        // $extension = $pathInfo['extension'];
        // $random = Str::random(50);

        // $publicPath = public_path('images/product/' . $random . '.' .  $extension);

        // file_put_contents($publicPath, $image);
        
        // VendorPercentage & VendorPrice & Price/// 
        $vendorPrice = $row[22];
        var_dump($vendorPrice);
        $VendorPercentage = 5;
        $percentageToAdd = ($vendorPrice / 100) * $VendorPercentage; 
        $yourPrice = $vendorPrice + $percentageToAdd;
        // VendorPercentage & VendorPrice & Price/// 

        $product = Product::firstOrNew([
            'product_code' => $row[0],
            'vendor_id' => 4,
        ]);

        $product->fill([
            "title" => $row[0],
            'qty' => $row[4],
            "status" => $row[5],
            "product_code" => $row[6],
            "image"=> $row[21],
            "product_code" => $row[0],
            "long_description"=>$row[2],
            "gross_weight"=>$row[3],
            "net_weight"=>$row[4],
            "barcode_each"=>$row[5],
            "inner_carton_quantity"=>$row[6],
            "inner_carton_weight"=>$row[7],
            "inner_carton_length"=>$row[8],
            "inner_carton_width"=>$row[9],
            "inner_carton_height"=>$row[10],
            "inner_carton_barcode"=>$row[11],
            "middle_carton_quantity"=>$row[12],
            "middle_carton_barcode"=>$row[13],
            "outer_carton_quantity"=>$row[14],
            "outer_carton_weight"=>$row[15],
            "outer_carton_length"=>$row[16],
            "outer_carton_width"=>$row[17],
            "outer_carton_height"=>$row[18],
            "outer_carton_volume"=>$row[19],
            "outer_carton_barcode"=>$row[20],
            // "price"=>$row[22],
            "vendor_price"=>$vendorPrice,
            "price"=>$yourPrice,
            "vendor_percentage"=>$VendorPercentage,
            "datasheet_url"=>$row[23],
            "declaration_of_conformity_ukca"=>$row[24],
            "declaration_of_conformity_ce"=>$row[25],
            "diameter"=>$row[26],
            "length"=>$row[27],
            "height"=>$row[28],
            "width"=>$row[29],
            "depth"=>$row[30],
            "projection"=>$row[31],
            "recessed_depth"=>$row[32],
            "recessed_depth_with_ic_cage"=>$row[33],
            "minimum_void"=>$row[34],
            "cut_out_diameter"=>$row[35],
            "cut_out_with_sleeve"=>$row[36],
            "cut_out_box_w_h_d"=>$row[37],
            "min_mounting_box_depth"=>$row[38],
            "tilt"=>$row[39],
            "rotation"=>$row[40],
            "construction"=>$row[41],
            "construction_two"=>$row[42],
            "finish"=>$row[43],
            "class"=>$row[44],
            "ip_rating"=>$row[45],
            "primary_voltage"=>$row[46],
            "cable_length"=>$row[47],
            "diffuser"=>$row[48],
            "emergency"=>$row[49],
            "maximum_weight_loading"=>$row[50],
            "lamp_technology"=>$row[51],
            "lamp_base"=>$row[52],
            "lamp_included"=>$row[53],
            "dimmable"=>$row[54],
            "max_wattage"=>$row[55],
            "l70b50"=>$row[56],
            "l70b10"=>$row[57],
            "energy_rating"=>$row[58],
            "beam_angle"=>$row[59],
            "cct"=>$row[60],
            "light_colour"=>$row[61],
            "lumens"=>$row[62],
            "lumens_light_source"=>$row[63],
            "lumens_em_mode"=>$row[64],
            "wattage"=>$row[65],
            "efficacy"=>$row[66],
            "cri"=>$row[67],
            "driver_type"=>$row[68],
            "fastcharge"=>$row[69],
            "earth_terminal"=>$row[70],
            "neon_indicator"=>$row[71],
            "tv_connection_type"=>$row[72],
            "sat_connection_type"=>$row[73],
            "fm_dab_connection_type"=>$row[74],
            "terminal"=>$row[75],
            "anti_microbial_properties"=>$row[76],
            "warranty"=>$row[77],
            "line_drawing_one_url"=>$row[78],
            "line_drawing_two_url"=>$row[79],
            "commodity_code"=>$row[80],
            "dismantling_procedure_url"=>$row[81],
            "vendor_id"=>4,
        ]);
        $product->save();

        return $product;
    }
}
