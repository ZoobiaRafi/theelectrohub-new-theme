<?php

namespace App\Http\Controllers;

use App\CouponCode;
use Illuminate\Http\Request;
use App\TempCart;
use App\Product;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

use function PHPUnit\Framework\isEmpty;

class CartController extends Controller
{
    public $cartAddress;

    public function __construct()
    {
        $this->cartAddress = $this->generatecookies();
    }

    public function generatecookies()
    {
        $cookieName = 'electrohub_cart';
        if (!Cookie::has($cookieName)) {
            $cookieValue = Str::random(50);
            Cookie::queue($cookieName, $cookieValue);
        }
        return Cookie::get($cookieName);
    }

    public function generateSessions(Request $request)
    {
        $session_id = $request->session()->get('session_id');
        if (!$session_id) {
            $session_id = Session::getId();
            $request->session()->put('session_id', $session_id);
        }
        $request->merge(['session_id' => $session_id]);
        return $session_id;
    }

    public function checkCartItemExist($productId, $user_id, $macAddr)
    {
        
       $cartitem = TempCart::where('product_id', $productId)
            ->where('user_id', $user_id)
            ->where('mac_address', $macAddr)
            ->where('status', 1)
            ->first();
       

        if ($cartitem) {
            return array(true, $cartitem);
        } else {
            return array(false, 0);
        }
    }

    public function addToCart(Request $request, $id)
    {
        $referer = strtolower(trim($request->headers->get('referer')));
        if (strpos($referer, 'my-account') !== false) {
            $UserID = 0;
            if (Auth()->check()) {
                $UserID =  Auth()->user()->id;
            }
            $productinfo = Product::find($id);
            $discount = 0;
            $qty = $request->qtty;
            if ($qty == 1) {
                $productprice = $productinfo->price_including_vat;
            }
            else if($qty >= setting('vendor.mlabundleqty')){
                //MLA Products Discount Start
                if($productinfo->vendor_id == 4){ //MLA vendor
                    $discount = $productinfo->price_including_vat - setting('vendor.mlabundlediscount');
                }
                //MLA Products Discount End
            } 
            else {
                $productprice = ($productinfo->price_including_vat) * $qty;
            }
            $macAddr = $this->cartAddress;

            if ($UserID > 0) {
                $check = $this->checkCartItemExist($id, $UserID, null);
                if ($check[0]) {
                    $updateCart = TempCart::find($check[1]->id);
                    $oldQty = $check[1]->quantity;
                    $updateCart->quantity = $oldQty + $qty;
                    $updateCart->price = ($discount <= 0) ? $productinfo->price_including_vat : $discount;
                    $updateCart->save();
                    $items = $this->getCartItems($request);
                    $qty = $items->where('product_id', $id)->first()->quantity;
                    
                }
                else {
                    $tempCart = new TempCart();
                    $tempCart->product_id = $productinfo->id;
                    $tempCart->user_id = $UserID;
                    $tempCart->price = ($discount <= 0) ? $productinfo->price_including_vat : $discount;
                    $tempCart->quantity = $qty;
                    $tempCart->mac_address = $macAddr;
                    $tempCart->status = 1;
                    $tempCart->save();
                    $items = $this->getCartItems($request);
                    
                }
            }
            else {
                $check = $this->checkCartItemExist($id, null, $macAddr);
                if ($check[0]) {
                    $updateCart = TempCart::find($check[1]->id);
                    $oldQty = $check[1]->quantity;
                    $updateCart->quantity = $oldQty + $qty;
                    $updateCart->price = ($discount <= 0) ? $productinfo->price_including_vat : $discount;
                    $updateCart->save();
                    $items = $this->getCartItems($request);
                    $qty = $items->where('product_id', $id)->first()->quantity;
                }
                else {
                    $tempCart = new TempCart();
                    $tempCart->product_id = $productinfo->id;
                    $tempCart->user_id = null;
                    $tempCart->price = ($discount <= 0) ? $productinfo->price_including_vat : $discount;
                    $tempCart->quantity = $qty;
                    $tempCart->mac_address = $macAddr;
                    $tempCart->status = 1;
                    $tempCart->save();
                    $items = $this->getCartItems($request);
                    
                }
            }
        }
        else{
            $UserID = 0;
            if (Auth()->check()) {
                $UserID =  Auth()->user()->id;
            }
            $productinfo = Product::find($id);
            $discount = 0;
            $qty = $request->qtty;
            if ($qty == 1) {
                $productprice = $productinfo->price_including_vat;
            } 
            else if($qty >= setting('vendor.mlabundleqty')){
                //MLA Products Discount Start
                
                if($productinfo->vendor_id == 4){ //MLA vendor
                    $discount = $productinfo->price_including_vat - setting('vendor.mlabundlediscount');
                }
                //MLA Products Discount End
            }
            else {
                $productprice = ($productinfo->price_including_vat) * $qty;
            }
            $macAddr = $this->cartAddress;
            
            if ($UserID > 0) {
                $check = $this->checkCartItemExist($id, $UserID, null);
                if ($check[0]) {
                    $updateCart = TempCart::find($check[1]->id);
                    $oldQty = $check[1]->quantity;
                    $updateCart->quantity = $oldQty + $qty;
                    $updateCart->price = ($discount <= 0) ? $productinfo->price_including_vat : $discount;
                    $updateCart->save();
                    $items = $this->getCartItems($request);
                    $qty = $items->where('product_id', $id)->first()->quantity;
                    return response()->json(
                        [
                            'status' => "success", 
                            'redirect' => '/', 
                            'message' => ucwords($productinfo->title) . " updated in your cart successfully", 
                            'cartcount' => $items->count(),
                            'qty' => $qty
                        ]
                    );
                }
                else {
                    $tempCart = new TempCart();
                    $tempCart->product_id = $productinfo->id;
                    $tempCart->user_id = $UserID;
                    $tempCart->price = ($discount <= 0) ? $productinfo->price_including_vat : $discount;
                    $tempCart->quantity = $qty;
                    $tempCart->mac_address = $macAddr;
                    $tempCart->status = 1;
                    $tempCart->save();
                    $items = $this->getCartItems($request);
                    return response()->json(
                        [
                            'status' => "success", 
                            'redirect' => '/', 
                            'message' => ucwords($productinfo->title) . " added in your cart successfully", 
                            'cartcount' => $items->count(),
                            'qty' => $qty + 1
                        ]
                    );
                }
            }
            else {
                $check = $this->checkCartItemExist($id, null, $macAddr);
                if ($check[0]) {
                    $updateCart = TempCart::find($check[1]->id);
                    $oldQty = $check[1]->quantity;
                    $updateCart->quantity = $oldQty + $qty;
                    $updateCart->price = ($discount <= 0) ? $productinfo->price_including_vat : $discount;
                    $updateCart->save();
                    $items = $this->getCartItems($request);
                    $qty = $items->where('product_id', $id)->first()->quantity;
                    return response()->json(
                        [
                            'status' => "success", 
                            'redirect' => '/', 
                            'message' => ucwords($productinfo->title) . " updated in your cart successfully", 
                            'cartcount' => $items->count(),
                            'qty' => $qty
                        ]
                    );
                }
                else {
                    $tempCart = new TempCart();
                    $tempCart->product_id = $productinfo->id;
                    $tempCart->user_id = null;
                    $tempCart->price = ($discount <= 0) ? $productinfo->price_including_vat : $discount;
                    $tempCart->quantity = $qty;
                    $tempCart->mac_address = $macAddr;
                    $tempCart->status = 1;
                    $tempCart->save();
                    $items = $this->getCartItems($request);
                    return response()->json(
                        [
                            'status' => "success", 
                            'redirect' => '/', 
                            'message' => ucwords($productinfo->title) . " added in your cart successfully", 
                            'cartcount' => $items->count(),
                            'qty' => $qty + 1
                        ]
                    );
                }
            }
        }
    }

