<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="border-bottom: 1px solid #dee2e6; background-color: white !important;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/dashboard" class="nav-link" style="font-weight: 500;">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{url ('/#contact')}}" class="nav-link" style="font-weight: 500;">Contact</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{url ('/#about')}}" class="nav-link" style="font-weight: 500;">About</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- User Dropdown -->
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <div class="image mr-2">
                    <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-1" alt="User Image" style="width: 30px; height: 30px;">
                </div>
                <span style="color: #18D26E; font-weight: bold;">{{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
        
        <!-- Fullscreen Toggle -->
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>

<style>
.navbar-light .navbar-nav .nav-link {
    color: #495057;
    transition: color 0.3s;
}

.navbar-light .navbar-nav .nav-link:hover {
    color: #18D26E;
}

.dropdown-menu {
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    border: 1px solid rgba(0,0,0,0.05);
}

.dropdown-item {
    transition: background-color 0.2s;
}

.dropdown-item:hover {
    background-color: #e8f5e9;
    color: #18D26E;
}

.img-circle {
    border-radius: 50%;
}
</style>