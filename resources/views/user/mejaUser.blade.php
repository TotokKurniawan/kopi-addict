@extends('layout.appuser')
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="container-fluid">
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Daftar Meja</h5>
                        <p class="text-muted mb-0">Lihat status meja dan nama reservasi meja</p>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            @foreach ($mejas as $meja)
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="card text-center shadow-sm h-100">
                                        <div class="card-body d-flex flex-column justify-content-between">
                                            <div>
                                                <h6 class="card-title">Meja {{ $meja->nomor_meja }}</h6>
                                                <p class="card-text mb-1">
                                                    Status:
                                                    @if ($meja->status == 'tersedia')
                                                        <span class="badge bg-success">Tersedia</span>
                                                    @elseif($meja->status == 'sedangdigunakan')
                                                        <span class="badge bg-danger">Sedang Digunakan</span>
                                                    @else
                                                        <span class="badge bg-warning text-dark">Sudah Dipesan</span>
                                                    @endif
                                                </p>
                                                <p class="card-text mb-2">
                                                    Nama reservasi: {{ $meja->nama_reservasi ?? '-' }}
                                                </p>
                                            </div>

                                            @if ($meja->status == 'tersedia')
                                                <button class="btn btn-primary btn-sm mt-auto btnReservasi"
                                                    data-id="{{ $meja->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#modalReservasi">
                                                    Pilih Meja
                                                </button>
                                            @elseif($meja->status == 'sudahdipesan')
                                                <a href="{{ route('transaksiPemesananUser', ['meja_id' => $meja->id]) }}"
                                                    class="btn btn-warning btn-sm mt-auto">
                                                    Selesaikan Pembayaran
                                                </a>
                                            @else
                                                <button class="btn btn-secondary btn-sm mt-auto btnSelesai"
                                                    data-id="{{ $meja->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#modalSelesaiMeja">
                                                    Selesai
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Tombol Tambah Meja -->
                        <div class="d-flex justify-content-center mt-3">
                            <a href="{{ route('tambahMejaUser') }}" class="btn btn-primary btn-sm">Tambah Meja</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('user.modal.modal-meja')

    <script>
        // Script untuk mengisi form reservasi dengan meja yang dipilih
        var modalReservasi = document.getElementById('modalReservasi');
        modalReservasi.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var mejaId = button.getAttribute('data-id');
            modalReservasi.querySelector('#mejaId').value = mejaId;
        });

        // Script untuk mengisi form selesai meja
        var modalSelesai = document.getElementById('modalSelesaiMeja');
        modalSelesai.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var mejaId = button.getAttribute('data-id');
            modalSelesai.querySelector('#mejaSelesaiId').value = mejaId;
        });
    </script>
@endsection
