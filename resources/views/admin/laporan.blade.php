@extends('layout.app')
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="container-fluid">

                <!-- Filter Tahun & Bulan -->
                <div class="card shadow-sm mb-4 p-3">
                    <form class="row g-3">
                        <div class="col-md-3">
                            <label for="tahun" class="form-label">Tahun</label>
                            <select class="form-select" id="tahun" onchange="this.form.submit()" name="tahun">
                                @php
                                    $currentYear = date('Y');
                                @endphp
                                @for ($y = $currentYear - 5; $y <= $currentYear; $y++)
                                    <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>
                                        {{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="bulan" class="form-label">Bulan (Menu Terlaris)</label>
                            <select class="form-select" id="bulan" onchange="this.form.submit()" name="bulan">
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create(null, (int) $m, 1)->format('F') }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </form>
                </div>

                <!-- Card Histogram Pendapatan Tahunan -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Pendapatan Tahunan</h5>
                    </div>
                    <div class="card-body">
                        <div id="chartPendapatan" style="height: 350px;"></div>
                    </div>
                </div>

                <!-- Card Pie Chart Menu Terlaris -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Persentase Menu Terlaris Bulan
                            {{ \Carbon\Carbon::create(null, (int) request('bulan', date('m')), 1)->format('F') }}</h5>
                    </div>
                    <div class="card-body">
                        <div id="chartMenu" style="height: 350px;"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ApexCharts -->
    <script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>
    <script>
        // Data Pendapatan per Bulan (dari controller)
        var pendapatanData = @json($pendapatanData); // misal: [500000,0,300000,...]
        var bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        var optionsPendapatan = {
            chart: {
                type: 'bar',
                height: 350
            },
            series: [{
                name: 'Pendapatan',
                data: pendapatanData
            }],
            xaxis: {
                categories: bulanLabels
            },
            colors: ['#0d6efd']
        };
        var chartPendapatan = new ApexCharts(document.querySelector("#chartPendapatan"), optionsPendapatan);
        chartPendapatan.render();

        // Data Persentase Menu Terlaris Bulan Tertentu
        var menuLabels = @json($menuLabels); // nama menu terlaris
        var menuData = @json($menuData); // jumlah terjual masing-masing

        var optionsMenu = {
            chart: {
                type: 'pie',
                height: 350
            },
            series: menuData,
            labels: menuLabels,
            colors: ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#6f42c1', '#fd7e14']
        };
        var chartMenu = new ApexCharts(document.querySelector("#chartMenu"), optionsMenu);
        chartMenu.render();
    </script>
@endsection
