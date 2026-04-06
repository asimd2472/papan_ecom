<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthenticationController as AdminAuthenticationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MyaccountController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\FilesController;
use App\Http\Controllers\Admin\NewsLetterController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PagesController;





use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MyaccountController as FrontMyaccountController;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product_categoty/{slug}', [ProductsController::class, 'product_categoty'])->name('product_categoty');
Route::get('/product_listing/{category_slug}/{type_id}', [ProductsController::class, 'product_listing_bytype'])->name('product_listing_bytype');
// Route::get('/product_listing/{category_slug}/{type_id?}/{brand_id}', [ProductsController::class, 'product_listing_bybrand'])->name('product_listing_bybrand');
Route::get('/product_listing/{category_slug}', [ProductsController::class, 'product_listing_bybrand'])->name('product_listing_bybrand');
Route::get('/product-details/{product_slug}', [ProductsController::class, 'product_details'])->name('product_details');

Route::get('/getattribute_items', [ProductsController::class, 'getattribute_items'])->name('getattribute_items');
Route::get('/viewSpecification', [ProductsController::class, 'viewSpecification'])->name('viewSpecification');
Route::post('/addtoCart', [CartController::class, 'addtoCart'])->name('addtoCart');
Route::get('/cart', [CartController::class, 'cartlist'])->name('cart');

// Route::get('/privacy-policy', [PageController::class, 'privacy_policy'])->name('privacy_policy');
// Route::get('/shipping-and-return-policy', [PageController::class, 'shipping_and_return'])->name('shipping_and_return');
// Route::get('/terms-and-condition', [PageController::class, 'terms_and_condition'])->name('terms_and_condition');

// Route::post('/customrodsave', [PageController::class, 'customrodsave'])->name('customrodsave');

// Route::get('/login', [FrontMyaccountController::class, 'login'])->name('login');
// Route::get('/signup', [FrontMyaccountController::class, 'signup'])->name('signup');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

Route::post('/cartupdate', [CartController::class, 'cartupdate'])->name('cartupdate');
Route::post('/logincheck', [FrontMyaccountController::class, 'logincheck'])->name('logincheck');

// User dashboard
// Route::get('/user-dashboard', [FrontMyaccountController::class, 'user_dashboard'])->name('user_dashboard');
// Route::get('/order-history', [FrontMyaccountController::class, 'order_history'])->name('order_history');
// Route::get('/order-details/{order_id}', [FrontMyaccountController::class, 'order_details'])->name('order_details');
// Route::get('/edit-account', [FrontMyaccountController::class, 'edit_account'])->name('edit_account');

// Route::post('/handleonlinepay', [CheckoutController::class, 'handleonlinepay'])->name('handleonlinepay');
Route::get('/order-success', [CheckoutController::class, 'order_success'])->name('order_success');

Route::post('remove_cart', [CheckoutController::class, 'remove_cart'])->name('remove_cart');

// Route::get('/user_logout', [FrontMyaccountController::class, 'user_logout'])->name('user_logout');
// Route::get('/change-password', [FrontMyaccountController::class, 'change_password'])->name('change_password');
// Route::post('/user_changepassword', [FrontMyaccountController::class, 'user_changepassword'])->name('user_changepassword');
// Route::post('/user_resetpassword', [FrontMyaccountController::class, 'user_resetpassword'])->name('user_resetpassword');

// Route::get('/holiday-sale', [HomeController::class, 'holiday_sale'])->name('holiday_sale');

// Route::post('/store-newslater-email', [HomeController::class, 'storeNewslaterEmail']);

// Route::get('/get_fedex_rate', [CheckoutController::class, 'get_fedex_rate'])->name('get_fedex_rate');
// Route::post('/save_customerdata', [CheckoutController::class, 'save_customerdata'])->name('save_customerdata');
// Route::post('/get_customerdata', [CheckoutController::class, 'get_customerdata'])->name('get_customerdata');
// Route::post('/checkCoupon', [CheckoutController::class, 'checkCoupon'])->name('checkCoupon');
// Route::post('/removeCoupon', [CheckoutController::class, 'removeCoupon'])->name('removeCoupon');

// Route::post('/cancel_order', [FrontMyaccountController::class, 'cancel_order'])->name('cancel_order');

// Route::get('/track_order', [FrontMyaccountController::class, 'track_order'])->name('track_order');

Route::post('/place_order_cod', [CheckoutController::class, 'place_order_cod'])->name('place_order_cod');




