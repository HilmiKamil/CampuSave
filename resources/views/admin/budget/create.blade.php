<x-layout>
    <x-slot name="page_name">Tambah Anggaran</x-slot>
    <x-slot name="page_title">Lengkapi Data Anggaran di Bawah Ini:</x-slot>
    <x-slot name="page_content">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.budget.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="user_id">Nama Mahasiswa</label>
                <select class="form-control" id="user_id" name="user_id" required>
                    <option value="">Pilih Mahasiswa</option>
                    @foreach($mahasiswas as $mahasiswa)
                        <option value="{{ $mahasiswa->id }}">{{ $mahasiswa->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="month">Bulan</label>
                <input type="number" name="month" class="form-control" min="1" max="12" required>
            </div>

            <div class="form-group">
                <label for="year">Tahun</label>
                <input type="number" name="year" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="income_target">Target Pemasukan (Rp)</label>
                <input type="number" step="0.01" name="income_target" class="form-control">
            </div>

            <div class="form-group">
                <label for="expense_limit">Batas Pengeluaran (Rp)</label>
                <input type="number" step="0.01" name="expense_limit" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.budget.index') }}" class="btn btn-secondary">Kembali</a>
        </form>

    </x-slot>
</x-layout>