<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class TransactionActive extends Component
{
    public $transactionList;
    public $transactionDetail;

    public function mount()
    {
        $this->transactionList = \App\Models\Transaction::whereStatusOrderId(1)
            ->whereDate('created_at', Carbon::today())
            ->get();
    }

    public function detail($id)
    {
        $this->transactionDetail = $this->transactionList->find($id);
    }

    public function done()
    {
        $this->transactionDetail->update(['status_order_id' => 2]);
        $this->emit('notify', [
            'type' => 'success',
            'title' => $this->transactionDetail->transaction_code." selesai",
        ]);
        $this->transactionList = \App\Models\Transaction::whereStatusOrderId(1)->whereDate('created_at', Carbon::today())->get();
    }

    public function cancel()
    {
        $this->transactionDetail->update(['status_order_id' => 3]);
        $this->emit('notify', [
            'type' => 'danger',
            'title' => $this->transactionDetail->transaction_code." dibatalkan",
        ]);
        $this->transactionList = \App\Models\Transaction::whereStatusOrderId(1)->whereDate('created_at', Carbon::today())->get();
    }

    public function render()
    {
        return view('livewire.transaction-active');
    }
}
