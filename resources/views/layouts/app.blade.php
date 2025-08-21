<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Sistem Manajemen Paket')</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        
        <div class="main-wrapper">
            <div class="content-with-background">
                @include('layouts.navigation')

            <main class="container" style="padding-top: 120px; padding-bottom: 40px;">
                @yield('content')
            </main>
            
        </div>

        <div id="imagePopupOverlay" class="image-popup-overlay">
            <img id="popupImage" src="" alt="Zoomed Image">
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
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
        @stack('scripts')
    </body>
</html>