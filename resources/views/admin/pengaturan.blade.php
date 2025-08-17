@extends('layout.app')
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="container-fluid">

                <div class="card shadow-sm mb-4 p-3">
                    <h2 class="mb-3">Pengaturan</h2>

                    <ul class="nav nav-tabs mb-3" id="pengaturanTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="toko-tab" data-bs-toggle="tab" data-bs-target="#toko"
                                type="button" role="tab" aria-controls="toko" aria-selected="true">Pengaturan
                                Toko</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="struk-tab" data-bs-toggle="tab" data-bs-target="#struk"
                                type="button" role="tab" aria-controls="struk" aria-selected="false">Pengaturan
                                Struk</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="pengaturanTabContent">

                        <div class="tab-pane fade show active" id="toko" role="tabpanel" aria-labelledby="toko-tab">
                            <div class="card-body p-0">
                                <form class="p-3" action="{{ route('simpanToko') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="namaToko" class="form-label">Nama Toko</label>
                                        <input type="text" class="form-control" id="namaToko" name="nama_toko"
                                            value="{{ $toko->nama_toko ?? '' }}" placeholder="Masukkan nama toko">
                                    </div>
                                    <div class="mb-3">
                                        <label for="logoToko" class="form-label">Logo Toko</label>
                                        <input type="file" class="form-control" id="logoToko" name="logo_toko">
                                    </div>
                                    @if (!empty($toko->logo_toko))
                                        <div class="mb-3">
                                            <label class="form-label">Logo Saat Ini:</label><br>
                                            <img src="{{ asset('uploads/toko/' . $toko->logo_toko) }}" alt="Logo Toko"
                                                style="width:100px;height:100px;">
                                        </div>
                                    @endif
                                    <div class="mb-3">
                                        <label for="alamatToko" class="form-label">Alamat Toko</label>
                                        <textarea class="form-control" id="alamatToko" name="alamat_toko" rows="3" placeholder="Masukkan alamat">{{ $toko->alamat_toko ?? '' }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pajakToko" class="form-label">Pajak (%)</label>
                                        <input type="number" class="form-control" id="pajakToko" name="pajak"
                                            value="{{ $toko->pajak ?? 0 }}" placeholder="Masukkan pajak">
                                    </div>
                                    <button type="submit" class="btn btn-primary"
                                        style="background-color: #fc9800; color: white;">Simpan Pengaturan Toko</button>
                                </form>

                                @if (!empty($toko))
                                    <div class="mt-4 border p-3 bg-light">
                                        <h5>Profil Toko Saat Ini</h5>
                                        <p><strong>Nama Toko:</strong> {{ $toko->nama_toko }}</p>
                                        <p><strong>Alamat:</strong> {{ $toko->alamat_toko }}</p>
                                        <p><strong>Pajak:</strong> {{ $toko->pajak }}%</p>
                                        @if ($toko->logo_toko)
                                            <p><strong>Logo:</strong></p>
                                            <img src="{{ asset('uploads/toko/' . $toko->logo_toko) }}" alt="Logo"
                                                style="width:100px;height:100px;">
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="tab-pane fade" id="struk" role="tabpanel" aria-labelledby="struk-tab">
                            <div class="card-body p-0">
                                <form class="p-3" action="{{ route('simpanStruk') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="headerStruk" class="form-label">Header Struk</label>
                                        <textarea class="form-control" id="headerStruk" name="header_struk" rows="2">{{ $struk->header_struk ?? '' }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="footerStruk" class="form-label">Footer Struk</label>
                                        <textarea class="form-control" id="footerStruk" name="footer_struk" rows="2">{{ $struk->footer_struk ?? '' }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary"
                                        style="background-color: #fc9800; color: white;">Simpan Pengaturan Struk</button>
                                </form>

                                <div class="mt-4 border p-3 bg-light" id="pratinjauStruk">
                                    <div class="text-center mb-2" id="pratinjauHeader">
                                        {!! $struk->header_struk ?? '<strong>Header Struk</strong>' !!}
                                    </div>
                                    <table class="table table-sm mb-2">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-end">Harga</th>
                                                <th class="text-end">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody id="pratinjauBody">
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3">Total</th>
                                                <th class="text-end" id="totalHarga">0</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="text-center" id="pratinjauFooter">
                                        {!! $struk->footer_struk ?? '<em>Footer Struk</em>' !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script>
        const headerInput = document.getElementById('headerStruk');
        const footerInput = document.getElementById('footerStruk');
        const pratinjauBody = document.getElementById('pratinjauBody');
        const totalHargaElem = document.getElementById('totalHarga');
        const pratinjauHeader = document.getElementById('pratinjauHeader');
        const pratinjauFooter = document.getElementById('pratinjauFooter');

        const dummyMenu = [{
                nama: 'Menu A',
                harga: 10000,
                qty: 2
            },
            {
                nama: 'Menu B',
                harga: 15000,
                qty: 1
            },
            {
                nama: 'Menu C',
                harga: 12000,
                qty: 3
            }
        ];

        function updatePratinjau() {
            let tbodyHtml = '';
            let total = 0;

            dummyMenu.forEach(item => {
                const subtotal = item.harga * item.qty;
                tbodyHtml += `
                <tr>
                    <td>${item.nama}</td>
                    <td class="text-center">${item.qty}</td>
                    <td class="text-end">${item.harga.toLocaleString()}</td>
                    <td class="text-end">${subtotal.toLocaleString()}</td>
                </tr>
            `;
                total += subtotal;
            });

            pratinjauBody.innerHTML = tbodyHtml;
            totalHargaElem.textContent = total.toLocaleString();

            pratinjauHeader.innerHTML = headerInput.value || '<strong>Header Struk</strong>';
            pratinjauFooter.innerHTML = footerInput.value || '<em>Footer Struk</em>';
        }

        headerInput.addEventListener('input', updatePratinjau);
        footerInput.addEventListener('input', updatePratinjau);

        updatePratinjau();
    </script>
@endsection
