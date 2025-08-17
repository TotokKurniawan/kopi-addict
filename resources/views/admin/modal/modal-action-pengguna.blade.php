<!-- Modal Edit Pengguna -->
<div class="modal fade" id="editPenggunaModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('updatePengguna', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 text-center">
                        <img src="{{ $user->foto ? asset('uploads/foto/' . $user->foto) : asset('assets/images/user.png') }}"
                            alt="Foto" style="width:100px;height:100px;border-radius:50%;" class="mb-2">
                        <input type="file" name="foto" class="form-control form-control-sm">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ $user->nama }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required
                            readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select" required>
                            <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>
                                Admin</option>
                            <option value="User" {{ $user->role == 'User' ? 'selected' : '' }}>User
                            </option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Hapus Pengguna -->
<div class="modal fade" id="deletePenggunaModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('deletePengguna', $user->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus pengguna
                    <b>{{ $user->nama }}</b>?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>
