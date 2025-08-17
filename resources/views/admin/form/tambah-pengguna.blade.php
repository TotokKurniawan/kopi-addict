@extends('layout.app')
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="container-fluid">

                <!-- Card Form Tambah Pengguna -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Tambah Pengguna Baru</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('simpanPengguna') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="namaPengguna" class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" id="namaPengguna"
                                    placeholder="Masukkan nama" required>
                            </div>

                            <div class="mb-3">
                                <label for="emailPengguna" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="emailPengguna"
                                    placeholder="Masukkan email" required>
                            </div>

                            <div class="mb-3">
                                <label for="rolePengguna" class="form-label">Role</label>
                                <select name="role" class="form-select" id="rolePengguna" required>
                                    <option value="">Pilih Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">Staf</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="passwordPengguna" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="passwordPengguna"
                                    placeholder="Masukkan password" required>
                            </div>

                            <div class="mb-3">
                                <label for="fotoPengguna" class="form-label">Foto</label>
                                <input type="file" name="foto" class="form-control" id="fotoPengguna">
                            </div>

                            <div class="d-flex justify-content-center mt-3">
                                <button type="submit" class="btn btn-primary btn-sm">Tambah Pengguna</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
