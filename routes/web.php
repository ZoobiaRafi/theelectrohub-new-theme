<?php

use App\Http\Controllers\BackEndController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ImageResizeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StocksController;
use App\Http\Controllers\WishListController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get("/panel", [BackEndController::class , 'index'])->name('index');
Route::post("/login/submit", [BackEndController::class , 'login_submit'])->name('login_submit');

Route::group(['middleware' => 'instaload'], function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get("/home", [BackEndController::class , 'dashboard'])->name('dashboard');
        Route::get("/users/{refkey}", [BackEndController::class , 'users'])->name('users');
        Route::get("/check", [BackEndController::class , 'check_username'])->name('check_username');
        Route::post("/user/submit", [BackEndController::class , 'user_submit'])->name('user_submit');
        Route::get("/profile", [BackEndController::class , 'profile'])->name('profile');
        Route::post("/profile-update-submit", [BackEndController::class , 'profile_update_submit'])->name('profile_update_submit');
        Route::get("/deactive-account/{userid}", [BackEndController::class , 'deactive_account'])->name('deactive_account');
        Route::get("/active-account/{userid}", [BackEndController::class , 'active_account'])->name('active_account');
        //Category Routes Start
            Route::get("/category/{refkey}", [BackEndController::class , 'category'])->name('category');
            Route::post("/category/submit", [BackEndController::class , 'category_submit'])->name('category_submit');
            Route::post("/category/update", [BackEndController::class , 'category_update'])->name('category_update');
            Route::get("/category/delete/submit", [BackEndController::class , 'category_delete'])->name('category_delete');
            // Route::get("/category/status/submit", [BackEndController::class , 'category_status'])->name('category_status');
            Route::get("/category/status/submit", [BackEndController::class , 'product_cate_status'])->name('product_cate_status');
            Route::get("/category/home-status/submit", [BackEndController::class , 'category_home_status'])->name('category_home_status');
            Route::get("/category/show-menu/submit", [BackEndController::class , 'category_show_menu'])->name('category_show_menu');

            //Add Category Data Using CSV Import Start
                Route::post('category/file-import',[BackEndController::class,'category_import'])->name('category_import'); 
            //Add Category Data Using CSV Import Start
        
        //Category Routes End

        //Product Routes Start    
            Route::get("/product/{refkey}", [BackEndController::class , 'product'])->name('product');
            Route::post("/product/submit", [BackEndController::class , 'product_submit'])->name('product_submit');
            Route::post("/product/update", [BackEndController::class , 'product_update'])->name('product_update');
            Route::get("/product/delete/submit", [BackEndController::class , 'product_delete'])->name('product_delete');
            Route::get("/product/status/submit", [BackEndController::class , 'product_status'])->name('product_status');
            Route::get("/product/popular-status/submit", [BackEndController::class , 'product_popular_status'])->name('product_popular_status');
            // Route::get("/product/status-product/submit", [BackEndController::class , 'product_status'])->name('product_status');
            //Add Category Data Using CSV Import Start
                Route::post('product/file-import',[BackEndController::class,'product_import'])->name('product_import'); 
            //Add Category Data Using CSV Import Start

            //mla SHEET URL ////
            Route::post('mla/file-import', [BackEndController::class,'mla_import'])->name('mla_import');
            //mla SHEET URL ////
            
            //Saxbe SHEET URL ////
            Route::post('saxbe/file-import', [BackEndController::class,'saxbe_import'])->name('saxbe_import');
            //Saxbe SHEET URL ////       

            //Saxbe SHEET URL ////
            Route::post('scollmore/file-import', [BackEndController::class,'scollmore_import'])->name('scollmore_import');
            //Saxbe SHEET URL ////
            
            //Saxbe SHEET URL ////
            Route::post('lw/file-import', [BackEndController::class,'lw_import'])->name('lw_import');
            //Saxbe SHEET URL ////

            //Price SHEET URL ////
            Route::post('price/file-import', [BackEndController::class,'price_import'])->name('price_import');
            //Price SHEET URL ////
            
            //UPdate Cat Id ROute
            Route::post('update-cat-id/file-import', [BackEndController::class,'update_cat_id'])->name('update_cat_id');
            //UPdate Cat Id ROute

            //Product Routes End

        //Coupon Code Start
            Route::get("/coupon-code/{refkey}", [BackEndController::class , 'coupon_code'])->name('coupon_code');
            Route::get("/add-coupon-code", [BackEndController::class , 'add_coupon_code'])->name('add_coupon_code');
            Route::post("/add-coupon-code/submit", [BackEndController::class , 'add_coupon_code_submit'])->name('add_coupon_code_submit');
            Route::get("/edit-coupon-code/{id}", [BackEndController::class , 'edit_coupon_code'])->name('edit_coupon_code');
            Route::post("/edit-coupon-code/{id}/submit", [BackEndController::class , 'edit_coupon_code_submit'])->name('edit_coupon_code_submit');
            Route::get("/delete-coupon-code/{id}", [BackEndController::class , 'delete_coupon_code'])->name('delete_coupon_code');
            Route::get("/status-coupon-code/{id}", [BackEndController::class , 'status_coupon_code'])->name('status_coupon_code');
            Route::get("/details-coupon-code/{id}", [BackEndController::class , 'details_coupon_code'])->name('details_coupon_code');
        //Coupon Code End

        //Wishlist Code Start
            Route::get("/wishlist/{refkey}", [BackEndController::class , 'wishlist'])->name('wishlist');
            Route::get("delete/wishlist", [BackEndController::class , 'delete_wishlist'])->name('delete_wishlist');
        //Wishlist Code End

        //Wishlist Code Start
        Route::get("/newsletter/{refkey}", [BackEndController::class , 'newsletter'])->name('newsletter');
        Route::get("delete/newsletter", [BackEndController::class , 'delete_newsletter'])->name('delete_newsletter');
        //Wishlist Code End

        //Banner Code Start
            Route::get("/banner/{refkey}", [BackEndController::class , 'banner'])->name('banner');
            Route::post("/banner/submit", [BackEndController::class , 'banner_submit'])->name('banner_submit');
            Route::post("/banner/update", [BackEndController::class , 'banner_update'])->name('banner_update');
            Route::get("/banner/status/submit", [BackEndController::class , 'banner_status'])->name('banner_status');
            Route::get("/banner/delete/submit", [BackEndController::class , 'banner_delete'])->name('banner_delete');
        //Banner Code End

        //ContactUsTopic Start
            Route::get("/contact-us-topic/{refkey}", [BackEndController::class , 'contactustopic'])->name('contactustopic');
            Route::post("/contact-us-topic/submit", [BackEndController::class , 'contactustopic_submit'])->name('contactustopic_submit');
            Route::post("/contact-us-topic/update/submit", [BackEndController::class , 'contactustopic_update'])->name('contactustopic_update');
            Route::get("/contact-us-topic/delete/submit", [BackEndController::class , 'contactustopic_delete'])->name('contactustopic_delete');
            Route::get("/contact-us-topic/status/submit", [BackEndController::class , 'contactustopic_status'])->name('contactustopic_status');
        //ContactUsTopic End

        //ContactUsStatus Start
            Route::get("/contact-us-status/{refkey}", [BackEndController::class , 'contactusstatus'])->name('contactusstatus');
            Route::post("/contact-us-status/submit", [BackEndController::class , 'contactusstatus_submit'])->name('contactusstatus_submit');
            Route::post("/contact-us-status/update/submit", [BackEndController::class , 'contactusstatus_update'])->name('contactusstatus_update');
            Route::get("/contact-us-status/delete/submit", [BackEndController::class , 'contactusstatus_delete'])->name('contactusstatus_delete');
            Route::get("/contact-us-status/status/submit", [BackEndController::class , 'contactusstatus_status'])->name('contactusstatus_status');
        //ContactUsStatus End

        //Contact Us Start
            Route::get("/contact-us/{refkey}", [BackEndController::class , 'contactus'])->name('contactus');
            Route::post("/contact-us/update/submit", [BackEndController::class , 'contactus_update'])->name('contactus_update');
            Route::get("/contact-us/view/{id}", [BackEndController::class , 'contact_us_view'])->name('contact_us_view');
            Route::get("/contact-us/delete/submit", [BackEndController::class , 'contact_us_delete'])->name('contact_us_delete');
        //Contact Us End

        //FAQ's Start
            Route::get("/faq/{refkey}", [BackEndController::class , 'faq'])->name('faq');
            Route::get("/add-faq", [BackEndController::class , 'faq_add'])->name('faq_add');
            Route::post("/add-faq/submit", [BackEndController::class , 'faq_add_submit'])->name('faq_add_submit');
            Route::get("/edit-faq/{id}", [BackEndController::class , 'faq_edit'])->name('faq_edit');
            Route::post("/edit-faq/{id}/submit", [BackEndController::class , 'faq_edit_submit'])->name('faq_edit_submit');
            Route::get("/faq/delete/submit", [BackEndController::class , 'faq_delete'])->name('faq_delete');
            Route::get("/faq/view/{id}", [BackEndController::class , 'faq_view'])->name('faq_view');
        //FAQ's End

        //Stocks Start
            Route::get("/stocks-status/{refkey}", [StocksController::class , 'stocks_statuses'])->name('stocks_statuses');
            Route::post("/stocks-status/submit", [StocksController::class , 'stocks_statuses_submit'])->name('stocks_statuses_submit');
            Route::post("/stocks-status/update/submit", [StocksController::class , 'stocks_statuses_update'])->name('stocks_statuses_update');
            Route::get("/stocks-status/delete/submit", [StocksController::class , 'stocks_statuses_delete'])->name('stocks_statuses_delete');
            Route::get("/stocks-status/status/submit", [StocksController::class , 'stocks_statuses_status'])->name('stocks_statuses_status');
        //Stocks End

        //Vendors Start
            Route::get("/vendors/{refkey}", [StocksController::class , 'vendors'])->name('vendors');
            Route::get("/add-vendors", [StocksController::class , 'add_vendors'])->name('add_vendors');
            Route::post("/add-vendors/submit", [StocksController::class , 'add_vendors_submit'])->name('add_vendors_submit');
            Route::get("/edit-vendors/{id}", [StocksController::class , 'edit_vendors'])->name('edit_vendors');
            Route::post("/edit-vendors/{id}/submit", [StocksController::class , 'edit_vendors_submit'])->name('edit_vendors_submit');
            Route::get("/edit-status/submit", [StocksController::class , 'edit_vendors_status'])->name('edit_vendors_status');
            Route::get("/view/vendor", [StocksController::class , 'view_vendors'])->name('view_vendors');
            Route::get("/delete/submit", [StocksController::class , 'delete_vendors'])->name('delete_vendors');
        //Vendors End

        //Order Status Start
            Route::get("/order-status/{refkey}", [BackEndController::class , 'order_statuses'])->name('order_statuses');
            Route::post("/order-status/submit", [BackEndController::class , 'order_statuses_submit'])->name('order_statuses_submit');
            Route::post("/order-status/update/submit", [BackEndController::class , 'order_statuses_update'])->name('order_statuses_update');
            Route::get("/order-status/delete/submit", [BackEndController::class , 'order_statuses_delete'])->name('order_statuses_delete');
            Route::get("/order-status/status/submit", [BackEndController::class , 'order_statuses_status'])->name('order_statuses_status');
        //Order Status End

        //Content Page Start
            Route::get("/content-page/{refkey}", [BackEndController::class , 'content_page'])->name('content_page');
            Route::get("/add-content-page", [BackEndController::class , 'add_content_page'])->name('add_content_page');
            Route::post("/add-content-page/submit", [BackEndController::class , 'add_content_page_submit'])->name('add_content_page_submit');
            Route::get("/edit-content-page/{id}", [BackEndController::class , 'edit_content_page'])->name('edit_content_page');
            Route::post("/edit-content-page/{id}/submit", [BackEndController::class , 'edit_content_page_submit'])->name('edit_content_page_submit');
            Route::get("/edit-contentpage/status/submit", [BackEndController::class , 'edit_contentpage_status'])->name('edit_contentpage_status');
            Route::get("/contentpage/delete/submit", [BackEndController::class , 'contentpages_delete_submit'])->name('contentpages_delete_submit');
            Route::get("/contentpage/view", [BackEndController::class , 'contentpages_view'])->name('contentpages_view');
        //Content Page End

        //Promotion page : Start
            Route::get("/promotion/{refkey}", [BackEndController::class , 'promotion_page'])->name('promotion');
            Route::post("/promotion/submit", [BackEndController::class , 'promotion_submit'])->name('promotion_submit');
            Route::post("/promotion/update", [BackEndController::class , 'promotion_update'])->name('promotion_update');
            Route::get("/promotion/delete/submit", [BackEndController::class , 'promotion_delete'])->name('promotion_delete');
            Route::get("/promotion/status/submit", [BackEndController::class , 'promotion_status'])->name('promotion_status');
            Route::get("/promotion/sale-status/submit", [BackEndController::class , 'promotion_sale'])->name('promotion_sale');
            Route::get("/promotion/bestseller-status/submit", [BackEndController::class , 'promotion_bestseller'])->name('promotion_bestseller');

        //Promotion page : End

        //Tickers Start
            Route::get("/ticker/{refkey}", [BackEndController::class , 'ticker'])->name('ticker');
            Route::post("/ticker/submit", [BackEndController::class , 'ticker_submit'])->name('ticker_submit');
            Route::post("/ticker/update", [BackEndController::class , 'ticker_update'])->name('ticker_update');
            Route::get("/ticker/delete/submit", [BackEndController::class , 'ticker_delete'])->name('ticker_delete');
            Route::get("/ticker/status/submit", [BackEndController::class , 'ticker_status'])->name('ticker_status');
            Route::get("/ticker/edit/{id}", [BackEndController::class , 'ticker_edit'])->name('ticker_edit');
        //Tickers End

        //Vendors Start
         Route::get("/vendor/{refkey}", [BackEndController::class , 'vendor'])->name('vendor');
         Route::post("/vendor/submit", [BackEndController::class , 'vendor_submit'])->name('vendor_submit');
         Route::post("/vendor/update", [BackEndController::class , 'vendor_update'])->name('vendor_update');
         Route::get("/vendor/status/submit", [BackEndController::class , 'vendor_status'])->name('vendor_status');
         Route::get("/vendor/edit/{id}", [BackEndController::class , 'vendor_edit'])->name('vendor_edit');
        //Vendors End

        //Order Page Start
            Route::get("/order/{refkey}", [BackEndController::class , 'order'])->name('order');
        //Order Page End

        //Get User Refkey Start 
            Route::get("/user", [BackEndController::class , 'user_details'])->name('user_details'); 
        //Get User Refkey End

        //Download Image From URL
            Route::get("download/product/image", [BackEndController::class , 'product_image'])->name('product_image');
        //Download Image From URL

        //Datasheet From URL ////
            Route::get("download/datasheet/pdf", [BackEndController::class , 'datasheet_pdf'])->name('datasheet_pdf');
        //Datasheet From URL ////

        //Order Status Update Route
            Route::post("order-status/update", [BackEndController::class , 'order_status_update'])->name('order_status_update');
            Route::get("customer/order/delete", [BackEndController::class , 'order_delete'])->name('order_delete');
            Route::get("customer/order/view", [BackEndController::class , 'customer_order_view'])->name('customer_order_view');
        //Order Status Update Route

        //MlA Accessories Specs Start
            Route::get("mla-accessories/specs-linked", [BackEndController::class , 'mla_accessories_specs_linked'])->name('mla_accessories_specs_linked');
        //MlA Accessories Specs End
        //Saxbe Specs Start
            Route::get("saxbe/specs-linked", [BackEndController::class , 'saxbe_specs_linked'])->name('saxbe_specs_linked');
        //Saxbe Specs End
        //Saxbe Specs Start
        Route::get("lw/specs-linked", [BackEndController::class , 'lw_specs_linked'])->name('lw_specs_linked');
        //Saxbe Specs End
        //Saxbe Specs Start
        Route::get("scolmore/specs-linked", [BackEndController::class , 'scolmore_specs_linked'])->name('scolmore_specs_linked');
        //Saxbe Specs End

        //Image Download & Resize Start
            Route::get("image-resize-and-compress", [ImageResizeController::class , 'image_resize_and_compress'])->name('image_resize_and_compress');
            Route::get("other-image-resize-and-compress", [ImageResizeController::class , 'other_image_resize_and_compress'])->name('other_image_resize_and_compress');
        //Image Download & Resize End

        //Data Sheet Download Start
            Route::get("download-pdf-from-url", [PDFController::class , 'download_pdf_from_url'])->name('download_pdf_from_url');
        //Data Sheet Download End

        //Declaration of UKCA Conformity Start
            Route::get("declaration-of-ukca-conformity", [PDFController::class , 'declaration_of_ukca_conformity'])->name('declaration_of_ukca_conformity');
        //Declaration of UKCA Conformity End

        //Specific Download Start
            Route::get("specific-download", [PDFController::class , 'specific_download'])->name('specific_download');
        //Specific Download End

        //Royal Mail Shipping Label
            Route::get("royal-mail-label/{id}", [BackEndController::class , 'royalmail_order'])->name('royalmail_order');
            Route::get("generate-shipping-label/{orderidentifier}", [BackEndController::class , 'generateshippinglabels'])->name('generateshippinglabels');
        //Royal Mail Shipping Label
        
        Route::get("/logout", [BackEndController::class , 'logout'])->name('logout');
    });
});

