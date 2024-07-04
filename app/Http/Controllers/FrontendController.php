<?php

namespace App\Http\Controllers;

use App\Category;
use App\ContentPage;
use App\Faq;
use App\Jobs\ForgotPasswordJob;
use App\Product;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Newsletter;
use App\SpecificationCategory;
use App\TempCart;
use Illuminate\Support\Facades\Hash;
use App\Order;
use App\OrderProduct;
use App\ProductToCategory;
use App\Wishlist;
use Illuminate\Support\Facades\Http;
use App\Jobs\OrderVerificationJob;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

use function PHPUnit\Framework\isEmpty;

class FrontendController extends Controller
{
    
    protected $cartcontroller;
    protected $ordercontroller;
    protected $wishlistcontroller;

    public function __construct(CartController $cartcontroller, OrderController $ordercontroller , WishListController $wishlistcontroller)
    {
        $this->cartcontroller = $cartcontroller;
        $this->ordercontroller = $ordercontroller;
        $this->wishlistcontroller = $wishlistcontroller;
    }
    public function products()
    {
        // return $products = Product::take(12)->inRandomOrder()->get();
        $cacheKey = 'products';
        return Cache::remember($cacheKey . date('d-m-Y'), 86400, function() {
            return $products = Product::whereHas('product_to_category')->where('status', 1)->inRandomOrder()->take(12)->get();
        });
    }

    public function popularProducts(){
        // MLA products SFR
        $cacheKey = 'popularProducts';
        return Cache::remember($cacheKey . date('d-m-Y'), 86400, function() {
            return $products = Product::where('vendor_id' , 4)
                                    ->whereHas('product_to_category')
                                    ->where('product_code','like','%SFR%')
                                    ->inRandomOrder()
                                    ->take(12)
                                    ->get();
        });

    }
    public function flashSale(){
        $cacheKey = 'flashSale';
        return Cache::remember($cacheKey . date('d-m-Y'), 86400, function() {
            return $products = Product::where(function ($query) {
                    $query->where('product_code', 'like', '%BT14%')->orWhere('product_code', 'like', '%BT9%')->orWhere('product_code', 'like', '%BT20%')->orWhere('product_code', 'like', '%BATS%');
                })->whereHas('product_to_category')->inRandomOrder()->take(12)->get();
        });
    }
    public function randomProducts()
    {
        $cacheKey = 'randomProducts';
        return Cache::remember($cacheKey . date('d-m-Y'), 86400, function() {
            return $products = Product::whereHas('product_to_category')->where('status' , 1)->take(12)->inRandomOrder()->get();
        });
    }

    public function featuredProducts()
    {
        $cacheKey = 'featuredProducts';
        return Cache::remember($cacheKey . date('d-m-Y'), 86400, function() {
            return Product::whereHas('product_to_category')->where('status', 1)->take(4)->inRandomOrder()->get();
        });
    }

    public function saleProducts()
    {
        $cacheKey = 'saleProducts';
        return Cache::remember($cacheKey . date('d-m-Y'), 86400, function() {
            return $products = Product::where(function ($query) {
                $query->where('product_code', 'like', '%BT14%')
                    ->orWhere('product_code', 'like', '%BT9%')
                    ->orWhere('product_code', 'like', '%BT20%')
                    ->orWhere('product_code', 'like', '%BATS%');
            })
            ->whereHas('product_to_category')
            ->inRandomOrder()
            ->take(4)
            ->get();
        });
    }

    public function topProducts()
    {
        $cacheKey = 'topProducts';
        return Cache::remember($cacheKey . date('d-m-Y'), 86400, function() {
            return $products = Product::whereHas('product_to_category')->where('status' , 1)->take(4)->inRandomOrder()->get();
        });
    }


    public function all_products()
    {
        $cacheKey = 'all_products';
        return Cache::remember($cacheKey . date('d-m-Y'), 86400, function() {
            return $products = Product::whereHas('product_to_category')->paginate(20);
        });
    }

    public function getProductBySlug($slug)
    {
        $cacheKey = 'getProductBySlug_' . $slug;
        return Cache::remember($cacheKey . date('d-m-Y'), 86400, function() use($slug){
            return $product = Product::where('slug', $slug)->first();
        });
    }

    public function categories()
    {
        $cacheKey = 'categories';
        return Cache::remember($cacheKey . date('d-m-Y'), 86400, function() {
            return $categories = Category::where('status', 1)->get();
        });
    }

