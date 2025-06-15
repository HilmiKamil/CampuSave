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
                @forelse ($mahasiswa->transaksis as $transaksi)
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
        @else
        <p>Mahasiswa tidak ditemukan.</p>
        @endif
    </x-slot>
</x-layout>
