<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    public function index()
    {
        $budgets = Budget::with('user')->latest()->paginate(10);
        return view('admin.budget.index', compact('budgets'));
    }

    public function create()
    {
        $mahasiswas = User::where('role', User::ROLE_USER)->get();
        return view('admin.budget.create', compact('mahasiswas'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'month' => (int) $request->month,
            'year' => (int) $request->year,
        ]);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'year' => 'required|integer|min:2000',
            'month' => 'required|integer|between:1,12',
            'income_target' => 'nullable|numeric',
            'expense_limit' => 'nullable|numeric',
        ]);

        Budget::create($request->all());

        return redirect()->route('admin.budget.index')->with('success', 'Rencana anggaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $budget = Budget::findOrFail($id);
        $users = User::all();
        return view('admin.budget.edit', compact('budget', 'users'));
    }

    public function update(Request $request, $id)
    {
        $budget = Budget::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'year' => 'required|integer|min:2000',
            'month' => 'required|integer|between:1,12',
            'income_target' => 'nullable|numeric',
            'expense_limit' => 'nullable|numeric',
        ]);

        $budget->update($request->all());

        return redirect()->route('admin.budget.index')->with('success', 'Rencana anggaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $budget = Budget::findOrFail($id);
        $budget->delete();

        return redirect()->route('admin.budget.index')->with('success', 'Rencana anggaran berhasil dihapus.');
    }
}
