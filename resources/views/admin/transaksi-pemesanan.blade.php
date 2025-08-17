@extends('layout.app')
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
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-tabs mb-3" id="menuTab" role="tablist">
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
                        <form id="formTransaksi">
                            @csrf
                            <input type="hidden" name="meja_id" value="{{ $mejaId }}">
                            <input type="hidden" name="total" id="inputTotal" value="0">
                            <input type="hidden" name="bayar" id="inputBayar" value="0">
                            <input type="hidden" name="kembalian" id="inputKembalian" value="0">
                            <input type="hidden" name="pembayaran" id="inputPembayaran" value="">
                            <input type="hidden" name="menu_json" id="inputMenuData">

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
                                        <input type="number" id="jumlahBayar" class="form-control"
                                            oninput="hitungKembalian()">
                                        <div class="mt-2 p-2 bg-light border rounded">
                                            <h5 class="fw-bold text-primary">Kembalian: Rp <span id="kembalian">0</span>
                                            </h5>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success btn-sm mt-3">Bayar</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        let total = 0;
        let menuList = {};

        function tambahMenu(id, nama, harga) {
            if (menuList[id]) menuList[id].qty += 1;
            else menuList[id] = {
                nama,
                harga,
                qty: 1
            };
            renderMenu();
        }

        function hapusMenu(id) {
            if (menuList[id]) {
                menuList[id].qty -= 1;
                if (menuList[id].qty <= 0) delete menuList[id];
                renderMenu();
            }
        }

        function renderMenu() {
            const menuTerpilih = document.getElementById('menuTerpilih');
            menuTerpilih.innerHTML = '';
            total = 0;
            let menuData = [];

            for (const id in menuList) {
                const item = menuList[id];
                const li = document.createElement('li');
                li.className = 'list-group-item d-flex justify-content-between align-items-center';
                li.innerHTML = `${item.nama} (x${item.qty}) - Rp ${(item.harga * item.qty).toLocaleString()} <div>
            <button class="btn btn-sm btn-danger" onclick="hapusMenu(${id})">-</button>
            <button class="btn btn-sm btn-primary" onclick="tambahMenu(${id}, '${item.nama.replace(/'/g, "\\'")}', ${item.harga})">+</button>
        </div>`;
                menuTerpilih.appendChild(li);
                total += item.harga * item.qty;
                menuData.push({
                    menu_id: id,
                    qty: item.qty,
                    harga: item.harga
                });
            }

            document.getElementById('totalHarga').textContent = total.toLocaleString();
            document.getElementById('inputTotal').value = total;
            document.getElementById('inputMenuData').value = JSON.stringify(menuData);
            hitungKembalian();
        }

        function pilihMetode(metode) {
            document.getElementById('inputPembayaran').value = metode;
            if (metode === 'cash') document.getElementById('cashInput').style.display = 'block';
            else {
                document.getElementById('cashInput').style.display = 'none';
                document.getElementById('inputBayar').value = 0;
                document.getElementById('inputKembalian').value = 0;
            }
        }

        function hitungKembalian() {
            const bayar = parseInt(document.getElementById('jumlahBayar')?.value) || 0;
            const kembalian = bayar - total;
            document.getElementById('kembalian').textContent = kembalian >= 0 ? kembalian.toLocaleString() : 0;
            document.getElementById('inputBayar').value = bayar;
            document.getElementById('inputKembalian').value = kembalian >= 0 ? kembalian : 0;
        }

        // Submit form via AJAX
        document.getElementById('formTransaksi').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch("{{ route('transaksi.store') }}", {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const metode = data.metode;

                        if (metode === 'cash') {
                            // Download PDF
                            window.location.href = '/transaksi/struk/' + data.transaksi_id;
                            // Redirect ke datapesanan setelah download
                            setTimeout(() => {
                                window.location.href = "{{ route('datapesanan') }}";
                            }, 2000);
                        } else {
                            // QRIS langsung redirect
                            window.location.href = "{{ route('datapesanan') }}";
                        }
                    } else alert('Terjadi kesalahan, coba lagi!');
                })
                .catch(err => {
                    console.error(err);
                    alert('Terjadi kesalahan server!');
                });
        });
    </script>
@endsection
