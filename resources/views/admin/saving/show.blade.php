@use(App\Models\User)

<x-layout>
    <x-slot name="page_name">Halaman Simpanan / Detail</x-slot>
    <x-slot name="page_title">Detail Simpanan yang Dipilih</x-slot>
    <x-slot name="page_content">
        @if($saving !== null)
            <h3>Detail Simpanan</h3>
            <table class="table table-bordered">
                <thead class="table-info">
                    <tr>
                        <th>ID</th>
                        <th>Nama Mahasiswa</th>
                        <th>Jumlah Tabungan (Rp)</th>
                        <th>Tanggal Simpanan</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $saving->id }}</td>
                        <td>{{ $saving->user->name }}</td>
                        <td>Rp {{ number_format($saving->amount, 2, ',', '.') }}</td>
                        <td>{{ $saving->saved_at ? $saving->saved_at->format('d-m-Y') : '-' }}</td>
                        <td>{{ $saving->description }}</td>
                    </tr>
                </tbody>
            </table>

            <h4 class="mt-4">Riwayat Simpanan Mahasiswa: {{ $saving->user->name }}</h4>
            <table class="table table-bordered mt-2">
                <thead class="table-info">
                    <tr>
                        <th>ID</th>
                        <th>Jumlah Tabungan (Rp)</th>
                        <th>Tanggal Simpanan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($savings as $s)
                        <tr>
                            <td>{{ $s->id }}</td>
                            <td>Rp {{ number_format($s->amount, 2, ',', '.') }}</td>
                            <td>{{ $s->saved_at ? $s->saved_at->format('d-m-Y') : '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada data simpanan untuk mahasiswa ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="mt-3">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        {{ $savings->links('vendor.pagination.bootstrap-4') }} <!-- Use Bootstrap 4 pagination -->
                    </ul>
                </nav>
            </div>
        @else
            <div class="alert alert-warning" role="alert">
                Simpanan tidak ditemukan.
            </div>
        @endif

        <div class="mt-4">
            <a href="{{ route('admin.saving.index') }}" class="btn btn-secondary">Kembali ke Daftar Simpanan</a>
        </div>
    </x-slot>
</x-layout>