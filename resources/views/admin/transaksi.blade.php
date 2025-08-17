@extends('layout.app')
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="container-fluid">
                <!-- Card Laporan -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0">Laporan Transaksi</h5>
                            <p class="text-muted mb-0">Pilih tanggal untuk melihat laporan transaksi</p>
                        </div>
                        <div>
                            <form action="{{ route('laporan.export') }}" method="get" class="d-inline">
                                <input type="hidden" name="startDate" value="{{ $start }}">
                                <input type="hidden" name="endDate" value="{{ $end }}">
                                <button type="submit" class="btn btn-danger btn-sm">Export PDF</button>
                            </form>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Filter Tanggal -->
                        <form class="row g-3 mb-3">
                            <div class="col-sm-4 col-md-3">
                                <label for="startDate" class="form-label">Dari Tanggal</label>
                                <input type="date" class="form-control" id="startDate" name="startDate"
                                    value="{{ $start ?? '' }}">
                            </div>
                            <div class="col-sm-4 col-md-3">
                                <label for="endDate" class="form-label">Sampai Tanggal</label>
                                <input type="date" class="form-control" id="endDate" name="endDate"
                                    value="{{ $end ?? '' }}">
                            </div>
                            <div class="col-sm-4 col-md-3 align-self-end">
                                <button type="button" class="btn btn-primary"
                                    style="background-color: #fc9800; color: white;"
                                    onclick="filterLaporan()">Tampilkan</button>
                            </div>
                        </form>

                        <!-- Tabel Laporan -->
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead style="background-color: #fc9800; color: white;">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nama Menu</th>
                                        <th>Kategori</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no=1; @endphp
                                    @foreach ($transaksis as $transaksi)
                                        @foreach ($transaksi->detail as $detail)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $transaksi->created_at->format('Y-m-d') }}</td>
                                                <td>{{ $detail->menu->nama }}</td>
                                                <td>{{ ucfirst($detail->menu->kategori) }}</td>
                                                <td>{{ $detail->qty }}</td>
                                                <td>Rp {{ number_format($detail->menu->harga, 0, ',', '.') }}</td>
                                                <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function filterLaporan() {
            let start = document.getElementById('startDate').value;
            let end = document.getElementById('endDate').value;
            window.location.href = `?startDate=${start}&endDate=${end}`;
        }
    </script>
@endsection
