<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Wishlist;
use Illuminate\Support\Facades\Cache;

class WishListController extends Controller
{

    protected $cartcontroller;
    protected $ordercontroller;

    public function __construct(CartController $cartcontroller, OrderController $ordercontroller)
    {
        $this->cartcontroller = $cartcontroller;
        $this->ordercontroller = $ordercontroller;
    }

    public function checkWishlistExist($productId, $user_id, $macAddr)
    {
        
        $cartitem = Wishlist::where('product_id', $productId)
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

    public function getWishListItems(Request $request)
    {
        $macAddr = $this->cartcontroller->cartAddress;
        $userID = 0;
        if (auth()->check()) {
            $userID = auth()->user()->id;
        }
        if ($userID > 0) {
            $wishlistItems = Wishlist::where('user_id', $userID)->orderBy('created_at', 'desc')->get();
            
        } else {
            $wishlistItems = Wishlist::where('mac_address', $macAddr)->orderBy('created_at', 'desc')->get();
            
        }
        return $wishlistItems;
    }

    public function addToWishlist(Request $request , $id){
        $UserID = 0;
        if (Auth()->check()) {
            $UserID =  Auth()->user()->id;
        }
        $productinfo = Product::find($id);

        $macAddr = $this->cartcontroller->cartAddress;

        if ($UserID > 0) {
            $check = $this->checkWishlistExist($id, $UserID, null);
            if (!$check[0]) {
                $tempwishlist = new Wishlist();
                $tempwishlist->product_id = $productinfo->id;
                $tempwishlist->user_id = $UserID;
                $tempwishlist->mac_address = $macAddr;
                $tempwishlist->save();
                return response()->json(
                    [
                        'status' => "success", 
                        'redirect' => '/', 
                        'message' => ucwords($productinfo->title) . " added in your wishlist successfully", 
                    ]
                );
            }
        }
        else {
            $check = $this->checkWishlistExist($id, null, $macAddr);
            if (!$check[0]) {
                $tempwishlist = new Wishlist();
                $tempwishlist->product_id = $productinfo->id;
                $tempwishlist->user_id = $UserID;
                $tempwishlist->mac_address = $macAddr;
                $tempwishlist->save();
                return response()->json(
                    [
                        'status' => "success", 
                        'redirect' => '/', 
                        'message' => ucwords($productinfo->title) . " added in your wishlist successfully", 
                    ]
                );
            }
        }
    }

    public function removeWish(Request $request)
    {
        $cartId = $request->cartId;
        $thiscart = Wishlist::find($cartId);
        if ($thiscart) {
            $thiscart->delete();
            $items = $this->getWishListItems($request);
            return response()->json([
                'status' => 'success',
                'message' => 'Product is Removed From Your wishlist Successfully !',
                'cartcount' => $items->count()
            ]);
        }
    }
    
}
