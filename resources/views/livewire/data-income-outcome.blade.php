<div class="col-xl-12 xl-100 dashboard-sec box-col-12">
    <div class="card earning-card">
        <div class="card-body p-0">
            <div class="row m-0">
                <div class="col-xl-3 earning-content p-0">
                    <div class="row m-0 chart-left">
                        <div class="col-xl-12 p-0 left_side_earning">
                            <h5>DATA</h5>
                            <p class="font-roboto">Pemasukan - Pengeluaran</p>
                        </div>
                        @if($title1!=null)
                        <div class="col-xl-12 p-0 left_side_earning">
                            <h5>Rp. {{ number_format($value1) }} </h5>
                            <p class="font-roboto">{{ $title1 }}</p>
                        </div>
                        @endif
                        @if($title2!=null)
                        <div class="col-xl-12 p-0 left_side_earning">
                            <h5>Rp. {{ number_format($value2) }}</h5>
                            <p class="font-roboto">{{$title2}}</p>
                        </div>
                        @endif
                        @if($title3!=null)
                        <div class="col-xl-12 p-0 left_side_earning">
                            <h5>{{ $value3 }}</h5>
                            <p class="font-roboto">{{ $title3 }}</p>
                        </div>
                        @endif
                        {{--                        <div class="col-xl-6 p-0 left-btn"><a href="{{$link1}}" class="btn {{$btnColor1}}">{{$btn1}}</a></div>--}}
                        {{--                        <div class="col-xl-6 p-0 left-btn"><a href="{{$link2}}" class="btn {{$btnColor2}}">{{$btn2}}</a></div>--}}
                    </div>
                </div>
                <div class="col-xl-9 p-0">
                    <div class="chart-right">
                        <div class="row m-0 p-tb">
                            <div class="col-xl-8 col-md-8 col-sm-8 col-12 p-0">
                                <div class="inner-top-left">
                                    <ul class="d-flex list-unstyled">
                                        {{--                                                    <li>Daily</li>--}}
                                        {{--                                                    <li class="active">Weekly</li>--}}
                                        {{--                                                    <li>Monthly</li>--}}
                                        {{--                                                    <li>Yearly</li>--}}
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 col-sm-4 col-12 p-0 justify-content-end">
                                <div class="inner-top-right">
                                    <ul class="d-flex list-unstyled justify-content-end">
                                        {{--                                                    <li>Online</li>--}}
                                        {{--                                                    <li>Store</li>--}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card-body p-0">
                                    <div class="current-sale-container">
                                        <div id="chart-currently"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            // currently sale
            var options = {
                series: [{
                    name: 'Pengeluaran',
                    data: [
                        @foreach($data1 as $d1)
                            {{$d1}},
                        @endforeach
                    ]
                }, {
                    name: 'Pemasukan',
                    data: [
                        @foreach($data2 as $d2)
                            {{$d2}},
                        @endforeach
                    ]
                }],
                chart: {
                    height: 320,
                    type: 'area',
                    toolbar: {
                        show: false
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    type: 'category',
                    low: 1,
                    offsetX: 0,
                    offsetY: 0,
                    show: false,
                    categories: [
                        @foreach($categories as $c)
                            '{{$c}}',
                        @endforeach
                    ],
                    labels: {
                        low: 0,
                        offsetX: 0,
                        show: false,
                    },
                    axisBorder: {
                        low: 0,
                        offsetX: 0,
                        show: false,
                    },
                },
                markers: {
                    strokeWidth: 3,
                    colors: "#ffffff",
                    strokeColors: [CubaAdminConfig.primary, CubaAdminConfig.secondary],
                    hover: {
                        size: 6,
                    }
                },
                yaxis: {
                    low: 0,
                    offsetX: 0,
                    offsetY: 0,
                    show: false,
                    labels: {
                        low: 0,
                        offsetX: 0,
                        show: false,
                    },
                    axisBorder: {
                        low: 0,
                        offsetX: 0,
                        show: false,
                    },
                },
                grid: {
                    show: false,
                    padding: {
                        left: 0,
                        right: 0,
                        bottom: -15,
                        top: -40
                    }
                },
                colors: [CubaAdminConfig.primary, CubaAdminConfig.secondary],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.5,
                        stops: [0, 80, 100]
                    }
                },
                legend: {
                    show: false,
                },
                tooltip: {
                    x: {
                        format: 'MM'
                    },
                },
            };

            var chart = new ApexCharts(document.querySelector("#chart-currently"), options);
            chart.render();
        });
    </script>
</div>