// frontend routes::Start
Route::get("/", [FrontendController::class , 'homePage'])->name('homePage');
// Route::get("/product-listing", [FrontendController::class , 'productListing'])->name('productListing');
// Route::get("/sign-in", [FrontendController::class , 'signinView'])->name('signinView');
Route::post("/sign-up-submit", [FrontendController::class , 'customerRegister'])->name('customerRegister');
Route::post("/sign-in-submit", [FrontendController::class , 'customerLogin'])->name('customerLogin');
Route::post("/recover-password-submit", [FrontendController::class , 'recoverPassword'])->name('recoverPassword');
Route::get("/password/reset/{refkey}", [FrontendController::class , 'resetPassword'])->name('resetPassword');
Route::post("/password/reset/submit", [FrontendController::class , 'resetPasswordsubmit'])->name('resetPasswordsubmit');
Route::get("/sign-out", [FrontendController::class , 'customerLogout'])->name('customerLogout');
Route::post("/payment-success", [OrderController::class , 'paymentSuccess'])->name('paymentSuccess');
Route::post("/product/update-cart-qtty", [CartController::class , 'updateCartQtty'])->name('updateCartQtty');
Route::post("/product/update-cart", [CartController::class , 'updateCart'])->name('updateCart');
Route::post("/remove/product/cart", [CartController::class , 'removeCart'])->name('removeCart');
Route::post("/remove/product/wishlist", [WishListController::class , 'removeWish'])->name('removeWish');
Route::get("/search/{keyword}", [FrontendController::class , 'search'])->name('search');
Route::get("/get-cart/list", [CartController::class , 'get_cart_list'])->name('get_cart_list');
// Route::get("/get-wishlist", [FrontendController::class , 'get_wishlist'])->name('get_wishlist');
// Route::post("/remove-wishlist", [FrontendController::class , 'remove_wishlist'])->name('remove_wishlist');
// Route::get("/all-categories", [FrontendController::class , 'all_categories'])->name('all_categories');
Route::get('/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');
// Route::get('/my-account', [FrontendController::class, 'userAccount'])->name('userAccount');
Route::get("/my-cart", [FrontendController::class , 'my_cart'])->name('my_cart');
Route::get("/checkout", [FrontendController::class , 'checkout'])->name('checkout');
Route::get("/logout", [FrontendController::class , 'logout'])->name('logout');
Route::post("/newsletter/subscribe", [FrontendController::class , 'newsletterSubscribe'])->name('newsletterSubscribe');

