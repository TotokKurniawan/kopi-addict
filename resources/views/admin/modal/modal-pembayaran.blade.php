<!-- Modal Payment -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Proses Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Daftar Menu -->
                <ul class="list-group mb-3" id="paymentMenuList"></ul>

                <!-- Total Harga -->
                <h6>Total: Rp <span id="paymentTotal">0</span></h6>

                <!-- Pilih Metode Pembayaran -->
                <div class="mt-3">
                    <label class="form-label">Metode Pembayaran</label>
                    <div class="d-flex gap-3 mt-1">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="payCash"
                                value="cash" checked onchange="ubahMetode()">
                            <label class="form-check-label" for="payCash">Cash</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="payQris"
                                value="qris" onchange="ubahMetode()">
                            <label class="form-check-label" for="payQris">QRIS</label>
                        </div>
                    </div>
                </div>

                <!-- Input Uang Bayar -->
                <div class="mt-3" id="cashInputDiv">
                    <label class="form-label">Uang Bayar</label>
                    <input type="number" class="form-control" id="uangBayar" oninput="hitungKembalian()">
                </div>

                <!-- Kembalian -->
                <div class="mt-2" id="kembalianDiv">
                    <h6>Kembalian: Rp <span id="kembalian">0</span></h6>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="prosesPayment()">Bayar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<script>
    function bukaPayment(menuTerpilihId = 'menuTerpilih') {
        const menuTerpilih = document.getElementById(menuTerpilihId);
        const paymentMenuList = document.getElementById('paymentMenuList');
        paymentMenuList.innerHTML = '';

        let total = 0;

        Array.from(menuTerpilih.children).forEach(li => {
            const liCopy = document.createElement('li');
            liCopy.className = 'list-group-item d-flex justify-content-between';

            // Ambil nama menu dan harga
            const namaMenu = li.querySelector('.namaMenu') ? li.querySelector('.namaMenu').textContent : li
                .textContent;
            const hargaMenuText = li.querySelector('.hargaMenu') ? li.querySelector('.hargaMenu').textContent :
                li.textContent;
            const hargaMatch = hargaMenuText.match(/Rp\s?([\d\.]+)/);
            let harga = 0;
            if (hargaMatch) {
                harga = parseInt(hargaMatch[1].replace(/\./g, ''));
                total += harga;
            }

            liCopy.innerHTML = `<span>${namaMenu}</span><span>Rp ${harga.toLocaleString()}</span>`;
            paymentMenuList.appendChild(liCopy);
        });

        document.getElementById('paymentTotal').textContent = total.toLocaleString();
        document.getElementById('uangBayar').value = '';
        document.getElementById('kembalian').textContent = '0';
        document.getElementById('cashInputDiv').style.display = 'block';
        document.getElementById('kembalianDiv').style.display = 'block';
        document.getElementById('payCash').checked = true;
    }

    function ubahMetode() {
        const cashChecked = document.getElementById('payCash').checked;
        document.getElementById('cashInputDiv').style.display = cashChecked ? 'block' : 'none';
        document.getElementById('kembalianDiv').style.display = cashChecked ? 'block' : 'none';
        if (!cashChecked) {
            document.getElementById('kembalian').textContent = '0';
        }
    }

    function hitungKembalian() {
        const total = parseInt(document.getElementById('paymentTotal').textContent.replace(/\./g, ''));
        const bayar = parseInt(document.getElementById('uangBayar').value) || 0;
        let kembalian = bayar - total;
        if (kembalian < 0) kembalian = 0;
        document.getElementById('kembalian').textContent = kembalian.toLocaleString();
    }

    function prosesPayment() {
        const method = document.getElementById('payCash').checked ? 'cash' : 'qris';
        if (method === 'cash') {
            const bayar = parseInt(document.getElementById('uangBayar').value) || 0;
            const total = parseInt(document.getElementById('paymentTotal').textContent.replace(/\./g, ''));
            if (bayar < total) {
                alert('Uang bayar kurang!');
                return;
            }
        }
        alert('Transaksi berhasil dibayar dengan metode ' + method.toUpperCase());
        const modal = bootstrap.Modal.getInstance(document.getElementById('paymentModal'));
        modal.hide();

        // Kosongkan menu terpilih
        const menuTerpilih = document.getElementById('menuTerpilih');
        if (menuTerpilih) menuTerpilih.innerHTML = '';
        const totalHargaElem = document.getElementById('totalHarga');
        if (totalHargaElem) totalHargaElem.textContent = '0';
    }
</script>
