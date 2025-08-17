    <!-- [ Header Topbar ] start -->
    <header class="pc-header">
        <div class="header-wrapper"><!-- [Mobile Media Block] start -->
            <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled mb-0">
                    <!-- Tombol collapse untuk mobile -->
                    <li class="pc-h-item header-mobile-collapse">
                        <a href="#" class="pc-head-link head-link-secondary ms-0" id="sidebar-hide">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    <li class="pc-h-item pc-sidebar-popup">
                        <a href="#" class="pc-head-link head-link-secondary ms-0" id="mobile-collapse">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>

                    <!-- Kalimat motivasi staf -->
                    <li class="pc-item mt-4">
                        <p class="pc-mtext text-muted fst-italic px-3" style="font-size: 1.2rem; font-weight: 700;">
                            "Semangat bekerja, setiap hari adalah kesempatan baru!"
                        </p>
                    </li>

                </ul>

            </div>
            <!-- [Mobile Media Block end] -->
            <div class="ms-auto">
                <ul class="list-unstyled">

                    <li class="dropdown pc-h-item header-user-profile">
                        <a class="pc-head-link head-link-primary dropdown-toggle arrow-none me-0"
                            data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-settings"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header">
                                <h4>
                                    Good Morning John Doe
                                </h4>
                                <p class="text-muted">Project Admin</p>
                                <hr />
                                <div class="profile-notification-scroll position-relative"
                                    style="max-height: calc(100vh - 280px)">
                                    <a href="{{ route('profileUser') }}"
                                        class="dropdown-item d-flex align-items-center">
                                        <i class="ti ti-settings me-2"></i>
                                        <span>Profile</span>
                                    </a>

                                    <form action="{{ route('logout') }}" method="POST" class="w-100">
                                        @csrf
                                        <button type="submit"
                                            class="dropdown-item d-flex align-items-center w-100 text-start">
                                            <i class="ti ti-logout me-2"></i>
                                            <span>Logout</span>
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- [ Header ] end -->
