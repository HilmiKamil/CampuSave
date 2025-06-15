@use(App\Models\User)

<x-layout>
    <x-slot name="page_name">Halaman Simpanan / Detail</x-slot>
    <x-slot name="page_title">Berikut adalah tampilan Detail Simpanan yang dipilih :</x-slot>
    <x-slot name="page_content">
        @if($saving !== null)
        <table class="table table-bordered">
            <thead class="table-info">
                <tr>
                    <th>ID</th>
                    <th>Nama Mahasiswa</th>
                    <th>Jumlah Tabungan (Rp)</th>
                    <th>Tanggal Simpanan</th>
                    <th>Deskripsi</th>
                    <th>Dibuat Pada</th>
                    <th>Diupdate Pada</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $saving->id }}</td>
                    <td>{{ $saving->user->name }}</td>
                    <td>Rp {{ number_format($saving->amount, 2, ',', '.') }}</td>
                    <td>{{ $saving->saved_at ? $saving->saved_at->format('d-m-Y') : '-' }}</td>
                    <td>{{ $saving->description }}</td>
                    <td>{{ $saving->created_at ? $saving->created_at->format('d-m-Y H:i:s') : '-' }}</td>
                    <td>{{ $saving->updated_at ? $saving->updated_at->format('d-m-Y H:i:s') : '-' }}</td>
                </tr>
            </tbody>
        </table>
        @else
        <p>Simpanan tidak ditemukan.</p>
        @endif

        <div class="mt-4">
            <a href="{{ route('admin.saving.index') }}" class="btn btn-secondary">Kembali ke Daftar Simpanan</a>
        </div>
    </x-slot>
</x-layout>