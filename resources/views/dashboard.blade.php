@extends('layouts.main')
<style>
    .none {
        display: none;
    }
</style>
@section('home')
<form action="/" method="GET">
    {{-- @csrf --}}
    <div class="row m-3">
        <div class="col-lg-4 col-md-6 col-sm-6 mb-4" id="">
            <div class="card shadow-lg rounded-3" style="height: 200px;">
                <div class="card-body row mt-2">
                    <p class="card-title">SUHU <span
                            class="float-end"><?php echo ($dataNow) ? $dataNow->created_at : 0 ?></span></p>
                    <p class="card-text text-center" style="font-size: 40px">
                        {{ ($dataNow) ? $dataNow->temperature : 0 }} °C</p>
                </div>
                @if($dataNow)
                @if ($dataNow->temperature <= 30 ) <div class="card-footer"
                    style="background-color: green; font-weight: bold;">
                    <span class="text-center"><img src="Gambar/smiling.png" height="30px" width="30px" alt="" srcset="">
                        Suhu Normal !! </span>
            </div>
            @endif
            @if ($dataNow->temperature > 35)
            <div class="card-footer" style="background-color: red; font-weight: bold;">
                <span class="text-center"><img src="Gambar/sad.png" height="30px" width="30px" alt="" srcset=""> Suhu
                    Tinggi !! </span>
            </div>
            @endif
            @endif
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6  mb-4 ">
        <div class="card shadow-lg rounded-3" style="height: 200px;">
            <div class="card-body row">
                <p class="card-title">KELEMBABAN TANAH<span
                        class="float-end">{{ ($dataNow) ? $dataNow->created_at : 0 }}</span></p>
                <p class="card-text text-center" style="font-size: 40px">{{ ($dataNow) ? $dataNow->soil_moisture : 0 }}
                    %</p>
            </div>
            @if($dataNow)
            @if ($dataNow->soil_moisture >= 50 )
            <div class="card-footer" style="background-color: green; font-weight: bold;">
                <span class="text-center"><img src="Gambar/smiling.png" height="30px" width="30px" alt="" srcset="">
                    Tanah Normal !! </span>
            </div>
            @endif
            @if ($dataNow->soil_moisture <= 49) <div class="card-footer"
                style="background-color: red; font-weight: bold;">
                <span class="text-center"><img src="Gambar/sad.png" height="30px" width="30px" alt="" srcset=""> Tanah
                    Kering !! </span>
        </div>
        @endif
        @endif
    </div>
    </div>


    <div class="m-4 row">
        <div class="card  bar col-lg-4 mb-4">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#temp-harian" role="tab" aria-controls="CO-harian"
                            aria-selected="true">Chart Harian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#temp-bulanan" role="tab" aria-controls="CO-bulanan"
                            aria-selected="false">Chart Bulanan</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">

                <div class="tab-content mt-3">
                    <div class="tab-pane active" id="temp-harian" role="tabpanel">
                        <canvas class="rounded-3" id="temp-chart"></canvas>
                    </div>

                    <div class="tab-pane" id="temp-bulanan" role="tabpanel" aria-labelledby="temp-tab">
                        <canvas class="rounded-3" id="temp-chart-bulanan"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="card  bar col-lg-4 mb-4">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#soil-harian" role="tab" aria-controls="soil-harian"
                            aria-selected="true">Chart Harian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#soil-bulanan" role="tab" aria-controls="soil-bulanan"
                            aria-selected="false">Chart Bulanan</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">

                {{-- <h4 class="card-title">Kadar</h4> --}}

                <div class="tab-content">
                    <div class="tab-pane active" id="soil-harian" role="tabpanel">
                        <canvas class="rounded-3 " id="soil-chart"></canvas>
                    </div>

                    <div class="tab-pane" id="soil-bulanan" role="tabpanel" aria-labelledby="soil-tab">
                        <canvas class="rounded-3 " id="soil-chart-bulanan"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </section>


    @endsection

    @section('js')
    <script type="text/javascript">
        $('#bologna-list a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
        // const select_wilayah = document.getElementById('select_wilayah');
        // select_wilayah.addEventListener('change', select);
        // function select(){
        //     console.log(select_wilayah.value);
        //     chart.data.datasets[0].data = select_wilayah.value.split(',');
        //     chart.update();
        // }

        // document.getElementById('malang').classList.remove('none');

        //     function enableBrand(answer){
        //     if(answer.value == 'malang'){
        //         // document.getElementById('surabaya').style.display = "none";
        //         // document.getElementById('malang').classList.remove = "none";
        //         document.getElementById('malang').classList.remove('none');
        //         document.getElementById('surabaya').classList.add('none');
        //         // document.getElementById('malang').style.display = "on";
        //     }else if(answer.value == 'surabaya'){
        //         document.getElementById('surabaya').classList.remove('none');
        //         document.getElementById('malang').classList.add('none');
        //     }else{
        //         document.getElementById('surabaya').classList.add('none');
        //         document.getElementById('malang').classList.add('none');
        //     }
        //     console.log(answer.value);
        // }


        //     //   $(function(){
        //           //Kode 1

        var cData = JSON.parse(`<?php echo $temp; ?>`);
        var cData1 = JSON.parse(`<?php echo $tempMonthly; ?>`);
        var cData2 = JSON.parse(`<?php echo $soil; ?>`);
        var cData22 = JSON.parse(`<?php echo $soilMonthly; ?>`);



        var ctx = $("#temp-chart");
        var ctx2 = $("#soil-chart");

        var ctx1 = $("#temp-chart-bulanan");
        var ctx22 = $("#soil-chart-bulanan");

        //   var ctx33 = $("#CH4-chart-bulanan");
        //   var ctx4 = $("#gabungan-chart");
        //   var ctx44 = $("#gabungan-chart-bulanan");

        //pie chart data

        var data = {
            labels: cData.label,
            datasets: [{
                label: "Temperature",
                data: cData.data,
                backgroundColor: "rgba(158, 118, 80, 0.288)",
                borderColor: "rgba(158, 118, 80, 1)",
                borderWidth: 2,
                hoverBackgroundColor: "rgba(158, 118, 80, 0.58)",
                hoverBorderColor: "rgba(158, 118, 80, 1)",
            }]
        };
        var data1 = {
            labels: cData1.label,
            datasets: [{
                label: "Temperature",
                data: cData1.data,
                backgroundColor: "rgba(158, 118, 80, 0.288)",
                borderColor: "rgba(158, 118, 80, 1)",
                borderWidth: 2,
                hoverBackgroundColor: "rgba(158, 118, 80, 0.58)",
                hoverBorderColor: "rgba(158, 118, 80, 1)",
            }]
        };
        var data2 = {
            labels: cData2.label,
            datasets: [{
                label: "Kelembapan Tanah",
                data: cData2.data,
                backgroundColor: "rgba(255,99,132,0.2)",
                borderColor: "rgba(255,99,132,1)",
                borderWidth: 2,
                hoverBackgroundColor: "rgba(255,99,132,0.4)",
                hoverBorderColor: "rgba(255,99,132,1)",
            }]
        };
        var data22 = {
            labels: cData22.label,
            datasets: [{
                label: "Kelembapan Tanah",
                data: cData22.data,
                backgroundColor: "rgba(255,99,132,0.2)",
                borderColor: "rgba(255,99,132,1)",
                borderWidth: 2,
                hoverBackgroundColor: "rgba(255,99,132,0.4)",
                hoverBorderColor: "rgba(255,99,132,1)",
            }]
        };

        var options1 = {
            scales: {
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: '°C',
                        color: '#911',
                        font: {
                            family: 'Comic Sans MS',
                            size: 12,
                            weight: 'bold',
                            lineHeight: 1.2,
                        },
                        padding: {
                            top: 20,
                            left: 0,
                            right: 0,
                            bottom: 0
                        }
                    },
                    stacked: true,
                    grid: {
                        display: true,
                        color: "rgba(255,99,132,0.2)"
                    }
                },
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'bulan',
                        color: '#911',
                        font: {
                            family: 'Comic Sans MS',
                            size: 12,
                            weight: 'bold',
                            lineHeight: 1.2,
                        },
                        padding: {
                            top: 20,
                            left: 0,
                            right: 0,
                            bottom: 0
                        }
                    },
                    grid: {
                        display: false
                    }
                }
            },
        }
        var options = {
            scales: {
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: '°C',
                        color: '#911',
                        font: {
                            family: 'Comic Sans MS',
                            size: 12,
                            weight: 'bold',
                            lineHeight: 1.2,
                        },
                        padding: {
                            top: 20,
                            left: 0,
                            right: 0,
                            bottom: 0
                        }
                    },
                    stacked: true,
                    grid: {
                        display: true,
                        color: "rgba(255,99,132,0.2)"
                    }
                },
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'hari',
                        color: '#911',
                        font: {
                            family: 'Comic Sans MS',
                            size: 12,
                            weight: 'bold',
                            lineHeight: 1.2,
                        },
                        padding: {
                            top: 20,
                            left: 0,
                            right: 0,
                            bottom: 0
                        }
                    },
                    grid: {
                        display: false
                    }
                }
            },

        };

        var optionsSoil = {
            scales: {
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: '%',
                        color: '#911',
                        font: {
                            family: 'Comic Sans MS',
                            size: 12,
                            weight: 'bold',
                            lineHeight: 1.2,
                        },
                        padding: {
                            top: 20,
                            left: 0,
                            right: 0,
                            bottom: 0
                        }
                    },
                    stacked: true,
                    grid: {
                        display: true,
                        color: "rgba(255,99,132,0.2)"
                    }
                },
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'bulan',
                        color: '#911',
                        font: {
                            family: 'Comic Sans MS',
                            size: 12,
                            weight: 'bold',
                            lineHeight: 1.2,
                        },
                        padding: {
                            top: 20,
                            left: 0,
                            right: 0,
                            bottom: 0
                        }
                    },
                    grid: {
                        display: false
                    }
                }
            },
        }
        var options1Soil = {
            scales: {
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: '%',
                        color: '#911',
                        font: {
                            family: 'Comic Sans MS',
                            size: 12,
                            weight: 'bold',
                            lineHeight: 1.2,
                        },
                        padding: {
                            top: 20,
                            left: 0,
                            right: 0,
                            bottom: 0
                        }
                    },
                    stacked: true,
                    grid: {
                        display: true,
                        color: "rgba(255,99,132,0.2)"
                    }
                },
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'hari',
                        color: '#911',
                        font: {
                            family: 'Comic Sans MS',
                            size: 12,
                            weight: 'bold',
                            lineHeight: 1.2,
                        },
                        padding: {
                            top: 20,
                            left: 0,
                            right: 0,
                            bottom: 0
                        }
                    },
                    grid: {
                        display: false
                    }
                }
            },

        };

        var chart = new Chart(ctx, {
            type: "bar",
            data: data,
            options: options

        });
        var chart = new Chart(ctx1, {
            type: "bar",
            data: data1,
            options: options1
        });
        var chart = new Chart(ctx2, {
            type: "bar",
            data: data2,
            options: options1Soil
        });
        var chart = new Chart(ctx22, {
            type: "bar",
            data: data22,
            options: optionsSoil
        });



        $(document).ready(function () {
            $('#select_wilayah').change(function () {
                const select_wilayah = $(this).val();
                if (select_wilayah != '') {
                    // alert(select_wilayah);
                    // data.select_wilayah;
                }
            })
        })
        //   });
    </script>
    @endsection