<x-layout>
    <x-slot name="page_name">Rencana Anggaran</x-slot>
    <x-slot name="page_title">Berikut adalah daftar rencana anggaran mahasiswa :</x-slot>
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
        @if (Auth::user()->role == \App\Models\User::ROLE_ADMIN)
        <a href="{{ route('admin.budget.create') }}" class="btn btn-primary mb-3">+ Tambah Rencana Anggaran</a>
        @endif
        @endauth

        <table class="table table-bordered">
            <thead class="table-info">
                <tr>
                    <th>Bulan & Tahun</th>
                    <th>Target Pemasukan</th>
                    <th>Batas Pengeluaran</th>
                    <th>Target Tabungan</th>
                    <th>Nama Mahasiswa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($budgets as $budget)
                <tr>
                    <td>{{ \Carbon\Carbon::create($budget->year, $budget->month)->translatedFormat('F Y') }}</td>
                    <td>Rp {{ number_format($budget->income_target, 2, ',', '.') }}</td>
                    <td>Rp {{ number_format($budget->expense_limit, 2, ',', '.') }}</td>
                    <td>Rp {{ number_format($budget->savings_goal, 2, ',', '.') }}</td>
                    <td>{{ $budget->user->name }}</td>
                    <td>
                        <a href="{{ route('admin.budget.edit', $budget->id) }}" class="btn btn-warning text-dark">
                            <i class="far fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.budget.destroy', $budget->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus rencana ini?');">
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
                    <td colspan="6" class="text-center">Belum ada data rencana anggaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{ $budgets->links() }}

    </x-slot>
</x-layout>
