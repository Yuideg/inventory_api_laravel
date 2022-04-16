<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SupplierController;
use App\Models\OrderDetail;
use App\Models\Staff;
use PHPUnit\TextUI\XmlConfiguration\Group;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//public routes

Route::post('/auth/login',[AuthController::class,'login']);
Route::post('/auth/customers/sign-up',[CustomerController::class,'store']);


Route::controller(StaffController::class)->group(function () {
    Route::post('/auth/staff/sign-up','store');
    Route::get('/staff/lists','index');
    Route::put('/staff/{staff_id}','update');
    Route::delete('/staff/{stff_id}','distroy');
    Route::get('/staff/{staff_id}','show');
});

Route::controller(CustomerController::class)->group(function () {
    Route::get('/customers','index');
    Route::put('/customers/{customer_id}','update');
    Route::delete('/customers/{customer_id}','distroy');
    Route::get('/customers/{customer_id}','show');
});

Route::controller(RoleController::class)->group(function () {
    Route::post('/auth/roles/sign-up','store');
    Route::get('/roles','index');
    Route::put('/roles/{role_id}','update');
    Route::delete('/roles/{role_id}','distroy');
    Route::get('/roles/{role_id}','show');
});


Route::controller(OrderController::class)->group(function () {
    Route::post('/orders','store');
    Route::get('/orders','index');
    Route::put('/orders/{order_id}','update');
    Route::delete('/orders/{order_id}','distroy');
    Route::get('/orders/{order_id}','show');
});

Route::controller(OrderDetail::class)->group(function () {
    Route::post('/order-details','store');
    Route::get('/order-details','index');
    Route::put('/order-details/{order_detail_id}','update');
    Route::delete('/order-details/{order_detail_id}','distroy');
    Route::get('/order-details/{order_detail_id}','show');
});

Route::controller(SupplierController::class)->group(function () {
    Route::post('/suppliers','store');
    Route::get('/suppliers','index');
    Route::put('/suppliers/{supplier_id}','update');
    Route::delete('/suppliers/{supplier_id}','distroy');
    Route::get('/suppliers/{supplier_id}','show');
});
Route::controller(ProductController::class)->group(function () {
    Route::post('/products','store');
    Route::get('/products','index');
    Route::put('/products/{product_id}','update');
    Route::delete('/products/{product_id}','distroy');
    Route::get('/products/{product_id}','show');
});
Route::controller(CategoryController::class)->group(function () {
    Route::post('/categories','store');
    Route::get('/categories','index');
    Route::put('/categories/{category_id}','update');
    Route::delete('/categories/{category_id}','distroy');
    Route::get('/categories/{category_id}','show');
});
Route::controller(PaymentController::class)->group(function () {
    Route::post('/payments','store');
    Route::get('/payments','index');
    Route::put('/payments/{bill_number}','update');
    Route::delete('/payments/{bill_number}','distroy');
    Route::get('/payments/{bill_number}','show');
});



Route::group(['middleware'=>['auth:sanctum']], function () {


});
