@props(['title','datas','id'])
<div class="col-xl-12 appointment box-col-12">
    <div class="card">
        <div class="card-Body">
            <div class="radar-chart">
                <div id="{{$id}}"></div>
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
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        var borderColor = ['#FAA255', '#F0C348', '#E27CF1', '#F562AC', '#EB5959', '#9EE67A', '#50D989', '#66CFF2', '#7F7CE6'];
        borderColor = shuffle(borderColor);
        var options1 = {
            title: {
                text: "{{$title}}",
                align: 'left',
                margin: 20,
                offsetX: 10,
                offsetY: 10,
                floating: false,
                style: {
                    fontSize: '28px',
                    fontWeight: 'bold',
                    fontFamily: undefined,
                    color: '#263238'
                },
            },
            dataLabels: {
                enabled: false,
                orientation: 'vertical',
                position: 'center'
            },
            legend: {
                show: true
            },
            chart: {
                height: 380,
                type: 'bar',
                toolbar: {
                    show: true,
                    margin: 20,
                    offsetX: 120,
                    offsetY: 120,
                    tools: {
                        download: true,
                    }
                },
            },
            series: [
                    @foreach($datas as $key=>$data)
                {
                    name: '{{ $key }}',
                    data: [@foreach($data as $d) {{$d}}, @endforeach],
                },
                @endforeach
            ],
            stroke: {
                width: 3,
                curve: 'smooth',
            },
            labels: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum at', 'Sabtu'],
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
                        return numberWithCommas(val)
                    }
                }
            },
            yaxis: {
                tickAmount: 12,
                labels: {
                    formatter: function (val, i) {
                        if (i % 2 === 0) {
                            return numberWithCommas(val)
                        } else {
                            return ''
                        }
                    }
                }
            }
        }

        var chart1 = new ApexCharts(
            document.querySelector("#{{$id}}"),
            options1
        );

        chart1.render();
    });
</script>


