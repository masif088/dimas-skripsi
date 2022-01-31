<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(){
        $supplier=Supplier::class;
        return view('pages.supplier.index',compact('supplier'));
    }
    public function create(){
        return view('pages.supplier.create');
    }
    public function edit($id){
        return view('pages.supplier.edit',compact('id'));
    }
    public function destroy($id){

    }
}
