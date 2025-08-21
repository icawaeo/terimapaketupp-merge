<nav class="navbar navbar-expand-lg navbar-dark navbar-pln fixed-top shadow-sm">
    <div class="container">
        {{-- Brand/Logo di Kiri --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ auth()->check() ? route('admin.index') : route('paket.create') }}">
            <x-application-logo style="height: 36px; margin-right: 10px;" />
            <span class="navbar-brand-text" style="font-size: 0.9rem; line-height: 1.2;">
                @if(auth()->check())
                    <span class="fw-semibold d-block">Admin</span>
                @endif
                <span class="fw-normal">Pencatatan Paket UPP SULUT</span>
            </span>
        </a>

        {{-- Tombol Toggler untuk Mobile --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Konten Navbar --}}
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            {{-- Menu Pengguna dan Navigasi di Kanan --}}
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center pt-3 pt-lg-0">
                @auth
                    {{-- Menu Dashboard dan History --}}
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom {{ request()->routeIs('admin.index') ? 'active' : '' }}" href="{{ route('admin.index') }}">
                            <i class="bi bi-grid-fill me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom {{ request()->routeIs('admin.history.index') ? 'active' : '' }}" href="{{ route('admin.history.index') }}">
                            <i class="bi bi-clock-history me-1"></i>History
                        </a>
                    </li>
                    
                    {{-- Menu Manajemen Pengguna (Hanya Super Admin) --}}
                    @if (Auth::user()->role == 'superadmin')
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom {{ request()->routeIs('admin.users.index') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                            <i class="bi bi-people-fill me-2"></i>Manajemen Pengguna
                        </a>
                    </li>
                    @endif

                    {{-- Dropdown Pengguna --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-2"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Log Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    {{-- Tombol Login --}}
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-outline-light rounded-pill px-3">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk sebagai Admin
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>