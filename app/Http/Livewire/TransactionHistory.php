<?php

namespace App\Http\Livewire;

use App\Models\PaymentMethod;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\Component;

class TransactionHistory extends Component
{
    public $date;
    public $transactionList;
    public $transactionDetail;
    public $productAmounts;
    public $productTotals;
    public $products;
    public $data;
    public $paymentMethod;
    public $money;

    public function mount()
    {
        $this->products=Product::get();
        $this->productAmounts=[];
        $this->productTotals=[];
        $this->paymentMethod=PaymentMethod::get();
        $this->money=[];
        $this->transactionList = \App\Models\Transaction::whereIn('status_order_id',[2,3])
            ->whereDate('created_at', $this->date)
            ->get();
        $total=0;
        $amount=0;
        foreach (\App\Models\Transaction::where('status_order_id',2)
                     ->whereDate('created_at', $this->date)
                     ->get() as $tl){
            foreach ($tl->transactionDetails as $td){
                $total += $td->price * $td->amount;
                $amount += $td->amount;
                if (isset($this->productAmounts[$td->product_id])){
                    $this->productAmounts[$td->product_id]+=$td->amount;
                    $this->productTotals[$td->product_id]+=$td->amount*$td->price;
                }else{
                    $this->productAmounts[$td->product_id]=$td->amount;
                    $this->productTotals[$td->product_id]=$td->amount*$td->price;
                }
                if (isset($this->money[$td->transaction->payment_method_id])) {
                    $this->money[$td->transaction->payment_method_id] += $td->price * $td->amount;
                } else {
                    $this->money[$td->transaction->payment_method_id] = $td->price * $td->amount;
                }
            }
        }
        $this->data['total']=array_sum($this->productTotals);
        $this->data['amount']=array_sum($this->productAmounts);
        $this->data['transaction']=$this->transactionList->count();
    }

    public function detail($id)
    {
        $this->transactionDetail = $this->transactionList->find($id);
    }

    public function render()
    {
        return view('livewire.transaction-history');
    }
}
