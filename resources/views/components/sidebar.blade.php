@use(App\Models\User)

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ asset('user/dist/img/1.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Campu<span style="color: #18D26E;">Save</span></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User  Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                <span class="text-primary">Role: {{ Auth::user()->role }}</span>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
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
                    <a href="{{ url('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @auth
                @if (Auth::user()->role == User::ROLE_ADMIN)
                <!-- Manajemen Pengguna -->
                <li class="nav-item">
                    <a href="{{ url('admin/pengguna') }}" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Manajemen Pengguna</p>
                    </a>
                </li>
                @endif
                @endauth

                <!-- Manajemen Transaksi -->
                <li class="nav-item">
                    <a href="{{ url('admin/transaksi') }}" class="nav-link">
                        <i class="nav-icon fa fa-user-plus"></i>
                        <p>Manajemen Transaksi</p>
                    </a>
                </li>

                <!-- Manajemen Rencana Anggaran -->
                <li class="nav-item">
                    <a href="{{ url('admin/budget') }}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>Manajemen Rencana Anggaran</p>
                    </a>
                </li>

                @auth
                @if (Auth::user()->role == User::ROLE_ADMIN)
                <!-- Manajemen Tabungan -->
                <li class="nav-item">
                    <a href="{{ url('admin/saving') }}" class="nav-link">
                        <i class="nav-icon fa fa-calendar"></i>
                        <p>Manajemen Tabungan</p>
                    </a>
                </li>
                @endif
                @endauth
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>