    public function getCartItems(Request $request)
    {
        $macAddr = $this->cartAddress;
        $userID = 0;
        if (auth()->check()) {
            $userID = auth()->user()->id;
        }
        if ($userID > 0) {
            $cartItems = TempCart::where('user_id', $userID)->where('status', 1)->orderBy('created_at', 'desc')->get();
            
        } else {
            $cartItems = TempCart::where('mac_address', $macAddr)->where('status', 1)->orderBy('created_at', 'desc')->get();
        }
        return $cartItems;
    }

    public function get_cart_list(Request $request)
    {
        $items = $this->getCartItems($request);
        $data = [];
        $productData = [];
        $totalCartPrice = 0;
        $discount = 0;

        foreach ($items as $item) {
            $proinfo = Product::find($item->product_id);
            if($proinfo->vendor_id == 4){
                if($item->quantity >= setting('vendor.mlabundleqty')){
                    $discount = $proinfo->price_including_vat - setting('vendor.mlabundlediscount');
                }
            }
            if (isset($proinfo)) {
                $images = [];
                if (isset($proinfo->uploader_image)) {
                    $images = json_decode($proinfo->uploader_image, true);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        $images = explode(',', $proinfo->uploader_image);
                    }
                }

                $imageUrl = '';
                foreach ($images as $image) {
                    if (!filter_var($image, FILTER_VALIDATE_URL)) {
                        if (file_exists(public_path($image)) && getimagesize(public_path($image))) {
                            $imageUrl = $image;
                            break;
                        }
                    } else {
                        if (getimagesize($image)) {
                            $imageUrl = $image;
                            break;
                        }
                    }
                }

                if (empty($imageUrl) && $proinfo->image) {
                    $imageUrl = $proinfo->image;
                }

                if(empty($imageUrl) && !isset($proinfo->image))
                {
                    $imageUrl= url('/frontend/background/no-image-teh.png');
                }

                if (!filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                    if (!file_exists(public_path($imageUrl))) {
                        $imageUrl = '/public' . $imageUrl;
                    }
                }
                if (isset($productData[$proinfo->id])) {
                    $productData[$proinfo->id]['quantity'] += $item->quantity;
                    $productData[$proinfo->id]['total'] += number_format($item->quantity * $proinfo->price_including_vat, 2);
                } else {
                    
                    $productData[$proinfo->id] = [
                        "tempcartid" => $item->id,
                        "proid" => $proinfo->id,
                        "protitle" => ucwords($proinfo->title),
                        "proimage" => $imageUrl,
                        "price" => ($discount <= 0) ? $proinfo->price_including_vat : $discount,
                        "quantity" => $item->quantity,
                        "total" => number_format($item->quantity * $proinfo->price_including_vat, 2)
                    ];
                }
                $totalCartPrice += $item->quantity * (($discount <= 0) ? $proinfo->price_including_vat : $discount);
            }
        }