    public function menu_categories()
    {
        $cacheKey = 'menu_categories';
        return Cache::remember($cacheKey . date('d-m-Y'), 86400, function() {
            return $categories = Category::where('is_menu', '1')->orderBy('sort_order','ASC')->where('status', 1)->get();
        });
    }

    public function main_categories()
    {
        $cacheKey = 'main_categories';
        return Cache::remember($cacheKey . date('d-m-Y'), 86400, function() {
            return $categories = Category::where('parent_id', null)->get();
        });
    }

    public function home_categories()
    {
        $cacheKey = 'home_categories';
        return Cache::remember($cacheKey . date('d-m-Y'), 86400, function() {
            return Category::where('home_status', '1')->where('parent_id', null)->get();
        });
    }

    public function nav_more_categories()
    {
        $cacheKey = 'nav_more_categories';
        return Cache::remember($cacheKey . date('d-m-Y'), 86400, function() {
            return Category::where('is_menu', 0)->where('parent_id' , null)->where('status', 1)->get();
        });
    }

    public function getCategoryBySlug($slug)
    {
        $cacheKey = 'getCategoryBySlug_' . $slug; // Include $slug in cache key
        return Cache::remember($cacheKey . date('d-m-Y'), 86400, function() use ($slug) {
            return Category::where('slug', $slug)->with('products')->first();
        });
    }

    public function getChildCategoriesById($id)
    {
        $cacheKey = 'getChildCategoriesById_' . $id;
        return Cache::remember($cacheKey . date('d-m-Y'), 86400, function() use($id){
            return $cat = Category::where('parent_id', $id)->where('status', 1)->get();
        });
    }

    public function checkCategoryHasProducts($cat)
    {

        $cacheKey = 'checkCategoryHasProducts_' . $cat ;
        Cache::remember($cacheKey . date('d-m-Y'), 86400, function() use($cat){
            return $products = ProductToCategory::where("cat_id", $cat)->get();
        });
        if ($products->count() > 0) {
            return array(true, $products);
        } else {
            return array(false, 0);
        }
    }

    public function homePage(Request $request){
        $products = $this->products();
        // foreach($products as $p) {
        //     return $p->price . " - " . $p->price_including_vat;
        // }
        $popularProducts = $this->popularProducts();
        // $sale_banner = $this->getSalePromotion();
        $flashSale = $this->flashSale();
        $featuredProducts = $this->featuredProducts()->take(4);
        $saleProducts = $this->saleProducts()->take(4);
        $topProducts = $this->topProducts()->take(4);
        $menu_categories = $this->menu_categories();
        $home_categories = $this->home_categories();
        $categories = Category::getNestedCategories();
        $nav_more_categories = $this->nav_more_categories();
        $wishlistitems = $this->wishlistcontroller->getWishListItems($request);
        $view = 'frontend.index';
        return view($view, compact(
            'products',
            'popularProducts',
            'flashSale',
            'featuredProducts',
            'saleProducts',
            'topProducts',
            'menu_categories',
            'home_categories',
            'categories',
            'nav_more_categories',
            'wishlistitems'
        ));
    }

    public function mainCategoryListing(Request $request, $mainCat)
    {
        $view = 'frontend.category-listing';
        $categories = $this->categories();
        $menu_categories = $this->menu_categories();
        $nav_more_categories = $this->nav_more_categories();
        $maincategory = $this->getCategoryBySlug($mainCat);
        $parentcategory = 0;
        $wishlistitems = $this->wishlistcontroller->getWishListItems($request);
        return view($view, compact(
            'menu_categories',
            'categories', 
            'nav_more_categories', 
            'maincategory', 
            'parentcategory', 
            'wishlistitems'

            // 'cart_items'
        ));
    }

    public function parentCategoryListing(Request $request, $mainCat, $parentCat)
    {
        // check if parentCat is product
        $isProduct = $this->getProductBySlug($parentCat);
        if($isProduct == null){
            $view = 'frontend.category-listing';
            $categories = $this->categories();
            $menu_categories = $this->menu_categories();
            $nav_more_categories = $this->nav_more_categories();
            $maincategory = $this->getCategoryBySlug($mainCat);
            $parentcategory = $this->getCategoryBySlug($parentCat);
            $wishlistitems = $this->wishlistcontroller->getWishListItems($request);
            return view($view, compact(
                'menu_categories', 
                'nav_more_categories', 
                'categories', 
                'maincategory', 
                'parentcategory',
                'wishlistitems'
     
                // 'cart_items'
            ));
        }
        else{
            return $this->productDetail($request, $mainCat, " ", " ", $parentCat);
        }

        // $data = [];
    }

