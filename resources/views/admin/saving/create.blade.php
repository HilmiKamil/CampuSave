@use(App\Models\User)

<x-layout>
    <x-slot name="page_name">Halaman Simpanan / Tambah</x-slot>
    <x-slot name="page_title">Lengkapi Data Simpanan di Bawah Ini :</x-slot>
    <x-slot name="page_content">

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form class="forms-sample" action="{{ route('admin.saving.store') }}" method="post">
            @csrf

            <div class="form-group row">
                <label for="user_id" class="col-sm-4 col-form-label">Nama Mahasiswa</label>
                <div class="col-sm-8">
                    <select class="form-control" id="user_id" name="user_id" required>
                        <option value="">Pilih Mahasiswa</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="amount" class="col-sm-4 col-form-label">Jumlah Tabungan (Rp)</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="amount" name="amount" placeholder="Masukkan Jumlah Tabungan" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="saved_at" class="col-sm-4 col-form-label">Tanggal Simpanan</label>
                <div class="col-sm-8">
                    <input type="date" class="form-control" id="saved_at" name="saved_at" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-sm-4 col-form-label">Deskripsi</label>
                <div class="col-sm-8">
                    <textarea class="form-control" id="description" name="description" placeholder="Masukkan Deskripsi" rows="3"></textarea>
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