<x-layout>
    <x-slot name="page_name">Halaman Mahasiswa / Edit</x-slot>
    <x-slot name="page_title">Silakan Perbarui Data Mahasiswa dengan Teliti :</x-slot>

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

        <form class="forms-sample" action="{{ url('admin/pengguna/' . $mahasiswa->id) }}" method="post">
            @csrf
            @method('put')
            <input type="hidden" name="id" value="{{ $mahasiswa->id }}">

            <div class="form-group row">
                <label for="name" class="col-sm-4 col-form-label">Nama</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Lengkap Mahasiswa" value="{{ $mahasiswa->name ?? '' }}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label">Email</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" value="{{ $mahasiswa->email ?? '' }}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="phone_number" class="col-sm-4 col-form-label">No. Handphone</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Masukkan Nomor Handphone" value="{{ $mahasiswa->phone_number ?? '' }}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="role" class="col-sm-4 col-form-label">Role</label>
                <div class="col-sm-8">
                    <select class="form-control" id="role" name="role">
                        <option value="mahasiswa" {{ $mahasiswa->role == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                        <option value="admin" {{ $mahasiswa->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
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