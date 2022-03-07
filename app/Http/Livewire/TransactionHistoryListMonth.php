<?php

namespace App\Http\Livewire;

use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\ProductCompany;
use App\Models\ProductType;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TransactionHistoryListMonth extends Component
{
    public $totalMonth;
    public $income;
    public $category;
    public $totalDay;
    public $month;
    public $year;
    public $transactions;
    public $productAmounts;
    public $productTotals;
    public $money;
    public $products;

    public function mount()
    {

        $this->totalMonth = 0;
        $monthly = \App\Models\Transaction::whereStatusOrderId(2)->whereMonth('created_at', $this->month)->whereYear('created_at', $this->year)->get();
        foreach ($monthly as $d) {
            foreach ($d->transactionDetails as $td) {
                $this->totalMonth += $td->amount * $td->price;
            }
        }
        $query = "
SELECT date(transactions.created_at) as dateList,count(*) as counter,
SUM(transaction_details.price*transaction_details.amount) as total
FROM transactions
JOIN transaction_details ON transaction_details.transaction_id=transactions.id
WHERE month(transactions.created_at)=$this->month and
  year(transactions.created_at)=$this->year and
  transactions.status_order_id=2
GROUP BY date(transactions.created_at)";
        $g = DB::select(DB::raw($query));
        $this->income = [];
        $now = Carbon::create($this->year,$this->month,1);
        $start = (new DateTime($now->format('Y-m-d')))->modify('first day of this month');
        $end = (new DateTime($now->format('Y-m-d')))->modify('first day of next month');

//        dd($this->transactions);
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($start, $interval, $end);
        $this->category = [];
        foreach ($period as $dt) {
            $this->income[$dt->format("Y-m-d")] = 0;
            array_push($this->category, $dt->format("Y-m-d"));
        }
        foreach ($g as $g1) {
            $this->income[$g1->dateList] = $g1->total;
        }
        $this->transactions=\App\Models\Transaction::where('status_order_id',2)->whereBetween('created_at',[$start->format('Y-m-d'),$end->format('Y-m-d')])->get();
        $this->productAmounts=[];
        $this->productTotals=[];
        $total=0;
        $amount=0;
        $this->products=Product::get();
        foreach ($this->transactions as $tl){
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
    }

    public function render()
    {
        return view('livewire.transaction-history-list-month');
    }

}
