@use(App\Models\User)

<x-layout>
    <x-slot name="page_name">Halaman Simpanan</x-slot>
    <x-slot name="page_title">Berikut adalah data simpanan :</x-slot>
    <x-slot name="page_content">

        @if (session('success'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
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
        <a href="{{ route('admin.saving.create') }}" class="btn btn-primary">+ Tambah Simpanan</a>
        @endif
        @endauth

        <br><br>
        <table class="table table-bordered">
            <thead class="table-success">
                <tr>
                    <th>ID</th>
                    <th>Nama Mahasiswa</th>
                    <th>Jumlah (Rp) </th>
                    <th>Tanggal Simpanan</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($savings as $saving)
                <tr>
                    <td>{{ $saving->id }}</td>
                    <td>{{ $saving->user->name }}</td>
                    <td>Rp {{ number_format($saving->amount, 2, ',', '.') }}</td>
                    <td>{{ $saving->saved_at->format('d-m-Y') }}</td>
                    <td>{{ $saving->description }}</td>
                    <td>
                        <a href="{{ route('admin.saving.show', $saving->id) }}" class="btn btn-primary text-light">
                            <i class="far fa-eye"></i> Lihat
                        </a>
                        @auth
                        @if (Auth::user()->role == User::ROLE_ADMIN)
                        <a href="{{ route('admin.saving.edit', $saving->id) }}" class="btn btn-warning text-dark">
                            <i class="far fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.saving.destroy', $saving->id) }}" method="post" class="d-inline">
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

        {{ $savings->links() }} <!-- Pagination links -->
    </x-slot>
</x-layout>