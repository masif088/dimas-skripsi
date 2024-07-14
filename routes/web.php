<?php

use App\Http\Controllers\Admin\ProductCompanyController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductTypeController;
use App\Http\Controllers\Admin\StockGoodController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\SupportController;
use App\Models\Forecast;
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
//    $a = 0.18;
//    $b = 0.08;
//    $g = 1;
//    $d = 1;
//    for ($year = 2022; $year < 2024; $year++) {
//        for ($month = 0; $month < 12; $month++) {
//            $m = $month;
//            $y = $year;
//            if ($month == 0) {
//                $m = 12;
//                $y -= 1;
//            }
//
//            $forecastLastMonth = Forecast::where('month', $m)->where('year', $y)->first();
//            $forecastYear = Forecast::where('month', $month + 1)->where('year', $year - 1)->first();
//            $forecast = Forecast::where('month', $month + 1)->where('year', $year)->first();
//
//            $level = $a * ($forecast->amount / $forecastYear->seasonal) + (1 - $a) * ($forecastLastMonth->level + $forecastLastMonth->trend);
//            $trend = $b * ($level - $forecastLastMonth->level) + (1 - $b) * $forecastLastMonth->trend;
//            $seasonal = $g * ($forecast->amount / $level) + (1 - $g) * $forecastYear->seasonal;
//            $forecastValue = ($forecastLastMonth->level + $d * $forecastLastMonth->trend) * $forecastYear->seasonal;
//            $forecast->update([
//                'level' => $level,
//                'trend' => $trend,
//                'seasonal' => $seasonal,
//                'forecast' => $forecastValue,
//                'error' => abs(($forecast->amount - $forecastValue) / $forecast->amount)
//            ]);
//        }
//    }
//    $forecastLast = Forecast::whereNotNull('amount')
//        ->whereNotNull('level')
//        ->whereNotNull('trend')
//        ->whereNotNull('seasonal')
//        ->orderByDesc('year')
//        ->orderByDesc('month')
//        ->first();
//
//    for ($year = 2024; $year < 2026; $year++) {
//        for ($month = 0; $month < 12; $month++) {
//            $forecastLastMonth = Forecast::whereNotNull('amount')
//                ->whereNotNull('level')
//                ->whereNotNull('trend')
//                ->whereNotNull('seasonal')
//                ->where('month', $month + 1)
//                ->orderByDesc('year')
//                ->first();
//
//            $d = (($year - $forecastLast->year) * 12) + (($month + 1) - $forecastLast->month);
//
//            $forecastValue = ($forecastLast->level + $d * $forecastLast->trend) * $forecastLastMonth->seasonal;
//            $forecastNow = Forecast::where('month', $month + 1)->where('year', $year)->first();
//            if ($forecastNow != null) {
//                $forecastNow->update([
//                    'forecast' => $forecastValue,
//                ]);
//            } else {
//                Forecast::create([
//                    'year' => $year,
//                    'month' => $month + 1,
//                    'forecast' => $forecastValue,
//                ]);
//            }
//        }
//    }
    return redirect(route('self-transaction','dGFucGEga2V0ZXJhbmdhbg=='));
});
//Route::get('/base64', function () {
////    \BaconQrCode\Encoder\QrCode::png('');
//
//
////$writer->writeFile('Hello World!', 'qrcode.png');
//    $listOfTable = [
//        'Atas Luar 1',
//        'Atas Luar 2',
//        'Atas Dalam 1',
//        'Atas Dalam 2',
//        'Atas Dalam 3',
//        'Atas Dalam 4',
//        'Atas Dalam 5',
//
//        'Bawah Dalam 1',
//        'Bawah Dalam 2',
//        'Bawah Dalam 3',
//
//        'Bawah Luar 1',
//        'Bawah Luar 2',
//    ];
//
//    return view('qrcode', compact('listOfTable'));
//
//});
//
//Route::get('/base32', function () {
//
//    $listOfTable = [
//        'Atas Luar 1',
//        'Atas Luar 2',
//        'Atas Dalam 1',
//        'Atas Dalam 2',
//        'Atas Dalam 3',
//        'Atas Dalam 4',
//        'Atas Dalam 5',
//
//        'Bawah Dalam 1',
//        'Bawah Dalam 2',
//        'Bawah Dalam 3',
//
//        'Bawah Luar 1',
//        'Bawah Luar 2',
//    ];
//    $listOfCode = [
//        'AL1',
//        'AL2',
//        'AD1',
//        'AD2',
//        'AD3',
//        'AD4',
//        'AD5',
//        'BD1',
//        'BD2',
//        'BD3',
//        'BL1',
//        'BL2',
//    ];
//    $pdf = App::make('dompdf.wrapper');
//    $view = "pdf-export.qrcode";
//    $pdf->loadView($view, compact('listOfTable','listOfCode'))->setPaper('a4');
//    return $pdf->stream("qrcode.pdf");
//});


