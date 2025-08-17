@extends('layout.appuser')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <h5>Daftar Menu</h5>
                                <p class="mb-0 text-muted">Kelola menu makanan dan minuman staf.</p>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <a href="{{ route('tambahMenuUser') }}" class="btn btn-primary btn-sm"
                                    style="background-color: #fc9800; color: white;">
                                    Tambah Menu
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <ul class="nav nav-tabs" id="menuTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="all-tab" data-bs-toggle="tab"
                                        data-bs-target="#all" type="button" role="tab">All</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="food-tab" data-bs-toggle="tab" data-bs-target="#food"
                                        type="button" role="tab">Food</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="drink-tab" data-bs-toggle="tab" data-bs-target="#drink"
                                        type="button" role="tab">Drink</button>
                                </li>
                            </ul>

                            <div class="tab-content" id="menuTabContent">
                                <!-- All Tab -->
                                <div class="tab-pane fade show active" id="all" role="tabpanel">
                                    <div class="table-responsive mt-3">
                                        <table class="table table-striped table-hover">
                                            <thead style="background-color: #fc9800; color: white;">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Foto</th>
                                                    <th>Nama</th>
                                                    <th>Kategori</th>
                                                    <th>Harga</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($menus as $index => $menu)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>
                                                            @if ($menu->foto)
                                                                <img src="{{ asset('uploads/menu/' . $menu->foto) }}"
                                                                    alt="{{ $menu->nama }}" width="60">
                                                            @else
                                                                <span class="text-muted">Tidak ada</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $menu->nama }}</td>
                                                        <td>
                                                            @if ($menu->kategori == 'food')
                                                                <span class="badge bg-success">Food</span>
                                                            @else
                                                                <span class="badge bg-info">Drink</span>
                                                            @endif
                                                        </td>
                                                        <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                                data-bs-target="#editMenuModal"
                                                                data-id="{{ $menu->id }}"
                                                                data-nama="{{ $menu->nama }}"
                                                                data-kategori="{{ $menu->kategori }}"
                                                                data-harga="{{ $menu->harga }}">
                                                                Edit
                                                            </button>
                                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                                data-bs-target="#deleteMenuModal"
                                                                data-id="{{ $menu->id }}">
                                                                Hapus
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Food Tab -->
                                <div class="tab-pane fade" id="food" role="tabpanel">
                                    <div class="table-responsive mt-3">
                                        <table class="table table-striped table-hover">
                                            <thead style="background-color: #fc9800; color: white;">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Foto</th>
                                                    <th>Nama</th>
                                                    <th>Kategori</th>
                                                    <th>Harga</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($menus->where('kategori', 'food') as $index => $menu)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>
                                                            @if ($menu->foto)
                                                                <img src="{{ asset('uploads/menu/' . $menu->foto) }}"
                                                                    alt="{{ $menu->nama }}" width="60">
                                                            @else
                                                                <span class="text-muted">Tidak ada</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $menu->nama }}</td>
                                                        <td><span class="badge bg-success">Food</span></td>
                                                        <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                                data-bs-target="#editMenuModal"
                                                                data-id="{{ $menu->id }}"
                                                                data-nama="{{ $menu->nama }}"
                                                                data-kategori="{{ $menu->kategori }}"
                                                                data-harga="{{ $menu->harga }}">
                                                                Edit
                                                            </button>
                                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                                data-bs-target="#deleteMenuModal"
                                                                data-id="{{ $menu->id }}">
                                                                Hapus
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Drink Tab -->
                                <div class="tab-pane fade" id="drink" role="tabpanel">
                                    <div class="table-responsive mt-3">
                                        <table class="table table-striped table-hover">
                                            <thead style="background-color: #fc9800; color: white;">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Foto</th>
                                                    <th>Nama</th>
                                                    <th>Kategori</th>
                                                    <th>Harga</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($menus->where('kategori', 'drink') as $index => $menu)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>
                                                            @if ($menu->foto)
                                                                <img src="{{ asset('uploads/menu/' . $menu->foto) }}"
                                                                    alt="{{ $menu->nama }}" width="60">
                                                            @else
                                                                <span class="text-muted">Tidak ada</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $menu->nama }}</td>
                                                        <td><span class="badge bg-info">Drink</span></td>
                                                        <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                                data-bs-target="#editMenuModal"
                                                                data-id="{{ $menu->id }}"
                                                                data-nama="{{ $menu->nama }}"
                                                                data-kategori="{{ $menu->kategori }}"
                                                                data-harga="{{ $menu->harga }}">
                                                                Edit
                                                            </button>
                                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                                data-bs-target="#deleteMenuModal"
                                                                data-id="{{ $menu->id }}">
                                                                Hapus
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('user.modal.modal-action-menu') <!-- modal edit & hapus -->
    <script>
        // Edit Menu
        var editModal = document.getElementById('editMenuModal');
        editModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var nama = button.getAttribute('data-nama');
            var kategori = button.getAttribute('data-kategori');
            var harga = button.getAttribute('data-harga');

            editModal.querySelector('input[name="nama"]').value = nama;
            editModal.querySelector('select[name="kategori"]').value = kategori;
            editModal.querySelector('input[name="harga"]').value = harga;
            editModal.querySelector('form').action = '/menu/' + id + '/update';
        });

        // Hapus Menu
        var deleteModal = document.getElementById('deleteMenuModal');
        deleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            deleteModal.querySelector('form').action = '/menu/' + id + '/delete';
        });
    </script>
@endsection
