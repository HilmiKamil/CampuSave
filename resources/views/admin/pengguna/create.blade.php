<x-layout>
    <x-slot name="page_name">Halaman Mahasiswa / Create</x-slot>
    <x-slot name="page_title">Lengkapi Data Anda dengan Teliti di Bawah Ini :</x-slot>
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

        <form class="forms-sample" action="{{ url('admin/pengguna') }}" method="post">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-sm-4 col-form-label">Nama Mahasiswa</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Mahasiswa">
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label">Email</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email">
                </div>
            </div>

            <div class="form-group row">
                <label for="phone_number" class="col-sm-4 col-form-label">Nomor Telepon</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Masukkan Nomor Telepon">
                </div>
            </div>

        <div class="form-group row">
            <label for="password" class="col-sm-4 col-form-label">Password</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password">
            </div>
        </div>

        <div class="form-group row">
            <label for="password_confirmation" class="col-sm-4 col-form-label">Konfirmasi Password</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password">
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
