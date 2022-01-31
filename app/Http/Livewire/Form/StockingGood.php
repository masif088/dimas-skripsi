<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;

class StockingGood extends Component
{
    public $dataId;
    public $amount;
    public $stockGood;
    public $note;

    public function mount(){
        $this->stockGood=\App\Models\StockGood::find($this->dataId);
        $this->amount=$this->stockGood->amount;
    }
    public function update(){
//        if (auth()->user()->role==){
//
//        }
        $this->stockGood->update(['amount'=>$this->amount]);
        $this->emit('notify', [
            'type' => 'success',
            'title' => 'berhasil mengubah jumlah barang',
        ]);
        $this->emit('redirect', route('admin.stock.index'));
    }
    public function render()
    {
        return view('livewire.form.stocking-good');
    }
}
