<x-layout>
    <x-slot name="page_name">Edit Anggaran</x-slot>
    <x-slot name="page_title">Perbarui Data Anggaran di Bawah Ini:</x-slot>
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

        <form action="{{ route('admin.budget.update', $budget->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="user_id">Nama Mahasiswa</label>
                <select class="form-control" id="user_id" name="user_id" required>
                    <option value="">Pilih Mahasiswa</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $budget->user_id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="month">Bulan</label>
                <input type="number" name="month" class="form-control" min="1" max="12" value="{{ $budget->month }}" required>
            </div>

            <div class="form-group">
                <label for="year">Tahun</label>
                <input type="number" name="year" class="form-control" value="{{ $budget->year }}" required>
            </div>

            <div class="form-group">
                <label for="income_target">Target Pemasukan (Rp)</label>
                <input type="number" step="0.01" name="income_target" class="form-control" value="{{ $budget->income_target }}">
            </div>

            <div class="form-group">
                <label for="expense_limit">Batas Pengeluaran (Rp)</label>
                <input type="number" step="0.01" name="expense_limit" class="form-control" value="{{ $budget->expense_limit }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('admin.budget.index') }}" class="btn btn-secondary">Kembali</a>
        </form>

    </x-slot>
</x-layout>