        $data = array_values($productData);

        return response()->json([
            "status" => "success",
            "data" => $data,
            "totalCartPrice" => isset($totalCartPrice) ? number_format($totalCartPrice, 2) : 0
        ]);
    }


    public function updateCartQtty(Request $request)
    {
        $macAddr = $this->cartAddress;
        $tempcart = TempCart::where('id', $request->tempcartid)->where('mac_address', $macAddr)->first();
        $tempcart->quantity = $request->qtty;
        $tempcart->save();
        $qty = $request->qtty;
        $unitPrice = $request->unitPrice;

        $result['subtotal'] = $unitPrice * $qty;
        // $result['vat'] = $result['subtotal'] * setting('site.vat');

        return response()->json([
            'status' => 'success',
            'message' => 'Product is Successfully Updated in your cart!',
            'data' => $result
        ]);
    }


    public function updateCart(Request $request)
    {
        $qty = $request->qtty;
        $cartId = $request->cartId;
        $productId = $request->productId;

        // return 'Quant : '. $qty . ' Cartid : '. $cartId . ' Prodid : '.$productId;
        $thiscart = TempCart::where('id', $cartId)->where('product_id', $productId)->first();
        if ($thiscart) {
            $thiscart->quantity = $qty;
            $thiscart->save();

            return response()->json([
                "status" => "success",
                "message" => "product successfully added",
            ]);
        } else {
            return response()->json([
                "status" => "error",
                "message" => "An error occured while adding",
            ]);
        }
    }

    public function removeCart(Request $request)
    {
        $cartId = $request->cartId;
        $thiscart = TempCart::find($cartId);
        if ($thiscart) {
            $thiscart->status = 0;
            $thiscart->save();
            if (isset($_REQUEST['request_type'])) {
                if ($_REQUEST['request_type'] == 'ajax') {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Product removed successfully'
                    ]);
                }
            }
            $items = $this->getCartItems($request);
            session()->flash('success', 'Product is Removed From Your Cart Successfully !');
            return response()->json([
                'status' => 'success',
                'message' => 'Product is Removed From Your Cart Successfully !',
                'cartcount' => $items->count()
            ]);
        }
    }

    public function calculateprice(Request $request){
        $items = $this->getCartItems($request);
        $cartTotal = 0;
        $grandTotal = 0;
        $discount = 0;
        $vat = 0;
        foreach ($items as $item) {
            $proinfo = Product::find($item->product_id);
            if($proinfo->vendor_id == 4){
                if($item->quantity >= setting('vendor.mlabundleqty')){
                    $discount = $proinfo->price_including_vat - setting('vendor.mlabundlediscount');
                }
            }
            $cartTotal += $item->quantity * (($discount <= 0) ? $proinfo->price_including_vat : $discount);
        }
        
        if($cartTotal >= setting('site.vat')){
            $vat = 0;
            $grandTotal = $cartTotal;
        }
        else{
            // $vat = ($cartTotal * 20) / 100;
            $vat = 0;
            $grandTotal = $cartTotal + $vat;
        }

        return $grandTotal;
    }

    public function calculatepricewithoutvat(Request $request){
        // return $request;
        $items = $this->getCartItems($request);
        $cartTotal = 0;
        $discount = 0;
        foreach ($items as $item) {
            $proinfo = Product::find($item->product_id);
            $cartTotal += number_format($item->quantity * $proinfo->price_including_vat,2);
        }

        return $cartTotal;
        
    }

    public function calculatevat(Request $request){
        if(isset($request->subtotal) && $request->subtotal != null){
            $cartTotal = $request->subtotal;
            if($cartTotal >= setting('site.vat')){
                $vat = 0;
            }
            else{
                $vat = ($cartTotal * 20) / 100;
            }
            return response()->json([
                "status" => "success",
                "vat" => "&pound;".number_format($vat , 2),
                "withoutpound" => number_format($vat , 2)

            ]);
        }   
        else{
            $cartTotal = $this->calculatepricewithoutvat($request);
            if($cartTotal >= setting('site.vat')){
                $vat = 0;
            }
            else{
                $vat = ($cartTotal * 20) / 100;
            }
            return $vat;
        }
    }

    public function calculateshipping(Request $request){
        $carttotal = $this->calculatepricewithoutvat($request);
        $grandTotal = $this->calculateprice($request);
        $shipping = 0;
        $total = 0;
        if($carttotal <= setting('site.shipping-applied')){
            $shipping = setting('site.delivery-charges');
            $total = $grandTotal + $shipping; 
        }

        return $total;   
    }


    public function calculateshippingvalue(Request $request){
        $carttotal = $this->calculatepricewithoutvat($request);
        $total = 0;
        $shipping = 0;
        if($carttotal <= setting('site.shipping-applied')){
            $shipping = setting('site.delivery-charges');
        }
        return $shipping;   
    }

    // public function checkDiscount(Request $request)
    // {
    //     if(isset($request->code) && $request->code != null ){
    //         $subtotal = 0;
    //         $currentdate = date('Y-m-d');
    //         $code = CouponCode::where("code", $request->code)->first();
    //         if(isset($code->id)){
    //             if($currentdate <= $code->expiry_date){
    //                 $getSubTotal = $this->calculatepricewithoutvat($request);
    //                 $type = $code->coupon_type;
    //                 if($type == 1){
    //                     //flat discount on general type
    //                     $subtotal = $getSubTotal - $code->discount;
    //                     $this->calculatepricewithoutvat($request);
    //                     return response()->json([
    //                         'status' => 'success',
    //                         'subtotal' =>  $subtotal,
    //                         'discountVal' => $code->discount,
    //                         'discountType' => 'flat'
    //                     ]);
    //                 }
    //                 elseif($type == 2){
    //                     //Percentage discount on general
    //                     $discount = ($code->discount/100) * $getSubTotal;
    //                     $subtotal = $getSubTotal - $discount;
    //                     return response()->json([
    //                         'status' => 'success',
    //                         'subtotal' =>  $subtotal,
    //                         'discountVal' => $code->discount,
    //                         'discountType' => 'percent'
    //                     ]);
    //                 }
    //             }
    //             else{
    //                 return response()->json([
    //                     'status' => 'error',
    //                     'message' => 'Coupon code Expired',
    //                 ]);
    //             }
    //          }
    //          else{
    //             return response()->json([
    //                 'status' => 'error',
    //                 'message' => 'Invalid coupon code.',
    //             ]);
    //         }
    //     }
    //     else{
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Invalid Coupon code.',
    //         ]);
    //     }
    // }


    public function checkDiscount(Request $request)
    {
        if (isset($request->code) && $request->code != null) {
            $discount = 0;
            $currentdate = date('Y-m-d');
            $code = CouponCode::where("code", $request->code)->first();
            if (isset($code->id)) {
                if ($currentdate <= $code->expiry_date) {
                    // Calculate the subtotal without VAT
                    $getSubTotal = $this->calculatepricewithoutvat($request);
                    $type = $code->coupon_type;
                    $subtotal = 0;

                    if ($type == 1) {
                        // Flat discount on general type
                        $subtotal = $getSubTotal - $code->discount;
                        $discount = $code->discount;
                        if($subtotal <= 0){
                            return response()->json([
                                'status' => 'error',
                                'message' => 'Discount cannot be applied to this amount',
                            ]);
                        }
                    } elseif ($type == 2) {
                        // Percentage discount on general
                        $discount = ($code->discount / 100) * $getSubTotal;
                        $subtotal = $getSubTotal - $discount;
                        if($subtotal <= 0){
                            return response()->json([
                                'status' => 'error',
                                'message' => 'Discount cannot be applied to this amount',
                            ]);
                        }
                    }

                    $this->calculatepricewithoutvat($request);

                    return response()->json([
                        'status' => 'success',
                        'subtotal' =>  "&pound;".number_format($subtotal , 2),
                        'subtotalwithoutpound' =>  number_format($subtotal , 2),
                        'discountVal' => "&pound;".number_format($code->discount , 2),
                        'totalDiscount' => "&pound;".number_format($discount , 2),
                        'discountType' => ($type == 1) ? 'flat' : 'percent'
                    ]);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Coupon code Expired',
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid coupon code.',
                ]);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Coupon code.',
            ]);
        }
    }


}
