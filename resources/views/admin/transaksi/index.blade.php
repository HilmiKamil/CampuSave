@use(App\Models\User)

<x-layout>
    <x-slot name="page_name">Daftar Transaksi Keuangan</x-slot>
    <x-slot name="page_title">Berikut adalah riwayat transaksi mahasiswa :</x-slot>
    <x-slot name="page_content">

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @auth
        @if (Auth::user()->role == User::ROLE_ADMIN)
        <a href="{{ route('admin.transaksi.create') }}" class="btn btn-primary mb-3">+ Tambah Transaksi</a>
        @endif
        @endauth

        <table class="table table-bordered">
            <thead class="table-success">
                <tr>
                    <th>Tanggal</th>
                    <th>Jenis Transaksi</th>
                    <th>Jumlah (Rp)</th>
                    <th>Keterangan</th>
                    <th>Nama Mahasiswa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksis as $transaksi)
                <tr>
                    <td>{{ $transaksi->date->format('d-m-Y') }}</td>
                    <td class="text-capitalize">{{ $transaksi->type }}</td>
                    <td>{{ number_format($transaksi->amount, 2, ',', '.') }}</td>
                    <td>{{ $transaksi->description ?? '-' }}</td>
                    <td>{{ $transaksi->user->name }}</td>
                    <td>
                        <a href="{{ asset('admin.transaksi.show', $transaksi->user->id) }}" class="btn btn-info">
                            <i class="fas fa-history"></i> Riwayat Mahasiswa
                        </a>

                        <a href="{{ route('admin.transaksi.edit', $transaksi->id) }}" class="btn btn-warning text-dark">
                            <i class="far fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.transaksi.destroy', $transaksi->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="far fa-trash-alt"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data transaksi.</td>
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

    </x-slot>
</x-layout>