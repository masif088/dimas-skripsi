<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StockGood;
use Illuminate\Http\Request;

class StockGoodController extends Controller
{
    public function index(){
        $stock=StockGood::class;
        return view('pages.stock.index',compact('stock'));
    }
    public function create(){
        return view('pages.stock.create');
    }
    public function edit($id){
        return view('pages.stock.edit',compact('id'));
    }
    public function add($id){
        return view('pages.stock.add',compact('id'));
    }

}
