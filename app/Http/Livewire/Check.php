<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use DateTime;
use Livewire\Component;

class Check extends Component
{
    public $count=0;
public $some;
    public function increment()
    {
        $this->count++;
//        dd($this->count);
    }
    public function mount(){

//        $this->some=Carbon::create('2022','01','29')->dayOfWeek;
//        $this->something='';
    }
    public function change(){

//        dd($this->some);
    }
    public function render()
    {
        return view('livewire.check');
    }
}
