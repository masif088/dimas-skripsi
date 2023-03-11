<x-admin>
    <x-slot name="title">
        Dashboard
    </x-slot>
    <div>
        {{--        @livewire('check')--}}
        @if (auth()->user()->role==1)
            <div class="container-fluid">
                <div class="row second-chart-list third-news-update">
                    <div class="col-sm-6 col-xl-4 col-lg-6">
                        <x-simple-card icon="dollar-sign" :value="number_format($totalDay)"
                                       title="Hasil penjualan harian"
                                       color="bg-primary"/>
                    </div>
                    <div class="col-sm-6 col-xl-4 col-lg-6">
                        <x-simple-card icon="dollar-sign" :value="number_format($totalWeek)"
                                       title="Hasil penjualan mingguan" color="bg-danger"/>
                    </div>
                    <div class="col-sm-6 col-xl-4 col-lg-6">
                        <x-simple-card icon="dollar-sign" :value="number_format($totalMonth)"
                                       title="Hasil penjualan bulanan" color="bg-secondary"/>
                    </div>

                    <x-data-income-outcome
                            id="some"
                            title1="Pemasukan bulan ini"
                            value1="Rp. {{ number_format($totalMonth,0,',','.') }}"
                            title2="Total minggu ini"
                            value2="Rp. {{ number_format($totalWeek,0,',','.') }}"
                            :data2="$income2"
                            dataTitle2="Bulan lalu"
                            :data1="$income"
                            dataTitle1="Bulan ini"
                            :categories="$category"
                    />
                </div>
            </div>
        @endif
    </div>
</x-admin>
