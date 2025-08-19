@extends('layout.app')
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="container-fluid">

                <!-- Filter Tahun & Bulan -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <form class="row g-3 align-items-end">
                            <div class="col-md-3">
                                <label for="tahun" class="form-label">Tahun</label>
                                <select class="form-select" id="tahun" name="tahun" onchange="this.form.submit()">
                                    @php $currentYear = date('Y'); @endphp
                                    @for ($y = $currentYear - 5; $y <= $currentYear; $y++)
                                        <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>
                                            {{ $y }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="bulan" class="form-label">Bulan (Menu Terlaris)</label>
                                <select class="form-select" id="bulan" name="bulan" onchange="this.form.submit()">
                                    @for ($m = 1; $m <= 12; $m++)
                                        <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::create(null, (int) $m, 1)->format('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Card Histogram Pendapatan -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Pendapatan Tahunan</h5>
                    </div>
                    <div class="card-body">
                        <div id="chartPendapatan" style="height: 350px;"></div>
                    </div>
                </div>

                <!-- Card Pie Chart Menu Terlaris & Kurang Laris -->
                @if ($year && $month && $menuData->count() > 0)
                    <div class="row">
                        <!-- Top 5 Terlaris -->
                        <div class="col-md-6">
                            <div class="card shadow-sm mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">5 Menu Terlaris Bulan
                                        {{ \Carbon\Carbon::create(null, (int) $month, 1)->format('F') }}</h5>
                                </div>
                                <div class="card-body">
                                    <div id="chartMenuTerlaris" style="height: 350px;"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Top 5 Kurang Laris -->
                        <div class="col-md-6">
                            <div class="card shadow-sm mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">5 Menu Kurang Laris Bulan
                                        {{ \Carbon\Carbon::create(null, (int) $month, 1)->format('F') }}</h5>
                                </div>
                                <div class="card-body">
                                    <div id="chartMenuKurang" style="height: 350px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($year && $month)
                    <div class="card shadow-sm mb-4">
                        <div class="card-body text-center text-muted">
                            <h6>Tidak ada data menu untuk bulan ini.</h6>
                        </div>
                    </div>
                @endif


            </div>
        </div>
    </div>

    <!-- ApexCharts -->
    <script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Pendapatan per bulan
            var pendapatanData = @json($pendapatanData);
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
                colors: ['#0d6efd'],
                dataLabels: {
                    enabled: true
                },
                tooltip: {
                    y: {
                        formatter: val => 'Rp ' + val.toLocaleString()
                    }
                }
            };
            new ApexCharts(document.querySelector("#chartPendapatan"), optionsPendapatan).render();

            // Pie chart menu terlaris (hanya jika ada data)
            // Pie chart menu terlaris & kurang laris (hanya jika ada data)
            @if ($year && $month && $menuData->count() > 0)
                var menuLabels = @json($menuLabels);
                var menuData = @json($menuData);

                var menuKurangLabels = @json($menuKurangLabels);
                var menuKurangData = @json($menuKurangData);

                function generateColors(count) {
                    const baseColors = ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#6f42c1', '#fd7e14', '#20c997',
                        '#6610f2'
                    ];
                    return Array.from({
                        length: count
                    }, (_, i) => baseColors[i % baseColors.length]);
                }

                // Terlaris
                var optionsMenuTerlaris = {
                    chart: {
                        type: 'pie',
                        height: 350
                    },
                    series: menuData,
                    labels: menuLabels,
                    colors: generateColors(menuData.length),
                    tooltip: {
                        y: {
                            formatter: val => val + ' Terjual'
                        }
                    }
                };
                new ApexCharts(document.querySelector("#chartMenuTerlaris"), optionsMenuTerlaris).render();

                // Kurang Laris
                var optionsMenuKurang = {
                    chart: {
                        type: 'pie',
                        height: 350
                    },
                    series: menuKurangData,
                    labels: menuKurangLabels,
                    colors: generateColors(menuKurangData.length),
                    tooltip: {
                        y: {
                            formatter: val => val + ' Terjual'
                        }
                    }
                };
                new ApexCharts(document.querySelector("#chartMenuKurang"), optionsMenuKurang).render();
            @endif

        });
    </script>
@endsection
