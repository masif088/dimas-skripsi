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
        $a = 0.18; // nilai alpa
        $b = 0.08; // nilai beta
        $g = 1; // nilai gama
        $d = 1; // nilai distance/jarak 1 <=

        $fLast = \App\Models\Forecast::whereNotNull('amount') // ambil batas akhir yang memiliki nilai
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->first();


        //perulangan untuk mengisi data level, seasonal, trend
        for ($year = 2022; $year <= $fLast->year; $year++) { // data dimulai dari 2022 hingga nilai terakhir flast
            for ($month = 0; $month < 12; $month++) { // perulangan bulan

                // memastikan saat sudah yang terakhir maka perulangan dihentikan
                if ($year==$fLast->year and $fLast->month<=$month){
                    break;
                }

                //untuk ambil data bulang terakhir untuk menghindari kesalahan saat bulan januari agar dapat mengambil data desember
                $m = $month;
                $y = $year;
                if ($month == 0) {
                    $m = 12;
                    $y -= 1;
                }

                //data bulan terakhir
                $forecastLastMonth = \App\Models\Forecast::where('month', $m)->where('year', $y)->first();
                //data bulan yang sama di tahun sebelumnya
                $forecastYear = \App\Models\Forecast::where('month', $month + 1)->where('year', $year - 1)->first();
                //data bulan ini
                $forecast = \App\Models\Forecast::where('month', $month + 1)->where('year', $year)->first();
                //$month+1 karena for/perulangan dimulai dari 0

                //untuk mendapatkan nilai level, trend, seasonal, dan forecast untuk bulan ini
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



        // ambil batas akhir yang memiliki nilai
        $fLast = \App\Models\Forecast::whereNotNull('amount')
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->first();
//        dd($fLast,'asd');

        // perulangan untuk 1 tahun kedepan
        for ($year = $fLast->year; $year <= $fLast->year+1; $year++) {
            for ($month = 0; $month < 12; $month++) {

                // memastikan perulangan dimulai dari $flast month + 1
                if ($fLast->year == $year and $fLast->month>$month){
                    continue;
                }

                // memastikan forecast dilakukan 1 tahun(12 bulan) kedepan tidak lebih
                if ($year==$fLast->year+1 and $fLast->month<=$month){
                    continue;
                }


                // mengambil value tahun terakhir (harusnya forecastLastYear :D)
                $forecastLastMonth = \App\Models\Forecast::whereNotNull('amount')
                    ->where('month', $month + 1)
                    ->where('year', $year - 1)
                    ->orderByDesc('year')
                    ->orderByDesc('month')
                    ->first();

                // untuk mengukur jarak dari bulan terakhir yang masih memiliki amount atau data penjualan
                $d = (($year - $fLast->year) * 12) + (($month+1 ) - $fLast->month);

                // memastikan forecast hanya untuk 12 bulan kedepan
                if ($d>0){
                    $forecastValue = ($fLast->level + $d * $fLast->trend) * $forecastLastMonth->seasonal;
                    $forecastNow = \App\Models\Forecast::where('month', $month + 1)->where('year', $year)->first();
                    if ($forecastNow != null) {
                        $forecastNow->update([
                            'forecast' => $forecastValue,
                        ]);
                    } else {
                        $forecastNow =\App\Models\Forecast::create([
                            'year' => $year,
                            'month' => $month + 1,
                            'forecast' => $forecastValue,
                        ]);
                    }
//                    if ($month==2 and $year==2024){
//                        dd($forecastNow);
//                    }
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
