@use(App\Models\Transaksi)

<x-layout>
    <x-slot name="page_name">Halaman Mahasiswa / Riwayat Transaksi</x-slot>
    <x-slot name="page_title">Berikut adalah riwayat transaksi mahasiswa yang dipilih :</x-slot>
    <x-slot name="page_content">
        @if($mahasiswa !== null)
            <h3>Detail Mahasiswa: {{ $mahasiswa->name }}</h3>
            <table class="table table-bordered">
                <thead class="table-info">
                    <tr>
                        <th>Tanggal Transaksi</th>
                        <th>Jenis Transaksi</th>
                        <th>Jumlah (Rp)</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksis as $transaksi)
                        <tr>
                            <td>{{ $transaksi->date->format('d-m-Y') }}</td>
                            <td class="text-capitalize">{{ $transaksi->type }}</td>
                            <td>{{ number_format($transaksi->amount, 2, ',', '.') }}</td>
                            <td>{{ $transaksi->description ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data transaksi untuk mahasiswa ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="mt-3">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        {{ $transaksis->links('vendor.pagination.bootstrap-4') }} <!-- Use Bootstrap 4 pagination -->
                    </ul>
                </nav>
            </div>
        @else
            <div class="alert alert-warning" role="alert">
                Mahasiswa tidak ditemukan.
            </div>
        @endif

        <div class="mt-3">
            <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary">Kembali ke Daftar Transaksi</a>
        </div>
    </x-slot>
</x-layout>