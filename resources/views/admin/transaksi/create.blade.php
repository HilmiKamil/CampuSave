<x-layout>
    <x-slot name="page_name">Halaman Transaksi / Create</x-slot>
    <x-slot name="page_title">Lengkapi Data Anda dengan Teliti di Bawah Ini :</x-slot>
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

        <form class="forms-sample" action="{{ route('admin.transaksi.store') }}" method="post">
            @csrf

            <div class="form-group row">
                <label for="user_id" class="col-sm-4 col-form-label">Nama Mahasiswa</label>
                <div class="col-sm-8">
                    <select class="form-control" id="user_id" name="user_id">
                        <option value="">Pilih Mahasiswa</option>
                        @foreach($mahasiswas as $mahasiswa)
                            <option value="{{ $mahasiswa->id }}">{{ $mahasiswa->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="date" class="col-sm-4 col-form-label">Tanggal Transaksi</label>
                <div class="col-sm-8">
                    <input type="date" class="form-control" id="date" name="date" placeholder="Masukkan Tanggal">
                </div>
            </div>

            <div class="form-group row">
                <label for="type" class="col-sm-4 col-form-label">Jenis Transaksi</label>
                <div class="col-sm-8">
                    <select class="form-control" id="type" name="type">
                        <option value="">Pilih Jenis</option>
                        <option value="pemasukan">Pemasukan</option>
                        <option value="pengeluaran">Pengeluaran</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="amount" class="col-sm-4 col-form-label">Jumlah Nominal</label>
                <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" id="amount" name="amount" placeholder="Masukkan Jumlah Nominal">
                </div>
            </div>

            <div class="form-group row">
                <label for="category" class="col-sm-4 col-form-label">Kategori</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="category" name="category" placeholder="Masukkan Kategori (opsional)">
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-sm-4 col-form-label">Keterangan Transaksi</label>
                <div class="col-sm-8">
                    <textarea class="form-control" id="description" name="description" placeholder="Masukkan Keterangan"></textarea>
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
