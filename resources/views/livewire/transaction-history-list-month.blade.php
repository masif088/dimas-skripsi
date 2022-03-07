<div class="row">
    {{--    @php($month=['-','Januari','Pebruari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'])--}}
    {{--    <div class="col-lg-2">--}}
    {{--        <div class="row second-chart-list third-news-update">--}}
    {{--            <div class="product-list">--}}
    {{--                <div class="product-wrapper-grid">--}}
    {{--                    <div class="row">--}}
    {{--                        @foreach($historyList as $key=>$history)--}}
    {{--                            <div class="card" wire:click="setDetail({{$key}})">--}}
    {{--                                <div class="card-body" style="padding: 10px">--}}
    {{--                                    <div>{{ $month[$history['monthList']].' - '.$history['yearList'] }}</div>--}}

    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        @endforeach--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <div class="col-lg-12">

        <x-data-income-outcome
            componentId="some"
            title1="Pemasukan bulan ini"
            :value1="$totalMonth"
            {{--            title2="Total minggu ini"--}}
            {{--            :value2="$totalWeek"--}}
            {{--            title3="Capain bulan ini"--}}
            {{--            value3="90%"--}}
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

    </div>
    <div>
        <div class="card">
            <div class="card-header">
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
                            <td>{{ number_format($pa) }}</td>
                            <td>Rp. {{ number_format($productTotals[$key]/$pa) }}</td>
                            <td>Rp. {{ number_format($productTotals[$key]) }}</td>
                            @php($total+=$productTotals[$key])
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5">Total :</td>
                        <td>Rp. {{ number_format($total) }}</td>
                    </tr>
                    </tbody>
                </table>

            </div>
            <div id="table_pagination" class="py-3">

            </div>
        </div>
    </div>
    @foreach(\App\Models\ProductCompany::get() as $pc)
        <div>
            <div class="card">
                <div class="card-header">
                    <h1>{{$pc->title}}</h1>
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
                            @if($products->find($key)->product_company_id==$pc->id)
                            <tr>

                                <td>{{ $count++ }}</td>
                                <td>{{ $products->find($key)->product_code }}</td>
                                <td>{{ $products->find($key)->title }}</td>
                                <td>{{ number_format($pa) }}</td>
                                <td>Rp. {{ number_format($productTotals[$key]/$pa) }}</td>
                                <td>Rp. {{ number_format($productTotals[$key]) }}</td>
                            </tr>
                            @endif
                        @endforeach
                        <tr>
                            <td colspan="5">Total :</td>
                            <td>Rp. {{ number_format(array_sum($productTotals)) }}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
                <div id="table_pagination" class="py-3">

                </div>
            </div>
        </div>
    @endforeach
</div>
