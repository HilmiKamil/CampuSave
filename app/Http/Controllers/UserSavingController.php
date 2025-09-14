<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use App\Models\Transaksi;
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
            ->orderBy('created_at', 'desc')
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

        // Ambil ID pengguna yang sedang login
        $userId = Auth::id();

        // Ambil total pemasukan yang tersedia
        $totalPemasukan = Transaksi::where('user_id', $userId)
            ->where('type', 'pemasukan') // Pastikan ini adalah pemasukan
            ->sum('amount');

        // Ambil total pengeluaran yang sudah dicatat
        $totalPengeluaran = Transaksi::where('user_id', $userId)
            ->where('type', 'pengeluaran') // Pastikan ini adalah pengeluaran
            ->sum('amount');

        // Hitung sisa uang yang tersedia
        $sisaUang = $totalPemasukan - $totalPengeluaran;

        // Cek apakah sisa uang cukup untuk menambahkan tabungan
        if ($sisaUang >= $request->amount) {
            // Simpan tabungan
            Saving::create([
                'user_id' => $userId,
                'amount' => $request->amount,
                'saved_at' => $request->saved_at,
                'description' => $request->description,
            ]);

            // Kurangi jumlah dari transaksi
            // Ambil transaksi pemasukan terbaru
            $transaksi = Transaksi::where('user_id', $userId)
                ->where('type', 'pemasukan')
                ->orderBy('date', 'desc')
                ->first();

            if ($transaksi) {
                // Kurangi jumlah dari transaksi
                $transaksi->amount -= $request->amount;
                $transaksi->save(); // Simpan perubahan
            }

            return redirect()->route('mahasiswa.saving')->with('success', 'Tabungan berhasil ditambahkan!');
        } else {
            return redirect()->back()->withErrors(['amount' => 'Jumlah tabungan melebihi jumlah uang yang tersedia.']);
        }
    }



    public function history()
    {
        $userId = Auth::id();
        $savings = Saving::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.mahasiswa.saving_history', compact('savings'));
    }
}
