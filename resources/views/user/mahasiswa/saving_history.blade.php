@include('components.head-user')

<body class="bg-light">
    @include('components.navbar-user')

    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Riwayat Tabungan Lengkap</h4>
                            <a href="{{ route('mahasiswa.saving') }}" class="btn btn-light">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($savings->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Jumlah</th>
                                            <th>Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($savings as $saving)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($saving->saved_at)->format('d M Y') }}</td>
                                            <td class="text-success">+ Rp {{ number_format($saving->amount, 0, ',', '.') }}</td>
                                            <td>{{ $saving->description ?? '-' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                <div class="d-flex justify-content-center mt-4">
                        {{  $savings->links('vendor.pagination.bootstrap-4') }} <!-- Use Bootstrap 4 pagination -->

                    </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-piggy-bank fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada riwayat tabungan</p>
                                <a href="{{ route('mahasiswa.saving') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i> Tambah Tabungan
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.footer-user')
</body>
</html>