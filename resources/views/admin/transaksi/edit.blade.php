<x-layout>
    <x-slot name="page_name">Halaman Transaksi / Edit</x-slot>
    <x-slot name="page_title">Silakan Perbarui Data Transaksi dengan Teliti :</x-slot>

    <x-slot name="page_content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="forms-sample" action="{{ route('admin.transaksi.update', $transaksi->id) }}" method="post">
            @csrf
            @method('put')

            <input type="hidden" name="id" value="{{ $transaksi->id }}">

            <div class="form-group row">
                <label for="user_id" class="col-sm-4 col-form-label">Nama Mahasiswa</label>
                <div class="col-sm-8">
                    <select class="form-control" id="user_id" name="user_id" required>
                        <option value="">-- Pilih Mahasiswa --</option>
                        @foreach($mahasiswas as $mhs)
                            <option value="{{ $mhs->id }}" {{ $transaksi->user_id == $mhs->id ? 'selected' : '' }}>
                                {{ $mhs->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="type" class="col-sm-4 col-form-label">Jenis Transaksi</label>
                <div class="col-sm-8">
                    <select class="form-control" id="type" name="type" required>
                        <option value="pemasukan" {{ $transaksi->type == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                        <option value="pengeluaran" {{ $transaksi->type == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="amount" class="col-sm-4 col-form-label">Jumlah (Rp)</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="amount" name="amount" value="{{ $transaksi->amount }}" min="0" step="0.01" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="budget_category_id" class="col-sm-4 col-form-label">Kategori</label>
                <div class="col-sm-8">
                    <select class="form-control" id="budget_category_id" name="budget_category_id" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $transaksi->budget_category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-sm-4 col-form-label">Keterangan</label>
                <div class="col-sm-8">
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Opsional">{{ $transaksi->description }}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="date" class="col-sm-4 col-form-label">Tanggal</label>
                <div class="col-sm-8">
                    <input type="date" class="form-control" id="date" name="date" value="{{ $transaksi->date->format('Y-m-d') }}" required>
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