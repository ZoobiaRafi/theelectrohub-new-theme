<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Spatie\PdfToImage\Pdf;

class PDFController extends Controller
{
    public function download_pdf_from_url(Request $request)
    {
        if (isset($request->refkey)) {
            if ($request->refkey == setting('site.refkey')) {
                $products = Product::where('datasheet_download', 0)->whereNotNull('datasheet_url')->take(25)->get();

                foreach ($products as $product) {
                    $datasheetUrl = $product->datasheet_url;
                    if (!empty($datasheetUrl)) {
                        $pdfUrl = str_replace('.html', '.pdf', $datasheetUrl);

                        $response = Http::get($pdfUrl);

                        if ($response->successful()) {
                            $randomString = Str::random(50);
                            $publicPath = 'pdf/product/' . $randomString . '.pdf';

                            file_put_contents($publicPath, $response->body());

                            $product->datasheet_url = 'pdf/product/' . $randomString . '.pdf';
                            $product->datasheet_download = 1;
                            $product->save();

                            echo "PDF saved for " . $product->title . " on path pdf/product/" . $randomString . '.pdf' . "<br/>";
                        }
                    }
                }

                echo "<script>setTimeout(function(){ location.reload(); }, 5000);</script>";
            }
        }
    }

    public function declaration_of_ukca_conformity(Request $request){
        if (isset($request->refkey)) {
            if ($request->refkey == setting('site.refkey')) {
                $products = Product::where('declaration_download', 0)->whereNotNull('declaration_of_conformity_ukca')->take(25)->get();

                foreach ($products as $product) {
                    $declarationofconformity = $product->declaration_of_conformity_ukca;
                    if (!empty($declarationofconformity)) {
                        $pdfUrl = str_replace('.html', '.pdf', $declarationofconformity);

                        $response = Http::get($pdfUrl);

                        if ($response->successful()) {
                            $randomString = Str::random(50);
                            $publicPath = 'declaration-pdf/product/' . $randomString . '.pdf';

                            file_put_contents($publicPath, $response->body());

                            $product->declaration_of_conformity_ukca = 'declaration-pdf/product/' . $randomString . '.pdf';
                            $product->declaration_download = 1;
                            $product->save();

                            echo "Declaration Conformity saved for " . $product->title . " on path declaration-pdf/product/" . $randomString . '.pdf' . "<br/>";
                        }
                    }
                }

                echo "<script>setTimeout(function(){ location.reload(); }, 5000);</script>";
            }
        }
    }

    public function specific_download(Request $request) {
        if (isset($request->refkey)) {
            if ($request->refkey == setting('site.refkey')) {
                $products = Product::where('specific_download_data', 0)
                    ->whereNotNull('specific_download')
                    ->take(25)
                    ->get();
    
                foreach ($products as $product) {
                    $specificDownloads = explode(',', $product->specific_download);
                    
                    foreach ($specificDownloads as $specificDownload) {
                        $specificDownload = trim($specificDownload);
                        if (!empty($specificDownload) && !str_ends_with($specificDownload, '.zip')) {
                            $pdfUrl = $specificDownload;
    
                            $response = Http::get($pdfUrl);
    
                            if ($response->successful()) {
                                $randomString = Str::random(50);
                                $publicPath = 'specific-download/product/' . $randomString . '.pdf';
    
                                file_put_contents($publicPath, $response->body());
    
                                $processedUrls[] = 'specific-download/product/' . $randomString . '.pdf';
    
                                echo "<p style = 'color:green;'>Specific Download saved for " . $product->title . " on path specific-download/product/" . $randomString . '.pdf' . "<br/><p>";
                            }
                        }
                    }
    
                    if (!empty($processedUrls)) {
                        $product->specific_download = implode(',', $processedUrls);
                        $product->specific_download_data = 1;
                        $product->save();
                    }
                }
    
                echo "<script>setTimeout(function(){ location.reload(); }, 5000);</script>";
            }
        }
    }
    
}
