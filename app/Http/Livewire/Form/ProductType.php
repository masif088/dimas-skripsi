<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;

class ProductType extends Component
{
    public $action;
    public $data;
    public $dataId;

    public function mount()
    {
        $this->data = [
            'title' => ''
        ];
        if ($this->dataId != null) {
            $data = \App\Models\ProductType::find($this->dataId);
            $this->data = [
                'title' => $data->title
            ];
        }
    }
    public function create()
    {
        $this->validate();
        \App\Models\ProductType::create($this->data);
        $this->emit('notify', [
            'type' => 'success',
            'title' => 'Data berhasil ditambahkan',
        ]);
        $this->emit('redirect', route('admin.product-type.index'));
    }

    public function update()
    {
        $this->validate();
        \App\Models\ProductType::find($this->dataId)->update($this->data);
        $this->emit('notify', [
            'type' => 'success',
            'title' => 'Data berhasil diubah',
        ]);
        $this->emit('redirect', route('admin.product-type.index'));
    }

    public function render()
    {
        return view('livewire.form.product-type');
    }

    protected function getRules()
    {
        return [
            'data.title' => 'required|max:255'
        ];
    }
}
