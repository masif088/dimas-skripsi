<?php

namespace App\Http\Livewire;

use App\Models\PaymentMethod;
use App\Models\ProductCompany;
use App\Models\ProductType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TransactionHistoryList extends Component
{
    public $historyList;
    public $type;
    public $company;
    public $keyHistory;
    public $keyState = 0;
    public $datas;
    public $method;

    public function mount()
    {
        $this->method = PaymentMethod::get();
        $this->type = ProductType::get();
        $this->company = ProductCompany::get();
        $hls = DB::select(DB::raw('SELECT date(created_at) as dateList,count(*) as counter FROM transactions where status_order_id=2 group by date(created_at)'));
        $this->historyList = [];

        foreach ($hls as $hl) {
            $hl = json_decode(json_encode($hl), true);
            array_push($this->historyList, $hl);
        }
    }

    public function getTurnover()
    {


//dd(array_key_first($this->datas['product']['type'][1]));
    }

    public function setDetail($id)
    {
        $this->keyHistory = $id;
        $this->keyState = 1;
        $transactions = \App\Models\Transaction::whereDate('created_at', $this->historyList[$this->keyHistory]['dateList'])
            ->whereStatusOrderId(2)
            ->get();
        $total = 0;
        $amount = 0;
        $product = [];
        foreach ($transactions as $transaction) {
            foreach ($transaction->transactionDetails as $trans) {
                $total += $trans->price * $trans->amount;
                $amount += $trans->amount;
                if (isset($product['type'][$trans->product->product_type_id][$trans->product_id])) {
                    $product['type'][$trans->product->product_type_id][$trans->product_id] += $trans->amount;
                    $product['company'][$trans->product->product_company_id][$trans->product_id] += $trans->amount;
                } else {
                    $product['type'][$trans->product->product_type_id][$trans->product_id] = $trans->amount;
                    $product['company'][$trans->product->product_company_id][$trans->product_id] = $trans->amount;
                }
                if (isset($product['payment_method'][$trans->transaction->payment_method_id])) {
                    $product['payment_method'][$trans->transaction->payment_method_id] += $trans->price * $trans->amount;
                } else {
                    $product['payment_method'][$trans->transaction->payment_method_id] = $trans->price * $trans->amount;
                }
            }
        }
        foreach ($this->type as $t) {
            if (isset($product['type'][$t->id])) {
                arsort($product['type'][$t->id]);
            }
        }
        foreach ($this->company as $t) {
            if (isset($product['company'][$t->id])) {
                arsort($product['company'][$t->id]);
            }
        }

        $this->datas['total'] = $total;
        $this->datas['amount'] = $amount;
        $this->datas['product'] = $product;
    }

    public function render()
    {
        return view('livewire.transaction-history-list');
    }
}