    public function productDetail(Request $request, $mainCat, $parentCat, $childCat, $slug){
        $products = $this->products();
        $parent = $this->getCategoryBySlug($parentCat);
        $child = $this->getCategoryBySlug($childCat);
        $main_cat = $this->getCategoryBySlug($mainCat);
        $randomProducts = $this->randomProducts();
        $menu_categories = $this->menu_categories();
        $product = $this->getProductBySlug($slug);
        $home_categories = $this->home_categories();
        $categories = Category::getNestedCategories();
        $specificationcat = SpecificationCategory::where('status' , 1)->get();
        $nav_more_categories = $this->nav_more_categories();
        $wishlistitems = $this->wishlistcontroller->getWishListItems($request);
        $cart_items = $this->cartcontroller->getCartItems($request);
        $view = 'frontend.product-detail';
        return view($view, compact(
            'parent',//data
            'child',//data
            'main_cat',//data
            'mainCat',//slug
            'parentCat',//slug
            'childCat',//slug
            'products',
            'product',
            'randomProducts',
            'menu_categories',
            'home_categories',
            'categories',
            'nav_more_categories',
            'specificationcat',
            'wishlistitems',
            'cart_items'
        ));
    }

    public function productListing(Request $request, $mainCat, $parentCat, $childCat)
    {
        $isProduct = $this->getProductBySlug($childCat);
        if($isProduct == null){
            $order = $request->order_by;
            // $child = $this->getCategoryBySlug($childCat);
            $storedOrder = $request->cookie('selectedOrder');
            $products = $this->products();
            $categories = $this->categories();
            $menu_categories = $this->menu_categories();
            $nav_more_categories = $this->nav_more_categories();
            $cart_items = $this->cartcontroller->getCartItems($request);
            $parent = $this->getCategoryBySlug($parentCat);
            $child = $this->getCategoryBySlug($childCat);
            $main_cat = $this->getCategoryBySlug($mainCat);
            $wishlistitems = $this->wishlistcontroller->getWishListItems($request);
            $view = 'frontend.product-listing';
            
            return view($view, compact(
                'products', 
                'categories', 
                'nav_more_categories', 
                // 'all_products', 
                'menu_categories', 
                'mainCat', //slug
                'parent', //data
                'child',//data
                'main_cat',//data
                'cart_items', 
                'parentCat', //slug
                'childCat', //slug
                // 'order_by',
                'wishlistitems',
                'request'
                // 'hasProducts'
            ));
        }
        else{
            return $this->productDetail($request, $mainCat, $parentCat ," ", $childCat );

        }
    }

    public function my_cart(Request $request){
        $products = $this->products();
        $randomProducts = $this->randomProducts();
        $menu_categories = $this->menu_categories();
        $home_categories = $this->home_categories();
        $categories = Category::getNestedCategories();
        $nav_more_categories = $this->nav_more_categories();
        $wishlistitems = $this->wishlistcontroller->getWishListItems($request);

        $view = 'frontend.my-cart';
        $cart_items = $this->cartcontroller->getCartItems($request);
        $wishlistitems = $this->wishlistcontroller->getWishListItems($request);

        $cartTotal = $this->cartcontroller->calculatepricewithoutvat($request);
        if($cart_items->count() == 0){
            return redirect('/')->with('error' , "Sorry ! No items in cart");
        }
        
        return view($view, compact(
            'products',
            'randomProducts',
            'menu_categories',
            'home_categories',
            'categories',
            'nav_more_categories',
            'cart_items',
            'cartTotal',
            'wishlistitems'

        ));
    }

    public function getWishlist(Request $request){
        $products = $this->products();
        $randomProducts = $this->randomProducts();
        $menu_categories = $this->menu_categories();
        $home_categories = $this->home_categories();
        $categories = Category::getNestedCategories();
        $nav_more_categories = $this->nav_more_categories();
        $wishlistitems = $this->wishlistcontroller->getWishListItems($request);

        $view = 'frontend.get-wishlist';

        if($wishlistitems->count() == 0){
            return redirect('/')->with('error' , "Sorry ! No items in wishlist");
        }
        
        return view($view, compact(
            'products',
            'randomProducts',
            'menu_categories',
            'home_categories',
            'categories',
            'nav_more_categories',
            'wishlistitems',
        ));
    }

