<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserBudgetController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|min:2000',
            'month' => 'required|integer|between:1,12',
            'income_target' => 'nullable|numeric',
            'expense_limit' => 'required|numeric',
        ]);

        Budget::create([
            'user_id' => Auth::id(),
            'year' => $request->year,
            'month' => $request->month,
            'income_target' => $request->income_target,
            'expense_limit' => $request->expense_limit,
        ]);

        return redirect()->route('user.budget')->with('success', 'Anggaran berhasil ditambahkan!');
    }

    public function update(Request $request, Budget $budget)
    {
        // Pastikan user hanya bisa mengedit budgetnya sendiri
        if ($budget->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'income_target' => 'nullable|numeric',
            'expense_limit' => 'required|numeric',
        ]);

        $budget->update([
            'income_target' => $request->income_target,
            'expense_limit' => $request->expense_limit,
        ]);

        return redirect()->route('user.budget')->with('success', 'Anggaran berhasil diperbarui!');
    }
}
