<?php

namespace App\Http\Livewire;

use App\Events\NewOrder;
use Livewire\Component;

class Check extends Component
{
    public $count = 0;
    public $some;


    public $showNewOrderNotification = false;

    // Special Syntax: ['echo:{channel},{event}' => '{method}']
    protected $listeners = ['echo:orders,NewOrder' => 'notifyNewOrder','check'=>'check'];

    public function notifyNewOrder()
    {
        $this->showNewOrderNotification = true;
        dd("asda");
    }

    public function button()
    {
        $socketa="asdasd";
        event(new NewOrder($socketa));
    }
    public function check(){
        dd("asdasd");
    }


    public function render()
    {
        return view('livewire.check');
    }
}