// Route::get('/custom-rods', [ProductsController::class,'custom_rods'])->name('custom_rods');
// Route::get('/drago-rods', [ProductsController::class,'drago_rods'])->name('drago_rods');



Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminAuthenticationController::class, 'login'])->name('login');
    Route::get('/login', [AdminAuthenticationController::class, 'login'])->name('login');
    Route::post('/login', [AdminAuthenticationController::class, 'authenticate'])->name('dologin');
    Route::middleware(['auth', 'is_admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/logout', [AdminAuthenticationController::class, 'logout'])->name('logout');
        Route::get('/my-account', [MyaccountController::class, 'index'])->name('my_account');
        Route::post('/update_profile', [MyaccountController::class, 'update_profile'])->name('update_profile');
        Route::post('/changepassword', [MyaccountController::class, 'changepassword'])->name('changepassword');

        Route::get('/productcategory', [ProductController::class, 'productcategory'])->name('productcategory');
        Route::get('/create-catrgory', [ProductController::class, 'create_catrgory'])->name('create_catrgory');
        Route::get('/edit_productcategory/{id}', [ProductController::class, 'edit_productcategory'])->name('edit_productcategory');
        Route::post('/save_category', [ProductController::class, 'save_category'])->name('save_category');
        Route::get('/delete_productcategory/{id}', [ProductController::class, 'delete_productcategory'])->name('delete_productcategory');
        Route::post('/productcategory_status', [ProductController::class, 'productcategory_status'])->name('productcategory_status');

        Route::get('/producttype', [ProductController::class, 'producttype'])->name('producttype');
        Route::get('/create-type', [ProductController::class, 'create_type'])->name('create_type');
        Route::post('/save_type', [ProductController::class, 'save_type'])->name('save_type');
        Route::get('/edit_type/{id}', [ProductController::class, 'edit_type'])->name('edit_type');
        Route::post('/getType', [ProductController::class, 'getType'])->name('getType');

        Route::get('/createproduct', [ProductController::class, 'createproduct'])->name('createproduct');
        Route::post('/save_product', [ProductController::class, 'save_product'])->name('save_product');
        Route::get('/product-list', [ProductController::class, 'product_list'])->name('product_list');
        Route::get('/edit-product/{id}', [ProductController::class, 'product_edit'])->name('product_edit');
        Route::get('/delete_product/{id}', [ProductController::class, 'delete_product'])->name('delete_product');
        Route::post('/update_product', [ProductController::class, 'update_product'])->name('update_product');

        Route::post('/delete_product_variation', [ProductController::class, 'delete_product_variation'])->name('delete_product_variation');

        

        Route::get('/all-product-image', [ProductController::class, 'ajaxAllProductImage'])->name('all_product_image');
        Route::get('/search_all_product_image', [ProductController::class, 'search_all_product_image'])->name('search_all_product_image');

        Route::get('/product/all-images', [ProductController::class, 'listProductImages'])->name('all_image');
        Route::post('/image/upload', [ProductController::class, 'imageUpload'])->name('upload_image');
        Route::post('/delete-image', [ProductController::class, 'deleteImage'])->name('delete_image');

        Route::get('/setting', [SettingController::class, 'setting'])->name('setting');
        Route::post('/save_setting', [SettingController::class, 'save_setting'])->name('save_setting');
        Route::post('/save_tax', [SettingController::class, 'save_tax'])->name('save_tax');

        Route::get('/users', [UsersController::class, 'users'])->name('users');


        Route::get('/brand', [BrandController::class, 'index'])->name('brand');
        Route::post('/save_brand', [BrandController::class, 'save_brand'])->name('save_brand');


        Route::get('/upload_file', [ProductController::class, 'upload_file'])->name('upload_file');
        Route::post('/import-excel', [ProductController::class, 'import_excel'])->name('import_excel');

        Route::post('/import-excel', [ProductController::class, 'import_excel'])->name('import_excel');


        Route::get('/delete_brand/{id}', [BrandController::class, 'delete_brand'])->name('delete_brand');
        Route::get('/delete_type/{id}', [ProductController::class, 'delete_type'])->name('delete_type');
        Route::get('/custom_rod', [ProductController::class, 'custom_rod'])->name('custom_rod');
        Route::post('/save_customrod_images', [ProductController::class, 'save_customrod_images'])->name('save_customrod_images');


        Route::get('/order_list', [OrderController::class, 'order_list'])->name('order_list');
        Route::get('/order-details/{order_id}', [OrderController::class, 'order_details'])->name('order_details');

        Route::get('/delete_order/{id}', [OrderController::class, 'delete_order'])->name('delete_order');

        Route::get('/news-letter-list', [NewsLetterController::class, 'newslater_list'])->name('newslater_list');
        Route::get('/delete_newsletters/{id}', [NewsLetterController::class, 'delete_newsletters'])->name('delete_newsletters');

        Route::get('/delete_product_attribute_items', [ProductController::class, 'delete_product_attribute_items'])->name('delete_product_attribute_items');

        Route::get('/coupon', [SettingController::class, 'coupon'])->name('coupon');
        Route::get('/create-coupon', [SettingController::class, 'create_coupon'])->name('create_coupon');
        Route::post('/save_coupon', [SettingController::class, 'save_coupon'])->name('save_coupon');
        Route::get('/edit_coupon/{id}', [SettingController::class, 'edit_coupon'])->name('edit_coupon');
        Route::get('/delete_coupon/{id}', [SettingController::class, 'delete_coupon'])->name('delete_coupon');

        Route::get('/home-page', [PagesController::class, 'home_page'])->name('home_page');
        Route::post('/save_home_page', [PagesController::class, 'save_home_page'])->name('save_home_page');
        Route::get('/delivery_locations', [PagesController::class, 'delivery_locations'])->name('delivery_locations');
        Route::get('/create-delivery-locations', [PagesController::class, 'create_delivery_locations'])->name('create_delivery_locations');
        Route::post('/save_location', [PagesController::class, 'save_location'])->name('save_location');
        Route::get('/edit_location/{id}', [PagesController::class, 'edit_location'])->name('edit_location');
        Route::get('/delete_location/{id}', [PagesController::class, 'delete_location'])->name('delete_location');
    });
});