    public function checkout(Request $request){

        $products = $this->products();
        $randomProducts = $this->randomProducts();
        $menu_categories = $this->menu_categories();
        $home_categories = $this->home_categories();
        $categories = Category::getNestedCategories();
        $nav_more_categories = $this->nav_more_categories();
        $wishlistitems = $this->wishlistcontroller->getWishListItems($request);

        if($request->code){
            return $subtotal = $this->cartcontroller->checkDiscount($request);
            //  return $subtotal['status'];
        }
        $view = 'frontend.checkout';
        $cart_items = $this->cartcontroller->getCartItems($request);
        if($cart_items->count() == 0){
            return redirect('/');
        }
        $shippingCharges = $this->cartcontroller->calculateshipping($request);
        if($shippingCharges > 0){
            $grandTotal = $shippingCharges;
        }
        else{
            $grandTotal = $this->cartcontroller->calculateprice($request);
        }
        $cartTotal = $this->cartcontroller->calculatepricewithoutvat($request);
        // $vat = $this->cartcontroller->calculatevat($request);
        $vat = 0;

        
        return view($view, compact(
            'products',
            'randomProducts',
            'menu_categories',
            'home_categories',
            'categories',
            'nav_more_categories',
            'cart_items',
            'cartTotal', 
            'vat',
            'grandTotal',
            'shippingCharges',
            'wishlistitems'
        ));
    }

    public function customerLogin(Request $request){
        if($request->email && $request->password){
            $findemail = User::where('email',$request->email)->first();
            if(isset($findemail->id)){
                if($findemail->status == 1){
                    if (Hash::check($request->password , $findemail->password)) {
                        Auth::loginUsingId($findemail->id);
                        $macAddr = $this->cartcontroller->cartAddress;
                        $wholecart = TempCart::where('mac_address' , $macAddr)->get();
                        foreach($wholecart as $wc){
                            $wc->mac_address = null;
                            $wc->user_id = $findemail->id;
                            $wc->save();
                        }

                        $wholewishlist = Wishlist::where('mac_address' , $macAddr)->get();
                        foreach($wholewishlist as $wc){
                            $wc->mac_address = null;
                            $wc->user_id = $findemail->id;
                            $wc->save();
                        }
                        return response()->json([
                            "status" => "success",
                        ]);
                    }
                    else{
                        return response()->json([
                            "status" => "danger",
                            "message" => "Incorrect password",
                        ]);
                    }
                }
                else{
                    return response()->json([
                        "status" => "warning",
                        "message" => "Sorry! Your account is blocked. Please contact support",
                    ]);
                }
            }
        }
    }

    public function success_order(Request $request, $refkey)
    {
        $view = 'frontend.thankyou';
        $cartItems = $this->cartcontroller->getCartItems($request);
        $wishlistitems = $this->wishlistcontroller->getWishListItems($request);
        $cart_items = $this->cartcontroller->getCartItems($request);
        $menu_categories = $this->menu_categories();
        $nav_more_categories = $this->nav_more_categories();
        $order = Order::where('ref_key' , $refkey)->first();
        $orderProducts = OrderProduct::where('order_no', $order->order_no)->get();

        if(isset($order->id)){
            return view($view, compact(
                'menu_categories',
                'cartItems',
                'wishlistitems',
                // 'orderid',
                'cart_items' , 
                'nav_more_categories' , 
                'order',
                'orderProducts',
            ));
        }
        else{
            return redirect('/');
        }
    }

    // public function thankyou(Request $request, $refkey)
    // {
    //     $view = 'frontend.thankyou';
    //     $order = Order::where('ref_key' , $refkey)->first();
    //     $orderProducts = OrderProduct::where('order_no', $order->order_no)->get();
    //     $cartItems = $this->cartcontroller->getCartItems($request);
    //     $wishlistitems = $this->wishlistcontroller->getWishListItems($request);
    //     $cart_items = $this->cartcontroller->getCartItems($request);
    //     $menu_categories = $this->menu_categories();
    //     $nav_more_categories = $this->nav_more_categories();
    //     if(isset($order->id)){
    //         return view($view, compact(
    //             'menu_categories',
    //             'cartItems',
    //             'wishlistitems',
    //             // 'orderid',
    //             'cart_items' , 
    //             'nav_more_categories' , 
    //             'order',
    //             'orderProducts',
    //         ));
    //     }
    //     else{
    //         return redirect('/');
    //     }
    // }

