<?php

use App\Http\Controllers\Admin\ProductCompanyController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductTypeController;
use App\Http\Controllers\Admin\ShiftController;
use App\Http\Controllers\Admin\StockGoodController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\SupportController;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Http\Controllers\CurrentTeamController;
use Laravel\Jetstream\Http\Controllers\Livewire\ApiTokenController;
use Laravel\Jetstream\Http\Controllers\Livewire\TeamController;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;
use Laravel\Jetstream\Jetstream;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('login'));
});
Route::get('/dashboard', function () {
    return redirect(route('admin.dashboard'));
});

Route::get('/user/profile', function () {
    return redirect(route('profile.show'));
})->name('profile.show');
Route::post('/summernote', [SupportController::class, 'upload'])->name('summernote');
Route::middleware(['auth:sanctum'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('dashboard', function () {
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');
        $totalDay = 0;
        $day = Transaction::whereStatusOrderId(2)->whereDate('created_at', Carbon::now())->get();
        foreach ($day as $d) {
            foreach ($d->transactionDetails as $td) {
                $totalDay += $td->amount * $td->price;
            }
        }
        $totalWeek = 0;
        $week = Transaction::whereStatusOrderId(2)->whereBetween('created_at', [$weekStartDate, $weekEndDate])->get();
        foreach ($week as $d) {
            foreach ($d->transactionDetails as $td) {
                $totalWeek += $td->amount * $td->price;
            }
        }
        $totalMonth = 0;
        $monthly = Transaction::whereStatusOrderId(2)->whereMonth('created_at', Carbon::now())->get();

        foreach ($monthly as $d) {
            foreach ($d->transactionDetails as $td) {
                $totalMonth += $td->amount * $td->price;
            }
        }
        $month = date('n');
        $query = "
SELECT day(transactions.created_at) as dateList,count(*) as counter,
SUM(transaction_details.price*transaction_details.amount) as total
FROM transactions
JOIN transaction_details ON transaction_details.transaction_id=transactions.id
WHERE month(transactions.created_at)=$month and
 transactions.status_order_id=2
GROUP BY day(transactions.created_at)";
        $g = DB::select(DB::raw($query));
        $income = [];
        $now = Carbon::now();
        $start = (new DateTime($now->format('Y-m-d')))->modify('first day of this month');
        $end = (new DateTime($now->format('Y-m-d')))->modify('first day of next month');

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($start, $interval, $end);
        $category = [];
        foreach ($period as $dt) {
            $income[$dt->format("d")] = 0;
            array_push($category, $dt->format("d"));
        }
        foreach ($g as $g1) {
            $income[$g1->dateList] = $g1->total;
        }

        $month-=1;
        $query = "
SELECT day(transactions.created_at) as dateList,count(*) as counter,
SUM(transaction_details.price*transaction_details.amount) as total
FROM transactions
JOIN transaction_details ON transaction_details.transaction_id=transactions.id
WHERE month(transactions.created_at)=$month and
 transactions.status_order_id=2
GROUP BY day(transactions.created_at)";
        $g = DB::select(DB::raw($query));
        $income2 = [];
        $now = Carbon::now();
        $start = (new DateTime($now->format('Y-m-d')))->modify('first day of this month');
        $end = (new DateTime($now->format('Y-m-d')))->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($start, $interval, $end);
        $category = [];
        foreach ($period as $dt) {
            $income2[$dt->format("d")] = 0;
        }
        foreach ($g as $g1) {
            $income2[$g1->dateList] = $g1->total;
        }

        $donate=$monthly->sum('donate');
        return view('pages.dashboard.index', compact('income2','totalDay', 'totalMonth', 'totalWeek', 'category', 'income','donate'));
    })->name('dashboard');

    Route::get('transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('transaction/download-employee-payment',[TransactionController::class,'download'])->name('transaction.download');
    Route::get('transaction/active', [TransactionController::class, 'active'])->name('transaction.active');
    Route::get('transaction/history', [TransactionController::class, 'history'])->name('transaction.history');
    Route::get('transaction/history/{date}', [TransactionController::class, 'historyDetail'])->name('transaction.history-detail');
    Route::get('transaction/history/month/{month}/year/{year}', function ($month, $year) {
        return view('pages.transaction.history-list-month', compact('month', 'year'));
    })->name('transaction.history-detail-month');
    Route::get('transaction/struck/{id}', [TransactionController::class, 'struck'])->name('transaction.struck');
    Route::get('transaction/struck-kitchen/{id}', [TransactionController::class, 'struckKitchen'])->name('transaction.struck-kitchen');

    Route::resource('stock', StockGoodController::class)->only('index', 'create', 'edit');
    Route::resource('supplier', SupplierController::class)->only('index', 'create', 'edit', 'destroy');
    Route::get('stock/add/{id}', [StockGoodController::class, 'add'])->name('stock.add');
    Route::resource('product-type', ProductTypeController::class)->only('index', 'create', 'edit', 'destroy');
    Route::resource('product-company', ProductCompanyController::class)->only('index', 'create', 'edit', 'destroy');
    Route::resource('product', ProductController::class)->only('index', 'create', 'edit','show', 'destroy');

//    Route::resource('shift', ShiftController::class)->only()


    Route::group(['middleware' => config('jetstream.middleware', ['web'])], function () {
        Route::group(['middleware' => ['auth', 'verified']], function () {
            // User & Profile...
            Route::get('/user/profile', [UserProfileController::class, 'show'])
                ->name('profile.show');

            // API...
            if (Jetstream::hasApiFeatures()) {
                Route::get('/user/api-tokens', [ApiTokenController::class, 'index'])->name('api-tokens.index');
            }

            // Teams...
            if (Jetstream::hasTeamFeatures()) {
                Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
                Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show');
                Route::put('/current-team', [CurrentTeamController::class, 'update'])->name('current-team.update');
            }
        });
    });
});
