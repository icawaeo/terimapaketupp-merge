<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-t">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Informasi Paket</title>

        <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
    </head>
    <body>
        <div class="main-wrapper">
            {{-- DIUBAH: Navbar disamakan dengan navbar admin --}}
            <nav class="navbar navbar-expand-lg navbar-dark navbar-pln fixed-top shadow-sm">
                <div class="container">
                    <a class="navbar-brand d-flex align-items-center" href="/">
                        <x-application-logo style="height: 36px; margin-right: 10px;" />
                        <span class="fw-bold navbar-brand-text">Cek Status Paket UPP SULUT</span>
                    </a>
            
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
            
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center pt-3 pt-lg-0">
                            @auth
                                <li class="nav-item">
                                    <a href="{{ route('admin.index') }}" class="btn btn-primary">
                                        Dashboard Admin
                                    </a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="{{ route('login') }}" class="btn btn-outline-light rounded-pill px-3">
                                        <i class="bi bi-box-arrow-in-right me-2"></i>Masuk sebagai Admin
                                    </a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>

            {{-- DIUBAH: Padding atas disesuaikan agar konten tidak tertutup navbar --}}
            <main class="container" style="padding-top: 120px; padding-bottom: 40px;">
                @yield('content')
            </main>
        </div>

        <div id="imagePopupOverlay" class="image-popup-overlay">
            <img id="popupImage" src="" alt="Zoomed Image">
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const popupOverlay = document.getElementById('imagePopupOverlay');
                const popupImage = document.getElementById('popupImage');
                
                document.body.addEventListener('click', function(e) {
                    if (e.target.classList.contains('image-popup-trigger')) {
                        e.preventDefault();
                        const imageUrl = e.target.getAttribute('data-image-url');
                        popupImage.setAttribute('src', imageUrl);
                        popupOverlay.style.display = 'flex';
                    }
                });

                popupOverlay.addEventListener('click', function () {
                    this.style.display = 'none';
                    popupImage.setAttribute('src', '');
                });
            });
        </script>
    </body>
</html>