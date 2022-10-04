<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/product', function () {
    return Product::where('product_status_id', 1)->orderBy('product_type_id')->with('productCompany', 'productStatus', 'productType',)->get();
});

Route::post('/store-transaction', function (Request $request) {

});

Route::post('/cek-api',function (Request $request){
    \App\Models\Log::create(['log'=>json_encode($request->all())]);
});
