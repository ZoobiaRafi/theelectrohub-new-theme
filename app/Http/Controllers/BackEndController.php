<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Category;
use App\CouponCode;
use App\CouponCodeToCategory;
use App\CouponCodeToProduct;
use App\CouponCodeToUser;
use App\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use PDO;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportCategory;
use App\Imports\ImportProduct;
use App\Imports\ImportSaxbe;
use App\Imports\ImportScollmore;
use App\Imports\ImportLW;
use App\Imports\ImportMla;
use App\Wishlist;
use App\Banner;
use App\ContactU;
use App\ContactUsStatus;
use App\ContactusTopic;
use App\ContentPage;
use App\Faq;
use App\FaqsToCategory;
use App\FaqsToProduct;
use App\Imports\UpdateCategoryImport;
use App\Newsletter;
use App\OrderStatus;
use App\Ticker;
use App\Order;
use App\ProductSpecification;
use App\ProductToCategory;
use App\Promotion;
use App\SpecificationCategory;
use App\Vendor;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class BackEndController extends Controller
{
    public function index(){
        $view = 'login';
        return view($view);
    }

    public function login_check(){
        if(Auth::check()){
            $user = Auth()->user();
        }
        return $user;
    }

    public function roles(){
        return \TCG\Voyager\Models\Role::where('id','!=',1)->get();
    }

    public function login_submit(Request $request){
        if(isset($request->email)){
            $findemail = User::where('email',$request->email)->first();
            if(isset($findemail->id)){
                if($findemail->status == 1){
                    if (Hash::check($request->password , $findemail->password)) {
                        Auth::loginUsingId($findemail->id);
                        return response()->json([
                            "status" => "success",
                            "message" => "Please wait we are redirecting you",
                            "redirect" => "/dashboard/home"
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
            $findusername = User::where('username',$request->email)->first();
            if(isset($findusername->id)){
                if($findusername->status == 1){
                    if (Hash::check($request->password , $findusername->password)) {
                        Auth::loginUsingId($findusername->id);
                        return response()->json([
                            "status" => "success",
                            "message" => "Please wait we are redirecting you",
                            "redirect" => "/dashboard/home"
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
            $findcontact = User::where('contact_no',$request->email)->first();
            if(isset($findcontact->id)){
                if($findcontact->status == 1){
                    if (Hash::check($request->password , $findcontact->password)) {
                        Auth::loginUsingId($findcontact->id);
                        return response()->json([
                            "status" => "success",
                            "message" => "Please wait we are redirecting you",
                            "redirect" => "/dashboard/home"
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
            else{
                return response()->json([
                    "status" => "danger",
                    "message" => "Sorry! we cannot find any account with your details",
                ]);
            }
        }
    }

    public function dashboard() {
        $view = 'dashboard';
        $user = $this->login_check();
        $latestusers = User::orderBy('id','DESC')->take(10);
        $firstweek = now()->startOfWeek()->toDateString();
        $lastweek = now()->subWeek()->startOfWeek()->toDateString();
        $lasttwoweek = now()->subWeeks(2)->startOfWeek()->toDateString();

        $currentdate = now();
        $firstdayofmonth = $currentdate->firstOfMonth()->format('Y-m-d');
        $lastdayofmonth = $currentdate->lastOfMonth()->format('Y-m-d');
        
        $firstdayofyear = $currentdate->firstOfYear()->format('Y-m-d');
        $lastdayofyear = $currentdate->lastOfYear()->format('Y-m-d');
    
        $orderstatus = OrderStatus::where('status', 1)->get();
        $orderamount = [];
        $ordercount = [];
        $orderamountmonthly = [];
    
        foreach ($orderstatus as $status) {
            $orderamount[$status->title]['thisweekordersamount'] = $status->getOrders($firstweek, null, "amount" , $status->id);
            $orderamount[$status->title]['lastweekordersamount'] = $status->getOrders($lastweek, $lasttwoweek, "amount" , $status->id);
            $orderamount[$status->title]['lasttwoweeksordersamount'] = $status->getOrders($lasttwoweek, null, "amount" , $status->id);
        }
        
        foreach ($orderstatus as $status) {
            $ordercount[$status->title]['thisweekorderscount'] = $status->getOrders($firstweek, null, "count" , $status->id);
            $ordercount[$status->title]['lastweekorderscount'] = $status->getOrders($lastweek, $lasttwoweek, "count" , $status->id);
            $ordercount[$status->title]['lasttwoweeksorderscount'] = $status->getOrders($lasttwoweek, null, "count" , $status->id);
        }

        foreach($orderstatus as $status){
            $orderamountmonthly[$status->title]['thismonthorders'] = $status->getOrders($firstdayofmonth, $lastdayofmonth, "amount" , $status->id);
        }
        
        foreach($orderstatus as $status){
            $orderamountyearly[$status->title]['thisyearorders'] = $status->getOrders($firstdayofyear, $lastdayofyear, "amount" , $status->id);
        }

        $wishlistdata = [];
        $wishlist = Wishlist::where('status', 1)->get();

        $productCounts = $wishlist->groupBy('product_id')->map->count();

        foreach ($productCounts as $productId => $count) {
            $wishlistdata[] = [
                "proid" => $productId,
                "count" => $count,
                "protitle" => Product::find($productId)->title
            ];
        }
        $sortedwishlistdata = collect($wishlistdata)->sortByDesc('count');
        $top10wishlistdata = $sortedwishlistdata->take(10)->values()->all();
        return view($view, compact('user', 'latestusers', 'orderamount' , 'ordercount' , 'orderstatus' , 'orderamount' , 'orderamountmonthly' , 'orderamountyearly' , 'top10wishlistdata'));
    }
    

    private function getOrders($startDate, $endDate = null , $type) {
        $orderstatusamount = [];
        $orderstatus = OrderStatus::where('status', 1)->get();
        
        foreach ($orderstatus as $status) {
            $query = Order::where('status', $status->id)->whereDate('created_at', '>=', $startDate);
            if ($endDate) {
                $query->whereDate('created_at', '<', $endDate);
            }
            if($type == "amount"){
                $orderstatusamount[$status->title] = number_format($query->sum('order_total'), 2);
            }
            else if($type == "count"){
                $orderstatusamount[$status->title] = $query->count();
            }
        }
        return $orderstatusamount;
    }

    public function users(Request $request,$refkey){
        $view = 'users';

        $user = $this->login_check();
        $roles = $this->roles();
        $finduser = User::where('ref_key',$refkey)->first();
        if(!isset($request->role)){
            if(isset($finduser)){
                if($request->has('query')){
                    $alluser = User::where('name' , 'LIKE' , '%' . $request->input('query') . '%')->orderBy('id','DESC')->paginate(10);
                }
                else{
                    if($finduser->role_id == 2 || $finduser->role_id == 1){
                        $alluser = User::orderBy('id','DESC')->paginate(10);
                    }
                    else{
                        $alluser = User::where('created_by', $finduser->id)->orderBy('id','DESC')->paginate(10);
                    }
                }
            }
            else{
                return redirect('/dashboard/home');
            }
        }
        // else{
        //     if(isset($finduser)){
        //         if($finduser->role_id == 2 || $finduser->role_id == 1){
        //             $alluser = User::orderBy('id','DESC')->where('role_id',$request->role)->paginate(10);
        //         }
        //         else{
        //             $alluser = User::where('created_by', $finduser->id)->where('role_id',$request->role)->orderBy('id','DESC')->paginate(10);
        //         }
        //     }
        //     else{
        //         return redirect('/dashboard/home');
        //     }
        // }
        return view($view,compact('user','alluser','roles'));
    }

    public function check_username(Request $request){
        if(isset($request->username)){
            $findusername = User::where('username',$request->username)->count();
            if($findusername > 0){
                return response()->json([
                    "status" => "warning",
                    "message" => "Username already exists"
                ]);
            }
            else{
                return response()->json([
                    "status" => "success",
                    "message" => "Username available"
                ]);
            }
        }

        else if(isset($request->email)){
            $findemail = User::where('email',$request->email)->count();
            if($findemail > 0){
                return response()->json([
                    "status" => "warning",
                    "message" => "Email already exists"
                ]);
            }
            else{
                return response()->json([
                    "status" => "success",
                    "message" => "Email available"
                ]);
            }
        }

        else if(isset($request->number)){
            $findcontact = User::where('contact_no',$request->number)->count();
            if($findcontact > 0){
                return response()->json([
                    "status" => "warning",
                    "message" => "Contact Number already exists"
                ]);
            }
            else{
                return response()->json([
                    "status" => "success",
                    "message" => "Contact Number available"
                ]);
            }
        }
    }

    public function user_submit(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->contact_no = $request->phone;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role;
        $user->status = 1;
        if($request->role == 4){
            $user->level = $request->level;
        }
        $user->save();
        return response()->json([
            "status" => "success",
            "message" => "User registered successfully"
        ]);
    }

    public function profile(Request $request){
        $view = 'profile';
        $roles = $this->roles();
        $user = $this->login_check();
        if ($request->expectsJson()) {
            return response()->json(['user' => $user, 'roles' => $roles , 'status' => "success"]);
        }   
        return view($view,compact('user','roles'));
    }

    public function profile_update_submit(Request $request){
        // return $request;
        $user = $this->login_check();
        if(isset($request->name)){
            $user->name = $request->name;
        }
        if(isset($request->email)){
            $user->email = $request->email;
        }
        if(isset($request->password) && isset($request->currpassword)){
            if (Hash::check($request->currpassword, $user->password)) {
                $user->password = bcrypt($request->password);
            } else {
                return response()->json([
                    "status" => 'warning',
                    "message" => "Sorry! The current password is incorrect."
                ]);
            }
        }
        if(isset($request->number)){
            $user->contact_no = $request->number;
        }
        $user->save();

        return response()->json([
            "status" => "success",
            "message" => "Profile has been updated",
            "user" => $user
        ]);
    }

    public function deactive_account($userid){
        $finduser = User::find($userid);
        if(isset($finduser->id)){
            $finduser->status = 0;
            $finduser->save();
        }
        return response()->json([
            "status" => "success"  
        ]);
    }

    public function active_account($userid){
        $finduser = User::find($userid);
        if(isset($finduser->id)){
            $finduser->status = 1;
            $finduser->save();
        }
        return response()->json([
            "status" => "success"  
        ]);
    }

    public function category(Request $request , $refkey){
        $view = 'category';
        $user = $this->login_check();
        if($request->has('query')){
            $category = Category::where('title' , 'LIKE' , '%' . $request->input('query') . '%')->orderBy('id','DESC')->get();
        }
        else{
            $category = Category::orderBy('id','DESC')->get();
        }
        $allcategory = Category::getNestedCategories();
        return view($view,compact('user','category','allcategory'));
    }

    public function category_submit(Request $request){
        // return $request;
        try{
            $category = new Category();
            $category->code = $request->code;
            $category->title = $request->title;
            $category->status = $request->status;
            $category->sale = $request->sale;
            if($request->sale == 1){
                $category->discount = $request->discount;
                $category->discount_type = $request->discounttype;
                $category->start_date = $request->startdate;
                $category->end_date = $request->enddate;
            }
            $random = Str::random(50);
            if(isset($request->image)){
                $imagename = $random . '.' . $request->image->extension();
                $category->image = $request->image->move('images/category/', $imagename);
            }
            if(isset($request->firsticon)){
                $imagename = $random . '.' . $request->firsticon->extension();
                $category->first_icon = $request->firsticon->move('images/category/firsticons', $imagename);
            }
            if(isset($request->secondicon)){
                $imagename = $random . '.' . $request->secondicon->extension();
                $category->second_icon = $request->secondicon->move('images/category/secondicons', $imagename);
            }
            if (ctype_digit($request->parentcategory)) {
                $category->parent_id = $request->parentcategory;
            }
            $category->save();
            return response()->json([
                "status" => "success",
                "message" => "Category Added Successfully"
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while adding the category",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function category_update(Request $request){
        try{
            $category = Category::find($request->id);
            $category->code = $request->code;
            $category->title = $request->title;
            $random = Str::random(50);
            $category->slug = $request->slug;
            $category->sale = $request->sale;
            if($request->sale == 1){
                $category->discount = $request->discount;
                $category->discount_type = $request->discounttype;
                $category->start_date = $request->startdate;
                $category->end_date = $request->enddate;
            }
            if($request->hasFile('image')){
                // return $request->image->extension();
                $imagename = $random . '.' . $request->image->extension();
                $category->image = $request->image->move('images/category/', $imagename);
            }
            if($request->hasFile('firsticon')){
                $imagename = $random . '.' . $request->firsticon->extension();
                $category->first_icon = $request->firsticon->move('images/category/firsticons', $imagename);
            }
            if($request->hasFile('secondicon')){
                $imagename = $random . '.' . $request->secondicon->extension();
                $category->second_icon = $request->secondicon->move('images/category/secondicons', $imagename);
            }
            if (ctype_digit($request->parentcategory)) {
                $category->parent_id = $request->parentcategory;
            }
            $category->save();
            return response()->json([
                "status" => "success",
                "message" => "Category Updated Successfully"    
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while updating the category",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function category_delete(Request $request){
        try {
            $category = Category::find($request->id);
            $category->delete();
            return response()->json([
                "status" => "success"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while deleting the category",
                "error" => $e->getMessage()
            ]);
        }
    }

    // public function category_status(Request $request){
    //     try{
    //         $category = Category::find($request->id);
    //         if($category->status == 1){
    //             $category->status = 0;
    //             $category->save();
    //         }
    //         else if($category->status == 0){
    //             $category->status = 1;
    //             $category->save();
    //         }
    //         return response()->json([
    //             "status" => "success"
    //         ]);
    //     }
    //     catch (\Exception $e) {
    //         return response()->json([
    //             "status" => "error",
    //             "message" => "An error occurred while updating the category status",
    //             "error" => $e->getMessage()
    //         ]);
    //     }
    // }

    public function product(Request $request , $refkey){
        $view = 'product';
        $user = $this->login_check();
        if($request->has('query')){
            $input = $request->input('query');
            $product = Product::where('title','LIKE','%'.$input.'%')->orWhere('product_code','LIKE','%'.$input.'%')->paginate(10);
            $procount = Product::count();
        }
        else{
            $product = Product::orderBy('id','DESC')->paginate(10);
            $procount = Product::count();
        }
        $vendors = Vendor::where('status' , 1)->get();
        $category = Category::getNestedCategories();
        return view($view,compact('user','product','category','procount','vendors'));
    }

    public function product_submit(Request $request){
        try{
            if($request->catid != ""){
                $sellingprice = 0;
                $price = 0;
                if(isset($request->vendorprice)){
                    $vendor = Vendor::find($request->vendorid);
                    if(isset($vendor)){
                        $vendorpercenatge = $vendor->percentage / 100;
                        $price = $request->vendorprice * $vendorpercenatge;
                        $sellingprice = $price + $request->vendorprice;
                    }
                }
                if(isset($request->productpercentage) && $request->productpercentage != ""){
                    $productprecetage = $request->productpercentage / 100;
                    $price = $request->vendorprice * $productprecetage;
                    $sellingprice = $price + $request->vendorprice;
                }
                $product = new Product();
                $product->title = $request->title;
                $product->status = $request->status;
                $product->price = $sellingprice;
                // if (ctype_digit($request->catid)) {
                //     $product->cat_id = $request->catid;
                // } else {
                //     return response()->json([
                //         "status" => "error",
                //         "message" => "Please select a category"
                //     ]);
                // }
                $product->qty = $request->quantity;
                $random = Str::random(50);
                $product->vendor_id = $request->vendorid;
                $product->sale = $request->sale;
                if(isset($request->shortdescription)){
                    $product->overview = $request->shortdescription;
                }
                if(isset($request->description)){
                    $product->long_description = $request->description;
                }
                if($request->sale == 1){
                    $product->discount = $request->discount;
                    $product->discount_type = $request->discounttype;
                    $product->start_date = $request->startdate;
                    $product->end_date = $request->enddate;
                }
                if(isset($request->image)){
                    $imagename = $random . '.' . $request->image->extension();
                    $product->image = $request->image->move('images/product/', $imagename);
                }
    
                if(isset($request->multiimages)){
                    $images = $request->multiimages;
                    $imagePaths = [];
    
                    foreach($images as $image){
                        $imagename = Str::random(50) . '.' . $image->extension();
                        $image->storeAs('images/product', $imagename);
                        $imagePaths[] = 'images/product/' . $imagename;
                    }
    
                    $product->other_images = json_encode($imagePaths);
                }
    
                $product->save();

                $catids = explode(',' , $request->catid);
                foreach($catids as $cat){
                    $producttocats = new ProductToCategory();
                    $producttocats->product_id = $product->id;
                    $producttocats->cat_id = $cat;
                    $producttocats->save();
                }

                return response()->json([
                    "status" => "success",
                    "message" => "Product Added Successfully"
                ]);
            }
            else{
                return response()->json([
                    "status" => "error",
                    "message" => "Please select a category"
                ]);
            }
        }
        catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while adding the product",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function product_update(Request $request){
        try{
            $product = Product::find($request->id);
            $sellingprice = 0;
            $price = 0;
            if(isset($request->vendorprice)){
                $vendor = Vendor::find($request->vendorid);
                if(isset($vendor)){
                    $vendorpercenatge = $vendor->percentage / 100;
                    $price = $request->vendorprice * $vendorpercenatge;
                    $sellingprice = $price + $request->vendorprice;
                }
            }
            if(isset($request->productpercentage) && $request->productpercentage != ""){
                $productprecetage = $request->productpercentage / 100;
                $price = $request->vendorprice * $productprecetage;
                $sellingprice = $price + $request->vendorprice;
            }
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->price = $sellingprice;
            $product->vendor_price = $request->vendorprice;
            $product->percentage = $request->productpercentage;
            $product->qty = $request->quantity;
            $product->vendor_id = $request->vendorid;
            $random = Str::random(50);
            $product->sale = $request->sale;
            if(isset($request->shortdescription)){
                $product->overview = $request->shortdescription;
            }
            if(isset($request->description)){
                $product->long_description = $request->description;
            }
            if($request->sale == 1){
                $product->discount = $request->discount;
                $product->discount_type = $request->discounttype;
                $product->start_date = $request->startdate;
                $product->end_date = $request->enddate;
            }
            if($request->hasFile('image')){
                $imagename = $random . '.' . $request->image->extension();
                $product->image = $request->image->move('images/product/', $imagename);
            }

            if($request->hasFile('multiimages')){
                $images = $request->multiimages;
                $imagePaths = [];

                foreach($images as $image){
                    $imagename = Str::random(50) . '.' . $image->extension();
                    $image->move('images/product', $imagename);
                    $imagePaths[] = 'images/product/' . $imagename;
                }

                $product->uploader_image = json_encode($imagePaths);
            }
            if(isset($request->catid) && $request->catid != ""){
                ProductToCategory::where('product_id', $product->id)->delete();
                $catids = explode(',' , $request->catid);
                foreach($catids as $cat){
                    $producttocats = new ProductToCategory();
                    $producttocats->product_id = $product->id;
                    $producttocats->cat_id = $cat;
                    $producttocats->save();
                }
            }
            $product->save();
            return response()->json([
                "status" => "success",
                "message" => "Product Updated Successfully"
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while updating the product",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function product_delete(Request $request){
        try {
            $product = Product::find($request->id);
            $product->delete();
            return response()->json([
                "status" => "success"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while deleting the product",
                "error" => $e->getMessage()
            ]);
        }
    }

    // public function product_status(Request $request){
    //     try{
    //         $product = Product::find($request->id);
    //         if($product->status == 1){
    //             $product->status = 0;
    //             $product->save();
    //         }
    //         else if($product->status == 0){
    //             $product->status = 1;
    //             $product->save();
    //         }
    //         return response()->json([
    //             "status" => "success"
    //         ]);
    //     }
    //     catch (\Exception $e) {
    //         return response()->json([
    //             "status" => "error",
    //             "message" => "An error occurred while updating the product status",
    //             "error" => $e->getMessage()
    //         ]);
    //     }
    // }

    public function coupon_code(Request $request , $refkey){
        $view = 'code.list';
        $user = $this->login_check();
        if($request->has('query')){
            $couponcode = CouponCode::where('title' , 'LIKE' , '%' . $request->input('query') . '%')->orderBy('id','DESC')->paginate(10);
        }
        else{
            $couponcode = CouponCode::orderBy('id','DESC')->paginate(10);
        }
        return view($view,compact('user','couponcode'));
    }

    public function add_coupon_code(){
        $view = 'code.add';
        $user = $this->login_check();
        $category = Category::where('status' , 1)->get();
        $product = Product::where('status' , 1)->get();
        $alluser = User::where('status' , 1)->get();
        return view($view,compact('user' , 'alluser' , 'product' , 'category'));
    }

    public function add_coupon_code_submit(Request $request){
        // return $request;
        $this->validate($request, [
            'title' => 'required',
            'code' => 'required',
            'discount' => 'required',
            'expiry_date' => 'required',
            'type' => 'required',
            'status' => 'required',
            'coupon_type' => 'required',
        ], [
            'title.required' => 'Please enter coupon title',
            'code.required' => 'Please enter coupon code',
            'discount.required' => 'Please enter discount',
            'expiry_date.required' => 'Please enter expiry date',
            'type.required' => 'Please select type',
            'status.required' => 'Please select status',
            'coupon_type.required' => 'Please select coupon type',
        ]);
        try{
            $loggedinuser = $this->login_check();
            $couponcode = new CouponCode();
            $couponcode->title =  $request->title;
            $couponcode->code =  $request->code;
            $couponcode->discount =  $request->discount;
            $couponcode->expiry_date =  $request->expiry_date;
            $couponcode->type =  $request->type;
            $couponcode->status =  $request->status;
            $couponcode->coupon_type =  $request->coupon_type;
            $couponcode->save();

            if($request->coupon_type == 2){
                // Category
                foreach($request->cat_ids as $catid){
                    $category = new CouponCodeToCategory();
                    $category->cat_id = $catid;
                    $category->coupon_id = $couponcode->id;
                    $category->save(); 
                }
            }

            else if($request->coupon_type == 3){
                // Product
                foreach($request->pro_ids as $proid){
                    $product = new CouponCodeToCategory();
                    $product->product_id = $proid;
                    $product->coupon_id = $couponcode->id;
                    $product->save(); 
                }
            }

            else if($request->coupon_type == 4){
                // User
                foreach($request->user_ids as $userids){
                    $user = new CouponCodeToUser();
                    $user->user_id = $userids;
                    $user->coupon_id = $couponcode->id;
                    $user->save(); 
                }
            }
            
            else if($request->coupon_type == 5){
                // Category + User
                foreach($request->cat_ids as $catid){
                    $category = new CouponCodeToCategory();
                    $category->cat_id = $catid;
                    $category->coupon_id = $couponcode->id;
                    $category->save(); 
                }
                foreach($request->user_ids as $userids){
                    $user = new CouponCodeToUser();
                    $user->user_id = $userids;
                    $user->coupon_id = $couponcode->id;
                    $user->save(); 
                }
            }

            else if($request->coupon_type == 6){
                // Product + User
                foreach($request->pro_ids as $proid){
                    $product = new CouponCodeToProduct();
                    $product->product_id = $proid;
                    $product->coupon_id = $couponcode->id;
                    $product->save(); 
                }
                foreach($request->user_ids as $userids){
                    $user = new CouponCodeToUser();
                    $user->user_id = $userids;
                    $user->coupon_id = $couponcode->id;
                    $user->save(); 
                }
            }


            return redirect()->route('coupon_code' , ['refkey' => $loggedinuser->ref_key])->with('success' , 'Coupon Code added successfully!');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error' , $e->getMessage());
            // dd($e->getMessage());
        }
    }

    public function edit_coupon_code($id){
        $view = 'code.edit';
        $user = $this->login_check();
        $category = Category::where('status' , 1)->get();
        $product = Product::where('status' , 1)->get();
        $alluser = User::where('status' , 1)->get();
        $couponcode = CouponCode::find($id);
        return view($view,compact('user' , 'alluser' , 'product' , 'category' , 'couponcode'));
    }

    public function edit_coupon_code_submit(Request $request , $id){
        $this->validate($request, [
            'title' => 'required',
            'code' => 'required',
            'discount' => 'required',
            'expiry_date' => 'required',
            'type' => 'required',
            'status' => 'required',
            'coupon_type' => 'required',
        ], [
            'title.required' => 'Please enter coupon title',
            'code.required' => 'Please enter coupon code',
            'discount.required' => 'Please enter discount',
            'expiry_date.required' => 'Please enter expiry date',
            'type.required' => 'Please select type',
            'status.required' => 'Please select status',
            'coupon_type.required' => 'Please select coupon type',
        ]);
        try{
            $loggedinuser = $this->login_check();
            $couponcode = CouponCode::find($id);
            $couponcode->title =  $request->title;
            $couponcode->code =  $request->code;
            $couponcode->discount =  $request->discount;
            $couponcode->expiry_date =  $request->expiry_date;
            $couponcode->type =  $request->type;
            $couponcode->status =  $request->status;
            $couponcode->coupon_type =  $request->coupon_type;
            $couponcode->save();

            if($request->coupon_type == 2){
                CouponCodeToCategory::where('coupon_id', $id)->delete();
                foreach($request->cat_ids as $catid){
                    $category = new CouponCodeToCategory();
                    $category->cat_id = $catid;
                    $category->coupon_id = $couponcode->id;
                    $category->save(); 
                }
            }

            else if($request->coupon_type == 3){
                CouponCodeToProduct::where('coupon_id', $id)->delete();
                foreach($request->pro_ids as $proid){
                    $product = new CouponCodeToProduct();
                    $product->product_id = $proid;
                    $product->coupon_id = $couponcode->id;
                    $product->save(); 
                }
            }

            else if($request->coupon_type == 4){
                CouponCodeToUser::where('coupon_id', $id)->delete();
                foreach($request->user_ids as $userid){
                    $user = new CouponCodeToUser();
                    $user->user_id = $userid;
                    $user->coupon_id = $couponcode->id;
                    $user->save(); 
                }
            }

            else if($request->coupon_type == 5){
                CouponCodeToCategory::where('coupon_id', $id)->delete();
                CouponCodeToUser::where('coupon_id', $id)->delete();
                foreach($request->cat_ids as $catid){
                    $category = new CouponCodeToCategory();
                    $category->cat_id = $catid;
                    $category->coupon_id = $couponcode->id;
                    $category->save();
                }
                foreach($request->user_ids as $userids){
                    $user = new CouponCodeToUser();
                    $user->user_id = $userids;
                    $user->coupon_id = $couponcode->id;
                    $user->save();
                }
            }

            else if($request->coupon_type == 6){
                CouponCodeToProduct::where('coupon_id', $id)->delete();
                CouponCodeToUser::where('coupon_id', $id)->delete();
                foreach($request->pro_ids as $proid){
                    $product = new CouponCodeToProduct();
                    $product->product_id = $proid;
                    $product->coupon_id = $couponcode->id;
                    $product->save(); 
                }
                foreach($request->user_ids as $userids){
                    $user = new CouponCodeToUser();
                    $user->user_id = $userids;
                    $user->coupon_id = $couponcode->id;
                    $user->save(); 
                }
            }
            
            // return $loggedinuser->ref_key;
            return redirect()->route('coupon_code' , ['refkey' => $loggedinuser->ref_key])->with('success' , 'Coupon Code updated successfully!');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error' , $e->getMessage());
        }
    }

    public function delete_coupon_code($id){
        $couponcode = CouponCode::find($id);
        if ($couponcode) {
            $couponcode->delete();
    
            CouponCodeToCategory::where('coupon_id', $id)->delete();
            CouponCodeToProduct::where('coupon_id', $id)->delete();
            CouponCodeToUser::where('coupon_id', $id)->delete();
        }
    
        return response()->json([
            "status" => 'success'
        ]);
    }
    
    public function status_coupon_code($id){
        $couponcode = CouponCode::find($id);
        if($couponcode->status == 1){
            $couponcode->status = 0;
        }
        else if($couponcode->status == 0){
            $couponcode->status = 1;
        }
        $couponcode->save();
        return response()->json([
            "status" => "success"
        ]);
    }

    public function details_coupon_code($id){
        $data = [];
        $couponcode = CouponCode::find($id);
        if(isset($couponcode)){
            if($couponcode->type == 1){
                $type = "Flat";
            }
            else if($couponcode->type == 2){
                $type = "Percentage";
            }
            $data = [
                "title" => ucwords($couponcode->title),
                'code' => $couponcode->code,
                'status' => $couponcode->status,
                'type' => $type,
                'discount' => $couponcode->discount,
                'expirydate' => date('d-m-Y' , strtotime($couponcode->expiry_date)),
                'coupon_type' => $couponcode->coupon_type,
                'category' => [],
                'products' => [],
                'users' => [],
                'cat_users' => [],
                'pro_users' => [],
            ];
    
            if($couponcode->coupon_type == 2){
                foreach($couponcode->category_detail as $cat){
                    $data['category'][] = [
                        "catid" => $cat->cat_id,
                        "cattitle" => $cat->category ?  $cat->category->title : ""
                    ];
                }
            }
    
            else if($couponcode->coupon_type == 3){
                foreach($couponcode->product_detail as $pro){
                    $data['products'][] = [
                        "proid" => $pro->product_id,
                        "protitle" => $pro->product ?  $pro->product->title : ""
                    ];
                }
            }
    
            else if($couponcode->coupon_type == 4){
                foreach($couponcode->user as $u){
                    $data['users'][] = [
                        "userid" => $u->user_id,
                        "username" => $u->user ?  $u->user->name : ""
                    ];
                }
            }

            else if($couponcode->coupon_type == 5){
                foreach($couponcode->user as $u){
                    $data['cat_users'][] = [
                        "userid" => $u->user_id,
                        "username" => $u->user ?  $u->user->name : ""
                    ];
                }
                foreach($couponcode->category_detail as $cat){
                    $data['cat_users'][] = [
                        "catid" => $cat->cat_id,
                        "cattitle" => $cat->category ?  $cat->category->title : ""
                    ];
                }
            }
            else if($couponcode->coupon_type == 6){
                foreach($couponcode->user as $u){
                    $data['pro_users'][] = [
                        "userid" => $u->user_id,
                        "username" => $u->user ?  $u->user->name : ""
                    ];
                }
                foreach($couponcode->product_detail as $pro){
                    $data['pro_users'][] = [
                        "proid" => $pro->product_id,
                        "protitle" => $pro->product ?  $pro->product->title : ""
                    ];
                }
            }
            return response()->json([
                "status" => "success",
                "message" => $data
            ]);
        }
        else{
            return response()->json([
                "status" => "error",
                "response" => "Sorry! Coupon Code couldn't be found!"
            ]);
        }
    }

    public function category_import(Request $request){
        try{
            $user = $this->login_check();
            Excel::import(new ImportCategory,$request->file('file')->store('files'));
            return redirect()->route('category' , $user->ref_key)->with('success' , 'Categories added successfully using CSV');
            
        }
        catch(\Exception $e){
            return redirect()->back()->with('error' , $e->getMessage());
        }
    }

    public function product_import(Request $request){
        try{
            $user = $this->login_check();
            ini_set('max_execution_time', 200); // 120 seconds = 60 seconds = 1 minutes
            // ini_set('memory_limit', '256M');
            Excel::import(new ImportProduct,$request->file('file')->store('files'));
            return redirect()->route('product' , $user->ref_key)->with('success' , 'Products added successfully using CSV');
            
        }
        catch(\Exception $e){
            dd($e->getMessage());
            return redirect()->back()->with('error' , $e->getMessage());
        }
    }

    public function product_image()
    {
        $user = $this->login_check();
        $product = Product::whereNull('product_image')->orderBy('id')->take(20)->get();
        if(isset($product)){
            foreach ($product as $p) {
                $url = $p->image;
                
                if (!empty($url)) {
                    $image = Http::get($url);
        
                    if ($image->successful()) {
                        $extension = pathinfo($url, PATHINFO_EXTENSION);
                        $random = Str::random(50);
                        $Propath = 'images/product/' . $random . '.' . $extension;
                        $publicPath = public_path($Propath);
                        file_put_contents($publicPath, $image->body());
                        $p->product_image = $Propath;
                        $p->save();
                    }
                }
                echo "Image saved for" . $p->title . "images/product/" . $random . '.' . $extension . "<br>";
                echo "<script>
                    setTimeout(function(){
                        location.reload();
                    },5000);
                </script>";
            }
        }
        else{
            echo "All Images Saved";
        }
    }

    public function datasheet_pdf()
    {
        $user = $this->login_check();
        $product = Product::whereNull('product_datasheet')->orderBy('id')->take(10)->get();

        if(isset($product)){
            foreach ($product as $p) {
                $html_url = $p->datasheet_url;

                if (!empty($html_url)) {
                    $pdf_url = str_replace('.html', '.pdf', $html_url);

                    $pdf = Http::get($pdf_url);

                    if ($pdf->successful()) {
                        $random = Str::random(50);
                        $publicPath = public_path('pdf/product/' . $random . '.pdf');

                        file_put_contents($publicPath, $pdf->body());

                        $p->product_datasheet = 'pdf/product/' . $random . '.pdf';
                        $p->save();

                        echo "PDF saved for " . $p->title . " on path pdf/product/" . $random . '.pdf' . "<br>";
                        echo "<script>
                            setTimeout(function(){
                                location.reload();
                            },5000);
                        </script>";
                    }
                }
            }
        } else {
            echo "All PDFs Saved";
        }
    }

    public function scollmore_import(Request $request){
        try{
            $user = $this->login_check();
            ini_set('max_execution_time', 200);
            // ini_set('memory_limit', '256M');
            Excel::import(new ImportScollmore,$request->file('file')->store('files'));
            return redirect()->route('product' , $user->ref_key)->with('success' , 'Products added successfully using CSV');
            
        }
        catch(\Exception $e){
            dd($e->getMessage());
            return redirect()->back()->with('error' , $e->getMessage());
        }
    }

    public function saxbe_import(Request $request){
        try{
            $user = $this->login_check();
            ini_set('max_execution_time', 600);
            // ini_set('memory_limit', '256M');
            Excel::import(new ImportSaxbe,$request->file('file')->store('files'));
            return redirect()->route('product' , $user->ref_key)->with('success' , 'Products added successfully using CSV');
            
        }
        catch(\Exception $e){
            dd($e->getMessage());
            return redirect()->back()->with('error' , $e->getMessage());
        }
    }

    public function mla_import(Request $request){
        try{
            $user = $this->login_check();
            ini_set('max_execution_time', 800);
            Excel::import(new ImportMla,$request->file('file')->store('files'));
            return redirect()->route('product' , $user->ref_key)->with('success' , 'Products added successfully using CSV');
            
        }
        catch(\Exception $e){
            dd($e->getMessage());
            return redirect()->back()->with('error' , $e->getMessage());
        }
    }

    public function lw_import(Request $request){
        try{
            $user = $this->login_check();
            ini_set('max_execution_time', 800);
            // ini_set('memory_limit', '256M');
            Excel::import(new ImportLW,$request->file('file')->store('files'));
            return redirect()->route('product' , $user->ref_key)->with('success' , 'Products added successfully using CSV');
            
        }
        catch(\Exception $e){
            dd($e->getMessage());
            return redirect()->back()->with('error' , $e->getMessage());
        }
    }

    public function newsletter(Request $request , $refkey){
        $view = 'newsletter';
        $user = $this->login_check();
        $newsletter = Newsletter::orderBy('id','DESC')->paginate(10);
        return view($view,compact('user' , 'newsletter'));
    }

    public function delete_newsletter(Request $request){
        if(isset($request->id)){
            Newsletter::find($request->id)->delete();
            return response()->json([
                "status" => "success"
            ]);
        }
    }

    public function wishlist(Request $request , $refkey){
        $view = 'wishlist';
        $user = $this->login_check();
        $wishlist = Wishlist::orderBy('id','DESC')->paginate(10);
        return view($view,compact('user' , 'wishlist'));
    }

    public function delete_wishlist(Request $request){
        if(isset($request->id)){
            Wishlist::find($request->id)->delete();
            return response()->json([
                "status" => "success"
            ]);
        }
    }

    public function banner(Request $request , $refkey){
        $view = 'banner';
        $user = $this->login_check();
        if($request->has('query')){
            $banner = Banner::where('title' , 'LIKE' , '%' . $request->input('query') . '%')->orderBy('id','DESC')->paginate(10);
        }
        else{
            $banner = Banner::orderBy('id','DESC')->paginate(10);

        }
        return view($view,compact('user' , 'banner'));
    }

    public function banner_submit(Request $request){
        try{
            $banner = new Banner();
            $banner->title = $request->title;
            $banner->status = $request->status;
            $banner->link = $request->link;
            $banner->type = $request->type;
            $random = Str::random(50);
            if($request->type == 0){
                $banner->start_date = $request->startdate;
                $banner->end_date = $request->enddate;
            }
            if($request->hasFile('image')){
                $imagename = $random . '.' . $request->image->extension();
                $banner->image = $request->image->move('images/banner/', $imagename);
            }

            $banner->save();
            return response()->json([
                "status" => "success",
                "message" => "Banner Added Successfully"
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while adding the banner",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function banner_update(Request $request){
        try{
            $banner = Banner::find($request->id);
            $banner->title = $request->title;
            $banner->status = $request->status;
            $banner->link = $request->link;
            $banner->type = $request->type;
            $random = Str::random(50);
            if($request->type == 0){
                $banner->start_date = $request->startdate;
                $banner->end_date = $request->enddate;
            }
            if($request->hasFile('image')){
                $imagename = $random . '.' . $request->image->extension();
                $banner->image = $request->image->move('images/banner/', $imagename);
            }

            $banner->save();
            return response()->json([
                "status" => "success",
                "message" => "Banner updated Successfully"
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while updating the banner",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function banner_status(Request $request){
        try{
            $banner = Banner::find($request->id);
            if($banner->status == 1){
                $banner->status = 0;
                $banner->save();
            }
            else if($banner->status == 0){
                $banner->status = 1;
                $banner->save();
            }
            return response()->json([
                "status" => "success"
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while updating the banner status",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function banner_delete(Request $request){
        try {
            $banner = Banner::find($request->id);
            $banner->delete();
            return response()->json([
                "status" => "success"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while deleting the banner",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function contactustopic(Request $request){
        $view = 'contactus.topic';
        $user = $this->login_check();
        if($request->has('query')){
            $contactustopic = ContactusTopic::where('title' , 'LIKE' , '%' . $request->input('query') . '%')->orderBy('id','DESC')->paginate(10);
        }
        else{
            $contactustopic = ContactusTopic::orderBy('id','DESC')->paginate(10);

        }
        return view($view,compact('user' , 'contactustopic'));
    }

    public function contactustopic_submit(Request $request){
        try{
            $topics = new ContactusTopic();
            $topics->title = $request->title;
            $topics->status = $request->status;
            $topics->save();
            return response()->json([
                "status" => "success",
                "message" => "Topic Added Successfully"
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while adding the topic",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function contactustopic_update(Request $request){
        try{
            $topics = ContactusTopic::find($request->id);
            $topics->title = $request->title;
            $topics->status = $request->status;
            $topics->save();
            return response()->json([
                "status" => "success",
                "message" => "Topic updated Successfully"
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while updating the topic",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function contactustopic_delete(Request $request){
        try {
            $topic = ContactusTopic::find($request->id);
            $topic->delete();
            return response()->json([
                "status" => "success"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while deleting the topic",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function contactustopic_status(Request $request){
        try{
            $topic = ContactusTopic::find($request->id);
            if($topic->status == 1){
                $topic->status = 0;
                $topic->save();
            }
            else if($topic->status == 0){
                $topic->status = 1;
                $topic->save();
            }
            return response()->json([
                "status" => "success"
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while updating the topic status",
                "error" => $e->getMessage()
            ]);
        }
    }


    public function contactusstatus(Request $request){
        $view = 'contactus.status';
        $user = $this->login_check();
        if($request->has('query')){
            $contactusstatus = ContactUsStatus::where('title' , 'LIKE' , '%' . $request->input('query') . '%')->orderBy('id','DESC')->paginate(10);
        }
        else{
            $contactusstatus = ContactUsStatus::orderBy('id','DESC')->paginate(10);

        }
        return view($view,compact('user' , 'contactusstatus'));
    }

    public function contactusstatus_submit(Request $request){
        try{
            $topics = new ContactUsStatus();
            $topics->title = $request->title;
            $topics->status = $request->status;
            $topics->save();
            return response()->json([
                "status" => "success",
                "message" => "Status Added Successfully"
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while adding the status",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function contactusstatus_update(Request $request){
        try{
            $topics = ContactUsStatus::find($request->id);
            $topics->title = $request->title;
            $topics->status = $request->status;
            $topics->save();
            return response()->json([
                "status" => "success",
                "message" => "Status updated Successfully"
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while updating the status",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function contactusstatus_delete(Request $request){
        try {
            $topic = ContactUsStatus::find($request->id);
            $topic->delete();
            return response()->json([
                "status" => "success"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while deleting the status",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function contactusstatus_status(Request $request){
        try{
            $topic = ContactUsStatus::find($request->id);
            if($topic->status == 1){
                $topic->status = 0;
                $topic->save();
            }
            else if($topic->status == 0){
                $topic->status = 1;
                $topic->save();
            }
            return response()->json([
                "status" => "success"
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while updating the status",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function contactus(Request $request , $refkey){
        $view = 'contactus.list';
        $user = $this->login_check();
        if($request->has('query')){
            $contactus = ContactU::where('name' , 'LIKE' , '%' . $request->input('query') . '%')->orderBy('id','DESC')->paginate(10);
        }
        else{
            $contactus = ContactU::orderBy('id','DESC')->paginate(10);
        }
        $contactstatus = ContactUsStatus::where('status' , 1)->get();
        return view($view,compact('user' , 'contactus' , 'contactstatus'));
    }

    public function contactus_update(Request $request){
        try{
            $contact = ContactU::find($request->id);
            $contact->status = $request->status;
            $contact->save();
            return response()->json([
                "status" => "success",
                "message" => "Contact Request status updated"
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while updating the status",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function contact_us_view($id){
        $contact = ContactU::find($id);
        if(isset($contact->id)){
            return response()->json([
                "status" => "success",
                "data" => $contact
            ]);
        }
        else{
            return response()->json([
                "status" => "error",
                "message" => "Sorry! we couldn't process your request"
            ]);
        }
    }

    public function contact_us_delete(Request $request){
        if(isset($request->id)){
            ContactU::find($request->id)->delete();
            return response()->json([
                'status' => "success"
            ]);
        }
    }

    public function faq(Request $request , $refkey){
        $view = 'faq.list';
        $user = $this->login_check();
        if($request->has('query')){
            $faq = Faq::where('question' , 'LIKE' , '%' . $request->input('query') . '%')->orderBy('id','DESC')->paginate(10);
        }
        else{
            $faq = Faq::orderBy('id','DESC')->paginate(10);
        }
        return view($view,compact('user' , 'faq'));
    }

    public function faq_add(){
        $view = 'faq.add';
        $user = $this->login_check();
        $category = Category::where('status' , 1)->get();
        $product = Product::where('status' , 1)->get();
        return view($view,compact('user' , 'product' , 'category'));
    }

    public function faq_add_submit(Request $request){
        $this->validate($request, [
            'question' => 'required',
            'answer' => 'required',
            'type' => 'required',
        ], [
            'question.required' => 'Please enter question',
            'answer.required' => 'Please enter answer',
            'type.required' => 'Please select type',
        ]);

        try{
            $user = $this->login_check();
            $faq = new Faq();
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->status = $request->status;
            $faq->type = $request->type;
            $faq->save();
            if($request->type == 2){
                foreach($request->cat_ids as $catid){
                    $faqcategory = new FaqsToCategory();
                    $faqcategory->faq_id = $faq->id;
                    $faqcategory->category_id = $catid;
                    $faqcategory->save();
                }
            }
            else if($request->type == 3){
                foreach($request->pro_ids as $proid){
                    $faqproduct = new FaqsToProduct();
                    $faqproduct->faq_id = $faq->id;
                    $faqproduct->product_id = $proid;
                    $faqproduct->save();
                }
            }
            return redirect()->route('faq' , $user->ref_key)->with('success' , 'Faq added successfully');
        }

        catch(\Exception $e){
            return redirect()->back()->with('error' , $e->getMessage());
        }
    }

    public function faq_edit($id){
        $view = 'faq.edit';
        $user = $this->login_check();
        $category = Category::where('status' , 1)->get();
        $product = Product::where('status' , 1)->get();
        $faq = Faq::find($id);
        return view($view,compact('user' , 'product' , 'category' , 'faq'));
    }

    public function faq_edit_submit(Request $request , $id){
        $this->validate($request, [
            'question' => 'required',
            'answer' => 'required',
            'type' => 'required',
        ], [
            'question.required' => 'Please enter question',
            'answer.required' => 'Please enter answer',
            'type.required' => 'Please select type',
        ]);

        try{
            $user = $this->login_check();
            $faq = Faq::find($id);
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->status = $request->status;
            $faq->type = $request->type;
            $faq->save();
            if($request->type == 2){
                FaqsToCategory::where('faq_id', $id)->delete();
                foreach($request->cat_ids as $catid){
                    $faqcategory = new FaqsToCategory();
                    $faqcategory->faq_id = $faq->id;
                    $faqcategory->category_id = $catid;
                    $faqcategory->save();
                }
            }
            else if($request->type == 3){
                FaqsToProduct::where('faq_id', $id)->delete();
                foreach($request->pro_ids as $proid){
                    $faqproduct = new FaqsToProduct();
                    $faqproduct->faq_id = $faq->id;
                    $faqproduct->product_id = $proid;
                    $faqproduct->save();
                }
            }
            return redirect()->route('faq' , $user->ref_key)->with('success' , 'Faq updated successfully');
        }

        catch(\Exception $e){
            return redirect()->back()->with('error' , $e->getMessage());
        }
    }

    public function faq_delete(Request $request){
        if(isset($request->id)){
            Faq::find($request->id)->delete();
            return response()->json([
                "status" => "success"
            ]);
        }
    }

    public function faq_view($id){
        $result = Faq::find($id);
        if(isset($result->id)){
            $faq = [];
            $faq = [
                "id" => $result->id,
                "question" => $result->question,
                "answer" => $result->answer,
                "type" => $result->type,
                "catids" => [], 
                "proids" => [], 
            ];
    
            if($result->type == 2){
                foreach($result->category as $cat){
                    $faq['catids'][] = [
                        "cattitle" => $cat->category ? $cat->category->title : ""   
                    ];
                }
            }
            else if($result->type == 3){
                foreach($result->product as $pro){
                    $faq['proids'][] = [
                        "protitle" => $pro->product ? $pro->product->title : ""   
                    ];
                }
            }

            return response()->json([
                "status" => "success",
                "data" => $faq
            ]);
        }
        else{
            return response()->json([
                "status" => "error",
                "data" => "Sorry! No Faq's found"
            ]);
        }
    }

    public function order_statuses(Request $request){
        $view = 'orders.status';
        $user = $this->login_check();
        if($request->has('query')){
            $orderstatus = OrderStatus::where('title' , 'LIKE' , '%' . $request->input('query') . '%')->orderBy('id','DESC')->paginate(10);
        }
        else{
            $orderstatus = OrderStatus::orderBy('id','DESC')->paginate(10);
        }
        return view($view,compact('user' , 'orderstatus'));
    }

    public function order_statuses_submit(Request $request){
        try{
            $topics = new OrderStatus();
            $topics->title = $request->title;
            $topics->status = $request->status;
            $topics->save();
            return response()->json([
                "status" => "success",
                "message" => "Status Added Successfully"
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while adding the status",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function order_statuses_update(Request $request){
        try{
            $topics = OrderStatus::find($request->id);
            $topics->title = $request->title;
            $topics->status = $request->status;
            $topics->save();
            return response()->json([
                "status" => "success",
                "message" => "Status updated Successfully"
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while updating the status",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function order_statuses_delete(Request $request){
        try {
            $topic = OrderStatus::find($request->id);
            $topic->delete();
            return response()->json([
                "status" => "success"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while deleting the status",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function order_statuses_status(Request $request){
        try{
            $topic = OrderStatus::find($request->id);
            if($topic->status == 1){
                $topic->status = 0;
                $topic->save();
            }
            else if($topic->status == 0){
                $topic->status = 1;
                $topic->save();
            }
            return response()->json([
                "status" => "success"
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while updating the status",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function content_page(Request $request , $refkey){
        $view = 'pages.list';
        $user = $this->login_check();
        if($request->has('query')){
            $contentpage = ContentPage::where('title' , 'LIKE' , '%' . $request->input('query') . '%')->orderBy('id','DESC')->paginate(10);
        }
        else{
            $contentpage = ContentPage::orderBy('id','DESC')->paginate(10);
        }
        return view($view,compact('user' , 'contentpage'));
    }

    public function add_content_page(){
        $view = 'pages.add';
        $user = $this->login_check();
        return view($view,compact('user'));
    }

    public function add_content_page_submit(Request $request){
        // return $request;
        $this->validate($request, [
            'title' => 'required',
        ], [
            'title.required' => 'Please enter title',
        ]);

        try{
            $contentpage = new ContentPage();
            $contentpage->title = $request->title;
            $contentpage->status = $request->status;
            $contentpage->sort_order = $request->sort_order;
            $contentpage->location = $request->location;
            $contentpage->section = $request->section;
            $contentpage->custom_link = $request->custom_link;
            $contentpage->text = $request->description;
            $contentpage->save();
            $user = $this->login_check();
            return redirect()->route('content_page' , $user->ref_key)->with('success' , 'Content page added successfully!');

        }

        catch(\Exception $e){
            return redirect()->back()->with('error' , $e->getMessage());
        }
    }

    public function edit_content_page($id){
        $view = 'pages.edit';
        $user = $this->login_check();
        $contentpage = ContentPage::find($id);
        return view($view,compact('user' , 'contentpage'));
    }

    public function edit_content_page_submit(Request $request , $id){
        $this->validate($request, [
            'title' => 'required',
        ], [
            'title.required' => 'Please enter title',
        ]);

        try{
            $contentpage = ContentPage::find($id);
            $contentpage->title = $request->title;
            $contentpage->slug = $request->slug;
            $contentpage->status = $request->status;
            $contentpage->sort_order = $request->sort_order;
            $contentpage->location = $request->location;
            $contentpage->section = $request->section;
            $contentpage->custom_link = $request->custom_link;
            $contentpage->text = $request->description;
            $contentpage->save();
            $user = $this->login_check();

            return redirect()->route('content_page' , $user->ref_key)->with('success' , 'Content page updated successfully!');

        }

        catch(\Exception $e){
            return redirect()->back()->with('error' , $e->getMessage());
        }
    }

    public function edit_contentpage_status(Request $request){
        if(isset($request->id)){
            $contentpage = ContentPage::find($request->id);

            if($contentpage->status == 1){
                $contentpage->status = 0;
            }
            else if($contentpage->status == 0){
                $contentpage->status = 1;
            }

            $contentpage->save();
            return response()->json([
                "status" => "success"
            ]);
        }
    }

    public function contentpages_delete_submit(Request $request){
        if(isset($request->id)){
            ContentPage::find($request->id)->delete();
            return response()->json([
                "status" => "success"
            ]);
        }
    }

    public function contentpages_view(Request $request){
        if(isset($request->id)){
            $contentpage = ContentPage::find($request->id);
            return response()->json([
                "status" => "success",
                "data" => $contentpage
            ]);
        }
    }

    public function ticker(Request $request , $refkey){
        $view = 'ticker';
        $user = $this->login_check();
        if($request->has('query')){
            $ticker = Ticker::where('title' , 'LIKE' , '%' . $request->input('query') . '%')->orderBy('id','DESC')->get();
        }
        else{
            $ticker = Ticker::orderBy('id','DESC')->get();
        }
        if ($request->expectsJson()) {
            return response()->json(['user' => $user, 'ticker' => $ticker]);
        }   
        return view($view,compact('user' , 'ticker'));
    }

    public function ticker_submit(Request $request){
        try{
            $ticker = new Ticker();
            $ticker->title = $request->title;
            $ticker->icon = $request->icons;
            $ticker->status = $request->status;
            $ticker->save();
            $newticker = Ticker::find($ticker->id);
            return response()->json([
                "status" => "success",
                "message" => "Ticker Added Successfully",
                "data" => $newticker
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while adding the ticker",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function ticker_update(Request $request){
        try{
            $ticker = Ticker::find($request->id);
            $ticker->title = $request->title;
            $ticker->icon = $request->icons;
            $ticker->status = $request->status;
            $ticker->save();
            $newticker = Ticker::find($request->id);
            return response()->json([
                "status" => "success",
                "message" => "Ticker updated Successfully",
                "data" => $newticker
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while updating the ticker",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function ticker_delete(Request $request){
        try {
            $ticker = Ticker::find($request->id);
            $ticker->delete();
            return response()->json([
                "status" => "success"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while deleting the ticker",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function ticker_status(Request $request){
        try{
            $ticker = Ticker::find($request->id);
            if($ticker->status == 1){
                $ticker->status = 0;
                $ticker->save();
            }
            else if($ticker->status == 0){
                $ticker->status = 1;
                $ticker->save();
            }
            return response()->json([
                "status" => "success",
                "data" => $ticker
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while updating the ticker status",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function ticker_edit($id){
        try{
            if(isset($id)){
                $ticker = Ticker::find($id);
                return response()->json([
                    "status" => "success",
                    "data" => $ticker
                ]);
            }
        }
        catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while fetching the ticker",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function vendor(Request $request , $refkey){
        $view = 'vendors';
        $user = $this->login_check();
        if($request->has('query')){
            $vendor = Vendor::where('vendor_name' , 'LIKE' , '%' . $request->input('query') . '%')->orderBy('id','DESC')->get();
        }
        else{
            $vendor = Vendor::orderBy('id','DESC')->get();
        }
        if ($request->expectsJson()) {
            return response()->json(['user' => $user, 'vendor' => $vendor]);
        }   
        return view($view,compact('user' , 'vendor'));
    }

    public function vendor_submit(Request $request){
        try{
            $vendor = new Vendor();
            $vendor->vendor_name = $request->vendorname;
            $vendor->address = $request->address;
            $vendor->email = $request->email;
            $vendor->phone = $request->phone;
            $vendor->website = $request->website;
            $vendor->percentage = $request->percentage;
            $vendor->contact_person_name = $request->conatctname;
            $vendor->contact_person_email = $request->conatctphone;
            $vendor->contact_person_phone = $request->conatctemail;
            $vendor->status = $request->status;
            $vendor->business_nature = 'Whole saler';
            $vendor->save();
            $newvendor = Vendor::find($vendor->id);
            return response()->json([
                "status" => "success",
                "message" => "Vendor Added Successfully",
                "data" => $newvendor
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while adding the vendor",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function vendor_update(Request $request){
        try{
            $vendor = Vendor::find($request->id);
            if(isset($vendor)){
                $vendor->vendor_name = $request->vendorname;
                $vendor->address = $request->address;
                $vendor->email = $request->email;
                $vendor->phone = $request->phone;
                $vendor->website = $request->website;
                $vendor->percentage = $request->percentage;
                $vendor->contact_person_name = $request->conatctname;
                $vendor->contact_person_email = $request->conatctphone;
                $vendor->contact_person_phone = $request->conatctemail;
                $vendor->status = $request->status;
                $vendor->save();
                $newvendor = Vendor::find($request->id);
                // find products with this vendor
                ini_set('max_execution_time', 300); // 300 seconds = 5 minutes
                $vendorProducts = Product::where('vendor_id', $request->id)
                                        ->whereNull('percentage')
                                        ->orWhere('percentage', '')
                                        ->get();

                foreach($vendorProducts as $product ){
                    $vendorPrice = floatval($product->vendor_price);

                    $percent = $vendorPrice * ($request->percentage / 100);
                    // $price = $product->price + $percent;
                    $price = number_format($vendorPrice + $percent, 2);

                    // Only update if the new price is different
                    if ($product->price != $price) {
                        $product->price = $price;
                        $product->save();
                    }
                }

                return response()->json([
                    "status" => "success",
                    "message" => "Vendor updated Successfully",
                    "data" => $newvendor
                ]);
            }
        }
        catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while updating the Vendor",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function vendor_status(Request $request){
        try{
            $vendor = Vendor::find($request->id);
            if($vendor->status == 1){
                $vendor->status = 0;
                $vendor->save();
            }
            else if($vendor->status == 0){
                $vendor->status = 1;
                $vendor->save();
            }
            return response()->json([
                "status" => "success",
                "data" => $vendor
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while updating the vendor status",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function vendor_edit($id){
        try{
            if(isset($id)){
                $vendor = Vendor::find($id);
                return response()->json([
                    "status" => "success",
                    "data" => $vendor
                ]);
            }
        }
        catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while fetching the vendor",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function order(Request $request){
        $view = 'order';
        $user = $this->login_check();
        $data = [];
        
        $orders = $request->has('query')? Order::where('title', 'LIKE', '%' . $request->input('query') . '%')->orderBy('id', 'DESC')->get(): Order::orderBy('id', 'DESC')->get();
    
        $orderstatus = OrderStatus::where('status', 1)->get();
    
        $ordersByStatus = [];
        foreach ($orderstatus as $status) {
            $ordersByStatus[$status->title] = $orders->where('status', $status->id);
        }
        return view($view, compact('user', 'ordersByStatus', 'orderstatus'));
    }
    

    public function order_status_update(Request $request){
        try{
            $order = Order::find($request->id);
            $order->status = $request->status;
            if(isset($request->reason)){
                $order->reason = $request->reason;
            }
            $order->save();
            return response()->json([
                "status" => "success",
                "message" => "Order updated Successfully",
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while fetching the ticker",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function order_delete(Request $request){
        try {
            $order = Order::find($request->id);
            foreach($order->order_products as $op){
                $op->delete();
            }
            $order->delete();
            return response()->json([
                "status" => "success"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while deleting the order",
                "error" => $e->getMessage()
            ]);
        }
    }
    
    public function customer_order_view(Request $request){
        try{
            $order = Order::find($request->id);
            $data = [];
            $data = [
                "custname" => $order->name,
                "custphone" => $order->contact_no,
                "custaddress" => $order->address,
                "custpostalcode" => $order->postal_code,
                "shippingtotal" => $order->shipping_total,
                "ordertotal" => $order->order_total,
                "transactionid" => $order->payment_transaction_id,
                "trackingid" => $order->shipping_tracking_id,
                "orderid" => $order->id,
                "orderno" => $order->order_no,
                "status" => $order->status_detail ? $order->status_detail->title : "", 
                "paymentstatus" => $order->payment_transaction_id ? "Paid" : "Not Paid", 
                "products" => [],
            ];
            foreach($order->order_products as $op){
                $data["products"][] = [
                    "proid" => $op->product_id,
                    "proname" => $op->product_detail ? $op->product_detail->title : "",
                    "proprice" => $op->price,
                    "proqty" => $op->quantity,
                    "prototal" => $op->total
                ];
            }

            return response()->json([
                "status" => "success",
                "data" => $data
            ]);

        }
        catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while fetching the order",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function user_details(){
        $user = $this->login_check();
        return response()->json([
            "status" => "success",
            "data" => $user
        ]);
    }

    public function category_home_status(Request $request){
        try {
            $category = Category::find($request->id);
            if($category->home_status == 1){
                $category->home_status = 0;
                $category->save();
                return response()->json([
                    "status" => "success",
                    "message" => ucwords($category->title) . " is removed from home"
                ]);
            }
            else{
                $category->home_status = 1;
                $category->save();
                return response()->json([
                    "status" => "success",
                    "message" => ucwords($category->title) . " is displayed on home"
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while updating the category",
                "error" => $e->getMessage()
            ]);
        }
    }
    
    public function category_show_menu(Request $request){
        try {
            $category = Category::find($request->id);
            if($category->is_menu == 1){
                $category->is_menu = 0;
                $category->save();
                return response()->json([
                    "status" => "success",
                    "message" => ucwords($category->title) . " is removed from menu"
                ]);
            }
            else{
                $category->is_menu = 1;
                $category->save();
                return response()->json([
                    "status" => "success",
                    "message" => ucwords($category->title) . " is displayed on displayed"
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while updating the category",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function product_popular_status(Request $request){
        try {
            $product = Product::find($request->id);
            if($product->popular_status == 1){
                $product->popular_status = 0;
                $product->save();
                return response()->json([
                    "status" => "success",
                    "message" => ucwords($product->title) . " is removed as popular"
                ]);
            }
            else{
                $product->popular_status = 1;
                $product->save();
                return response()->json([
                    "status" => "success",
                    "message" => ucwords($product->title) . " is marked as popular"
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while updating the product",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function product_status(Request $request){
        try {
            $product = Product::find($request->id);
            if($product->status == 1){
                $product->status = 0;
                $product->save();
                return response()->json([
                    "status" => "warning",
                    "message" => ucwords($product->title) . " is deactivated"
                ]);
            }
            else{
                $product->status = 1;
                $product->save();
                return response()->json([
                    "status" => "success",
                    "message" => ucwords($product->title) . " is activated"
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while updating the product",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function product_cate_status(Request $request){
        try {
            $product = category::find($request->id);
            if($product->status == 1){
                $product->status = 0;
                $product->save();
                return response()->json([
                    "status" => "warning",
                    "message" => ucwords($product->title) . " is deactivated"
                ]);
            }
            else{
                $product->status = 1;
                $product->save();
                return response()->json([
                    "status" => "success",
                    "message" => ucwords($product->title) . " is activated"
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while updating the product",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function promotion_page(Request $request , $refkey){
        $view = 'promotion';
        $user = $this->login_check();
        if($request->has('query')){
            $promotion = Promotion::where('title' , 'LIKE' , '%' . $request->input('query') . '%')->orderBy('id','DESC')->paginate(10);
        }
        else{
            $promotion = Promotion::orderBy('id','DESC')->paginate(10);
        }
        // $allcategory = Promotion::getNestedCategories();
        return view($view,compact('user','promotion'));
    }

    public function promotion_submit(Request $request){
        // return $request;
        try{
            $promotion = new Promotion();
            $promotion->title = $request->title;
            $promotion->status = $request->status;
            $promotion->link = $request->link;
            $promotion->is_sale = $request->sale;
            $promotion->is_bestseller = $request->bestseller;
            
            $random = Str::random(50);
            if(isset($request->desktop_img)){
                $imagename = $random . '.' . $request->desktop_img->extension();
                $promotion->desktop_image = $request->desktop_img->move('images/promotion/desktop/', $imagename);
            }
            if(isset($request->mobile_img)){
                $imagename = $random . '.' . $request->mobile_img->extension();
                $promotion->mobile_image = $request->mobile_img->move('images/promotion/mobile/', $imagename);
            }
            $promotion->save();
            return response()->json([
                "status" => "success",
                "message" => "Promotion Added Successfully"
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while adding the Promotion",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function promotion_update(Request $request){
        try{
            $promotion = Promotion::find($request->id);
            $random = Str::random(50);
            $promotion->title = $request->title;
            $promotion->status = $request->status;
            $promotion->link = $request->link;
            $promotion->is_sale = $request->sale;
            $promotion->is_bestseller = $request->bestseller;
            
            if($request->hasFile('desktop_img')){
                $imagename = $random . '.' . $request->desktop_img->extension();
                $promotion->desktop_image = $request->desktop_img->move('images/promotion/desktop/', $imagename);
            }
            if($request->hasFile('mobile_img')){
                $imagename = $random . '.' . $request->mobile_img->extension();
                $promotion->mobile_image = $request->mobile_img->move('images/promotion/mobile/', $imagename);
            }
            $promotion->save();
            return response()->json([
                "status" => "success",
                "message" => "Promotion Updated Successfully"    
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while updating the promotion",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function promotion_delete(Request $request){
        try {
            $promotion = Promotion::find($request->id);
            // $promotion->status = 0;
            $promotion->delete();
            return response()->json([
                "status" => "success"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while deleting the promotion",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function promotion_sale(Request $request){
        try{
            $promotion = Promotion::find($request->id);
            if($promotion->is_sale == 1){
                $promotion->is_sale = 0;
                $promotion->save();
            }
            else if($promotion->is_sale == 0){
                $promotion->is_sale = 1;
                $promotion->save();
            }
            return response()->json([
                "status" => "success"
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while updating the promotion sale status",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function promotion_bestseller(Request $request){
        try{
            $promotion = Promotion::find($request->id);
            if($promotion->is_bestseller == 1){
                $promotion->is_bestseller = 0;
                $promotion->save();
            }
            else if($promotion->is_bestseller == 0){
                $promotion->is_bestseller = 1;
                $promotion->save();
            }
            return response()->json([
                "status" => "success"
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while updating the promotion bestseller status",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function promotion_status(Request $request){
        try{
            $promotion = Promotion::find($request->id);
            if($promotion->status == 1){
                $promotion->status = 0;
                $promotion->save();
            }
            else if($promotion->status == 0){
                $promotion->status = 1;
                $promotion->save();
            }
            return response()->json([
                "status" => "success"
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while updating the promotion bestseller status",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function update_cat_id(Request $request){
        try{
            $user = $this->login_check();
            ini_set('max_execution_time', 800);
            Excel::import(new UpdateCategoryImport,$request->file('file')->store('files'));
            return redirect()->route('product' , $user->ref_key)->with('success' , 'Category linked with products');
            
        }
        catch(\Exception $e){
            dd($e->getMessage());
            return redirect()->back()->with('error' , $e->getMessage());
        }
    }

    public function mla_accessories_specs_linked(Request $request){
        try{
            if($request->parameter == "dimensions"){
                ini_set('max_execution_time', 300);
                $products = Product::where('vendor_id', 4)->get();
                $specscat = SpecificationCategory::where('title', 'LIKE', '%' . $request->parameter . '%')->first();
                $data = ['diameter', 'height', 'projection', 'recessed_depth', 'minimum_void', 'cut_out_diameter', 'tilt'];
                foreach($products as $product){
                    foreach($data as $d){
                        $existingSpec = ProductSpecification::where('pro_id', $product->id)->where('spec_id', $specscat->id)->where('title', $d)->first();
                        if(!$existingSpec){
                            $productspecs = new ProductSpecification();
                            $productspecs->pro_id = $product->id;
                            $productspecs->spec_id = $specscat->id;
                            $productspecs->title = $d;
                            $productspecs->description = $product->getAttribute($d);
                            $productspecs->save();
        
                            $product->update([$d => null]);
                        }
                    }
                }
            }

            else if($request->parameter == "key specification"){
                ini_set('max_execution_time', 600);
                $products = Product::where('vendor_id', 4)->get();
                $specscat = SpecificationCategory::where('title', 'LIKE', '%' . $request->parameter . '%')->first();
                $data = ['construction', 'finish', 'class', 'ip_rating', 'primary_voltage'];
                foreach($products as $product){
                    foreach($data as $d){
                        $existingSpec = ProductSpecification::where('pro_id', $product->id)->where('spec_id', $specscat->id)->where('title', $d)->first();
                        if(!$existingSpec){
                            $productspecs = new ProductSpecification();
                            $productspecs->pro_id = $product->id;
                            $productspecs->spec_id = $specscat->id;
                            $productspecs->title = $d;
                            $productspecs->description = $product->getAttribute($d);
                            $productspecs->save();
        
                            $product->update([$d => null]);
                        }
                    }
                }
            }

            else if($request->parameter == "lamp"){
                ini_set('max_execution_time', 600);
                $products = Product::where('vendor_id', 4)->get();
                $specscat = SpecificationCategory::where('title', 'LIKE', '%' . $request->parameter . '%')->first();
                $data = ['lamp_technology', 'lamp_base', 'lamp_included', 'dimmable', 'max_wattage'];
                foreach($products as $product){
                    foreach($data as $d){
                        $existingSpec = ProductSpecification::where('pro_id', $product->id)->where('spec_id', $specscat->id)->where('title', $d)->first();
                        if(!$existingSpec){
                            $productspecs = new ProductSpecification();
                            $productspecs->pro_id = $product->id;
                            $productspecs->spec_id = $specscat->id;
                            $productspecs->title = $d;
                            $productspecs->description = $product->getAttribute($d);
                            $productspecs->save();
        
                            $product->update([$d => null]);
                        }
                    }
                }
            }

            else if($request->parameter == "warranty"){
                ini_set('max_execution_time', 600);
                $products = Product::where('vendor_id', 4)->get();
                $specscat = SpecificationCategory::where('title', 'LIKE', '%' . $request->parameter . '%')->first();
                $data = ['warranty'];
                foreach($products as $product){
                    foreach($data as $d){
                        $existingSpec = ProductSpecification::where('pro_id', $product->id)->where('spec_id', $specscat->id)->where('title', $d)->first();
                        if(!$existingSpec){
                            $productspecs = new ProductSpecification();
                            $productspecs->pro_id = $product->id;
                            $productspecs->spec_id = $specscat->id;
                            $productspecs->title = $d;
                            $productspecs->description = $product->getAttribute($d);
                            $productspecs->save();
        
                            $product->update([$d => null]);
                        }
                    }
                }
            }

            else if($request->parameter == "misc"){
                ini_set('max_execution_time', 600);
                $products = Product::where('vendor_id', 4)->get();
                $specscat = SpecificationCategory::where('title', 'LIKE', '%' . $request->parameter . '%')->first();
                $data = ['commodity_code'];
                foreach($products as $product){
                    foreach($data as $d){
                        $existingSpec = ProductSpecification::where('pro_id', $product->id)->where('spec_id', $specscat->id)->where('title', $d)->first();
                        if(!$existingSpec){
                            $productspecs = new ProductSpecification();
                            $productspecs->pro_id = $product->id;
                            $productspecs->spec_id = $specscat->id;
                            $productspecs->title = $d;
                            $productspecs->description = $product->getAttribute($d);
                            $productspecs->save();
        
                            $product->update([$d => null]);
                        }
                    }
                }
            }
        }
        
        catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
    public function saxbe_specs_linked(Request $request)
    {
        try {
            ini_set('max_execution_time', 600);
            $products = Product::where('vendor_id', 6)->whereNotNull('specification')->get();
            $specscat = SpecificationCategory::where('title', 'LIKE', '%' . $request->parameter . '%')->first();
            
            foreach ($products as $p) {
                //echo "Product ID: " . $p->id . "<br />";
                $specifications = json_decode($p->specification);
                // return $specifications = [];
                if (!empty($specifications)) {
                    foreach ($specifications[0] as $key => $specs) {
                        //echo "Key is: " . $key . " : " . $specs . "<br />";
                        //foreach ($specs as $spec) {
                            $trimmedSpec = trim($specs);
                            $existingSpec = ProductSpecification::where('pro_id', $p->id)
                                ->where('spec_id', 2) 
                                ->where('title', $key)
                                ->where('description', $trimmedSpec)
                                ->first();

                            if (!$existingSpec) {
                                $productspecs = new ProductSpecification();
                                $productspecs->pro_id = $p->id;
                                $productspecs->spec_id = 2; 
                                $productspecs->title = $key;
                                if(!empty($trimmedSpec)){
                                    $productspecs->description = $trimmedSpec;
                                }
                                $productspecs->save();
                            }
                        //}
                    }
                }
                echo "<br /><br />";
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Specifications linked successfully.',
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
    public function lw_specs_linked(Request $request){
        try{
            if($request->parameter == "key specification"){
                ini_set('max_execution_time', 600);
                $products = Product::where('vendor_id', 7)->get();
                $specscat = SpecificationCategory::where('title', 'LIKE', '%' . $request->parameter . '%')->first();
                $data = ['specification', 'colour', 'height', 'depth', 'width'];
                foreach($products as $product){
                    foreach($data as $d){
                        $existingSpec = ProductSpecification::where('pro_id', $product->id)->where('spec_id', $specscat->id)->where('title', $d)->first();
                        if(!$existingSpec){
                            $productspecs = new ProductSpecification();
                            $productspecs->pro_id = $product->id;
                            $productspecs->spec_id = $specscat->id;
                            $productspecs->title = $d;
                            $productspecs->description = $product->getAttribute($d);
                            $productspecs->save();
        
                            $product->update([$d => null]);
                        }
                    }
                }
            }
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
    public function scolmore_specs_linked(Request $request){
        try{
            if($request->parameter == "key specification"){
                ini_set('max_execution_time', 300);
                $products = Product::where('vendor_id', 5)->get();
                $specscat = SpecificationCategory::where('title', 'LIKE', '%' . $request->parameter . '%')->first();
                $data = ['net weight', 'gross weight', 'product length' , 'product width' , 'product height', 'commodity code'];
                foreach($products as $product){
                    foreach($data as $d){
                        $field = str_replace(' ', '_', $d);
                        $existingSpec = ProductSpecification::where('pro_id', $product->id)->where('title',  $d)->first();
                        if(!$existingSpec){
                            $productspecs = new ProductSpecification();
                            $productspecs->pro_id = $product->id;
                            $productspecs->spec_id = $specscat->id;
                            $productspecs->title = $d;
                            $productspecs->description = $product->getAttribute($field);
                            $productspecs->save();
        
                            $product->update([$d => null]);
                        }
                    }
                }
            }
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function royalmail_order($oid)
    {
        $OrderInfo = Order::where('order_no' , $oid)->first();
        $curl = curl_init();

        $OrderRefDate = explode(" ", $OrderInfo->created_at);
        $OrderDate = $OrderRefDate[0];
        $OrderTime = $OrderRefDate[1];
        $OrderDateTime = $OrderDate . "T" . $OrderTime . "Z";

        $RequestArr = '{
            "items": [
                {
                "orderReference": "OBM' . $OrderInfo->order_no . '",
                "recipient": {
                    "address": {
                        "fullName": "' . $OrderInfo->name . '",
                        "companyName": "",
                        "addressLine1": "' . $OrderInfo->address . '",
                        "addressLine2": "' . $OrderInfo->address_2 . '",
                        "addressLine3": "",
                        "city": "' . $OrderInfo->city . '",
                        "county": "",
                        "postcode": "' . $OrderInfo->postal_code . '",
                        "countryCode": "UK"
                    },
                    "phoneNumber": "' . $OrderInfo->contact_no . '",
                    "emailAddress": "' . $OrderInfo->email . '"
                },
                "sender": {
                    "tradingName": "The Electro Hub",
                    "phoneNumber": "033300124214",
                    "emailAddress": "info@theelectrohub.co.uk"
                },
                "billing": {
                    "address": {
                        "fullName": "Rizwan Malik",
                        "companyName": "The Electro Hub",
                        "addressLine1": "AA Business Centre",
                        "addressLine2": "326-340 Dunstable Rd",
                        "addressLine3": "",
                        "city": "Luton",
                        "county": "",
                        "postcode": "LU4 8JS",
                        "countryCode": "UK"
                    },
                    "phoneNumber": "033300124214",
                    "emailAddress": "info@theelectrohub.co.uk"
                },
                "packages": [
                    {
                        "weightInGrams": 500,
                        "packageFormatIdentifier": "Large Letter"
                    }
                ],
                "orderDate": "' . $OrderDateTime . '",
                "subtotal": 0,
                "shippingCostCharged": 0,
                "otherCosts": 0,
                "total": 0,
                "postageDetails": {
                    "sendNotificationsTo": "sender",
                    "serviceCode": "TPN24",
                    "receiveEmailNotification": true,
                    "receiveSmsNotification": true,
                    "requestSignatureUponDelivery": true,
                    "safePlace": ""
                },
                "label": {
                    "includeLabelInResponse": true
                }
                }
            ]
        }';

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.parcel.royalmail.com/api/v1/orders',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $RequestArr,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer 1cdb851a-8481-42a5-9e06-354574fb5bf9'
            ),
        ));

        return $response = curl_exec($curl);

        curl_close($curl);
        $arr = json_decode($response, true);
        if (isset($arr['createdOrders'][0]['trackingNumber'])) {
            $OrderInfo->shipping_tracking_id = $arr['createdOrders'][0]['trackingNumber'];
            $OrderInfo->save();
        }
    }

    public function generateshippinglabels($orderidentifier) {
        $curl = curl_init();
    
        $url = 'https://api.parcel.royalmail.com/api/v1/orders/' . $orderidentifier . '/label';
        $url .= '?documentType=postageLabel&includeReturnsLabel=true'; // Include returns label parameter
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer 1cdb851a-8481-42a5-9e06-354574fb5bf9'
            ),
        ));
    
        $response = curl_exec($curl);
        curl_close($curl);
        
        return $response;
    }    
    
    public function logout(){
        Auth::logout();
        return redirect('/panel');
    }
}
