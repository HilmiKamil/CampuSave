@use(App\Models\User)
@use(App\Models\Saving)
@use(App\Models\Transaksi) <!-- Jika Anda memiliki model untuk transaksi -->

<x-layout>
    <x-slot name="page_name">Dashboard</x-slot>
    <x-slot name="page_title">Selamat Datang di Dashboard Tabungan Mahasiswa</x-slot>
    <x-slot name="page_content">
        <div class="row">
            @Auth
            @if (Auth::user()->role == User::ROLE_ADMIN)
            <div class="col-lg-4 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ User::where('role', 'mahasiswa')->count() }}</h3>
                        <p>Pengguna Aktif</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{ route('admin.pengguna.index') }}" class="small-box-footer">Lihat Data Pengguna <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            @endif
            @endauth

            <div class="col-lg-4 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>Rp {{ number_format(Saving::sum('amount'), 2, ',', '.') }}</h3>
                        <p>Total Tabungan</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money-bill-wave"></i>
                    </div>
                    <a href="{{ route('admin.saving.index') }}" class="small-box-footer">Lihat Data Tabungan <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ Transaksi::count() }}</h3> <!-- Ganti dengan model transaksi yang sesuai -->
                        <p>Total Transaksi</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                    </div>
                    <a href="{{ route('admin.transaksi.index') }}" class="small-box-footer">Lihat Data Transaksi <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
   
        </div>

        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Kriteria Kesuksesan Proyek</h3>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>Pengguna aktif meningkat 20% dalam 6 bulan.</li>
                            <li>Jumlah total tabungan mencapai Rp 1.000.000.000 dalam 1 tahun.</li>
                            <li>Transaksi harian rata-rata mencapai 100 transaksi.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-layout>