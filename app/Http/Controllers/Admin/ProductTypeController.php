<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    public function index(){
        $productType=ProductType::class;
        return view('pages.product-type.index',compact('productType'));
    }
    public function create(){
        return view('pages.product-type.create');
    }
    public function edit($id){
        return view('pages.product-type.edit',compact('id'));
    }
    public function destroy($id){
        ProductType::find($id)->delete();
        return redirect(route('admin.product-type.index'));
    }
}