Route::get('/my-account', [FrontendController::class, 'account'])->name('account');
Route::post("/user-details-update", [FrontendController::class , 'userupdate'])->name('userupdate');
Route::post("/check-password", [FrontendController::class , 'checkUserPassword'])->name('checkUserPassword');
Route::post("/customer-password-update", [FrontendController::class , 'updateUserPassword'])->name('updateUserPassword');

Route::get('/track-your-order', [FrontendController::class, 'track_order'])->name('track_order');
Route::post('/track-order-submit', [OrderController::class, 'trackOrderSubmit'])->name('trackOrderSubmit');
Route::get('/find-order/{refkey}', [FrontendController::class, 'find_order'])->name('find_order');
Route::get('/faqs', [FrontendController::class, 'faqs'])->name('faqs');
Route::post("/create-intent", [OrderController::class , 'create_intent'])->name('create_intent');
Route::get('pages/{slug}', [FrontendController::class, 'contentPages'])->name('content');

Route::get('/discount-code/verify', [CartController::class, 'checkDiscount'])->name('checkDiscount');
Route::get('/calculate-vat', [CartController::class, 'calculatevat'])->name('calculatevat');



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get("/my-wishlist", [FrontendController::class , 'getWishlist'])->name('getWishlist');
Route::get("/re-order", [FrontendController::class , 'reorder'])->name('reorder');
Route::get("/list-whole-order", [FrontendController::class , 'listwholeorder'])->name('listwholeorder');
Route::get("/add-to-cart/{id}", [CartController::class , 'addToCart'])->name('addToCart');
Route::get("/add-to-wishlist/{id}", [WishListController::class , 'addToWishlist'])->name('addToWishlist');

// Route::get("/product-detail/{slug}", [FrontendController::class , 'productDetail'])->name('productDetail');

Route::get("/success/{orderid}", [FrontendController::class , 'success_order'])->name('success_order');
Route::get("/success-quick-payment", [FrontendController::class , 'success_quick_payment'])->name('success_quick_payment');

Route::get("/{slug1}", [FrontendController::class , 'mainCategoryListing'])->name('mainCategoryListing');
Route::get("/{slug1}/{slug2}", [FrontendController::class , 'parentCategoryListing'])->name('parentCategoryListing');
Route::get("/{slug1}/{slug2}/{slug3}", [FrontendController::class , 'productListing'])->name('productListing');
Route::get("/{slug1}/{slug2}/{slug3}/{slug4}", [FrontendController::class , 'productDetail'])->name('productDetail');

// frontend routes::End
