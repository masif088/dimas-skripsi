@props([
'componentId' => 'some',
'title'=> 'No title',
'data1' => [],
'dataTitle1' => 'no title',
'data2' => [],
'dataTitle2' => 'no title',
'data3' => [],
'dataTitle3' => 'no title',
'categories' => [],
])
<div class="col-xl-12 xl-100 dashboard-sec box-col-12">
    <div class="card earning-card">
        <div class="card-header" style="padding: 20px">
            <h4>{{ $title }}</h4>
        </div>
        <div class="card-body p-0">
            <div class="row m-0">
                <div class="col-xl-12 p-0">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card-body p-0">
                                <div class="current-sale-container">
                                    <div id="{{$componentId}}"></div>
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
    document.addEventListener('DOMContentLoaded', () => {
        // currently sale
        var options = {
            series: [{
                name: '{{ $dataTitle1 }}',
                data: [
                    @foreach($data1 as $d1)
                        {{$d1}},
                    @endforeach
                ]
            }, {
                name: '{{ $dataTitle2 }}',
                data: [
                    @foreach($data2 as $d2)
                        {{$d2}},
                    @endforeach
                ]
            }, {
                name: '{{ $dataTitle3 }}',
                data: [
                    @foreach($data3 as $d3)
                        {{$d3}},
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
                strokeColors: [CubaAdminConfig.primary, CubaAdminConfig.secondary, '#00ff00'],
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
            colors: [CubaAdminConfig.primary, CubaAdminConfig.secondary, '#00ff00'],
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

        var chart = new ApexCharts(document.querySelector("#{{$componentId}}"), options);
        chart.render();
    });
</script>
