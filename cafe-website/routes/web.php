<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Cart;
use App\Http\Controllers\Checkout;


Route::get('/', function() {return view('welcome');})->name('home');

Route::get('/order', [CustomerController::class, 'index'])->name('start_order');
Route::post('/order', [CustomerController::class, 'createCustomer'])->name('create_customer');
Route::get('/menu', [ProductController::class, 'index'])->name('menu');
Route::get('/cart', [Cart::class, 'index'])->name('cart');
Route::post('/cart-add', [Cart::class, 'addToCart'])->name('cart_add');
Route::post('/cart-delete', [Cart::class, 'deleteFromCart'])->name('cart_delete');
Route::get('/checkout', [Checkout::class, 'index'])->name('checkout');
Route::post('/checkout', [Checkout::class, 'processCheckout'])->name('checkout.process');
Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation');
Route::get('/my-order', [OrderController::class, 'index'])->name('my_order');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservations.store');