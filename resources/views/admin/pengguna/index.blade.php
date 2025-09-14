@use(App\Models\User)

<x-layout>
    <x-slot name="page_name">Halaman Mahasiswa</x-slot>
    <x-slot name="page_title">Berikut adalah data mahasiswa :</x-slot>
    <x-slot name="page_content">

        @if (session('pesan'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>{{ session('pesan') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if (session('update'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session('update') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if (session('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @auth
        @if (Auth::user()->role == User::ROLE_ADMIN)
        <a href="{{ route('admin.pengguna.create') }}" class="btn btn-primary">+ Tambah Mahasiswa</a>
        @endif
        @endauth

        <br><br>
        <table class="table table-bordered">
            <thead class="table-success">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mahasiswas as $mahasiswa)
                <tr>
                    <td>{{ $mahasiswa->id }}</td>
                    <td>{{ $mahasiswa->name }}</td>
                    <td>{{ $mahasiswa->email }}</td>
                    <td>{{ $mahasiswa->phone_number }}</td>
                    <td>
                        <a href="{{ route('admin.pengguna.show', $mahasiswa->id) }}" class="btn btn-primary text-light">
                            <i class="far fa-eye"></i> Lihat
                        </a>
                        @auth
                        @if (Auth::user()->role == User::ROLE_ADMIN)
                        <a href="{{ route('admin.pengguna.edit', $mahasiswa->id) }}" class="btn btn-warning text-dark">
                            <i class="far fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.pengguna.destroy', $mahasiswa->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data?')">
                                <i class="far fa-trash-alt"></i> Hapus
                            </button>
                        </form>
                        @endif
                        @endauth
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </x-slot>
</x-layout>