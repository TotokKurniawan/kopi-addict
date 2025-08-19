    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Sidebar Menu ] start -->
    <nav class="pc-sidebar d-flex flex-column">
        <div class="navbar-wrapper d-flex flex-column">
            <!-- Header / Logo -->
            <div class="m-header flex items-center justify-center gap-2 h-full">
                <!-- Icon kopi -->
                <i class="fas fa-coffee text-2xl" style="color: #fc6600;"></i>
                <!-- Nama brand -->
                <a href="{{ route('dashboard') }}" class="text-2xl font-extrabold" style="color: #fc6600;">
                    COFFE ADDICT
                </a>
            </div>


            <!-- Menu Utama -->
            <div class="navbar-content d-flex flex-column">
                <ul class="pc-navbar">
                    <li class="pc-item pc-caption">
                        <label>Menu</label>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('dashboard') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route(name: 'menu') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-credit-card"></i></span>
                            <span class="pc-mtext">Menu </span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('meja') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-credit-card"></i></span>
                            <span class="pc-mtext">Meja </span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('transaksi') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-credit-card"></i></span>
                            <span class="pc-mtext"> Transaksi</span>
                        </a>
                    </li>
                    <!-- Spacer / Batas bawah -->
                    <li class="pc-item mt-8">
                        <hr class="border-t border-gray-300 my-3" />
                    </li>

                    <li class="pc-item">
                        <a href="{{ route('laporan') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-report"></i></span>
                            <span class="pc-mtext">Laporan</span>
                        </a>
                    </li>

                    <!-- Spacer / Batas bawah -->
                    <li class="pc-item mt-3">
                        <hr class="border-t border-gray-300 my-3" />
                    </li>

                    <!-- Menu Bawah -->
                    <li class="pc-item">
                        <a href="{{ route('pengguna') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-user"></i></span>
                            <span class="pc-mtext">Pengguna</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('pengaturan') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-settings"></i></span>
                            <span class="pc-mtext">Pengaturan</span>
                        </a>
                    </li>
                    <!-- Spacer / Batas bawah -->
                    <li class="pc-item mt-8">
                        <hr class="border-t border-gray-300 my-3" />
                    </li>

                    <!-- Logout di bawah Pengaturan -->
                    <li class="pc-item mt-8">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100"
                                style="background-color: #fc9800; color: white;">
                                <span class="pc-micon"><i class="ti ti-power"></i></span>
                                <span class="pc-mtext">Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- [ Sidebar Menu ] end -->
