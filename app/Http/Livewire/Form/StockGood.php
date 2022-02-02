<?php

namespace App\Http\Livewire\Form;

use App\Models\Supplier;
use Livewire\Component;

class StockGood extends Component
{
    public $data;
    public $dataId;
    public $action;
    public $optionSupplier;

    public function mount()
    {
        $this->data = [
            'supplier_id' => 1,
            'title' => '',
            'minimal_amount' => 0,
            'maximal_amount' => 0,
            'amount' => 0,
            'note' => ''
        ];
//        'supplier_id',
// 'title',
// 'minimal_amount',
// 'maximal_amount',
// 'amount',
// 'note',
        $this->optionSupplier = eloquent_to_options(Supplier::get(), 'id', 'title');
        if ($this->dataId!=null) {
            $data = \App\Models\StockGood::find($this->dataId);
            $this->data = [
                'supplier_id' => $data->supplier_id,
                'title' => $data->title,
                'minimal_amount' => $data->minimal_amount,
                'maximal_amount' => $data->maximal_amount,
                'amount' => $data->amount,
                'note' => $data->note
            ];
        }
    }

    public function create()
    {
        $this->validate();
        \App\Models\StockGood::create($this->data);
        $this->emit('notify', [
            'type' => 'success',
            'title' => 'Data berhasil ditambahkan',
        ]);
        $this->emit('redirect', route('admin.stock.index'));
    }

    public function update()
    {
        $this->validate();
        \App\Models\StockGood::find($this->dataId)->update($this->data);
        $this->emit('notify', [
            'type' => 'success',
            'title' => 'Data berhasil ditambahkan',
        ]);
        $this->emit('redirect', route('admin.stock.index'));
    }

    public function render()
    {
        return view('livewire.form.stock-good');
    }

    protected function getRules()
    {
        return [
            'data.supplier_id' => 'required',
            'data.title' => 'required',
            'data.minimal_amount' => 'required',
            'data.maximal_amount' => 'required',
            'data.amount' => 'required',
        ];
    }
}
