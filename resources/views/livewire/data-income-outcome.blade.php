<div class="col-xl-12 xl-100 dashboard-sec box-col-12">
    <div class="card earning-card">
        <div class="card-body p-0">
            <div class="row m-0">
                <div class="col-xl-12 p-0">
                    <div class="row p-5 pb-0">
                        <div class="col-xl-4 p-0 left_side_earning">
                            <h5>DATA</h5>
                            <p class="font-roboto">Peramalan Perkiraan</p>
                        </div>

                        <div class="col-xl-4 p-0 left_side_earning">
                            <h5>Ramalan Error</h5>
                            <p class="font-roboto">{{ number_format($error,2)??'-' }}%</p>
                        </div>
                        <div class="col-xl-4 p-0 left_side_earning">
                            <h5>Perkiraan kenaikan dalam 12bulan</h5>
                            <p class="font-roboto">
                                @if($forecast>0)
                                    <i class="fa fa-sort-up text-success">{{$forecast}}%</i>
                                @else
                                    <i class="fa fa-sort-down text-danger">{{$forecast}}%</i>
                                @endif

                            </p>
                        </div>
                    </div>
                    <div class="chart-right">
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
                    name: 'Data asli',
                    data: [
                        @foreach($data1 as $d1)
                            {{$d1}},
                        @endforeach
                    ]
                }, {
                    name: 'Hasil ramalan',
                    data: [
                        @foreach($data2 as $d2)
                            {{$d2}},
                        @endforeach
                    ]
                }],
                chart: {
                    height: 500,
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
                        show: true,
                    },
                    axisBorder: {
                        low: 0,
                        offsetX: 0,
                        show: true,
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
                    show: true,
                    labels: {
                        low: 0,
                        offsetX: 0,
                        show: true,
                    },
                    axisBorder: {
                        low: 0,
                        offsetX: 0,
                        show: true,
                    },
                },
                grid: {
                    show: true,
                    padding: {
                        left: 0,
                        right: 0,
                        // bottom: -15,
                        // top: -20
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
