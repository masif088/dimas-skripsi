<?php

namespace App\Http\Livewire\Table;

class Product extends Main
{
    public $status;
    public function statusOnChange($id,$status){
        \App\Models\Product::find($id)->update(['product_status_id'=>$status]);
    }

    public function statusOnChangeSelfTransaction($id,$status){
        \App\Models\Product::find($id)->update(['self_transaction_status'=>$status]);
    }
}
