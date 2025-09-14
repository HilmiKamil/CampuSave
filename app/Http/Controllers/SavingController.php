<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use App\Models\User;
use Illuminate\Http\Request;

class SavingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $savings = Saving::with('user')->orderBy('saved_at', 'desc')->paginate(10);
        return view('admin.saving.index', compact('savings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all(); // Ambil semua pengguna
        return view('admin.saving.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'amount'      => 'required|numeric|min:0',
            'saved_at'    => 'required|date',
            'description' => 'nullable|string',
        ]);

        Saving::create($request->all());

        return redirect()->route('admin.saving.index')->with('success', 'Saving berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Fetch the saving by ID
        $saving = Saving::with('user')->find($id);

        // Check if the saving exists
        if (!$saving) {
            return redirect()->route('admin.saving.index')->withErrors(['error' => 'Simpanan tidak ditemukan.']);
        }

        // Get all savings for the user and paginate them
        $savings = Saving::where('user_id', $saving->user_id)->paginate(10);

        // Pass the saving and paginated savings to the view
        return view('admin.saving.show', compact('saving', 'savings'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Saving $saving)
    {
        $users = User::all(); // Ambil semua pengguna
        return view('admin.saving.edit', compact('saving', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Saving $saving)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'amount'      => 'required|numeric|min:0',
            'saved_at'    => 'required|date',
            'description' => 'nullable|string',
        ]);

        $saving->update($request->all());
        return redirect()->route('admin.saving.index')->with('success', 'Saving berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Saving $saving)
    {
        $saving->delete();
        return redirect()->route('admin.saving.index')->with('success', 'Saving berhasil dihapus.');
    }
}
