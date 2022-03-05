<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class TransactionController extends Controller
{
    public function index(){
        return view('pages.transaction.index');
    }
    public function active(){
        return view('pages.transaction.active');
    }
    public function history(){
        return view('pages.transaction.history-list');
    }
    public function historyDetail($date) {
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
    public function struck($id){
        $transaction=Transaction::find($id);
        if (config('app.name', 'Laravel')=="Lekker Putar") {
            $height = 480 + ($transaction->transactionDetails->count() * 60);//base 420 // 1 item 60px
        }else{
            $height = 700 + ($transaction->transactionDetails->count() * 120);//base 420 // 1 item 60px
        }
        $pdf = App::make('dompdf.wrapper');
        $view="pdf-export.struck";
        if (config('app.name', 'Laravel')=="Lekker Putar"){
            $view="pdf-export.struck-lekker";
        }
        $pdf->loadView($view, compact('transaction'))->setPaper([0, 0, 250, $height]);;
        return $pdf->stream($transaction->transaction_code.".pdf");
    }
}
