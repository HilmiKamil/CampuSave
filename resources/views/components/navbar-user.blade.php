@php use App\Models\User; @endphp
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{ route('user.index') }}" class="logo d-flex align-items-center me-auto">
            <img src="{{ asset('user/landing/img/toga.jpg') }}" alt="CampuSave Logo">
            <h1 class="sitename">CampuSave</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('user.index') }}#hero" class="active">Home</a></li>
                
                @auth
                    <li><a href="{{ route('user.mahasiswa') }}">Transaksi</a></li>
                    <li><a href="{{ route('mahasiswa.saving') }}">Tabungan</a></li>
                    <li><a href="{{ route('user.budget') }}">Anggaran</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu">
                            @if (Auth::user()->role == User::ROLE_ADMIN)
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.index') }}">Dashboard</a>
                                </li>
                            @endif
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">Profil</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" 
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{ route('user.index') }}#literation">Blog</a></li>
                @endauth
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        @guest
            <a class="btn-getstarted flex-md-shrink-0" href="{{ route('login') }}">Login & Register</a>
        @endguest

    </div>
</header>