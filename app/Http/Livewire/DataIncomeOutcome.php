<?php

namespace App\Http\Livewire;

use App\Models\Forecast;
use Livewire\Component;

class DataIncomeOutcome extends Component
{
//@props([
//'id' => 'some',
//'title1' => 'no title', 'value1'=>'0',
//'title2' => 'no title', 'value2'=>'0',
//'title3' => 'no title', 'value3'=>'0',
//'btn1' => 'PDF',
//'btnColor1' => 'btn-danger',
//'btn2' => ' csv',
//'btnColor2' => 'btn-success',
//'link1' => '#',
//'link2' => '#',
//'data1' => [],
//'dataTitle1' => 'no title',
//'data2' => [],
//'dataTitle2' => 'no title',
//'categories' => [],
//])
    public $componentId;
    public $title1;
    public $title2;
    public $title3;
    public $value1;
    public $value2;
    public $value3;
    public $data1;
    public $data2;
    public $dataTitle1;
    public $dataTitle2;
    public $categories;
    public $monthName=['','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    public function mount(){


        foreach (Forecast::get() as $f){
            $this->data1[]=round($f->amount,2)??0;
            $this->data2[]=round($f->forecast,2)??0;
            $this->categories[]=$this->monthName[$f->month].' '.$f->year;
        }
//        dd($this->data1);

//        if ($this->data1==null){
//            $this->data1=[];
//        }
//        if ($this->data2==null){
//            $this->data2=[];
//        }
//        if ($this->categories==null){
//            $this->categories=[];
//        }
    }

    public function render()
    {
        return view('livewire.data-income-outcome');
    }
}
