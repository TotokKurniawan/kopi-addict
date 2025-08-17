<!-- Modal Pilih Meja -->
<div class="modal fade" id="modalReservasi" tabindex="-1" aria-labelledby="modalReservasiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="POST" id="formReservasi">
            @csrf
            <input type="hidden" name="meja_id" id="mejaId">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reservasi Meja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Reservasi</label>
                        <input type="text" name="nama_reservasi" class="form-control"
                            placeholder="Masukkan nama reservasi" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan Reservasi</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Konfirmasi Selesai Meja -->
<div class="modal fade" id="modalSelesaiMeja" tabindex="-1" aria-labelledby="modalSelesaiMejaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="POST" id="formSelesaiMeja">
            @csrf
            <input type="hidden" name="meja_id" id="mejaSelesaiId">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Meja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin meja ini sudah selesai?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Ya, Selesai</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Set action form saat klik tombol reservasi
    document.querySelectorAll('.btnReservasi').forEach(function(button) {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            var form = document.getElementById('formReservasi');
            form.action = '/meja/reservasiadmin/' + id;
        });
    });

    // Set action form saat klik tombol selesai
    document.querySelectorAll('.btnSelesai').forEach(function(button) {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            var form = document.getElementById('formSelesaiMeja');
            form.action = '/meja/selesaiadmin/' + id;
        });
    });
</script>
