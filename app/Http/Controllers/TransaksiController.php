<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use App\Models\BudgetCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('user')->orderBy('date', 'desc')->paginate(10);
        return view('admin.transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $mahasiswas = User::where('role', User::ROLE_USER)->get();
        $categories = BudgetCategory::with('budget')->get();
        return view('admin.transaksi.create', compact('mahasiswas', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'type'        => 'required|in:pemasukan,pengeluaran',
            'amount'      => 'required|numeric|min:0',
            'budget_category_id' => 'required|exists:budget_categories,id',
            'description' => 'nullable|string',
            'date'        => 'required|date',
        ]);

        if ($request->type === 'pengeluaran') {
            $category = BudgetCategory::find($request->budget_category_id);
            $spent = $category->calculateSpent();
            $remaining = $category->amount - $spent;

            if ($request->amount > $remaining) {
                return back()->withErrors([
                    'amount' => 'Pengeluaran melebihi sisa budget kategori. Sisa: Rp ' . number_format($remaining, 0, ',', '.')
                ]);
            }
        }

        Transaksi::create($request->all());
        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function storeByUser(Request $request)
    {
        $request->validate([
            'type'        => 'required|in:pemasukan,pengeluaran',
            'amount'      => 'required|numeric|min:0',
            'budget_category_id' => 'required|exists:budget_categories,id',
            'description' => 'nullable|string',
            'date'        => 'required|date',
        ]);

        // Gunakan user yang sedang login
        $request->merge(['user_id' => Auth::id()]);

        if ($request->type === 'pengeluaran') {
            $category = BudgetCategory::find($request->budget_category_id);
            $spent = $category->calculateSpent();
            $remaining = $category->amount - $spent;

            if ($request->amount > $remaining) {
                return back()->withErrors([
                    'amount' => 'Pengeluaran melebihi sisa budget kategori. Sisa: Rp ' . number_format($remaining, 0, ',', '.')
                ]);
            }
        }

        Transaksi::create($request->all());
        return back()->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function show()
    {
        // Perbaikan: Gunakan Auth facade
        $userId = Auth::id();

        $transaksis = Transaksi::where('user_id', $userId)
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('user.mahasiswa.riwayat', compact('transaksis'));
    }

    public function edit(Transaksi $transaksi)
    {
        $mahasiswas = User::where('role', User::ROLE_USER)->get();
        $categories = BudgetCategory::with('budget')->get();
        return view('admin.transaksi.edit', compact('transaksi', 'mahasiswas', 'categories'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'type'        => 'required|in:pemasukan,pengeluaran',
            'amount'      => 'required|numeric|min:0',
            'budget_category_id' => 'required|exists:budget_categories,id',
            'description' => 'nullable|string',
            'date'        => 'required|date',
        ]);

        if ($request->type === 'pengeluaran') {
            $category = BudgetCategory::find($request->budget_category_id);
            $spent = $category->calculateSpent();

            if ($transaksi->budget_category_id == $category->id) {
                $spent -= $transaksi->amount;
            }

            $remaining = $category->amount - $spent;

            if ($request->amount > $remaining) {
                return back()->withErrors([
                    'amount' => 'Pengeluaran melebihi sisa budget kategori. Sisa: Rp ' . number_format($remaining, 0, ',', '.')
                ]);
            }
        }

        $transaksi->update($request->all());
        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil diupdate.');
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
