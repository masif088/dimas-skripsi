<div>
    <div class="row second-chart-list third-news-update">
        <div class="col-lg-6 col-sm-12 product-list">
            <div class="product-wrapper-grid">
                @php
                    $month=0
                @endphp
                @foreach($historyList as $key=>$history)
                    @php
                        $monthHistory=explode('-',$history['dateList'])
                    @endphp
                    @if($month!=$monthHistory[1])
                        @if($month!=0)
                            {!! '</div>' !!}
                        @endif
                        @php
                            $month=$monthHistory[1];
                        @endphp
                        {!! '<div class="row">' !!}
                            <a href="{{ route('admin.transaction.history-detail-month',[$monthHistory[1],$monthHistory[0]]) }}"
                               class="col-12" style="padding-right: 5px">
                                <div class="card" style="" wire:click="setDetail({{$key}})">
                                    <div class="card-body" style="padding: 10px; text-align: center">
                                        <div>{{ $monthHistory[1] }} -  {{ $monthHistory[0] }}</div>
                                    </div>
                                </div>
                            </a>
                    @endif
                    <div class="col-2" style="padding-right: 5px">
                        <div class="card" style="" wire:click="setDetail({{$key}})">
                            <div class="card-body" style="padding: 10px; text-align: center">
                                <div>{{ $monthHistory[2] }}</div>
                            </div>
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
                Total Pengunjung : {{ $datas['visitor'] }}
                <br>
                Total Transaksi : {{ $historyList[$keyHistory]['counter'] }}
                <br>
                Total Omset : {{ number_format($datas['total']) }}
                <br>
                Total Penjualan : {{ number_format($datas['amount']) }}
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
                @foreach($type as $t)
                    @isset($datas['product']['type'][$t->id])
                        <b>Favorit {{$t->title}}:</b> <br>
                        1. {{ \App\Models\Product::find(array_keys($datas['product']['type'][$t->id])[0])->title }}
                        <br>
                        @isset(array_keys($datas['product']['type'][$t->id])[1])
                            2. {{ \App\Models\Product::find(array_keys($datas['product']['type'][$t->id])[1])->title }}
                            <br>
                        @endif
                        <br>
                    @endif
                @endforeach

                <b>BERDASARKAN USAHA</b>
                <br>
                @foreach($company as $t)
                    @isset($datas['product']['company'][$t->id])
                        {{--                                Favorit {{$t->title}}--}}
                        {{--                                : {{ \App\Models\Product::find(array_key_first($datas['product']['company'][$t->id]))->title }}--}}
                        {{--                                <br>--}}
                        <b>Favorit {{$t->title}}:</b> <br>
                        1. {{ \App\Models\Product::find(array_keys($datas['product']['company'][$t->id])[0])->title }}
                        <br>
                        @isset(array_keys($datas['product']['company'][$t->id])[1])
                            2. {{ \App\Models\Product::find(array_keys($datas['product']['company'][$t->id])[1])->title }}
                            <br>
                        @endif
                        {{--                            {{ var_dump($datas['product']['type'][$t->id]) }}--}}
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
                Total : {{ number_format(array_sum($datas['product']['payment_method'])) }} <br>
                Donasi : {{ number_format($donate) }}
                <br>
                <br>

                {{--                        Pengunjung--}}
                {{--                        <br>--}}
                {{--                        terhedon :--}}
                {{--                        <br>--}}
                {{--                        terbanyak belinya :--}}
                {{--                        <br>--}}
                {{--                        <br>--}}
                <a href="{{ route('admin.transaction.history-detail',$historyList[$keyHistory]['dateList']) }}"
                   class="btn btn-primary col-12">Detail</a>
            @endif
        </div>
    </div>
</div>
</div>

</div>
