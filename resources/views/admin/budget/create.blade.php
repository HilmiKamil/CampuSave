<x-layout>
    <x-slot name="page_name">Halaman Budget / Create</x-slot>
    <x-slot name="page_title">Lengkapi Data Budget di Bawah Ini :</x-slot>
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

        <form class="forms-sample" action="{{ route('admin.budget.store') }}" method="post">
            @csrf

            <div class="form-group row">
                <label for="user_id" class="col-sm-4 col-form-label">Nama Mahasiswa</label>
                <div class="col-sm-8">
                    <select class="form-control" id="user_id" name="user_id" required>
                        <option value="">Pilih Mahasiswa</option>
                        @foreach($mahasiswas as $mahasiswa)
                            <option value="{{ $mahasiswa->id }}" {{ old('user_id') == $mahasiswa->id ? 'selected' : '' }}>
                                {{ $mahasiswa->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="month" class="col-sm-4 col-form-label">Bulan</label>
                <div class="col-sm-8">
                    <input type="number" name="month" class="form-control" min="1" max="12" value="{{ old('month') }}" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="year" class="col-sm-4 col-form-label">Tahun</label>
                <div class="col-sm-8">
                    <input type="number" name="year" class="form-control" placeholder="Contoh: 2025" value="{{ old('year') }}" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="income_target" class="col-sm-4 col-form-label">Target Pemasukan (Rp)</label>
                <div class="col-sm-8">
                    <input type="number" step="0.01" name="income_target" class="form-control" placeholder="Masukkan target pemasukan" value="{{ old('income_target') }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="expense_limit" class="col-sm-4 col-form-label">Batas Pengeluaran (Rp)</label>
                <div class="col-sm-8">
                    <input type="number" step="0.01" name="expense_limit" class="form-control" placeholder="Masukkan batas pengeluaran" value="{{ old('expense_limit') }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="savings_goal" class="col-sm-4 col-form-label">Target Tabungan (Rp)</label>
                <div class="col-sm-8">
                    <input type="number" step="0.01" name="savings_goal" class="form-control" placeholder="Masukkan target tabungan" value="{{ old('savings_goal') }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-sm-4 col-form-label">Keterangan</label>
                <div class="col-sm-8">
                    <textarea name="description" class="form-control" placeholder="Masukkan keterangan (opsional)">{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-4"></div>
                <div class="col-sm-8">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                </div>
            </div>
        </form>

    </x-slot>
</x-layout>
