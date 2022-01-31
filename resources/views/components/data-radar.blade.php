@props(['title'])
<div class="col-xl-6 appointment box-col-6">
    <div class="card">
        <div class="card-header">
            <div class="header-top">
                <h5 class="m-0">{{$title}}</h5>
                <div class="card-header-right-icon">
                    {{--                    <div class="dropdown">--}}
                    {{--                        <button class="btn dropdown-toggle" id="dropdownMenuButton" type="button"--}}
                    {{--                                data-bs-toggle="dropdown" aria-expanded="false">Year--}}
                    {{--                        </button>--}}
                    {{--                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"><a--}}
                    {{--                                class="dropdown-item" href="#">Year</a><a class="dropdown-item" href="#">Month</a><a--}}
                    {{--                                class="dropdown-item" href="#">Day</a></div>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div>
        <div class="card-Body">
            <div class="radar-chart">
                <div id="{{$title}}"></div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('livewire:load', function () {
        function shuffle(array) {
            var currentIndex = array.length, randomIndex;
            while (currentIndex != 0) {
                randomIndex = Math.floor(Math.random() * currentIndex);
                currentIndex--;
                [array[currentIndex], array[randomIndex]] = [
                    array[randomIndex], array[currentIndex]];
            }
            return array;
        }

        var borderColor = ['#FAA255', '#F0C348', '#E27CF1', '#F562AC', '#EB5959', '#9EE67A', '#50D989', '#66CFF2', '#7F7CE6'];
        borderColor = shuffle(borderColor);
        var options1 = {
            chart: {
                height: 380,
                type: 'radar',
                toolbar: {
                    show: false
                },
            },
            series: [{
                name: 'Minggu 1',
                data: [20, 100, 40, 30, 50, 80, 33],
            }, {
                name: 'Minggu 2',
                data: [30, 120, 50, 50, 40, 10, 33],
            }, {
                name: 'Minggu 3',
                data: [40, 100, 40, 30, 50, 80, 50],
            }, {
                name: 'Minggu 4',
                data: [50, 130, 50, 10, 30, 20, 60],
            },
            ],
            stroke: {
                width: 3,
                curve: 'smooth',
            },
            labels: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            plotOptions: {
                radar: {
                    size: 140,
                    polygons: {
                        fill: {
                            colors: ['#fcf8ff', '#f7eeff']
                        },

                    }
                }
            },
            colors: borderColor,

            markers: {
                size: 6,
                colors: ['#fff'],
                strokeColor: borderColor,
                strokeWidth: 3,
            },

            tooltip: {
                y: {
                    formatter: function (val) {
                        return val
                    }
                }
            },
            yaxis: {
                tickAmount: 7,
                labels: {
                    formatter: function (val, i) {
                        if (i % 2 === 0) {
                            return val
                        } else {
                            return ''
                        }
                    }
                }
            }
        }

        var chart1 = new ApexCharts(
            document.querySelector("#{{$title}}"),
            options1
        );

        chart1.render();
    });
</script>


