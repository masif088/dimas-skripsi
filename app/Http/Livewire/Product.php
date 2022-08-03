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
    public $incomePreviousMonth;
    public $income2PreviousMonth;
    public $saleThisMonth;
    public $salePreviousMonth;
    public $sale2PreviousMonth;
    public $revenueThisMonth=0;
    public $revenuePreviousMonth=0;
    public $revenue2PreviousMonth=0;
    public $amountThisMonth=0;
    public $amountPreviousMonth=0;
    public $amount2PreviousMonth=0;

    public function mount()
    {
        $now = Carbon::now();
        $start = (new DateTime($now->format('Y-m-d')))->modify('first day of this month');
        $end = (new DateTime($now->format('Y-m-d')))->modify('first day of next month');

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($start, $interval, $end);
        $category1 = [];
        foreach ($period as $dt) {
            $this->incomeThisMonth[intval($dt->format("d"))] = 0;
            $this->saleThisMonth[intval($dt->format("d"))] = 0;
            array_push($category1, intval($dt->format("d")));
        }

        $query = "
SELECT day(transactions.created_at) as dateList,count(*) as counter,
SUM(transaction_details.price*transaction_details.amount) as total ,
  SUM(transaction_details.amount) as amount ,
  SUM(transactions.visitors) as visitors
FROM transactions
JOIN transaction_details ON transaction_details.transaction_id=transactions.id
WHERE month(transactions.created_at)=$now->month and
  year(transactions.created_at)=$now->year and
  transactions.status_order_id=2 and
  transaction_details.product_id=$this->dataId
GROUP BY day(transactions.created_at)";
        $g = DB::select(DB::raw($query));
        foreach ($g as $g1) {
            $this->incomeThisMonth[$g1->dateList] = $g1->total;
            $this->saleThisMonth[$g1->dateList] = $g1->amount;
            $this->revenueThisMonth+=$g1->total;
            $this->amountThisMonth+=$g1->amount;

        }

        $now=$now->subMonth();
        $start = (new DateTime($now->format('Y-m-d')))->modify('first day of this month');
        $end = (new DateTime($now->format('Y-m-d')))->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($start, $interval, $end);
        $category2 = [];
        foreach ($period as $dt) {
            $this->incomePreviousMonth[intval($dt->format("d"))] = 0;
            $this->salePreviousMonth[intval($dt->format("d"))] = 0;
            array_push($category2, intval($dt->format("d")));
        }
        $query = "
SELECT day(transactions.created_at) as dateList,count(*) as counter,
SUM(transaction_details.price*transaction_details.amount) as total ,
  SUM(transaction_details.amount) as amount ,
  SUM(transactions.visitors) as visitors
FROM transactions
JOIN transaction_details ON transaction_details.transaction_id=transactions.id
WHERE month(transactions.created_at)=$now->month and
  year(transactions.created_at)=$now->year and
  transactions.status_order_id=2 and
  transaction_details.product_id=$this->dataId
GROUP BY day(transactions.created_at)";
        $g = DB::select(DB::raw($query));
        foreach ($g as $g1) {
            $this->incomePreviousMonth[$g1->dateList] = $g1->total;
            $this->salePreviousMonth[$g1->dateList] = $g1->amount;
            $this->revenuePreviousMonth+=$g1->total;
            $this->amountPreviousMonth+=$g1->amount;
        }

        $now=$now->subMonth();
        $start = (new DateTime($now->format('Y-m-d')))->modify('first day of this month');
        $end = (new DateTime($now->format('Y-m-d')))->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($start, $interval, $end);
        foreach ($period as $dt) {
            $this->income2PreviousMonth[intval($dt->format("d"))] = 0;
            $this->sale2PreviousMonth[intval($dt->format("d"))] = 0;
        }
        $query = "
SELECT day(transactions.created_at) as dateList,count(*) as counter,
SUM(transaction_details.price*transaction_details.amount) as total ,
  SUM(transaction_details.amount) as amount ,
  SUM(transactions.visitors) as visitors
FROM transactions
JOIN transaction_details ON transaction_details.transaction_id=transactions.id
WHERE month(transactions.created_at)=$now->month and
  year(transactions.created_at)=$now->year and
  transactions.status_order_id=2 and
  transaction_details.product_id=$this->dataId
GROUP BY day(transactions.created_at)";
        $g = DB::select(DB::raw($query));
        foreach ($g as $g1) {
            $this->income2PreviousMonth[$g1->dateList] = $g1->total;
            $this->sale2PreviousMonth[$g1->dateList] = $g1->amount;
            $this->revenue2PreviousMonth+=$g1->total;
            $this->amount2PreviousMonth+=$g1->amount;
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

    }


    public function render()
    {
        return view('livewire.product');
    }
}
