<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ImageResizeController extends Controller
{
    public function image_resize_and_compress(Request $request)
    {
        if(isset($request->refkey)){
            if($request->refkey == setting('site.refkey')){
                $products = Product::where('image_resized' , 0)->whereNotNull('image')->take(100)->get();
                foreach($products as $product){
                    if ($product->image) {
                        $imageUrl = $product->image;
                        $resizedImage = $this->image_resize($imageUrl);
                        if (is_string($resizedImage)) {
                            Product::where('id', $product->id)->update(['image' => $resizedImage , 'image_resized' => 1]);
                            echo "<p style = 'color:green;'>Image resized, compressed successfully and save in database on path " . $resizedImage . "</p>";
                        } else {
                            Product::where('id', $product->id)->update(['image_resized' => 1]);
                            echo "<p style = 'color:orange;'>" . $resizedImage['error'] . "</p>";
                        }
                    }
                }
                echo "<script>setTimeout(function(){ location.reload(); }, 5000);</script>";
            }
        }
    }

    public function image_resize($image)
    {
        try {
            $image = Image::make($image);

            // Define the target size
            $targetWidth = 500;
            $targetHeight = 500;

            $image->resize($targetWidth, $targetHeight, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $width = $image->width();
            $height = $image->height();

            $canvas = Image::canvas($targetWidth, $targetHeight, '#ffffff');

            $canvas->insert($image, 'center');

            $random = Str::random(50);
            $outputPath = 'images/product/' . $random . '.webp';

            $quality = 100;

            $tempPath = public_path('temp_image.webp');

            do {
                $canvas->save($tempPath, $quality);

                $fileSize = filesize($tempPath);
                $quality -= 5;
            } 
            while ($fileSize > 100000 && $quality > 0);

            if ($quality <= 0) {
                unlink($tempPath);
                return ['error' => 'Unable to compress image to under 100KB'];
            }

            $canvas->save($outputPath, $quality);
            unlink($tempPath);

            return $outputPath;
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function other_image_resize_and_compress(Request $request)
    {
        if (isset($request->refkey)) {
            if ($request->refkey == setting('site.refkey')) {
                $products = Product::where('other_image_resized', 0)->whereNotNull('uploader_image')->take(5)->get();

                foreach ($products as $product) {
                    $images = explode(',', $product->uploader_image);
                    $processedImages = [];

                    foreach ($images as $imageUrl) {
                        try {
                            if ($imageUrl) {
                                $imageContents = @file_get_contents($imageUrl);
                                if ($imageContents === false) {
                                    continue;
                                }

                                $tempImagePath = tempnam(sys_get_temp_dir(), 'image');
                                file_put_contents($tempImagePath, $imageContents);

                                $resizedImagePath = $this->other_image_resize($tempImagePath);

                                if (is_array($resizedImagePath) && isset($resizedImagePath['error'])) {
                                    continue;
                                }

                                $processedImages[] = $resizedImagePath;
                            }
                        } catch (\Exception $e) {
                            continue;
                        }
                    }

                    $product->uploader_image = implode(',', $processedImages);
                    $product->other_image_resized = 1;
                    $product->save();

                    echo "<p style='color:green;'>Image resized, compressed successfully and saved in database on path " . implode(',', $processedImages) . "</p>";
                }

                echo "<script>setTimeout(function(){ location.reload(); }, 5000);</script>";
            }
        }
    }

    public function other_image_resize($image)
    {
        try {
            $image = Image::make($image);

            // Define the target size
            $targetWidth = 500;
            $targetHeight = 500;

            $image->resize($targetWidth, $targetHeight, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $width = $image->width();
            $height = $image->height();

            $canvas = Image::canvas($targetWidth, $targetHeight, '#ffffff');

            $canvas->insert($image, 'center');

            $random = Str::random(50);
            $outputPath = 'other-images/product/' . $random . '.webp';

            $quality = 100;

            $tempPath = public_path('temp_image.webp');

            do {
                $canvas->save($tempPath, $quality);

                $fileSize = filesize($tempPath);
                $quality -= 5;
            } 
            while ($fileSize > 100000 && $quality > 0);

            if ($quality <= 0) {
                unlink($tempPath);
                return ['error' => 'Unable to compress image to under 100KB'];
            }

            $canvas->save($outputPath, $quality);
            unlink($tempPath);

            return $outputPath;
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
