<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class Check extends Component
{
    public $something;

    public function mount(){
        $this->something='';
    }
    public function render()
    {
        return view('livewire.check');
    }
}