Route::get('/self-transaction/{tableCode}', function ($tableCode) {
    try {
        $decrypted_string = base64_decode($tableCode);
    } catch (Exception $exception) {
        abort(403, 'Kode meja tidak sesuai');
    }
    return view('layouts.home', compact('decrypted_string'));
})->name('self-transaction');

Route::get('/dashboard', function () {
    return redirect(route('admin.dashboard'));
});

Route::get('/user/profile', function () {
    return redirect(route('profile.show'));
})->name('profile.show');
Route::post('/summernote', [SupportController::class, 'upload'])
    ->name('summernote');
Route::middleware(['auth:sanctum'])->name('admin.')->prefix('admin')
    ->group(function () {
        Route::get('dashboard', function () {
            $now = Carbon::now();
            $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
            $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');
            $totalDay = 0;
            $day = Transaction::whereStatusOrderId(2)
                ->whereDate('created_at', Carbon::now())->get();
            foreach ($day as $d) {
                foreach ($d->transactionDetails as $td) {
                    $totalDay += $td->amount * $td->price;
                }
            }
            $totalWeek = 0;
            $week = Transaction::whereStatusOrderId(2)
                ->whereBetween('created_at', [$weekStartDate, $weekEndDate])
                ->get();
            foreach ($week as $d) {
                foreach ($d->transactionDetails as $td) {
                    $totalWeek += $td->amount * $td->price;
                }
            }
            $totalMonth = 0;
            $monthly = Transaction::whereStatusOrderId(2)
                ->whereMonth('created_at', Carbon::now())
                ->whereYear('created_at', Carbon::now())
                ->get();

            foreach ($monthly as $d) {
                foreach ($d->transactionDetails as $td) {
                    $totalMonth += $td->amount * $td->price;
                }
            }
            $month = date('n');
            $year = $now->year;
            $query = "
SELECT day(transactions.created_at) as dateList, sum(amount) as counter,
SUM(transaction_details.price*transaction_details.amount) as total
FROM transactions
JOIN transaction_details ON transaction_details.transaction_id=transactions.id
WHERE month(transactions.created_at)=$month and year(transactions.created_at)=$year  and
 transactions.status_order_id=2
GROUP BY day(transactions.created_at)";
            $g = DB::select(DB::raw($query));
            $income = [];
            $now = Carbon::now();
            $start
                = (new DateTime($now->format('Y-m-d')))->modify('first day of this month');
            $end
                = (new DateTime($now->format('Y-m-d')))->modify('first day of next month');

            $interval = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($start, $interval, $end);
            $category = [];
            foreach ($period as $dt) {
                $income[intval($dt->format("d"))] = 0;
                array_push($category, $dt->format("d"));
            }
            foreach ($g as $g1) {
                $income[$g1->dateList] = $g1->total;
            }

            $month -= 1;
            $query = "
SELECT day(transactions.created_at) as dateList,count(*) as counter,
SUM(transaction_details.price*transaction_details.amount) as total
FROM transactions
JOIN transaction_details ON transaction_details.transaction_id=transactions.id
WHERE month(transactions.created_at)=$month and year(transactions.created_at)=$year  and
 transactions.status_order_id=2
GROUP BY day(transactions.created_at)";
            $g = DB::select(DB::raw($query));
            $income2 = [];
            $now = Carbon::now();
            $start
                = (new DateTime($now->format('Y-m-d')))->modify('first day of this month');
            $end
                = (new DateTime($now->format('Y-m-d')))->modify('first day of next month');
            $interval = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($start, $interval, $end);
            $category = [];
            foreach ($period as $dt) {
                $income2[intval($dt->format("d"))] = 0;
            }
            foreach ($g as $g1) {
                $income2[$g1->dateList] = $g1->total;
            }

            $donate = $monthly->sum('donate');
            return view('pages.dashboard.index',
                compact('income2', 'totalDay', 'totalMonth', 'totalWeek',
                    'category', 'income', 'donate'));
        })->name('dashboard');

        Route::get('forecast-tab', [TransactionController::class, 'forecastTab'])->name('forecast-tab');
        Route::get('forecast-tab/create', [TransactionController::class, 'forecastTabCreate'])->name('forecast-tab.create');
        Route::get('forecast-tab/edit/{id}', [TransactionController::class, 'forecastTabEdit'])->name('forecast-tab.edit');

        Route::get('transaction', [TransactionController::class, 'index'])
            ->name('transaction.index');

        Route::get('transaction/download-employee-payment',
            [TransactionController::class, 'download'])
            ->name('transaction.download');
        Route::get('transaction/active',
            [TransactionController::class, 'active'])
            ->name('transaction.active');
        Route::get('transaction/history',
            [TransactionController::class, 'history'])
            ->name('transaction.history');
        Route::get('transaction/history/{date}',
            [TransactionController::class, 'historyDetail'])
            ->name('transaction.history-detail');
        Route::get('transaction/history/month/{month}/year/{year}',
            function ($month, $year) {
                return view('pages.transaction.history-list-month',
                    compact('month', 'year'));
            })->name('transaction.history-detail-month');
        Route::get('transaction/struck/{id}',
            [TransactionController::class, 'struck'])
            ->name('transaction.struck');
        Route::get('transaction/struck-kitchen/{id}',
            [TransactionController::class, 'struckKitchen'])
            ->name('transaction.struck-kitchen');

        Route::resource('stock', StockGoodController::class)
            ->only('index', 'create', 'edit');
        Route::resource('supplier', SupplierController::class)
            ->only('index', 'create', 'edit', 'destroy');
        Route::get('stock/add/{id}', [StockGoodController::class, 'add'])
            ->name('stock.add');
        Route::resource('product-type', ProductTypeController::class)
            ->only('index', 'create', 'edit', 'destroy');
        Route::resource('product-company', ProductCompanyController::class)
            ->only('index', 'create', 'edit', 'destroy');
        Route::resource('product', ProductController::class)
            ->only('index', 'create', 'edit', 'show', 'destroy');

//    Route::resource('shift', ShiftController::class)->only()


        Route::group(['middleware' => config('jetstream.middleware', ['web'])],
            function () {
                Route::group(['middleware' => ['auth', 'verified']],
                    function () {
                        // User & Profile...
                        Route::get('/user/profile',
                            [UserProfileController::class, 'show'])
                            ->name('profile.show');

                        // API...
                        if (Jetstream::hasApiFeatures()) {
                            Route::get('/user/api-tokens',
                                [ApiTokenController::class, 'index'])
                                ->name('api-tokens.index');
                        }

                        // Teams...
                        if (Jetstream::hasTeamFeatures()) {
                            Route::get('/teams/create',
                                [TeamController::class, 'create'])
                                ->name('teams.create');
                            Route::get('/teams/{team}',
                                [TeamController::class, 'show'])
                                ->name('teams.show');
                            Route::put('/current-team',
                                [CurrentTeamController::class, 'update'])
                                ->name('current-team.update');
                        }
                    });
            });
    });
