<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class TransactionActiveNotification extends Component
{
    public $transactionNotification;
    public $count;
    protected $listeners = ['refresh' => 'refresh'];

    public function mount()
    {
        $this->count=\App\Models\Transaction::whereStatusOrderId(1)
            ->whereDate('created_at', Carbon::today())->get();
        $this->refresh();
    }

    public function done($id)
    {
        $td = $this->transactionNotification->find($id);
        $td->update(['status_order_id' => 2]);
        $this->emit('notify', [
            'type' => 'success',
            'title' => $td->transaction_code . " selesai",
        ]);
        $this->refresh();
    }
    public function cancel($id)
    {
        $td = $this->transactionNotification->find($id);
        $td->update(['status_order_id' => 3]);
        $this->emit('notify', [
            'type' => 'danger',
            'title' => $td->transaction_code . " cancel",
        ]);
        $this->refresh();
    }
    public function print($id)
    {
        $url=route('admin.transaction.struck',$id);
        $this->emit('redirect:new',$url );
    }

    public function refresh()
    {
        $this->transactionNotification = \App\Models\Transaction::whereStatusOrderId(1)->whereDate('created_at', Carbon::today())->limit(5)->get();
    }


    public function render()
    {
        return view('livewire.transaction-active-notification');
    }
}
