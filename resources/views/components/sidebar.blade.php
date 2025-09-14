@use(App\Models\User)

<aside class="main-sidebar sidebar-light-primary elevation-4" style="background-color: #f8f9fa;">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link" style="background-color: #fff;">
        <img src="{{ asset('user/dist/img/1.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">Campu<span style="color: #2c7be5;">Save</span></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block font-weight-bold" style="color: #2c7be5;">{{ Auth::user()->name }}</a>
                <span class="text-muted">Role: {{ Auth::user()->role }}</span>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline mt-2 mb-3">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search" style="border-radius: 20px;">
                <div class="input-group-append">
                    <button class="btn btn-sidebar" style="background-color: #2c7be5; color: white;">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link" style="color: #343a40;">
                        <i class="nav-icon fas fa-tachometer-alt" style="color: #2c7be5;"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @auth
                @if (Auth::user()->role == User::ROLE_ADMIN)
                <!-- Manajemen Pengguna -->
                <li class="nav-item">
                    <a href="{{ url('admin/pengguna') }}" class="nav-link" style="color: #343a40;">
                        <i class="nav-icon fas fa-users" style="color: #2c7be5;"></i>
                        <p>Manajemen Pengguna</p>
                    </a>
                </li>
                @endif
                @endauth

                <!-- Manajemen Transaksi -->
                <li class="nav-item">
                    <a href="{{ url('admin/transaksi') }}" class="nav-link" style="color: #343a40;">
                        <i class="nav-icon fas fa-exchange-alt" style="color: #2c7be5;"></i>
                        <p>Manajemen Transaksi</p>
                    </a>
                </li>

                <!-- Manajemen Rencana Anggaran -->
                <li class="nav-item">
                    <a href="{{ url('admin/budget') }}" class="nav-link" style="color: #343a40;">
                        <i class="nav-icon fas fa-chart-pie" style="color: #2c7be5;"></i>
                        <p>Manajemen Anggaran</p>
                    </a>
                </li>

                @auth
                @if (Auth::user()->role == User::ROLE_ADMIN)
                <!-- Manajemen Tabungan -->
                <li class="nav-item">
                    <a href="{{ url('admin/saving') }}" class="nav-link" style="color: #343a40;">
                        <i class="nav-icon fas fa-piggy-bank" style="color: #2c7be5;"></i>
                        <p>Manajemen Tabungan</p>
                    </a>
                </li>
                @endif
                @endauth
            </ul>
        </nav>
    </div>
</aside>

<style>
.sidebar-light-primary {
    background-color: #f8f9fa;
    color: #343a40;
}

.nav-link:hover {
    background-color: #e6f0ff !important;
    border-radius: 4px;
}

.nav-link.active {
    background-color: #2c7be5 !important;
    color: white !important;
    border-radius: 4px;
}

.brand-link {
    border-bottom: 1px solid #e3e6f0;
}

.user-panel {
    border-bottom: 1px solid #e3e6f0;
}
</style>