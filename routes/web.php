<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;             // Controller frontend
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\PostController;            // nếu có PostController
use App\Http\Controllers\PaymentController;
/*
|--------------------------------------------------------------------------
| Admin routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum', 'admin'])
     ->prefix('admin')
     ->name('admin.')
     ->group(function () {
    // Dashboard
    Route::get('/', fn() => view('admin.admin'))->name('admin');

    // CRUD Products, Sizes, Categories
    Route::resource('products', AdminProductController::class);
    Route::resource('sizes',    SizeController::class);
    Route::resource('category', CategoryController::class);

    // Posts (ví dụ, nếu chưa có controller thì tạo 1 file PostController rỗng)
    Route::resource('posts',    PostController::class)->only(['index','create','store','edit','update','destroy']);

    // Các trang tĩnh khác trong admin:
    Route::get('recruitments', fn() => view('admin.recruitments.index'))->name('recruitments.index');
    Route::get('users',        fn() => view('admin.users.index'))       ->name('users.index');
});

/*
|--------------------------------------------------------------------------
| Cart routes (chỉ dành cho user đã login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function(){
    Route::get(   'cart',                 [CartController::class,'index'])   ->name('cart.index');
    Route::post(  'cart/add/{product}',  [CartController::class,'add'])     ->name('cart.add');
    Route::put(   'cart/update/{cartItem}',[CartController::class,'update'])->name('cart.update');
    Route::delete('cart/remove/{cartItem}',[CartController::class,'remove'])->name('cart.remove');
    Route::post(  'cart/clear',          [CartController::class,'clear'])   ->name('cart.clear');
});

/*
|--------------------------------------------------------------------------
| Public site routes
|--------------------------------------------------------------------------
*/
Route::get('/',           fn() => view('index'))         ->name('home');
Route::get('/thong-tin',  fn() => view('info'))          ->name('info');
Route::get('/tuyen-dung', fn() => view('recruitment'))   ->name('recruitment');
Route::get('/lien-he',    fn() => view('contact'))       ->name('contact');

// Product listing & detail
Route::get('/san-pham',           [ProductController::class,'index']) ->name('products');
Route::get('/san-pham/{product}', [ProductController::class,'show'])  ->name('products.show');

// Gửi yêu cầu thanh toán
Route::post('/payment', [PaymentController::class, 'redirectToGateway'])
     ->name('payment.redirect')
     ->middleware('auth');

// Callback VNPAY
Route::get('/payment/callback', [PaymentController::class, 'callback'])
     ->name('payment.callback');

