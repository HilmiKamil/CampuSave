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
        return view('admin.transaksi.create', [
            'mahasiswas' => User::where('role', User::ROLE_USER)->get(),
            'categories' => BudgetCategory::with('budget')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        // Handle the case where budget_category_id is not provided
        if (empty($request->budget_category_id)) {
            $request->merge(['budget_category_id' => null]); // Set to null if not provided
        }

        return $this->handleTransaction($request, 'admin.transaksi.index');
    }

    public function storeByUser(Request $request)
    {
        $request->validate([
            'type' => 'required|in:pemasukan,pengeluaran',
            'amount' => 'required|numeric|min:0',
            'budget_category_id' => 'nullable|exists:budget_categories,id', // Make this nullable
            'description' => 'nullable|string',
            'date' => 'required|date',
        ]);

        $request->merge(['user_id' => Auth::id()]);

        // Handle the case where budget_category_id is not provided
        if (empty($request->budget_category_id)) {
            $request->merge(['budget_category_id' => null]); // Set to null if not provided
        }

        return $this->handleTransaction($request, 'user.mahasiswa');
    }


    public function show()
    {
        $transaksis = Transaksi::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);
        return view('user.mahasiswa.riwayat', compact('transaksis'));
    }

    public function edit(Transaksi $transaksi)
    {
        return view('admin.transaksi.edit', [
            'transaksi' => $transaksi,
            'mahasiswas' => User::where('role', User::ROLE_USER)->get(),
            'categories' => BudgetCategory::with('budget')->get(),
        ]);
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $this->validateRequest($request);
        return $this->handleTransaction($request, 'admin.transaksi.index', $transaksi);
    }

    public function destroy(Transaksi $transaksi)
    {
        try {
            $transaksi->delete();
            return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus transaksi.']);
        }
    }

    protected function validateRequest(Request $request)
    {
        return $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:pemasukan,pengeluaran',
            'amount' => 'required|numeric|min:0',
            'budget_category_id' => 'required|exists:budget_categories,id',
            'description' => 'nullable|string',
            'date' => 'required|date',
        ]);
    }

    protected function handleTransaction(Request $request, $redirectRoute, ?Transaksi $transaksi = null) // Updated here
    {
        if ($request->type === 'pengeluaran') {
            $category = BudgetCategory::find($request->budget_category_id);
            $spent = $category->calculateSpent();
            $remaining = $category->amount - ($transaksi ? $spent - $transaksi->amount : $spent);

            if ($request->amount > $remaining) {
                return back()->withErrors([
                    'amount' => 'Pengeluaran melebihi sisa budget kategori. Sisa: Rp ' . number_format($remaining, 0, ',', '.')
                ]);
            }
        }

        try {
            if ($transaksi) {
                $transaksi->update($request->all());
                return redirect()->route($redirectRoute)->with('success', 'Transaksi berhasil diupdate.');
            } else {
                Transaksi::create($request->all());
                return redirect()->route($redirectRoute)->with('success', 'Transaksi berhasil ditambahkan.');
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan transaksi.']);
        }
    }
}
