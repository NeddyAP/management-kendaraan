@extends('layouts.app', ['page' => 'Home', 'page2' => '', 'page3' => ''])

@section('content')
    <!-- Row start -->
    <div class="row">
        <div class="col-xxl-4 col-sm-6 col-12">
            <div class="stats-tile">
                <div class="sale-icon shade-yellow">
                    <h4 class="text-white">Rp</h4>
                </div>
                <div class="sale-details">
                    <h3 class="text-yellow">
                        {{ number_format($paguAnggaran - $belanja_tahunan, 0, ',', '.') }}
                    </h3>
                    <p>Sisa Anggaran Tahun {{ \Carbon\Carbon::now()->translatedFormat('Y') }}</p>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-sm-6 col-12">
            <a href="{{ route('paguAnggaran.index') }}">
                <div class="stats-tile">
                    <div class="sale-icon shade-blue">
                        <h4 class="text-white">Rp</h4>
                    </div>
                    <div class="sale-details">
                        <h3 class="text-blue">
                            {{ number_format($paguAnggaran, 0, ',', '.') }}
                        </h3>
                        <p>Pagu Anggaran Tahun {{ \Carbon\Carbon::now()->translatedFormat('Y') }}</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxl-4 col-sm-6 col-12">
            <a href="#">
                <div class="stats-tile">
                    <div class="sale-icon shade-red">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div class="sale-details">
                        <h3 class="text-red">{{ $isExpire }}/{{ $kendaraan }}</h3>
                        <p>Kadaluarsa Pajak</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <!-- Row end -->

    <!-- Row start -->
    <div class="row">
        <div class="col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Transaksi</div>
                </div>
                <div class="card-body">
                    <div class="scroll370">
                        <div class="transactions-container">
                            <div class="transaction-block">
                                <div class="transaction-icon shade-blue">
                                    <h4 class="text-white">Rp</h4>
                                </div>
                                <div class="transaction-details">
                                    <h4>Total Belanja</h4>
                                    <p class="text-truncate">Tahun {{ \Carbon\Carbon::now()->translatedFormat('Y') }}</p>
                                </div>
                                <div class="transaction-amount text-blue">Rp
                                    {{ number_format($belanja_tahunan, 0, ',', '.') }}</div>
                            </div>
                            <div class="transaction-block">
                                <div class="transaction-icon shade-blue">
                                    <h4 class="text-white">Rp</h4>
                                </div>
                                <div class="transaction-details">
                                    <h4>Total Belanja</h4>
                                    <p class="text-truncate">Bulan {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</p>
                                </div>
                                <div class="transaction-amount text-green">Rp
                                    {{ number_format($belanja_bulanan, 0, ',', '.') }}
                                </div>
                            </div>
                            <div class="transaction-block">
                                <div class="transaction-icon shade-blue">
                                    <i class="bi bi-truck"></i>
                                </div>
                                <div class="transaction-details">
                                    <h4>Bahan Bakar</h4>
                                    <p class="text-truncate">Bensin & Solar</p>
                                </div>
                                <div class="transaction-amount text-blue">Rp
                                    {{ number_format($belanjas->sum('belanja_bahan_bakar_minyak'), 0, ',', '.') }}</div>
                            </div>
                            <div class="transaction-block">
                                <div class="transaction-icon shade-blue">
                                    <i class="bi bi-droplet"></i>
                                </div>
                                <div class="transaction-details">
                                    <h4>Pelumas</h4>
                                    <p class="text-truncate">Pelumas Mesin</p>
                                </div>
                                <div class="transaction-amount text-blue">Rp
                                    {{ number_format($belanjas->sum('belanja_pelumas_mesin'), 0, ',', '.') }}</div>
                            </div>
                            <div class="transaction-block">
                                <div class="transaction-icon shade-blue">
                                    <i class="bi bi-nut"></i>
                                </div>
                                <div class="transaction-details">
                                    <h4>Suku Cadang</h4>
                                    <p class="text-truncate">Suku Cadang</p>
                                </div>
                                <div class="transaction-amount text-blue">Rp
                                    {{ number_format($belanjas->sum('belanja_suku_cadang'), 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Data Pajak</div>
                </div>
                <div class="card-body">
                    <div id="taskGraph"></div>
                    <ul class="task-list-container">
                        <li class="task-list-item">
                            <div class="task-icon shade-green">
                                <i class="bi bi-clipboard-check"></i>
                            </div>
                            <div class="task-info">
                                <h5 class="task-title">Pajak Aktif</h5>
                                <p class="amount-spend">{{ $kendaraan - $isExpire }}</p>
                            </div>
                        </li>
                        <li class="task-list-item">
                            <div class="task-icon shade-red">
                                <i class="bi bi-clipboard-x"></i>
                            </div>
                            <div class="task-danger">
                                <h5 class="task-title">Pajak Kadaluarsa</h5>
                                <p class="amount-spend">{{ $isExpire }}</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->
@endsection

@section('script')
    <script src="{{ secure_asset('vendor/apex/apexcharts.min.js') }}"></script>
    <script src="{{ secure_asset('vendor/apex/custom/sales/salesGraph.js') }}"></script>
    <script src="{{ secure_asset('vendor/apex/custom/sales/revenueGraph.js') }}"></script>

    <script>
        var options = {
            chart: {
                height: 300,
                type: 'radialBar',
                toolbar: {
                    show: false,
                },
            },
            plotOptions: {
                radialBar: {
                    dataLabels: {
                        name: {
                            fontSize: '12px',
                            fontColor: 'black',
                            fontFamily: 'Merriweather',
                        },
                        value: {
                            fontSize: '21px',
                            fontFamily: 'Merriweather',
                        },
                        total: {
                            show: true,
                            label: 'Kendaraan',
                            formatter: function(w) {
                                return '{{ $kendaraan }}';
                            }
                        }
                    }
                }
            },
            series: [{{ (($kendaraan - $isExpire) / $kendaraan) * 100 }}, {{ ($isExpire / $kendaraan) * 100 }}],
            labels: ['Aktif', 'Kadaluarsa'],
            colors: ['#26ba4f', '#f87957'],
        }

        var chart = new ApexCharts(
            document.querySelector("#taskGraph"),
            options
        );
        chart.render();
    </script>
@endsection
