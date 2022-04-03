<x-admin>
    <x-slot name="title">
        Dashboard
    </x-slot>
    <div>
        @if (auth()->user()->role==1)
        <div class="container-fluid">
            <div class="row second-chart-list third-news-update">
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <x-simple-card icon="dollar-sign" :value="number_format($totalDay)" title="Hasil penjualan harian"
                                   color="bg-primary"/>
                </div>
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <x-simple-card icon="dollar-sign" :value="number_format($totalWeek)"
                                   title="Hasil penjualan mingguan" color="bg-danger"/>
                </div>
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <x-simple-card icon="dollar-sign" :value="number_format($totalMonth)"
                                   title="Hasil penjualan bulanan" color="bg-secondary"/>
                </div>

                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <x-simple-card icon="dollar-sign" :value="number_format($donate)"
                                   title="Hasil Donasi bulanan" color="bg-success"/>
                </div>

                <x-data-income-outcome
                    id="some"
                    title1="Pemasukan bulan ini"
                    :value1="$totalMonth"
                    title2="Total minggu ini"
                    :value2="$totalWeek"
                    title3="Capain bulan ini"
                    value3="90%"
                    btn1="PDF"
                    btnColor1="btn-danger"
                    btn2="CSV"
                    btnColor2="btn-success"
                    link1="#"
                    link2="#"
{{--                    data1="[]"--}}
{{--                    dataTitle1="Pengeluaran"--}}
                    :data2="$income"
                    dataTitle2="Pemasukkan"
                    :categories="$category"
                />
{{--                                <x-data-radar title="Keuangan"/>--}}
{{--                                <x-data-radar title="Transaksi"/>--}}
{{--                                <x-data-radar title="Barang"/>--}}
{{--                                <x-data-radar title="Pengunjung"/>--}}
            </div>

        </div>
        @endif
    </div>
</x-admin>
