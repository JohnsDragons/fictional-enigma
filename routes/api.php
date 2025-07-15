<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('customers', [CustomerController::class, 'store']);
Route::post('products', [ProductController::class, 'store']);
Route::post('orders', [OrderController::class, 'store']);
Route::post('orders/{order}/products', [OrderController::class, 'addProduct']);
Route::get('orders/{order}', [OrderController::class, 'show']);
Route::get('customers/{customer}/orders', [CustomerController::class, 'showOrders']);
