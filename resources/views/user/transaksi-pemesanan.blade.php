@extends('layout.appuser')
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="container-fluid">
                <div class="row g-3">

                    <!-- Card Menu -->
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header">
                                <h5>Daftar Menu</h5>
                                <small class="text-muted d-block mt-1">
                                    Nomor Meja: {{ request('nomor_meja') ?? ($meja->nomor_meja ?? '-') }} |
                                    Status: {{ request('status') ?? ($meja->status ?? '-') }}
                                </small>
                            </div>

                            <div class="card-body">
                                <ul class="nav nav-tabs mb-3" id="menuTab">
                                    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#drink">Drink</button></li>
                                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#food">Food</button></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="drink">
                                        <div class="list-group">
                                            @foreach ($menus->where('kategori', 'drink') as $menu)
                                                <div
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h6>{{ $menu->nama }}</h6>
                                                        <small class="text-muted">Rp
                                                            {{ number_format($menu->harga) }}</small>
                                                    </div>
                                                    <button class="btn btn-primary btn-sm"
                                                        onclick="tambahMenu({{ $menu->id }}, '{{ $menu->nama }}', {{ $menu->harga }})">Pilih</button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="food">
                                        <div class="list-group">
                                            @foreach ($menus->where('kategori', 'food') as $menu)
                                                <div
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h6>{{ $menu->nama }}</h6>
                                                        <small class="text-muted">Rp
                                                            {{ number_format($menu->harga) }}</small>
                                                    </div>
                                                    <button class="btn btn-primary btn-sm"
                                                        onclick="tambahMenu({{ $menu->id }}, '{{ $menu->nama }}', {{ $menu->harga }})">Pilih</button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Menu Terpilih -->
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header">
                                <h5>Menu Terpilih</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group mb-3" id="menuTerpilih"></ul>
                                <h5 class="mt-3 fw-bold p-2 bg-light border rounded">
                                    Total: Rp <span id="totalHarga">0</span>
                                </h5>

                                <div class="mt-3">
                                    <label>Metode Pembayaran:</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="metode" value="cash"
                                            onchange="pilihMetode('cash')">
                                        <label class="form-check-label">Cash</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="metode" value="qris"
                                            onchange="pilihMetode('qris')">
                                        <label class="form-check-label">QRIS</label>
                                    </div>
                                </div>

                                <div id="cashInput" class="mt-3" style="display:none;">
                                    <label>Jumlah Bayar:</label>
                                    <input type="number" id="jumlahBayar" class="form-control" oninput="hitungKembalian()">
                                    <div class="mt-2 p-2 bg-light border rounded">
                                        <h5 class="fw-bold text-primary">Kembalian: Rp <span id="kembalian">0</span></h5>
                                    </div>
                                </div>

                                <button class="btn btn-warning btn-sm mt-3" onclick="bayarTerpilih()">Bayar
                                    Terpilih</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Notifikasi -->
    <div class="modal fade" id="modalNotif" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalNotifTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalNotifBody"></div>
            </div>
        </div>
    </div>

    @include('user.form.fungsi-tp')
@endsection
