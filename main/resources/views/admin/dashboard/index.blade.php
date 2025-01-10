@extends('layouts.admin.master')

@section('isi-konten-dashboard')
    @auth
        <p>Selamat Datang, {{ Auth::user()->nama }}!</p>
    @endauth

    @guest
        <p>Anda belum login</p>
    @endguest

    {{-- Role Penjual --}}
    <div class="col-lg">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title d-flex align-items-center gap-2">
                        Home
                    </h5>
                    <a type="button" class="btn btn-primary p-2 rounded-1" href="{{ route('event-create') }}">
                        Buat Event
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian Grafik Penjualan -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title d-flex align-items-center gap-2 mb-4">
                    Grafik Penjualan
                    <span>
                        <iconify-icon icon="solar:question-circle-bold" class="fs-7 d-flex text-muted"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-success"
                            data-bs-title="Penjualan Mingguan"></iconify-icon>
                    </span>
                </h5>
                <!-- Container utk chart Penjualan -->
                <div id="grafikPenjualan"></div>
            </div>
        </div>
    </div>

    <!-- Bagian Top 5 Event + Tipe Tiket Terlaris -->
    <div class="col-lg-12 mt-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title d-flex align-items-center gap-2 mb-4">
                    Top 5 Event + Tipe Tiket Terlaris
                    <span>
                        <iconify-icon icon="solar:question-circle-bold" class="fs-7 d-flex text-muted"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-success"
                            data-bs-title="Menampilkan event teratas dan tipe tiket terjual di setiap event"></iconify-icon>
                    </span>
                </h5>
                <div id="topEventsWithTicketTypesChart"></div>
            </div>
        </div>
    </div>

    @if (strtoupper(auth()->user()->cariRole->nama_role) === 'ADMIN')
        {{-- Bagian khusus ADMIN --}}
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        Jumlah User Online
                    </h5>
                    <hr>
                    <div id="onlineChart"></div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('js-tambahan')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. CHART USER BARU (Jika role Admin)
            const onlineUsersChartData = @json($onlineUsersChartData);

            // Setup ApexCharts
            let optionsOnline = {
                series: [{
                    name: 'User Online (Unique)',
                    data: onlineUsersChartData.counts
                }],
                chart: {
                    type: 'line',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                xaxis: {
                    categories: onlineUsersChartData.days,
                    labels: {
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                markers: {
                    size: 5
                },
                colors: ['#007bff'], // warna garis
                tooltip: {
                    shared: true,
                    intersect: false
                },
                grid: {
                    borderColor: '#e7e7e7'
                },
                legend: {
                    position: 'top'
                }
            };

            let chartOnline = new ApexCharts(document.querySelector("#onlineChart"), optionsOnline);
            chartOnline.render();


            // 2. CHART PENJUALAN
            const salesChartData = @json($salesChartData);

            let optionsPenjualan = {
                series: [{
                        name: 'Tiket Terjual',
                        data: salesChartData.ticket_sold
                    },
                    {
                        name: 'Pendapatan',
                        data: salesChartData.revenue
                    },
                ],
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: salesChartData.days,
                    labels: {
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                fill: {
                    opacity: 1
                },
                colors: ['#CAD2C5', '#84A98C'],
                dataLabels: {
                    enabled: false
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                    y: {
                        formatter: function(val, opts) {
                            // Series ke-2 = pendapatan
                            if (opts.seriesIndex === 1) {
                                return "Rp" + val.toLocaleString('id-ID');
                            }
                            return val;
                        }
                    }
                },
                grid: {
                    borderColor: '#e7e7e7',
                },
                legend: {
                    position: 'top'
                },
            };


            let chartPenjualan = new ApexCharts(document.querySelector("#grafikPenjualan"), optionsPenjualan);
            chartPenjualan.render();


            // 3. CHART TOP 5 EVENT + Tipe Tiket
            const combinedData = @json($topEventsWithTicketTypesChart);

            let optionsCombined = {
                series: combinedData.series,
                chart: {
                    type: 'bar',
                    height: 350,
                    stacked: true,
                    toolbar: {
                        show: false
                    }
                },
                xaxis: {
                    categories: combinedData.event_names,
                    labels: {
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                colors: ['#0077b6', '#00b4d8', '#48cae4', '#90e0ef', '#ade8f4', '#caf0f8'],
                dataLabels: {
                    enabled: false
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + ' Tiket';
                        }
                    }
                },
                grid: {
                    borderColor: '#e7e7e7'
                },
                legend: {
                    position: 'bottom'
                },
            };

            let chartCombined = new ApexCharts(
                document.querySelector("#topEventsWithTicketTypesChart"),
                optionsCombined
            );
            chartCombined.render();





        });
    </script>
@endsection
