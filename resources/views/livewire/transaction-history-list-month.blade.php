
text/x-generic transaction-history-list-month.blade.php ( ASCII text )
<div class="row">
    <div class="col-lg-4 mb-3">
        <button href="" wire:click="downlaod" class="btn btn-primary">Download rekap diskon karyawan</button>
        <br>
    </div>
    <div class="col-lg-12">
        <x-data-income-outcome
            componentId="some"
            title1="Pemasukan bulan ini"
            :value1="$totalMonth"
            btn1="Potongan karyawan"
            btnColor1="btn-danger"
            btn2="CSV"
            btnColor2="btn-success"
            link1=""
            link2="#"
            :data2="$income"
            dataTitle2="Pemasukkan"
            :categories="$category"
        />
    </div>

    <x-data-radar title="Omzer Mingguan Bulan Ini" id="money" :datas="$dayOfWeekMoney"/>
    <x-data-radar title="Omzet Harian Bulan Ini" id="money1" :datas="$dayMoney"/>
    <x-data-bar-group title="Omzet Perjam Bulan ini" id="money3" :datas="$dayTimeMoney"/>

    <x-data-radar title="Pengunjung Bulan Ini" id="visitor" :datas="$dayOfWeekVisitor"/>
    <x-data-radar title="Pengunjung Harian Bulan Ini" id="visitor1" :datas="$dayVisitor"/>
    <x-data-bar-group title="Pengunjung Perjam Bulan ini" id="visitor2" :datas="$dayTimeVisitor"/>

    <x-data-radar title="Penjualan Item Bulan Ini" id="item" :datas="$dayOfWeekItem"/>
    <x-data-radar title="Penjualan Harian Bulan Ini" id="item1" :datas="$dayItem"/>
    <x-data-bar-group title="Penjualan Perjam Bulan ini" id="item2" :datas="$dayTimeItem"/>

    <x-data-radar title="Transaksi Bulan Ini" id="transaction" :datas="$dayOfWeekTransaction"/>
    <x-data-radar title="Transaksi Harian Bulan Ini" id="transaction1" :datas="$dayTransaction"/>
    <x-data-bar-group title="Transaksi Perjam Bulan ini" id="transaction2" :datas="$dayTimeTransaction"/>

    {{--    <x-data-radar title="Transaksi Minggu Ini" id="transaction1" :datas="$dayTransaction"/>--}}


    <div>
        <div class="card">
            <div class="card-header" style="padding: 10px">
                <h1>Statistik Pengunjung</h1>
            </div>
            <div class="card-body table-responsive">
                Total Pengunjung : {{ number_format(($visitorCount),0,',','.')}}
                <br>
                Total Transaksi : {{ number_format(($transactionCount),0,',','.')}}
                <br>
                Total Omset : Rp. {{ number_format(array_sum($income),0,',','.')}}
                <br>
                Total Penjualan :
                <br>
                <br>
                <b>BERDASARKAN JENIS</b>
                <br>
                @php
                    foreach ($type as $t){
                        if (isset($datas['product']['type'][$t->id])) {
                            arsort($datas['product']['type'][$t->id]);
                        }
                    }
                    foreach ($company as $t){
                        if (isset($datas['product']['company'][$t->id])) {
                            arsort($datas['product']['company'][$t->id]);
                        }
                    }
                @endphp
                <div class="row">
                    @foreach($type as $t)
                        @isset($datas['product']['type'][$t->id])
                            <div class="col-4">
                                <b>Favorit {{$t->title}}:</b> <br>
                                1. {{ $this->products->find(array_keys($datas['product']['type'][$t->id])[0])->title }}
                                ({{ $productAmounts[array_keys($datas['product']['type'][$t->id])[0]] }})
                                <br>
                                @isset(array_keys($datas['product']['type'][$t->id])[1])
                                    2. {{ $this->products->find(array_keys($datas['product']['type'][$t->id])[1])->title }}
                                    ({{ $productAmounts[array_keys($datas['product']['type'][$t->id])[1]] }})
                                    <br>
                                @endif
                                <br>
                            </div>
                        @endif
                    @endforeach
                </div>

                <b>BERDASARKAN USAHA</b>
                <br>
                <div class="row">
                    @foreach($company as $t)
                        @isset($datas['product']['company'][$t->id])
                            <div class="col-4">
                                <b>Favorit {{$t->title}}:</b> <br>
                                1. {{ $this->products->find(array_keys($datas['product']['company'][$t->id])[0])->title }}
                                ({{ $productAmounts[array_keys($datas['product']['company'][$t->id])[0]] }})
                                <br>
                                @isset(array_keys($datas['product']['company'][$t->id])[1])
                                    2. {{ $this->products->find(array_keys($datas['product']['company'][$t->id])[1])->title }}
                                    ({{ $productAmounts[array_keys($datas['product']['company'][$t->id])[1]] }})
                                    <br>
                                @endif
                                <br>
                            </div>
                        @endif
                    @endforeach
                </div>
                <br>
                <b>BERDASARKAN USAHA</b>
                <br>
                <div class="row">
                    @foreach($company as $t)
                        @isset($datas['product']['company'][$t->id])
                            <div class="col-4">
                                <b>Favorit {{$t->title}}:</b> <br>
                                1. {{ $this->products->find(array_keys($datas['product']['company'][$t->id])[0])->title }}
                                ({{ $productAmounts[array_keys($datas['product']['company'][$t->id])[0]] }})
                                <br>
                                @isset(array_keys($datas['product']['company'][$t->id])[1])
                                    2. {{ $this->products->find(array_keys($datas['product']['company'][$t->id])[1])->title }}
                                    ({{ $productAmounts[array_keys($datas['product']['company'][$t->id])[1]] }})
                                    <br>
                                @endif
                                <br>
                            </div>
                        @endif
                    @endforeach
                </div>
                <br>
                <b>OMZET</b> <br>
                @foreach($method as $t)
                    @isset($datas['product']['payment_method'][$t->id])
                        <b>{{$t->title}}</b>
                        : Rp. {{ number_format($datas['product']['payment_method'][$t->id],0,',','.') }}
                        <br>
                    @endif
                @endforeach
                <b>TOTAL : Rp. {{ number_format(array_sum($datas['product']['payment_method']),0,',','.') }}</b>
                <br>
            </div>
        </div>
    </div>
    <div>
        <div class="card">
            <div class="card-header" style="padding: 10px">
                <h1>Keseluruhan</h1>
            </div>
            <div class="card-body table-responsive">
                <table class="table">
                    <thead>
                    <tr style="font-weight: bold">
                        <td>No</td>
                        <td>Kode</td>
                        <td>Produk</td>
                        <td>Qty</td>
                        <td>Harga Rata-rata</td>
                        <td>Total</td>
                    </tr>
                    </thead>
                    <tbody>

                    @php($count=1)
                    @foreach($productAmounts as $key=>$pa)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $products->find($key)->product_code }}</td>
                            <td>{{ $products->find($key)->title }}</td>
                            <td>{{ number_format($pa,0,',','.') }}</td>
                            <td>Rp. {{ number_format($productTotals[$key]/$pa,0,',','.') }}</td>
                            <td>Rp. {{ number_format($productTotals[$key],0,',','.') }}</td>

                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5">Total :</td>
                        <td>Rp. {{ number_format(array_sum($productTotals)) }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($company->count() !=1)
        @foreach($company as $pc)
            <div>
                <div class="card">
                    <div class="card-header" style="padding: 10px">
                        <h1>{{$pc->title}}</h1>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table">
                            <thead>
                            <tr style="font-weight: bold">
                                <td>No</td>
                                <td>Jenis</td>
                                <td>Produk</td>
                                <td>Qty</td>
                                <td>Harga Rata-rata</td>
                                <td>Total</td>
                            </tr>
                            </thead>
                            <tbody>
                            @php($total=0)
                            @php($count=1)
                            @foreach($productAmounts as $key=>$pa)
                                @if($products->find($key)->product_company_id==$pc->id)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $products->find($key)->productType->title }}</td>
                                        <td>{{ $products->find($key)->title }}</td>
                                        <td>{{ number_format($pa) }}</td>
                                        <td>Rp. {{ number_format($productTotals[$key]/$pa) }}</td>
                                        <td>Rp. {{ number_format($productTotals[$key]) }}</td>
                                        @php($total+=$productTotals[$key])
                                    </tr>
                                @endif
                            @endforeach
                            <tr>
                                <td colspan="5">Total :</td>
                                <td>Rp. {{ number_format($total) }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
