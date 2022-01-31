<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;

class Supplier extends Component
{
    public $action;
    public $data;
    public $dataId;

    public function mount()
    {
        $this->data = [
            'title' => '',
            'no_phone' => '',
            'email' => '',
            'address' => '',
        ];
    }
    protected function getRules()
    {
        return ['data.title'=>'required'];
    }

    public function create(){
        $this->validate();
        $this->resetErrorBag();
        \App\Models\Supplier::create($this->data);
        $this->emit('notify', [
            'type' => 'success',
            'title' => 'Data berhasil ditambahkan',
        ]);
        $this->emit('redirect', route('admin.product-company.index'));
    }
    public function update(){
        $this->validate();
        $this->resetErrorBag();
        \App\Models\Supplier::find($this->dataId)->update($this->data);
        $this->emit('notify', [
            'type' => 'success',
            'title' => 'Data berhasil ditambahkan',
        ]);
        $this->emit('redirect', route('admin.product-company.index'));
    }
    public function render()
    {
        return view('livewire.form.supplier');
    }
}
