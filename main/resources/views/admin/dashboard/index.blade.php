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
                        <span class="me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                <path d="M16 3l0 4" />
                                <path d="M8 3l0 4" />
                                <path d="M4 11l16 0" />
                                <path d="M8 15h2v2h-2z" />
                            </svg>
                        </span>
                        Buat Event
                    </a>
                </div>
            </div>
        </div>
    </div>

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
                <!-- Container utk chart -->
                <div id="grafikPenjualan"></div>
            </div>
        </div>
    </div>

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
        {{-- Role Admin --}}
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title d-flex align-items-center gap-2 mb-4">
                        Jumlah user yang aktif
                        <span>
                            <iconify-icon icon="solar:question-circle-bold" class="fs-7 d-flex text-muted"
                                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-success"
                                data-bs-title="Traffic Overview"></iconify-icon>
                        </span>
                    </h5>
                    <div id="grafik"></div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('js-tambahan')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ---------------- [ User Aktif ] ---------------
            const chartData = @json($chartData);

            let options = {
                series: [{
                    name: 'user',
                    data: chartData.counts
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
                    width: 3,
                },
                xaxis: {
                    categories: chartData.days,
                    labels: {
                        style: {
                            fontSize: '12px',
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            fontSize: '12px',
                        }
                    }
                },
                colors: ['#007bff'],
                markers: {
                    size: 5
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                },
                grid: {
                    borderColor: '#e7e7e7',
                },

            };

            let chart = new ApexCharts(document.querySelector("#grafik"), options);
            chart.render();

            // ================= [ Chart Penjualan ] =================
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
                    type: 'bar', // misal bar chart
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
                            fontSize: '12px',
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            fontSize: '12px',
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


            // ---------------- [ Top 5 Event Terlaris ] ---------------
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
