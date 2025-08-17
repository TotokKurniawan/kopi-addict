@extends('layout.app')
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="container-fluid">

                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Data Pesanan</h5>
                    </div>
                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <!-- Tabs -->
                        <ul class="nav nav-tabs mb-3" id="statusTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="belum-lunas-tab" data-bs-toggle="tab"
                                    data-bs-target="#belum-lunas" type="button" role="tab" aria-controls="belum-lunas"
                                    aria-selected="true">
                                    Belum Lunas
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="lunas-tab" data-bs-toggle="tab" data-bs-target="#lunas"
                                    type="button" role="tab" aria-controls="lunas" aria-selected="false">
                                    Lunas
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content" id="statusTabContent">
                            <!-- Belum Lunas -->
                            <div class="tab-pane fade show active" id="belum-lunas" role="tabpanel"
                                aria-labelledby="belum-lunas-tab">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead style="background-color: #fc9800; color: white;">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Meja</th>
                                                <th>Item</th>
                                                <th>Metode Pembayaran</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no1 = 1; @endphp
                                            @foreach ($transaksis->where('status', 'belum lunas') as $transaksi)
                                                <tr id="tr-{{ $transaksi->id }}">
                                                    <td>{{ $no1++ }}</td>
                                                    <td>{{ $transaksi->meja->nama_reservasi }}</td>
                                                    <td>
                                                        <ul>
                                                            @foreach ($transaksi->detail as $detail)
                                                                <li>{{ $detail->menu->nama }} (x{{ $detail->qty }})</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td>{{ ucfirst($transaksi->pembayaran) }}</td>
                                                    <td>
                                                        <span class="badge bg-warning text-dark">Belum Lunas</span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-success btn-sm"
                                                            onclick="tandaiLunas({{ $transaksi->id }})">
                                                            Tandai Lunas
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Lunas -->
                            <div class="tab-pane fade" id="lunas" role="tabpanel" aria-labelledby="lunas-tab">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead style="background-color: #28a745; color: white;">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Meja</th>
                                                <th>Item</th>
                                                <th>Metode Pembayaran</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no2 = 1; @endphp
                                            @foreach ($transaksis->where('status', 'lunas') as $transaksi)
                                                <tr>
                                                    <td>{{ $no2++ }}</td>
                                                    <td>{{ $transaksi->meja->nomor_meja }}</td>
                                                    <td>
                                                        <ul>
                                                            @foreach ($transaksi->detail as $detail)
                                                                <li>{{ $detail->menu->nama }} (x{{ $detail->qty }})</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td>{{ ucfirst($transaksi->pembayaran) }}</td>
                                                    <td>
                                                        <span class="badge bg-success">Lunas</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-success">✔</span>
                                                    </td>
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
    </div>

    <!-- Tambahkan SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function tandaiLunas(transaksiId) {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah Anda yakin menandai transaksi ini lunas?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, tandai lunas',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('/transaksi/' + transaksiId + '/lunas', {
                            method: 'PUT',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({})
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Transaksi berhasil ditandai lunas.',
                                    timer: 1500,
                                    showConfirmButton: false
                                });

                                // Download struk PDF
                                window.location.href = '/transaksi/struklunas/' + data.transaksi_id;

                                // Reload halaman supaya status berubah menjadi Lunas
                                setTimeout(() => {
                                    window.location.reload();
                                }, 2000);
                            } else {
                                Swal.fire('Gagal!', 'Transaksi gagal ditandai lunas.', 'error');
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            Swal.fire('Error!', 'Terjadi kesalahan server.', 'error');
                        });
                }
            });
        }
    </script>
@endsection
