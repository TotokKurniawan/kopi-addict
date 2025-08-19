<script>
    let menuList = {};
    let totalHarga = 0;

    @foreach ($cart as $item)
        menuList[{{ $item->menu_id }}] = {
            nama: '{{ $item->menu->nama }}',
            harga: {{ $item->harga }},
            qty: {{ $item->qty }}
        };
    @endforeach

    renderMenu();

    function tambahMenu(id, nama, harga) {
        fetch('/menu/cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                meja_id: {{ $mejaId }},
                menu_id: id,
                nama,
                harga
            })
        }).then(() => {
            if (menuList[id]) menuList[id].qty += 1;
            else menuList[id] = {
                nama,
                harga,
                qty: 1
            };
            renderMenu();
        });
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
        totalHarga = 0;

        for (const id in menuList) {
            const item = menuList[id];
            totalHarga += item.qty * item.harga;

            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between align-items-center';
            li.innerHTML = `
            <div class="form-check">
                <input class="form-check-input menuCheck" type="checkbox" checked onchange="updateTotal()">
                <label class="form-check-label">${item.nama} (x${item.qty}) - Rp ${item.harga * item.qty}</label>
            </div>
            <div>
                <button class="btn btn-sm btn-danger" onclick="hapusMenu(${id})">-</button>
                <button class="btn btn-sm btn-primary" onclick="tambahMenu(${id}, '${item.nama.replace(/'/g,"\\'")}', ${item.harga})">+</button>
            </div>
        `;
            menuTerpilih.appendChild(li);
        }

        updateTotal();
    }

    function updateTotal() {
        let totalCheck = 0;
        const keys = Object.keys(menuList);
        document.querySelectorAll('#menuTerpilih .menuCheck').forEach((cb, i) => {
            if (cb.checked) totalCheck += menuList[keys[i]].qty * menuList[keys[i]].harga;
        });

        totalHarga = totalCheck;
        document.getElementById('totalHarga').textContent = totalHarga;
        hitungKembalian();
    }

    function pilihMetode(metode) {
        document.getElementById('cashInput').style.display = (metode === 'cash') ? 'block' : 'none';
        hitungKembalian();
    }

    function hitungKembalian() {
        const bayar = parseInt(document.getElementById('jumlahBayar')?.value) || 0;
        const kembalian = Math.max(bayar - totalHarga, 0);
        document.getElementById('kembalian').textContent = kembalian;
    }

    // modal helper
    function showModal(title, message) {
        document.getElementById('modalNotifTitle').textContent = title;
        document.getElementById('modalNotifBody').textContent = message;
        const modal = new bootstrap.Modal(document.getElementById('modalNotif'));
        modal.show();
    }

    // bayar terpilih
    async function bayarTerpilih() {
        const metode = document.querySelector('input[name="metode"]:checked')?.value;
        if (!metode) {
            showModal('Peringatan', 'Pilih metode pembayaran terlebih dahulu!');
            return;
        }

        const menuItems = [];
        const keys = Object.keys(menuList);
        document.querySelectorAll('#menuTerpilih .menuCheck').forEach((cb, i) => {
            if (cb.checked) {
                const item = menuList[keys[i]];
                menuItems.push({
                    menu_id: parseInt(keys[i]),
                    qty: item.qty,
                    harga: item.harga
                });
            }
        });

        if (menuItems.length === 0) {
            showModal('Peringatan', 'Pilih minimal 1 menu untuk dibayar.');
            return;
        }

        let bayar = 0;
        if (metode === 'cash') {
            bayar = parseInt(document.getElementById('jumlahBayar')?.value) || 0;
            if (bayar < totalHarga) {
                showModal('Kesalahan', 'Jumlah bayar kurang!');
                return;
            }
        }

        try {
            const res = await fetch('/menu/bayar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    meja_id: {{ $mejaId }},
                    metode,
                    menu: menuItems,
                    bayar
                })
            });

            const data = await res.json();
            if (!res.ok) {
                showModal('Kesalahan', data.message || 'Terjadi kesalahan!');
                return;
            }

            showModal('Sukses', data.message || 'Pembayaran berhasil!');

            // hapus menu yang dibayar
            menuItems.forEach(item => delete menuList[item.menu_id]);
            renderMenu();
            document.getElementById('jumlahBayar').value = '';

            // cetak struk
            if (data.transaksi_id) cetakStruk(data.transaksi_id);

        } catch (err) {
            console.error(err);
            showModal('Kesalahan', 'Gagal melakukan pembayaran.');
        }
    }

    // cetak struk
    async function cetakStruk(transaksiId) {
        try {
            const res = await fetch(`/transaksi/strukuser/${transaksiId}`);
            const data = await res.json();
            if (!data.success) {
                showModal('Kesalahan', 'Gagal mencetak struk.');
                return;
            }

            const link = document.createElement('a');
            link.href = data.url;
            link.download = '';
            link.target = '_blank';
            link.click();

            setTimeout(() => {
                window.location.href = '/dashboardUser';
            }, 1000);

        } catch (err) {
            console.error(err);
            showModal('Kesalahan', 'Gagal mencetak struk.');
        }
    }
</script>
