@extends('layout.app')
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="container-fluid">

                <!-- Card Form Tambah Menu -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Tambah Menu Baru</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('storeMenuAdmin') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="namaMenu" class="form-label">Nama Menu</label>
                                <input type="text" name="nama" class="form-control" id="namaMenu"
                                    placeholder="Masukkan nama menu" required>
                            </div>

                            <div class="mb-3">
                                <label for="kategoriMenu" class="form-label">Kategori</label>
                                <select name="kategori" class="form-select" id="kategoriMenu" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="drink">Drink</option>
                                    <option value="food">Food</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="hargaMenu" class="form-label">Harga</label>
                                <input type="number" name="harga" class="form-control" id="hargaMenu"
                                    placeholder="Masukkan harga" required>
                            </div>

                            <div class="mb-3">
                                <label for="gambarMenu" class="form-label">Gambar Menu</label>
                                <input type="file" name="foto" class="form-control" id="gambarMenu">
                            </div>

                            <button type="submit" class="btn btn-primary">Tambah Menu</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
