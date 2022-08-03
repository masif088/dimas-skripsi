<?php

namespace App\Http\Livewire;

use App\Models\EmployeePayment;
use App\Models\PaymentMethod;
use App\Models\ProductCompany;
use App\Models\ProductType;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Product extends Component
{
    public $dataId;
    public $product;
    public $data;
    public $category;
    public $incomeThisMonth;
    public $incomePreviewMonth;

    public function mount()
    {
        $now = Carbon::now();
        $start = (new DateTime($now->format('Y-m-d')))->modify('first day of this month');
        $end = (new DateTime($now->format('Y-m-d')))->modify('first day of next month');

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($start, $interval, $end);
        $category1 = [];
        foreach ($period as $dt) {
            $this->incomeThisMonth[$dt->format("Y-m-d")] = 0;
            array_push($category1, $dt->format("Y-m-d"));
        }

        $query = "
SELECT date(transactions.created_at) as dateList,count(*) as counter,
SUM(transaction_details.price*transaction_details.amount) as total ,
  SUM(transactions.visitors) as visitors
FROM transactions
JOIN transaction_details ON transaction_details.transaction_id=transactions.id
WHERE month(transactions.created_at)=$now->month and
  year(transactions.created_at)=$now->year and
  transactions.status_order_id=2 and
  transaction_details.product_id=$this->dataId
GROUP BY date(transactions.created_at)";
        $g = DB::select(DB::raw($query));
        foreach ($g as $g1) {
            $this->incomeThisMonth[$g1->dateList] = $g1->total;
        }

        $now=$now->subMonth(1);
        $start = (new DateTime($now->format('Y-m-d')))->modify('first day of this month');
        $end = (new DateTime($now->format('Y-m-d')))->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($start, $interval, $end);
        $category2 = [];
        foreach ($period as $dt) {
            $this->incomePreviewMonth[$dt->format("Y-m-d")] = 0;
            array_push($category2, $dt->format("Y-m-d"));
        }
        if (count($category1)<count($category2)){
            $this->category=$category2;
        }else{
            $this->category=$category1;
        }

        $this->product = \App\Models\Product::find($this->dataId);
        $this->data=[
            'total'=>0,
            'amount'=>0
        ];
        foreach ($this->product->transactionDetails as $d){
            $this->data['total']+=$d->amount*$d->price;
            $this->data['amount']+=$d->amount;
        }


        $query = "
SELECT date(transactions.created_at) as dateList,count(*) as counter,
SUM(transaction_details.price*transaction_details.amount) as total ,
  SUM(transactions.visitors) as visitors
FROM transactions
JOIN transaction_details ON transaction_details.transaction_id=transactions.id
WHERE month(transactions.created_at)=$now->month and
  year(transactions.created_at)=$now->year and
  transactions.status_order_id=2 and
  transaction_details.product_id=$this->dataId
GROUP BY date(transactions.created_at)";
        $g = DB::select(DB::raw($query));
        foreach ($g as $g1) {
            $this->incomePreviewMonth[$g1->dateList] = $g1->total;
        }
//        dd($this->incomePreviewMonth);


    }

    public function render()
    {
        return view('livewire.product');
    }
}
