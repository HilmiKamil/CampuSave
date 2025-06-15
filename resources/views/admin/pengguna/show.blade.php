@use(App\Models\User)

<x-layout>
    <x-slot name="page_name">Halaman Mahasiswa / Detail</x-slot>
    <x-slot name="page_title">Berikut adalah tampilan Detail Mahasiswa yang dipilih :</x-slot>
    <x-slot name="page_content">
        @if($mahasiswa !== null)
        <table class="table table-bordered">
            <thead class="table-info">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Nomor Telepon</th>
                    <th>Role</th>
                    <th>Dibuat Pada</th>
                    <th>Diupdate Pada</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $mahasiswa->id }}</td>
                    <td>{{ $mahasiswa->name }}</td>
                    <td>{{ $mahasiswa->email }}</td>
                    <td>{{ $mahasiswa->phone_number }}</td>
                    <td>{{ $mahasiswa->role }}</td>
                    <td>{{ $mahasiswa->created_at->format('d-m-Y H:i:s') }}</td>
                    <td>{{ $mahasiswa->updated_at->format('d-m-Y H:i:s') }}</td>
                </tr>
            </tbody>
        </table>
        @else
        <p>Mahasiswa tidak ditemukan.</p>
        @endif
    </x-slot>
</x-layout>