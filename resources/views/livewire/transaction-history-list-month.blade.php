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
</div>
