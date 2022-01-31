<div>
    <div class="row second-chart-list third-news-update">
        <div class="col-lg-6 col-sm-12 product-list">
            <div class="product-wrapper-grid">
                <div class="row">
                    @foreach($historyList as $key=>$history)
                        <div class="card" wire:click="setDetail({{$key}})">
                            <div class="card-body" style="padding: 10px">
                                <div>{{ $history['dateList'] }}</div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="card">
                <div class="card-header" style="padding: 10px">
                    <div class="header-top">
                        <h5 class="m-0">Laporan Harian</h5>
                    </div>
                </div>
                <div class="card-body" style="padding: 10px">
                    @if($keyState!=null)
                        Total Pengunjung :
                        <br>
                        Total Transaksi : {{ $historyList[$keyHistory]['counter'] }}
                        <br>
                        Total Omset : {{ number_format($datas['total']) }}
                        <br>
                        Total Penjualan : {{ number_format($datas['amount']) }}
                        <br>
                        <br>
                        Berdasarkan jenis
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
                        @foreach($type as $t)
                            @isset($datas['product']['type'][$t->id])
                                Favorit {{$t->title}}
                                : {{ \App\Models\Product::find(array_key_first($datas['product']['type'][$t->id]))->title }}
                                <br>
                            @endif
                        @endforeach
                        <br>
                        Berdasarkan usaha
                        <br>
                        @foreach($company as $t)
                            @isset($datas['product']['company'][$t->id])
                                Favorit {{$t->title}}
                                : {{ \App\Models\Product::find(array_key_first($datas['product']['company'][$t->id]))->title }}
                                <br>
                            @endif
                        @endforeach
                        <br>
                        @foreach($method as $t)
                            @isset($datas['product']['payment_method'][$t->id])
                                {{$t->title}}
                                : {{ number_format($datas['product']['payment_method'][$t->id]) }}
                                <br>
                            @endif
                        @endforeach
                    Total : {{ number_format(array_sum($datas['product']['payment_method'])) }}
                        <br>
                        <br>

{{--                        Pengunjung--}}
{{--                        <br>--}}
{{--                        terhedon :--}}
{{--                        <br>--}}
{{--                        terbanyak belinya :--}}
{{--                        <br>--}}
{{--                        <br>--}}
                        <a href="{{ route('admin.transaction.history-detail',$historyList[$keyHistory]['dateList']) }}" class="btn btn-primary col-12">Detail</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
