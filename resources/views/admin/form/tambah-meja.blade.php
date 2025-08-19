@extends('layout.app')
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="container-fluid">

                <!-- Card Form Tambah Meja -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Tambah Meja Baru</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('meja.storeadmin') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nomorMeja" class="form-label">Nomor Meja</label>
                                <input type="number" name="nomor_meja" class="form-control" id="nomorMeja"
                                    placeholder="Masukkan nomor meja" value="{{ $nextNomor }}" readonly>

                            </div>

                            <div class="mb-3">
                                <label for="statusMeja" class="form-label">Status</label>
                                <select name="status" class="form-select" id="statusMeja" required>
                                    <option value="">Pilih Status</option>
                                    <option value="kosong">Kosong</option>
                                    <option value="aktif">Terisi</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary btn-sm">Tambah Meja</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
