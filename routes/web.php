<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('front.index');
// });



Route::get('/',[UserController::class,'index']);
Route::get('/login',[UserController::class,'login'])->name('front.login');
Route::post('/login-process',[UserController::class,'loginProcess'])->name('front.login.process');
Route::get('logout', function () {
    session()->forget('USER_LOGIN');
    session()->forget('USER_ID');
    session()->forget('USER_NAME');
    session()->forget('USER_TEMP_ID');
    return redirect('/');
});


Route::post('/add-to-cart', [CartController::class, 'addToCart']);
Route::get('/cart-count', [CartController::class, 'cartCount']);

Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::get('/delete-cart-item/{id}', [CartController::class, 'delete']);
Route::post('/update-cart-qty', [CartController::class, 'updateQty']);



