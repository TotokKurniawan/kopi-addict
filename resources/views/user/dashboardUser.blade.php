@extends('layout.appuser')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="row">

                <!-- Kartu Statistik -->
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

                <!-- Tabel Ringkas Pesanan -->
                <div class="col-xl-8 col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h5>5 Pesanan Terbaru</h5>
                        </div>
                        <div class="card-body table-responsive">
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
                                    @foreach ($pesananTerbaru as $index => $pesanan)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $pesanan->user->name ?? '-' }}</td>
                                            <td>{{ $pesanan->meja->nomor_meja ?? '-' }}</td>
                                            <td>
                                                @if ($pesanan->status == 'belum lunas')
                                                    <span class="badge bg-warning">Pending</span>
                                                @else
                                                    <span class="badge bg-success">Selesai</span>
                                                @endif
                                            </td>
                                            <td>{{ $pesanan->created_at->format('H:i d-m-Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Progress Bar Meja -->
                <div class="col-xl-4 col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h5>Status Meja</h5>
                        </div>
                        <div class="card-body">
                            <p>Meja Terpakai: {{ $mejaTerpakai }} / {{ $totalMeja }}</p>
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $progressMeja }}%"
                                    aria-valuenow="{{ $mejaTerpakai }}" aria-valuemin="0"
                                    aria-valuemax="{{ $totalMeja }}"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
