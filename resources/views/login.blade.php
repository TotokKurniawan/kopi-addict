<!doctype html>
<html lang="en">

<head>
    <title>Kopi-Addict</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Kopi-Addict" />
    <meta name="keywords" content="Kopi-Addict" />
    <meta name="author" content="codedthemes" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon" />

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/phosphor/duotone/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}" />

    <!-- CSS Template -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}" />
</head>

<body>
    <!-- Pre-loader -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <div class="auth-main">
        <div class="auth-wrapper v3">
            <div class="auth-form">
                <div class="card my-5">
                    <div class="card-body text-center">
                        <!-- Lingkaran dengan icon kopi putih -->
                        <div class="d-flex flex-column align-items-center justify-content-center mb-3"
                            style="text-decoration: none;">
                            <div
                                style="width: 80px; height: 80px; background-color: #fc6600; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-cup-fill" style="color: white; font-size: 36px;"></i>
                            </div>
                            <div class="mt-2 text-center">
                                <h2 class="text-secondary mt-2"><b>Hi, Welcome Back</b></h2>
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="mb-2">
                                    <span class="block font-medium text-sm text-gray-700">Sistem</span>
                                    <span class="block font-bold text-lg text-[#fc6600]">COFFE ADDICT</span>
                                    <span class="block font-medium text-sm text-gray-700">Kasir</span>
                                </div>
                            </div>
                        </div>

                        <!-- Form Login -->
                        <form action="{{ route('login.post') }}" method="POST" class="mt-4">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" name="email" class="form-control"
                                    placeholder="Email address / Username" value="{{ old('email') }}" required />
                                <label>Email address / Username</label>
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Password"
                                    required />
                                <label>Password</label>
                                @error('password')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-secondary">Sign In</button>
                            </div>

                            @if ($errors->any())
                                <div class="mt-3 text-danger text-center">
                                    {{ $errors->first() }}
                                </div>
                            @endif
                        </form>
                        <!-- End Form Login -->

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- JS Files -->
    <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/icon/custom-font.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>

    <script>
        layout_change('light');
        font_change('Roboto');
        change_box_container('false');
        layout_caption_change('true');
        layout_rtl_change('false');
        preset_change('preset-1');
    </script>
</body>

</html>
