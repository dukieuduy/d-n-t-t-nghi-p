<?php


use App\Models\User;
// use App\Http\Controllers\AdminCartController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsMember;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
// use App\Http\Controllers\AdminCartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\AdminCartController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\ShippingFeeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;

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

// client


// Route::get('/locations', [LocationController::class, 'index']);
// Route::get('/districts/{provinceId}', [LocationController::class, 'getDistricts']);
// Route::get('/wards/{districtId}', [LocationController::class, 'getWards']);

//home
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');



// Route::delete('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

// Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
// Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
// Route::post('/cart/update/{productId}', [CartController::class, 'updateItem'])->name('cart.update');
// Route::delete('/cart/remove/{productId}', [CartController::class, 'removeItem'])->name('cart.remove');
// Route::put('/cart/update/{productId}', [CartController::class, 'updateItem'])->name('cart.update');

// Route::get('/hihi', [CartController::class, 'index'])->name('hihi');



// // admin cart
// Route::get('/carts', [AdminCartController::class, 'index'])->name('admin.carts.index');
// Route::get('/cart/{id}', [AdminCartController::class, 'show'])->name('admin.cart.show');
// Route::delete('/cart/{id}', [AdminCartController::class, 'destroy'])->name('admin.cart.destroy');



// // whishlist

Route::get('/wishlist', [WishlistController::class, 'show'])->name('wishlist.show');



// KIỀU DUY DU
// {{

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth',IsAdmin::class]);
//detail product
Route::get('/product/{id}', [\App\Http\Controllers\HomeController::class, 'detailProduct'])->name('detail-product');
// Route::get('/create-prd', [DashboardController::class, 'createProduct'])->middleware(['auth',IsAdmin::class]);
// Route::post('/create-prd', [DashboardController::class, 'createProduct'])->middleware(['auth',IsAdmin::class]);

Route::prefix('admin')->name('admin.')->middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('products/{product}/update', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.delete');

     //  cập nhật trạng thái sản phẩm
    Route::post('products/{id}/update-status', [ProductController::class, 'updateStatus'])->name('products.updateStatus');
    // thêm mới biến thể sản phẩm
    Route::post('/product/{productId}/variations', [ProductController::class, 'storeVariation']);
    // quản lý phí ship
    Route::get('/shipping-fees', [ShippingFeeController::class, 'index'])->name('shipping_fees.index'); // Danh sách
    Route::get('/shipping-fees/create', [ShippingFeeController::class, 'create'])->name('shipping_fees.create'); // Tạo mới
    Route::post('/shipping-fees', [ShippingFeeController::class, 'store'])->name('shipping_fees.store'); // Lưu mới
    Route::get('/shipping-fees/{shippingFee}/edit', [ShippingFeeController::class, 'edit'])->name('shipping_fees.edit'); // Sửa
    Route::put('/shipping-fees/{shippingFee}', [ShippingFeeController::class, 'update'])->name('shipping_fees.update'); // Cập nhật
    Route::delete('/shipping-fees/{shippingFee}', [ShippingFeeController::class, 'destroy'])->name('shipping_fees.destroy'); // Xóa
    // quản lý đơn hàng
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::post('orders/{id}/update', [OrderController::class, 'update'])->name('orders.update');
    
    Route::post('orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::delete('orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');

    Route::get('categories', [CategoryController::class, 'index'])-> name('categories.index');
    Route::post('categories/edit/{id}', [CategoryController::class, 'edit'])-> name('categories.edit');
    Route::post('categories/destroy/{id}', [CategoryController::class, 'delete'])->name('categories.destroy');
    // Route::resource('hosts',CategoryController::class);


});
Route::get('/shipping-fee/{province_id}', [ShippingFeeController::class, 'getShippingFeeByProvince']);
Route::get('/shipping-fee/{province_id}/{district_id}', [ShippingFeeController::class, 'getShippingFeeByProvinceAndDistrict']);
// Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
Auth::routes();


Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/edit/{id}', [CartController::class, 'edit'])->name('cart.edit');

Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');


Route::post('/confirm_checkout', [CheckoutController::class, 'confirmCheckout'])->name('confirm_checkout');
Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::GET('/vnpay-return', [CheckoutController::class, 'vnpayReturn'])->name('vnpay.return');

Route::get('/locations', [CheckoutController::class, 'index']);
Route::get('/districts/{provinceId}', [CheckoutController::class, 'getDistricts']);
Route::get('/wards/{districtId}', [CheckoutController::class, 'getWards']);
// }}

Route::middleware(['auth'])->group(function () {
    Route::get('/user_orders', [UserOrderController::class, 'index'])->name('user.orders.index');
    Route::post('/user_orders/{order}/cancel', [UserOrderController::class, 'cancel'])->name('orders.cancel');
});

Route::get('/user_orders/verify-phone', [UserOrderController::class, 'verifyPhone'])->name('user.orders.verify_phone');
Route::post('/user_orders/verify-phone', [UserOrderController::class, 'checkPhone'])->name('user.orders.check_phone');







// admin
// Route::group(['prefix' => 'admin'], function () {
//     Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
// });


//checkout
// Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout.index');
// Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

// Route::get('/order/success', function () {
//     return view('checkout.success');
// })->name('order.success');


// //mini cart











// route cũ không dùng

// login-logout-register-forgetpassword
// Route::get('/login',[UserController::class,'login'])->name('login');
// Route::post('/login',[UserController::class,'postlogin']);
// Route::get('/register',[UserController::class,'register'])->name('register');
// Route::post('/register',[UserController::class,'postRegister']);
// Route::post('/logout',[UserController::class, 'logout'])->name('logout');
// Route::get('/test-email',[UserController::class,'testEmail']);
// Route::get('/forget-password',[UserController::class,'forgetPass'])->name('customer.forgetPass');
// Route::post('/forget-password',[UserController::class,'postForgetPassword']);
// Route::get('/get-password/customer/{token}',[UserController::class,'getPass'])->name('customer.getPass');
// Route::post('/get-password/customer/{token}',[UserController::class,'postGetPass']);


