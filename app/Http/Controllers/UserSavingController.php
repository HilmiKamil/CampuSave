<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Added Auth facade
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSavingController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Total tabungan
        $totalSavings = Saving::where('user_id', $userId)->sum('amount');

        // Tabungan bulan ini
        $monthlySavings = Saving::where('user_id', $userId)
            ->whereMonth('saved_at', now()->month)
            ->whereYear('saved_at', now()->year)
            ->sum('amount');

        // Jumlah transaksi
        $transactionCount = Saving::where('user_id', $userId)->count();

        // Rata-rata per bulan
        $averageMonthly = Saving::where('user_id', $userId)
            ->select(DB::raw('AVG(amount) as average'))
            ->value('average') ?? 0;

        // Riwayat terbaru (5 terbaru)
        $savingsHistory = Saving::where('user_id', $userId)
            ->orderBy('saved_at', 'desc')
            ->take(5)
            ->get();

        return view('user.mahasiswa.saving', [
            'totalSavings' => $totalSavings,
            'monthlySavings' => $monthlySavings,
            'transactionCount' => $transactionCount,
            'averageMonthly' => $averageMonthly,
            'savingsHistory' => $savingsHistory
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
            'saved_at' => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);

        Saving::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'saved_at' => $request->saved_at,
            'description' => $request->description,
        ]);

        return redirect()->route('mahasiswa.saving')->with('success', 'Tabungan berhasil ditambahkan!');
    }

    public function history()
    {
        $userId = Auth::id();
        $savings = Saving::where('user_id', $userId)
            ->orderBy('saved_at', 'desc')
            ->paginate(10);

        return view('user.mahasiswa.saving_history', compact('savings'));
    }
}
