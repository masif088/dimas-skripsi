<?php

namespace App\Http\Livewire\Form;

use Carbon\Carbon;
use Livewire\Component;

class Forecast extends Component
{
    public $action;
    public $data;
    public $dataId;

    public function mount()
    {
        $this->data = [
            'year' => Carbon::now()->year,
            'month' => Carbon::now()->month,
            'amount' => 0,
        ];
        if ($this->dataId != null) {
            $data = \App\Models\Forecast::find($this->dataId);
            $this->data = [
                'year' => $data->year,
                'month' => $data->month,
                'amount' => $data->amount,
            ];
        }
    }

    public function create()
    {
        $this->validate();
        $this->resetErrorBag();
        $fore = \App\Models\Forecast::where('month',$this->data['month'])->where('year',$this->data['year'])->first();
        if ($fore!=null){
            $this->emit('notify', [
                'type' => 'danger',
                'title' => 'Data sudah ada',
            ]);
            return;
        }

        \App\Models\Forecast::create($this->data);
        $this->generateForecast();

        $this->emit('notify', [
            'type' => 'success',
            'title' => 'Data berhasil ditambahkan',
        ]);
        $this->emit('redirect', route('admin.forecast-tab'));
    }

    public function generateForecast()
    {
        $a = 0.18;
        $b = 0.08;
        $g = 1;
        $d = 1;

        $fLast = \App\Models\Forecast::whereNotNull('amount')
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->first();
//        dd($fLast);

        for ($year = 2022; $year <= $fLast->year; $year++) {
            for ($month = 0; $month < 12; $month++) {

                if ($year==$fLast->year and $fLast->month<=$month){
//                    dd($year,$month);
                    break;
                }

                $m = $month;
                $y = $year;
                if ($month == 0) {
                    $m = 12;
                    $y -= 1;
                }

                $forecastLastMonth = \App\Models\Forecast::where('month', $m)->where('year', $y)->first();

                $forecastYear = \App\Models\Forecast::where('month', $month + 1)->where('year', $year - 1)->first();

                $forecast = \App\Models\Forecast::where('month', $month + 1)->where('year', $year)->first();

                $level = $a * ($forecast->amount / $forecastYear->seasonal) + (1 - $a) * ($forecastLastMonth->level + $forecastLastMonth->trend);
                $trend = $b * ($level - $forecastLastMonth->level) + (1 - $b) * $forecastLastMonth->trend;
                $seasonal = $g * ($forecast->amount / $level) + (1 - $g) * $forecastYear->seasonal;
                $forecastValue = ($forecastLastMonth->level + $d * $forecastLastMonth->trend) * $forecastYear->seasonal;
                $forecast->update([
                    'level' => $level,
                    'trend' => $trend,
                    'seasonal' => $seasonal,
                    'forecast' => $forecastValue,
                    'error' => abs(($forecast->amount - $forecastValue) / $forecast->amount)
//                    'error' => abs(($forecast->amount - $forecastValue) / $forecast->amount)
                ]);
            }
        }
//        dd($year,$month);



        $fLast = \App\Models\Forecast::whereNotNull('amount')
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->first();
//        dd($fLast,'asd');

        for ($year = $fLast->year; $year <= $fLast->year+1; $year++) {
            for ($month = 0; $month < 12; $month++) {

                if ($fLast->year == $year and $month==0){
                    $month = $fLast->month-1;
                }

                if ($year==$fLast->year+1 and $fLast->month==$month){
                    break;
                }

                $m = $month;
                $y = $year;
                if ($month == 0) {
                    $m = 12;
                    $y -= 1;
                }

                $forecastLastYear = \App\Models\Forecast::whereNotNull('amount')
                    ->where('month', $month + 1)
                    ->orderByDesc('year')
                    ->orderByDesc('month')
                    ->first();

//                $forecastLastMonth = \App\Models\Forecast::whereNotNull('amount')
//                    ->where('month', $m)
//                    ->where('year', $y)
//                    ->orderByDesc('year')
//                    ->orderByDesc('month')
//                    ->first();
//                dd($forecastLastMonth);

                $d = (($year - $fLast->year) * 12) + (($month + 1) - $fLast->month);

                if ($d!=0){
//                    dd($d, $forecastLastMonth, $month,$fLast);
                    $forecastValue = ($fLast->level + $d * $fLast->trend) * $forecastLastMonth->seasonal;
                    $forecastNow = \App\Models\Forecast::where('month', $month + 1)->where('year', $year)->first();
                    if ($forecastNow != null) {
                        $forecastNow->update([
                            'forecast' => $forecastValue,

                        ]);
                    } else {
                        \App\Models\Forecast::create([
                            'year' => $year,
                            'month' => $month + 1,
                            'forecast' => $forecastValue,
                        ]);
                    }
                }

            }
        }
    }

    public function update()
    {
        $this->validate();
        $this->resetErrorBag();
        \App\Models\Forecast::find($this->dataId)->update($this->data);
        $this->generateForecast();
        $this->emit('notify', [
            'type' => 'success',
            'title' => 'Data berhasil ditambahkan',
        ]);
        $this->emit('redirect', route('admin.forecast-tab'));
    }

    public function render()
    {
        return view('livewire.form.forecast');
    }

    protected function getRules()
    {
        return [
            'data.year' => 'required',
            'data.month' => 'required',
            'data.amount' => 'required',
        ];
    }
}