    public function customerRegister(Request $request){
        $findemail = User::where('email' , $request->email)->first();
        if(isset($findemail->id)){
            return response()->json([
                "status" => "warning",
                "message" => "Sorry! This email is already registered. Please login to continue",
            ]);
        }
        else{
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role_id = 2;
            $user->status = 1;
            $user->save();
            Auth::loginUsingId($user->id);
            $macAddr = $this->cartcontroller->cartAddress;
            $wholecart = TempCart::where('mac_address' , $macAddr)->get();
            foreach($wholecart as $wc){
                $wc->mac_address = null;
                $wc->user_id = $user->id;
                $wc->save();
            }

            $wholewishlist = Wishlist::where('mac_address' , $macAddr)->get();
            foreach($wholewishlist as $wc){
                $wc->mac_address = null;
                $wc->user_id = $user->id;
                $wc->save();
            }
            return response()->json([
                "status" => "success",
                "message" => "Account created successfully.",
            ]);
        }
    }

    public function recoverPassword(Request $request){
        $user = User::where('email' , $request->email)->first();
        if(isset($user->id)){
            dispatch(new ForgotPasswordJob($user->id));

            return response()->json([
                "status" => "success",
                "message" => "A email has been sent to your email address. Please follow the instruction in the email to reset your password.",
            ]);
        }
        else{
            return response()->json([
                "status" => "warning",
                "message" => "Sorry! We couldn't find any account associated with this email.",
            ]);
        }
    }

    public function resetPassword(Request $request , $refkey){
        $view = 'frontend.reset-password';
        $user = User::where('token' , $refkey)->first();
        $cartItems = $this->cartcontroller->getCartItems($request);
        $cart_items = $this->cartcontroller->getCartItems($request);
        $menu_categories = $this->menu_categories();
        $nav_more_categories = $this->nav_more_categories();
        $wishlistitems = $this->wishlistcontroller->getWishListItems($request);

        if(isset($user->id)){
            return view($view, compact('menu_categories', 'wishlistitems', 'cartItems', 'cart_items' , 'nav_more_categories' ,'user'));
        }
        else{
            return redirect('/');
        }
    }

