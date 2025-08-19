@extends('layout.app')
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
                                    <div class="card text-center border-5 h-100">
                                        <div class="card-body d-flex flex-column border-2 justify-content-between">
                                            <div>
                                                <h6 class="card-title">Meja {{ $meja->nomor_meja }}</h6>
                                                <p class="card-text mb-1">
                                                    Status:
                                                    @if ($meja->status == 'kosong')
                                                        <span class="badge bg-success">Kosong</span>
                                                    @elseif($meja->status == 'aktif')
                                                        <span class="badge bg-danger">Aktif</span>
                                                    @endif
                                                </p>
                                            </div>

                                            @if ($meja->status == 'kosong')
                                                <!-- Tombol Pilih Meja -->
                                                <button class="btn btn-primary btn-sm mt-auto" data-bs-toggle="modal"
                                                    data-bs-target="#modalReservasi{{ $meja->id }}">
                                                    Pilih Meja
                                                </button>

                                                <!-- Modal khusus meja ini -->
                                                <div class="modal fade" id="modalReservasi{{ $meja->id }}"
                                                    tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <form action="{{ route('meja.reservasiadmin', $meja->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <!-- id dikirim lewat hidden -->
                                                                <input type="hidden" name="meja_id"
                                                                    value="{{ $meja->id }}">

                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Konfirmasi Reservasi</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah Anda yakin ingin menggunakan
                                                                    <strong>Meja {{ $meja->nomor_meja }}</strong> ?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-primary">Ya,
                                                                        Gunakan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($meja->status == 'aktif')
                                                <a href="{{ route('transaksiPemesanan', [
                                                    'meja_id' => $meja->id,
                                                    'nomor_meja' => $meja->nomor_meja,
                                                    'status' => $meja->status,
                                                ]) }}"
                                                    class="btn btn-warning btn-sm mt-auto">
                                                    Selesaikan Pembayaran
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <!-- Tombol Tambah Meja -->
                        <div class="d-flex justify-content-center mt-3">
                            <a href="{{ route('tambahMeja') }}" class="btn btn-primary btn-sm">Tambah Meja</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
