@extends('layout.app')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="row">

                <!-- Dashboard Cards -->
                <div class="col-xl-3 col-md-6">
                    <div class="card dashnum-card overflow-hidden" style="background-color: #ffd966; color: black;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="avtar avtar-lg">
                                        <i class="ti ti-shopping-cart" style="color: black;"></i>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <h4>{{ $pesananHariIni }}</h4>
                                    <p class="mb-0">Pesanan Hari Ini</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card dashnum-card overflow-hidden" style="background-color: #a9d18e; color: black;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="avtar avtar-lg">
                                        <i class="ti ti-table" style="color: black;"></i>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <h4>{{ $mejaTersedia }}</h4>
                                    <p class="mb-0">Meja Tersedia</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card dashnum-card overflow-hidden" style="background-color: #f4b084; color: black;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="avtar avtar-lg">
                                        <i class="ti ti-alert-circle" style="color: black;"></i>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <h4>{{ $mejaTidakTersedia }}</h4>
                                    <p class="mb-0">Meja Tidak Tersedia</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card dashnum-card overflow-hidden" style="background-color: #ffe599; color: black;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="avtar avtar-lg">
                                        <i class="ti ti-currency-dollar" style="color: black;"></i>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <h4>Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h4>
                                    <p class="mb-0">Pendapatan Hari Ini</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grafik Pendapatan dan Data Pengguna Sebaris -->
                <div class="col-xl-8 col-md-12 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h5>Pendapatan Bulan Ini</h5>
                            <div id="pendapatanChart" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h5>Data Pengguna</h5>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($usersTop as $index => $user)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $user->nama }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ ucfirst($user->role) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 5 Pesanan Terbaru di bawah -->
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h5>5 Pesanan Terbaru</h5>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Meja</th>
                                            <th>Status</th>
                                            <th>Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pesananTerbaru as $index => $transaksi)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $transaksi->user->name }}</td>
                                                <td>Meja {{ $transaksi->meja->nomor_meja ?? '-' }}</td>
                                                <td>
                                                    @if ($transaksi->status == 'lunas')
                                                        <span class="badge bg-success">Lunas</span>
                                                    @else
                                                        <span class="badge bg-warning">Belum Lunas</span>
                                                    @endif
                                                </td>
                                                <td>{{ $transaksi->created_at->format('H:i d-m-Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ApexCharts -->
    <script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>
    <script>
        var options = {
            chart: {
                type: 'bar',
                height: 300
            },
            series: [{
                name: 'Pendapatan',
                data: @json(array_values($pendapatanGrafik))
            }],
            xaxis: {
                categories: @json(array_keys($pendapatanGrafik))
            },
            colors: ['#0d6efd']
        };

        var chart = new ApexCharts(document.querySelector("#pendapatanChart"), options);
        chart.render();
    </script>
@endsection
