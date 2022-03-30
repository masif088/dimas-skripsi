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
    public $type;
    public $company;
    public $datas;

    public $tdactions;
    public $productAmounts;
    public $productTotals;
    public $money;
    public $products;
    public $product;
    public $method;

    public $visitorCount;
    public $tdactionCount;

    public $dayOfWeekMoney;
    public $dayOfWeekVisitor;
    public $dayOfWeekItem;
    public $dayOfWeekTransaction;

    public $dayMoney;
    public $dayVisitor;
    public $dayItem;
    public $dayTransaction;

    public function mount()
    {
        $this->method = PaymentMethod::get();
        $this->type = ProductType::get();
        $this->company = ProductCompany::get();
        $this->totalMonth = 0;
        $monthly = \App\Models\Transaction::whereStatusOrderId(2)->whereMonth('created_at', $this->month)->whereYear('created_at', $this->year)->get();
        foreach ($monthly as $d) {
            foreach ($d->transactionDetails as $td) {
                $this->totalMonth += $td->amount * $td->price;
            }
        }
        $query = "
SELECT date(transactions.created_at) as dateList,count(*) as counter,
SUM(transaction_details.price*transaction_details.amount) as total ,
  SUM(transactions.visitors) as visitors
FROM transactions
JOIN transaction_details ON transaction_details.transaction_id=transactions.id
WHERE month(transactions.created_at)=$this->month and
  year(transactions.created_at)=$this->year and
  transactions.status_order_id=2
GROUP BY date(transactions.created_at)";
        $g = DB::select(DB::raw($query));
        $this->income = [];
        $now = Carbon::create($this->year, $this->month, 1);
        $start = (new DateTime($now->format('Y-m-d')))->modify('first day of this month');
        $end = (new DateTime($now->format('Y-m-d')))->modify('first day of next month');

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($start, $interval, $end);
        $this->category = [];
        foreach ($period as $dt) {
            $this->income[$dt->format("Y-m-d")] = 0;
            array_push($this->category, $dt->format("Y-m-d"));
        }
        foreach ($g as $g1) {
            $this->income[$g1->dateList] = $g1->total;
            $this->visitorCount = $g1->visitors;
            $this->transactionCount = $g1->counter;
        }
        $this->transactions = \App\Models\Transaction::where('status_order_id', 2)->whereBetween('created_at', [$start->format('Y-m-d'), $end->format('Y-m-d')])->get();
        $this->productAmounts = [];
        $this->productTotals = [];
        $total = 0;
        $amount = 0;
        $this->products = Product::get();
        $product = [];

        $query = "SELECT DAYOFWEEK(transactions.created_at) as days,
       sum(transaction_details.amount*transaction_details.price) as total
FROM `transactions` JOIN transaction_details ON transaction_details.transaction_id=transactions.id
WHERE transactions.status_order_id=2 and
month(transactions.created_at)= month(NOW())
group BY DAYOFWEEK(transactions.created_at)";
        $dow = DB::select(DB::raw($query));
        $b = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0,];
        foreach ($dow as $d) {
            $b[$d->days] = $d->total;
        }
        $this->dayOfWeekMoney['Bulan ini'] = $b;

        $query = "SELECT DAYOFWEEK(created_at) as days,
       sum(visitors) as total
FROM `transactions`
WHERE status_order_id=2 and
month(created_at)= month(NOW())
group BY DAYOFWEEK(created_at)";
        $dow = DB::select(DB::raw($query));
        $b = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0,];
        foreach ($dow as $d) {
            $b[$d->days] = $d->total;
        }
        $this->dayOfWeekVisitor['Bulan ini'] = $b;

        $query = "SELECT DAYOFWEEK(transactions.created_at) as days,
       sum(transaction_details.amount) as total
FROM `transactions` JOIN transaction_details ON transaction_details.transaction_id=transactions.id
WHERE transactions.status_order_id=2 and
month(transactions.created_at)= month(NOW())
group BY DAYOFWEEK(transactions.created_at)";
        $dow = DB::select(DB::raw($query));
        $b = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0,];
        foreach ($dow as $d) {
            $b[$d->days] = $d->total;
        }
        $this->dayOfWeekItem['Bulan ini'] = $b;

        $query = "SELECT DAYOFWEEK(created_at) as days,
       count(id) as total
