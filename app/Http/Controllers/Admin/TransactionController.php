<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CodeCashBook;
use App\Models\ProductCompany;
use App\Models\Transaction;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
        return view('pages.transaction.index');
    }

    public function active()
    {
        return view('pages.transaction.active');
    }
    public function forecastTab()
    {
        return view('pages.transaction.forecast-tab');
    }
    public function forecastTabCreate()
    {
        return view('pages.transaction.forecast-tab-create');
    }

    public function forecastTabEdit($id)
    {
        return view('pages.transaction.forecast-tab-edit',compact('id'));
    }

    public function history()
    {
        return view('pages.transaction.history-list');
    }

    public function historyDetail($date)
    {
        if ($date == "today") {
            $date = Carbon::today();
        } else {
            if (auth()->user()->role == 1 or auth()->user()->role == 2) {
                try {
                    $date = Carbon::createFromFormat('Y-m-d', $date);
                } catch (Exception $err) {
                    abort(404);
                }
            } else {
                abort(403);
            }
        }
        return view('pages.transaction.history', compact('date'));
    }

    public function struck($id)
    {
        $transaction = Transaction::find($id);
        if (config('app.name', 'Laravel') == "Lekker Putar") {
            $height = 480 + ($transaction->transactionDetails->count() * 60);//base 420 // 1 item 60px
        }else{
            $height = 800 + ($transaction->transactionDetails->count() * 120);//base 420 // 1 item 60px
        }
        $pdf = App::make('dompdf.wrapper');
        $view = "pdf-export.struck";
        if (config('app.name', 'Laravel') == "Lekker Putar") {
            $view = "pdf-export.struck-lekker";
        }
        $pdf->loadView($view, compact('transaction'))->setPaper([0, 0, 250, $height]);
        return $pdf->stream($transaction->transaction_code . ".pdf");
    }

    public function struckKitchen($id)
    {
        $transaction = Transaction::find($id);
        $height = 400 + ($transaction->transactionDetails->count() * 130);//base 420 // 1 item 60px
        $pdf = App::make('dompdf.wrapper');
        $view = "pdf-export.struck-kitchen";
//        if (config('app.name', 'Laravel') == "Lekker Putar") {
//            $view = "pdf-export.struck-lekker";
//        }
        $pdf->loadView($view, compact('transaction'))->setPaper([0, 0, 250, $height]);
        return $pdf->stream($transaction->transaction_code . "-kitchen.pdf");
    }

    public function download($month, $year){
        $fileName = "Rekap-kas_$month-$year" . ".csv";
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );
        $callback = function () {
            $delimiter = ';';
            $file = fopen('php://output', 'w');
            $company=ProductCompany::pluck('title')->toArray();
            $head=['Tanggal','Nama','Item'];
            array_push($head,$company);
            fputcsv($file,$head,$delimiter);

            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
}
