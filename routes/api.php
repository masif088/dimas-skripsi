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
    $re='{"arrKey":[{"amount":1,"description":null,"discount_price":7200,"discount_state":0,"id":99,"price":9000,"product_code":"Kopi Tubruk Arabika","product_company_id":5,"product_status_id":1,"product_type_id":8,"thumbnail":"null","title":"Kopi Tubruk Arabika","updated_at":"2022-05-08T13:49:04.000000Z"},{"amount":1,"description":null,"discount_price":5400,"discount_state":0,"id":100,"price":6000,"product_code":"Kopi Tubruk Robusta","product_company_id":5,"product_status_id":1,"product_type_id":8,"thumbnail":"null","title":"Kopi Tubruk Robusta","updated_at":"2022-03-04T23:40:26.000000Z"},{"amount":1,"description":null,"discount_price":9000,"discount_state":0,"id":101,"price":10000,"product_code":"Kopi Susu Tubruk Arabica","product_company_id":5,"product_status_id":1,"product_type_id":8,"thumbnail":"null","title":"Kopi Susu Tubruk Arabica","updated_at":"2022-03-04T23:40:13.000000Z"},{"amount":1,"description":null,"discount_price":7200,"discount_state":0,"id":102,"price":8000,"product_code":"Kopi Tubruk Susu Robusta","product_company_id":5,"product_status_id":1,"product_type_id":8,"thumbnail":"null","title":"Kopi Tubruk Susu Robusta","updated_at":"2022-03-04T23:40:03.000000Z"}]}';
    dd(json_decode($re));
//    \App\Models\Log::create(['log'=>json_encode($request->all())]);
});

Route::get('/cek-api-a',function (Request $request){
    $re='{"arrKey":[{"amount":1,"description":null,"discount_price":7200,"discount_state":0,"id":99,"price":9000,"product_code":"Kopi Tubruk Arabika","product_company_id":5,"product_status_id":1,"product_type_id":8,"thumbnail":"null","title":"Kopi Tubruk Arabika","updated_at":"2022-05-08T13:49:04.000000Z"},{"amount":1,"description":null,"discount_price":5400,"discount_state":0,"id":100,"price":6000,"product_code":"Kopi Tubruk Robusta","product_company_id":5,"product_status_id":1,"product_type_id":8,"thumbnail":"null","title":"Kopi Tubruk Robusta","updated_at":"2022-03-04T23:40:26.000000Z"},{"amount":1,"description":null,"discount_price":9000,"discount_state":0,"id":101,"price":10000,"product_code":"Kopi Susu Tubruk Arabica","product_company_id":5,"product_status_id":1,"product_type_id":8,"thumbnail":"null","title":"Kopi Susu Tubruk Arabica","updated_at":"2022-03-04T23:40:13.000000Z"},{"amount":1,"description":null,"discount_price":7200,"discount_state":0,"id":102,"price":8000,"product_code":"Kopi Tubruk Susu Robusta","product_company_id":5,"product_status_id":1,"product_type_id":8,"thumbnail":"null","title":"Kopi Tubruk Susu Robusta","updated_at":"2022-03-04T23:40:03.000000Z"}]}';
    $a=json_decode($re);
//    \App\Models\Log::create(['log'=>json_encode($request->all())]);
});
