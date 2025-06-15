<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    /**
     * Tampilkan daftar mahasiswa.
     */
    public function index()
    {
        $mahasiswas = User::where('role', 'mahasiswa')->get();
        return view('admin.pengguna.index', compact('mahasiswas'));
    }

    /**
     * Tampilkan form untuk menambahkan mahasiswa baru.
     */
    public function create()
    {
        return view('admin.pengguna.create');
    }

    /**
     * Simpan mahasiswa baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Tambahkan role dan hash password sebelum simpan
        $validated['role'] = 'mahasiswa';
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.pengguna.index')->with('pesan', 'Data mahasiswa berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail mahasiswa.
     */
    public function show(string $id)
    {
        $mahasiswa = User::where('id', $id)->firstOrFail();
        return view('admin.pengguna.show', compact('mahasiswa'));
    }

    /**
     * Tampilkan form edit mahasiswa.
     */
    public function edit($id)
    {
        $mahasiswa = User::findOrFail($id);
        return view('admin.pengguna.edit', compact('mahasiswa'));
    }

    /**
     * Update data mahasiswa.
     */
    public function update(Request $request, $id)
    {
        // Ambil data mahasiswa berdasarkan ID
        $mahasiswa = User::findOrFail($id);

        // Validasi data yang diterima dari form
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email,' . $id,
            'phone_number' => 'required|string|max:20',
            'role'         => 'required|string|in:admin,mahasiswa',
        ]);

        // Update data mahasiswa
        $mahasiswa->update($data);

        // Redirect kembali ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('admin.pengguna.index')->with('update', 'Data mahasiswa berhasil diperbarui.');
    }
    /**
     * Hapus mahasiswa dari database.
     */
    public function destroy(String $id)
    {
        $mahasiswa = User::where('id', $id)->first();
        $mahasiswa->delete();
        return redirect()->route('admin.pengguna.index')->with('delete', 'Data mahasiswa berhasil dihapus.');
    }
}
