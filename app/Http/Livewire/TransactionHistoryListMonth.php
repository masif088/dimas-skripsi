<?php

namespace App\Http\Livewire;

use App\Models\PaymentMethod;
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
    public $totalWeek;
    public $income;
    public $category;
    public $totalDay;
    public $month;
    public $year;

    public function mount()
    {
        $this->historyList = [];
//        $this->method = PaymentMethod::get();
//        $this->type = ProductType::get();
//        $this->company = ProductCompany::get();
//        $hls = DB::select(DB::raw('SELECT month(created_at) as monthList,year(created_at) as yearList,count(*) as counter FROM transactions where status_order_id=2 GROUP BY YEAR(created_at), MONTH(created_at);'));
//        foreach ($hls as $hl) {
//            $hl = json_decode(json_encode($hl), true);
//            array_push($this->historyList, $hl);
//        }
        $this->setDetail(0);
    }

    public function render()
    {
        return view('livewire.transaction-history-list-month');
    }
public $some;
    public function setDetail($key)
    {
        $month = $this->month;
        $year = $this->year;
        $this->totalMonth = 0;
        $monthly = \App\Models\Transaction::whereStatusOrderId(2)->whereMonth('created_at', $month)->whereYear('created_at', $year)->get();
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
WHERE month(transactions.created_at)=$month and
  year(transactions.created_at)=$year and
  transactions.status_order_id=2
GROUP BY date(transactions.created_at)";
        $g = DB::select(DB::raw($query));
        $this->income = [];
        $now = Carbon::create($year,$month,1);
        $start = (new DateTime($now->format('Y-m-d')))->modify('first day of this month');
        $end = (new DateTime($now->format('Y-m-d')))->modify('first day of next month');
//        dd($start);
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($start, $interval, $end);
        $category = [];
        foreach ($period as $dt) {
            $this->income[$dt->format("Y-m-d")] = 0;
            array_push($category, $dt->format("Y-m-d"));
        }
        foreach ($g as $g1) {
            $this->income[$g1->dateList] = $g1->total;
        }
//        dd($income);
    }
}