FROM `transactions`
WHERE status_order_id=2 and
month(created_at)= month(NOW())
group BY DAYOFWEEK(created_at)";
        $dow = DB::select(DB::raw($query));
        $b = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0,];
        foreach ($dow as $d) {
            $b[$d->days] = $d->total;
        }
        $this->dayOfWeekTransaction['Bulan ini'] = $b;


        $query = "
        SELECT DAYOFWEEK(transactions.created_at) as days,
               DATE(transactions.created_at) as dates,
               WEEK(transactions.created_at) as weeks,
               SUM(transaction_details.amount*transaction_details.price) as total
        FROM `transactions`
            JOIN transaction_details ON transaction_details.transaction_id=transactions.id
        WHERE transactions.status_order_id=2 and
              MONTH(transactions.created_at) = month(NOW())
        GROUP BY days, weeks, dates
        ORDER BY weeks, days";
        $dow = DB::select(DB::raw($query));
        $b = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0,];
        $w=0;
        $w0=1;
        foreach ($dow as $d) {
            if ($w!=$d->weeks){
                if ($w!=0){
                    $this->dayMoney['Minggu ke-'. $w0] = $b;
                    $w0+=1;
                }
                $b = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0,];
                $w=$d->weeks;
            }
            $b[$d->days] = intval($d->total);
        }
        $this->dayMoney['Minggu ke-'. $w0] = $b;

        $query = "
        SELECT DAYOFWEEK(transactions.created_at) as days,
               DATE(transactions.created_at) as dates,
               WEEK(transactions.created_at) as weeks,
               SUM(transaction_details.amount) as total
        FROM `transactions`
            JOIN transaction_details ON transaction_details.transaction_id=transactions.id
        WHERE transactions.status_order_id=2 and
              MONTH(transactions.created_at) = month(NOW())
        GROUP BY days, weeks, dates
        ORDER BY weeks, days";
        $dow = DB::select(DB::raw($query));
        $b = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0,];
        $w=0;
        $w0=1;
        foreach ($dow as $d) {
            if ($w!=$d->weeks){
                if ($w!=0){
                    $this->dayItem['Minggu ke-'. $w0] = $b;
                    $w0+=1;
                }
                $b = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0,];
                $w=$d->weeks;
            }
            $b[$d->days] = intval($d->total);
        }
        $this->dayItem['Minggu ke-'. $w0] = $b;

        $query = "
        SELECT DAYOFWEEK(transactions.created_at) as days,
               DATE(transactions.created_at) as dates,
               WEEK(transactions.created_at) as weeks,
               SUM(transactions.visitors) as total
        FROM `transactions`
        WHERE transactions.status_order_id=2 and
              MONTH(transactions.created_at) = month(NOW())
        GROUP BY days, weeks, dates
        ORDER BY weeks, days";
        $dow = DB::select(DB::raw($query));
        $b = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0,];
        $w=0;
        $w0=1;
        foreach ($dow as $d) {
            if ($w!=$d->weeks){
                if ($w!=0){
                    $this->dayVisitor['Minggu ke-'. $w0] = $b;
                    $w0+=1;
                }
                $b = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0,];
                $w=$d->weeks;
            }
            $b[$d->days] = intval($d->total);
        }
        $this->dayVisitor['Minggu ke-'. $w0] = $b;

        $query = "
        SELECT DAYOFWEEK(transactions.created_at) as days,
               DATE(transactions.created_at) as dates,
               WEEK(transactions.created_at) as weeks,
               count(transactions.id) as total
        FROM `transactions`
        WHERE transactions.status_order_id=2 and
              MONTH(transactions.created_at) = month(NOW())
        GROUP BY days, weeks, dates
        ORDER BY weeks, days";
        $dow = DB::select(DB::raw($query));
        $b = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0,];
        $w=0;
        $w0=1;
        foreach ($dow as $d) {
            if ($w!=$d->weeks){
                if ($w!=0){
                    $this->dayTransaction['Minggu ke-'. $w0] = $b;
                    $w0+=1;
                }
                $b = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0,];
                $w=$d->weeks;
            }
            $b[$d->days] = intval($d->total);
        }
        $this->dayTransaction['Minggu ke-'. $w0] = $b;



        foreach ($this->transactions as $tl) {
            foreach ($tl->transactionDetails as $td) {
                $total += $td->price * $td->amount;
                $amount += $td->amount;
                if (isset($product['type'][$td->product->product_type_id][$td->product_id])) {
                    $product['type'][$td->product->product_type_id][$td->product_id] += $td->amount;
                    $product['company'][$td->product->product_company_id][$td->product_id] += $td->amount;
                } else {
                    $product['type'][$td->product->product_type_id][$td->product_id] = $td->amount;
                    $product['company'][$td->product->product_company_id][$td->product_id] = $td->amount;
                }
                if (isset($product['payment_method'][$td->transaction->payment_method_id])) {
                    $product['payment_method'][$td->transaction->payment_method_id] += $td->price * $td->amount;
                } else {
                    $product['payment_method'][$td->transaction->payment_method_id] = $td->price * $td->amount;
                }
                if (isset($this->productAmounts[$td->product_id])) {
                    $this->productAmounts[$td->product_id] += $td->amount;
                    $this->productTotals[$td->product_id] += $td->amount * $td->price;
                } else {
                    $this->productAmounts[$td->product_id] = $td->amount;
                    $this->productTotals[$td->product_id] = $td->amount * $td->price;
                }
                if (isset($this->money[$td->transaction->payment_method_id])) {
                    $this->money[$td->transaction->payment_method_id] += $td->price * $td->amount;
                } else {
                    $this->money[$td->transaction->payment_method_id] = $td->price * $td->amount;
                }
            }
        }
        $this->datas['total'] = $total;
        $this->datas['amount'] = $amount;
        $this->datas['product'] = $product;
//        $this->datas['visitor']=$transactions->sum('visitors');
    }

    public function render()
    {
        return view('livewire.transaction-history-list-month');
    }

}
