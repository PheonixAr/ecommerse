<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductsCController;

use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/login', function () {
    return view('login');
});

Route::get('/logout', function () {
    Session::forget('user');
    return redirect('login');
});


Route::view('/register', 'register');
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::get("/", [ProductController::class, 'index']);
Route::get("detail/{id}", [ProductController::class, 'detail']);
// Route::post("detail/{id}", [ProductController::class, 'detail']);

Route::get("search", [ProductController::class, 'search']);
Route::post("add_to_cart", [ProductController::class, 'addToCart']);
Route::get("cartlist", [ProductController::class, 'cartList']);
Route::get("removecart/{id}", [ProductController::class, 'removeCart']);
Route::get("ordernow", [ProductController::class, 'orderNow']);
Route::get("orderAll", [ProductController::class, 'orderAll']);
Route::post("orderplace", [ProductController::class, 'orderPlace']);
Route::get("myorders", [ProductController::class, 'myOrders']);
Route::get("payment", [ProductController::class, 'payment']);

// Route::get("pastecontent", [ProductController::class, 'pastecontent']);

Route::get("orderplace", [ProductController::class, 'orderPlace']);
Route::get('checkout', [StripeController::class, 'checkout'])->name('checkout');
Route::post('checkout', [StripeController::class, 'checkout'])->name('checkout');

Route::post('/session', [StripeController::class, 'session'])->name('session');
// Route::post('/psession', [ProductController::class, 'session'])->name('psession');
Route::get('/success', [StripeController::class, 'success'])->name('success');
Route::get('/cancel', [StripeController::class, 'cancel'])->name('cancel');
Route::get('productupload', [ProductController::class, 'productupload'])->name('productupload');


// Route::get('/', function () {
//     return view('stripe');
// });
// Route::post('stripe', [StripeController::class, 'stripe'])->name('stripe');
// Route::get('/', [ProductController::class, 'login']);



// ---------------------productc-----------------
Route::get('/productupload', [ProductsCController::class, 'products'])->name('productupload');
Route::get('/add-product', [ProductsCController::class, 'addProduct']);
Route::post('/add-product', [ProductsCController::class, 'addProduct'])->name('add.product');
// Route::get('/update-product', [ProductsCController::class, 'updateProduct'])->name('update.product');
Route::post('/update-product', [ProductsCController::class, 'updateProduct'])->name('update.product');
Route::post('/delete-product', [ProductsCController::class, 'deleteProduct'])->name('delete.product');
Route::get('/pagination/paginate-data', [ProductsCController::class, 'pagination']);
Route::get('/search-product', [ProductsCController::class, 'searchProduct'])->name('search.product');
