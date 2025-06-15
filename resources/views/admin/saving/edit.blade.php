@use(App\Models\User)

<x-layout>
    <x-slot name="page_name">Halaman Simpanan / Edit</x-slot>
    <x-slot name="page_title">Silakan Perbarui Data Simpanan dengan Teliti :</x-slot>

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

        <form class="forms-sample" action="{{ route('admin.saving.update', $saving->id) }}" method="post">
            @csrf
            @method('put')

            <div class="form-group row">
                <label for="user_id" class="col-sm-4 col-form-label">Nama Mahasiswa</label>
                <div class="col-sm-8">
                    <select class="form-control" id="user_id" name="user_id" required>
                        <option value="">Pilih Mahasiswa</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $user->id == $saving->user_id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="amount" class="col-sm-4 col-form-label">Jumlah Tabungan (Rp)</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="amount" name="amount" placeholder="Masukkan Jumlah Tabungan" value="{{ $saving->amount }}" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="saved_at" class="col-sm-4 col-form-label">Tanggal Simpanan</label>
                <div class="col-sm-8">
                    <input type="date" class="form-control" id="saved_at" name="saved_at" value="{{ $saving->saved_at->format('Y-m-d') }}" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-sm-4 col-form-label">Deskripsi</label>
                <div class="col-sm-8">
                    <textarea class="form-control" id="description" name="description" placeholder="Masukkan Deskripsi" rows="3">{{ $saving->description }}</textarea>
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