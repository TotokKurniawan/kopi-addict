@extends('layout.app')
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="container-fluid">
                <div class="card shadow-sm mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0">Data Pengguna</h5>
                            <p class="text-muted mb-0">Kelola pengguna aplikasi</p>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <a href="{{ route('tambahPengguna') }}" style="background-color: #fc9800; color: white;"
                                class="btn btn-primary btn-sm">Tambah Pengguna</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead style="background-color: #fc9800; color: white;">
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $index => $user)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                @if ($user->foto)
                                                    <img src="{{ asset('uploads/foto/' . $user->foto) }}" alt="Foto"
                                                        style="width:50px;height:50px;border-radius:50%;">
                                                @else
                                                    <img src="{{ asset('assets/images/user.png') }}" alt="Foto"
                                                        style="width:50px;height:50px;border-radius:50%;">
                                                @endif
                                            </td>
                                            <td>{{ $user->nama }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editPenggunaModal{{ $user->id }}">Edit</button>
                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#deletePenggunaModal{{ $user->id }}">Hapus</button>
                                            </td>
                                        </tr>

                                        @include('admin.modal.modal-action-pengguna')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
