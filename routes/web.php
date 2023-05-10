<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Home\AuthController;
use App\Http\Controllers\Home\CartController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Home\PaymentController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Home\WishlistController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\SearchUserController;
use App\Http\Controllers\Home\UserAddressController;
use App\Http\Controllers\Home\UserProfileController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Home\CommentController as HomeCommentController;
use App\Http\Controllers\Home\ProductController as HomeProductController;
use App\Http\Controllers\Home\CategoryController as HomeCategoryController;

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

Route::get('/admin-panel/dashboard',[AdminController::class , 'index'])->name('dashboard')->middleware(['role:admin']);

Route::prefix('admin-panel/management')->name('admin.')->middleware(['role:admin|seller'])->group(function(){

    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::resource('products', ProductController::class);
    Route::resource('comments', CommentController::class);
    Route::resource('coupons', CouponController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('users', UserController::class)->middleware(['role:admin']);
    Route::resource('permissions', PermissionController::class)->middleware(['role:admin']);
    Route::resource('roles', RoleController::class)->middleware(['role:admin']);
    Route::resource('contactUs', ContactUsController::class);
    Route::get('/search-user' , [SearchUserController::class , 'searchUser'])->name('search.user');

    Route::get('/comments/{comment}/change_approve' , [CommentController::class , 'changeApprove'])->name('comments.change_approve')->middleware(['role:admin']);


     //edit product image
     Route::get('/products/{product}/images-edit' , [ProductImageController::class , 'edit'])->name('products.images.edit');
     Route::delete('/products/{product}/images-destroy' , [ProductImageController::class , 'destroy'])->name('products.images.destroy');
     Route::put('/products/{product}/images-set-primary' , [ProductImageController::class , 'setPrimary'])->name('products.images.set_primary');
     Route::post('/products/{product}/images-add' , [ProductImageController::class , 'add'])->name('products.images.add');

});

//home
Route::get('/' , [HomeController::class , 'index'])->name('home.index');
Route::get('/categories/{category:slug}' , [HomeCategoryController::class , 'show'])->name('home.categories.show');
Route::get('/products/{product:slug}' , [HomeProductController::class , 'show'])->name('home.products.show');
Route::post('/comments/{product}' , [HomeCommentController::class , 'store'])->name('home.comments.store');

Route::get('/about-us' , [HomeController::class , 'aboutUs'])->name('home.about-us');
Route::get('/contact-us' , [HomeController::class , 'contactUs'])->name('home.contact-us');
Route::post('/contact-us-form' , [HomeController::class , 'contactUsForm'])->name('home.contact-us.form');
Route::get('/search-product' , [HomeController::class , 'searchProduct'])->name('home.search.product');

//WISH LIST
Route::get('/add_to_wishlist/{product}' , [WishlistController::class , 'add'])->name('home.wishlist.add');
Route::get('/remove_to_wishlist/{product}' , [WishlistController::class , 'remove'])->name('home.wishlist.remove');

//CART
Route::get('/cart' , [CartController::class , 'index'])->name('home.cart.index');
Route::post('/add_to_cart' , [CartController::class , 'add'])->name('home.cart.add');
Route::get('/remove_from_cart/{rowId}' , [CartController::class , 'remove'])->name('home.cart.remove');
Route::put('/cart' , [CartController::class , 'update'])->name('home.cart.update');
Route::get('/clear_cart' , [CartController::class , 'clear'])->name('home.cart.clear');
Route::post('/check_coupon' , [CartController::class , 'checkCoupon'])->name('home.coupons.check');
Route::get('/checkout' , [CartController::class , 'checkout'])->name('home.orders.checkout');


Route::post('/payment' , [PaymentController::class , 'payment'])->name('home.payment');
Route::get('/payment-verify/{gatewayName}' , [PaymentController::class , 'paymentVerify'])->name('home.payment_verify');


//PROFILE
Route::prefix('profile')->name('home.')->group(function(){
    Route::get('/' , [UserProfileController::class , 'index'])->name('users_profile.index');
    Route::post('/profiles' , [ProfileController::class , 'update'])->name('profile.update');
    // Route::post('/password' , [ProfileController::class , 'updatePassword'])->name('profile.update.password');

    Route::get('/comments' , [HomeCommentController::class , 'usersProfileIndex'])->name('comments.users_profile.index');

    Route::get('/wishlist' , [WishListController::class , 'usersProfileIndex'])->name('wishlist.users_profile.index');

    Route::get('/addresses' , [UserAddressController::class , 'index'])->name('addresses.index');
    Route::post('/addresses' , [UserAddressController::class , 'store'])->name('addresses.store');
    Route::put('/addresses/{address}' , [UserAddressController::class , 'update'])->name('addresses.update');

    Route::get('/orders' , [CartController::class , 'usersProfileIndex'])->name('orders.users_profile.index');

});

Route::get('/get-province-cities-list' , [UserAddressController::class , 'getProvinceCitiesList']);

Route::get('/about-us' , [HomeController::class , 'aboutUs'])->name('home.about-us');
Route::get('/contact-us' , [HomeController::class , 'contactUs'])->name('home.contact-us');
Route::post('/contact-us-form' , [HomeController::class , 'contactUsForm'])->name('home.contact-us.form');
Route::get('/logout' , [AuthController::class , 'logout'])->name('logout');

