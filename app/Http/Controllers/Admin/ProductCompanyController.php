<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCompany;
use Illuminate\Http\Request;

class ProductCompanyController extends Controller
{
    public function index(){
        $productCompany=ProductCompany::class;
        return view('pages.product-company.index',compact('productCompany'));
    }
    public function create(){
        return view('pages.product-company.create');
    }
    public function edit($id){
        return view('pages.product-company.edit',compact('id'));
    }
    public function destroy($id){
        ProductCompany::find($id)->delete();
        return redirect(route('admin.product-company.index'));
    }
}