    public function resetPasswordsubmit(Request $request){
        $user = User::find($request->userid);
        if(isset($user->id)){
            $user->password = bcrypt($request->password);
            $user->token = null;
            $user->save();
            Auth::loginUsingId($user->id);
            $macAddr = $this->cartcontroller->cartAddress;
            $wholecart = TempCart::where('mac_address' , $macAddr)->get();
            foreach($wholecart as $wc){
                $wc->mac_address = null;
                $wc->user_id = $user->id;
                $wc->save();
            }

            $wholewishlist = Wishlist::where('mac_address' , $macAddr)->get();
            foreach($wholewishlist as $wc){
                $wc->mac_address = null;
                $wc->user_id = $user->id;
                $wc->save();
            }
            return response()->json([
                "status" => "success",
                "message" => "Password reset successfully. Please login to continue.",
            ]);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function getUserOrders($userid)
    {
        return $orders = Order::where('user_id', $userid)->get();
    }

    public function userupdate(Request $request)
    {
        $userid = $request->userid;
        $user = User::find($userid);
        if ($user) {
            $user->contact_no = $request->contact_no;
            $user->name = $request->firstname . " " . $request->lastname;
            $user->save();
            return response()->json([
                'status' => 'success',
                'message' => 'User is updated!',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid user!',
            ]);
        }
    }

    public function updateUserPassword(Request $request)
    {

        $user = User::find($request->userid);
        
        if (Hash::check($request->old_password, $user->password, [])) {
            // Check if the old password matches the current password
            if ($request->new_password != $request->confirm_password) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Passwords do not match!',
                ]);
            } else {
                // Update the password
                $user->password = bcrypt($request->new_password);
                $user->save();
    
                return response()->json([
                    'status' => 'success',
                    'message' => 'Password updated successfully!',
                ]);
            }
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid old password!',
            ]);
        }

    }
    
    public function account(Request $request)
    {
        $view = 'frontend.my-account';
        $products = $this->products();
        $randomProducts = $this->randomProducts();
        $menu_categories = $this->menu_categories();
        $home_categories = $this->home_categories();
        $categories = Category::getNestedCategories();
        $nav_more_categories = $this->nav_more_categories();
        $wishlistitems = $this->wishlistcontroller->getWishListItems($request);

        $UserID = 0;
        if (Auth()->check()) {
            $UserID =  Auth()->user()->id;
        }
        if ($UserID != 0) {
            $user = User::where('id', $UserID)->first();
        } else {
            return redirect()->route('home');
            $user = '';
        }

        $order_items = $this->getUserOrders($UserID);
        // dd($order_items[0]->order_products->id);
        return view($view, compact(
            'products',
            'randomProducts',
            'menu_categories',
            'home_categories',
            'categories',
            'nav_more_categories',
            'wishlistitems',
            'user',
            'UserID',
            'order_items',
        ));
    }

    public function track_order(Request $request)
    {
        $view = 'frontend.track-order';
        $menu_categories = $this->menu_categories();
        $categories = Category::getNestedCategories();
        $nav_more_categories = $this->nav_more_categories();
        $wishlistitems = $this->wishlistcontroller->getWishListItems($request);

        // dd($order_items[0]->order_products->id);
        return view($view, compact(
            'menu_categories',
            'categories',
            'nav_more_categories',
            'wishlistitems',
        ));
    }
    
    public function find_order(Request $request, $refkey)
    {
        $view = 'frontend.find-order';
        $menu_categories = $this->menu_categories();
        $categories = Category::getNestedCategories();
        $nav_more_categories = $this->nav_more_categories();
        $wishlistitems = $this->wishlistcontroller->getWishListItems($request);
        $thisorder = Order::where('ref_key' , $refkey)->first();
        $orderProducts = OrderProduct::where('order_no' , $thisorder->order_no)->get();

        // dd($order_items[0]->order_products->id);
        return view($view, compact(
            'menu_categories',
            'categories',
            'nav_more_categories',
            'wishlistitems',
            'thisorder',
            'orderProducts',
        ));
    }

    public function faqs(Request $request)
    {
        $view = 'frontend.faqs';
        $menu_categories = $this->menu_categories();
        $categories = Category::getNestedCategories();
        $nav_more_categories = $this->nav_more_categories();
        $wishlistitems = $this->wishlistcontroller->getWishListItems($request);
        $faqs = Faq::where('status', 1)->get();


        // dd($order_items[0]->order_products->id);
        return view($view, compact(
            'menu_categories',
            'categories',
            'nav_more_categories',
            'wishlistitems',
            'faqs',
        ));
    }

    public function contentPages(Request $request, $slug)
    {
        $view = 'frontend.content-page';
        $menu_categories = $this->menu_categories();
        $categories = Category::getNestedCategories();
        $nav_more_categories = $this->nav_more_categories();
        $wishlistitems = $this->wishlistcontroller->getWishListItems($request);
        $page = ContentPage::where('status', 1)->where('slug', $slug)->first();


        // dd($order_items[0]->order_products->id);
        return view($view, compact(
            'menu_categories',
            'categories',
            'nav_more_categories',
            'wishlistitems',
            'page',
        ));
    }
    public function newsletterSubscribe(Request $request){
        $ipAddress = $request->ip();

        // Check if there are already two entries from the same IP address
        $entryCount = Newsletter::where('ip_address', $ipAddress)->count();
    
        if ($entryCount >= 2) {
            return response()->json([
                "status" => "warning",
                "message" => "Sorry! You have already subscribed twice from this IP address.",
            ]);
        }
    
        // Check if the email is already registered
        $findEmail = Newsletter::where('email' , $request->email)->first();
        if(isset($findEmail->id)){
            return response()->json([
                "status" => "warning",
                "message" => "Sorry! This email is already registered. Please login to continue",
            ]);
        }
        else{
            $newsletter = new Newsletter();
            $newsletter->email = $request->email;
            $newsletter->status = 1;
            $newsletter->ip_address = $ipAddress;

            $newsletter->save();
            return response()->json([
                "status" => "success",
                "message" => "Subscribed successfully.",
            ]);
        }
    }

    public function search(Request $request , $search){
        // return $search;
        $order = $request->order_by;
        $storedOrder = $request->cookie('selectedOrder');
        $randomProducts = $this->randomProducts();
        $categories = $this->categories();
        $menu_categories = $this->menu_categories();
        $nav_more_categories = $this->nav_more_categories();
        $cart_items = $this->cartcontroller->getCartItems($request);
        $cacheKey = 'suggestions_' . md5($search);
        $results = Product::whereHas('product_to_category')->where(function($query) use ($search) {
                $query->where('title', 'LIKE', '%'.$search.'%')->orWhere('product_code', 'LIKE', '%'.$search.'%');
            })->where('status', 1)->take(10);
        
        $check = $results->get();
        if(count($check) < 0){
            // return "ABC";
            $results = Product::whereHas('product_to_category')->where('status', 1)->inRandomOrder()->take(12)->get();
        }

        $wishlistitems = $this->wishlistcontroller->getWishListItems($request);
        $view = 'frontend.search-listing';
        
        return view($view, compact(
            'categories',
            'search',
            'results',
            'nav_more_categories', 
            // 'all_products', 
            'menu_categories', 
            'cart_items', 
            'wishlistitems',
            'randomProducts',
            'request' 
            // 'randomProducts'
        ));
    }

    public function success_quick_payment(Request $request){
        if (isset($request->payment_intent) && isset($request->payment_intent_client_secret) && isset($request->redirect_status)) { 
            if (setting('stripe.status') == "1") {
                $apiKey = setting('stripe.livekey');
            } else {
                $apiKey = setting('stripe.testkey');
            }
        
            $paymentIntent = $request->payment_intent;
            try {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $apiKey,
                ])->get('https://api.stripe.com/v1/payment_intents/' . $paymentIntent);
                
                $paymentIntent = $response->json();
                
                $cartItems = $this->cartcontroller->getCartItems($request);
                $macAddr = $this->cartcontroller->cartAddress;
                $user = "";
                $email = "";
        
                if (isset($paymentIntent['status']) && $paymentIntent['status'] == 'succeeded') {
                    if (isset($paymentIntent['charges']['data'][0]['billing_details'])) {
                        $billingDetails = $paymentIntent['charges']['data'][0]['billing_details']['address'];
        
                        $email = $request->email;
        
                        $user = User::where('email', $email)->first();
                        if (!isset($user->id)) {
                            $user = new User();
                            $user->name = $request->name;
                            $user->email = $request->email;
                            $user->contact_no = $request->phone;
                            $password = Str::random(10);
                            $user->password = bcrypt($password);
                            $user->address = (isset($billingDetails['line1']) ? $billingDetails['line1'] : '') . ' ' . (isset($billingDetails['line2']) ? $billingDetails['line2'] : '');
                            $user->postcode = isset($billingDetails['postal_code']) ? $billingDetails['postal_code'] : ''; 
                            $user->state = isset($billingDetails['state']) ? $billingDetails['state'] : ''; 
                            $user->city = isset($billingDetails['city']) ? $billingDetails['city'] : ''; 
                            $user->save();
                        }
                        else{
                            $user->name = $request->name;
                            $user->email = $request->email;
                            $user->contact_no = $request->phone;
                            $user->address = (isset($billingDetails['line1']) ? $billingDetails['line1'] : '') . ' ' . (isset($billingDetails['line2']) ? $billingDetails['line2'] : '');
                            $user->postcode = isset($billingDetails['postal_code']) ? $billingDetails['postal_code'] : ''; 
                            $user->state = isset($billingDetails['state']) ? $billingDetails['state'] : ''; 
                            $user->city = isset($billingDetails['city']) ? $billingDetails['city'] : ''; 
                            $user->save();
                        }
        
                        Auth::loginUsingID($user->id);
        
                        $wholeCart = TempCart::where('mac_address', $macAddr)->get();
                        
                        if (!$wholeCart->isEmpty()) {
                            foreach ($wholeCart as $wc) {
                                $wc->mac_address = null;
                                $wc->user_id = $user->id;
                                $wc->save();
                            }
                        }
        
                        $order = new Order();
                        $orderId = date('ymd') . mt_rand(10000, 99999);
                        $order->order_no = $orderId;
                        $order->user_id = $user->id;
                        $order->name = $user->name;
                        $order->email = $user->email;
                        $order->contact_no = $user->contact_no;
                        $order->ref_key = Str::random(15);
                        $order->address = (isset($billingDetails['line1']) ? $billingDetails['line1'] : '') . ' ' . (isset($billingDetails['line2']) ? $billingDetails['line2'] : '');
                        $order->postal_code = isset($billingDetails['postal_code']) ? $billingDetails['postal_code'] : '';
                        $order->state = isset($billingDetails['state']) ? $billingDetails['state'] : ''; 
                        $order->city = isset($billingDetails['city']) ? $billingDetails['city'] : ''; 
                        $amountcharged =  str_replace(',' , '' ,isset($paymentIntent['amount_received']) ? number_format($paymentIntent['amount_received'] / 100, 2) : '');
                        $order->order_discount = preg_replace("/[^0-9\.]/", "", $request->discount);
                        $order->order_total = $amountcharged;
                        $shippingtotal = $this->cartcontroller->calculateshippingvalue($request);
                        $order->shipping_total = $shippingtotal;
                        $order->payment_response = json_encode($paymentIntent);
                        $order->payment_type = "Paid";
                        $order->payment_status = "paid";
                        $order->payment_gateway = isset($paymentIntent['payment_method_types']) ? implode('-', $paymentIntent['payment_method_types']) : "Stripe";
        
                        $order->save();
        
                        foreach ($cartItems as $item) {
                            $orderpro = new OrderProduct();
                            $orderpro->order_no = $order->order_no;
                            $orderpro->product_id = $item->product_id;
                            $orderpro->price = $item->price;
                            $orderpro->total = $item->price * $item->quantity;
                            $orderpro->quantity = $item->quantity;
                            $orderpro->save();
                        }
        
                        $removeCart = TempCart::where('user_id', $user->id)->get();
                        if (!$removeCart->isEmpty()) {
                            foreach ($removeCart as $rc) {
                                $rc->delete();
                            }
                        }
        
                        $view = 'frontend.thankyou';
                        $cartItems = $this->cartcontroller->getCartItems($request);
                        $wishlistitems = $this->wishlistcontroller->getWishListItems($request);
                        $cart_items = $this->cartcontroller->getCartItems($request);
                        $menu_categories = $this->menu_categories();
                        $nav_more_categories = $this->nav_more_categories();
                        $order = Order::where('ref_key' , $order->ref_key)->first();
                        $orderProducts = OrderProduct::where('order_no', $order->order_no)->get();
                        //invoice Start
                        $invoice = $this->ordercontroller->createInvoice($order->id);
                        //invoice End
                        if (filter_var($order->email, FILTER_VALIDATE_EMAIL)) {
                            dispatch(new OrderVerificationJob($order->id,$order->email , 'customer' , $invoice->invoice_pdf));
                        }
                        $NotificationEmails = explode(",",setting('site.notificationmails'));
                        foreach($NotificationEmails as $NE) {
                            dispatch(new OrderVerificationJob($order->id, $NE , 'admin' , $invoice->invoice_pdf));
                        }

                        if(isset($order->id)){
                            return view($view, compact(
                                'menu_categories',
                                'cartItems',
                                'wishlistitems',
                                'cart_items' , 
                                'nav_more_categories' , 
                                'order',
                                'orderProducts',
                            ));
                        }
                        else{
                            return redirect('/');
                        }
                    }
                }
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
        else{
            return redirect('/');
        }
    }

    public function reorder(Request $request){
        if($request->id){
            $orderpro = OrderProduct::where('order_no' , $request->id)->get();
            foreach($orderpro as $op){
                $request->merge(['qtty' => $op->quantity]);
                $addtocart = $this->cartcontroller->addToCart($request , $op->product_id);
            }

            return response()->json([
                "status" => "success",
                "redirect" => route('checkout')
            ]);
        }
        else{
            return redirect('/');
        }
    }

    public function listwholeorder(Request $request){
        $view = 'frontend.list-whole-order';
        $menu_categories = $this->menu_categories();
        $categories = Category::getNestedCategories();
        $nav_more_categories = $this->nav_more_categories();
        $wishlistitems = $this->wishlistcontroller->getWishListItems($request);
        $orderpro = OrderProduct::where('order_no' , $request->id)->get();
        $cart_items = $this->cartcontroller->getCartItems($request);

        return view($view, compact(
            'menu_categories',
            'categories',
            'nav_more_categories',
            'wishlistitems',
            'orderpro',
            'cart_items'
        ));
    }
}