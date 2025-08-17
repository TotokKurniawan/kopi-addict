@extends('layout.appuser')
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="container-fluid">

                <!-- Card Profil -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Profil Saya</h5>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-3 text-center">
                                    <img src="{{ $user->foto ? asset('uploads/foto/' . $user->foto) : asset('assets/images/user.png') }}"
                                        class="img-fluid rounded-circle mb-3" alt="Foto Profil"
                                        style="width:150px;height:150px;">
                                    <input type="file" class="form-control form-control-sm" name="foto">
                                </div>
                                <div class="col-md-9">
                                    <div class="mb-3">
                                        <label for="namaProfil" class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="nama"
                                            value="{{ $user->nama }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="emailProfil" class="form-label">Email</label>
                                        <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label for="roleProfil" class="form-label">Role</label>
                                        <input type="text" class="form-control" value="{{ ucfirst($user->role) }}"
                                            readonly>
                                    </div>

                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary btn-sm">Simpan Perubahan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
