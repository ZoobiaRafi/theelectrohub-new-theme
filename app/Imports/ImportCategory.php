<?php

namespace App\Imports;

use App\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;

class ImportCategory implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $url = $row[1];
        $image = file_get_contents($url);

        $pathInfo = pathinfo($url);
        $extension = $pathInfo['extension'];
        $random = Str::random(50);

        $publicPath = public_path('images/category/' . $random . '.' .  $extension);

        file_put_contents($publicPath, $image);

        $product = Product::firstOrNew([
            'product_code' => $row[0],
            'vendor_id' => 5,
        ]);

        $product->fill([
            "title" => $row[0],
            'image' => 'images/category/' . $random . '.' .  $extension,
            "status" => $row[2],
        ]);
        $product->save();

        return $product;

        // return new Category([
        //     "title" => $row[0],
        //     'image' => 'images/category/' . $random . '.' .  $extension,
        //     "status" => $row[2],
        // ]);
    }
}
