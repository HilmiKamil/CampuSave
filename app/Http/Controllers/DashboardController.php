<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;
use App\Models\Budget;
use App\Models\BudgetCategory;
use Carbon\Carbon;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk melihat dashboard.');
        }

        $userId = $user->id; // Perbaikan: Definisikan $userId

        // Hitung total pemasukan, pengeluaran, dan tabungan
        $totalPemasukan = Transaksi::where('user_id', $userId)
            ->where('type', 'pemasukan')
            ->sum('amount');

        $totalPengeluaran = Transaksi::where('user_id', $userId)
            ->where('type', 'pengeluaran')
            ->sum('amount');

        $totalTabungan = $totalPemasukan - $totalPengeluaran;

        // Hitung pengeluaran hari ini
        $pengeluaranHariIni = Transaksi::where('user_id', $userId)
            ->where('type', 'pengeluaran')
            ->whereDate('date', now())
            ->sum('amount');

        // Hitung rata-rata pengeluaran per hari (bukan per transaksi)
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();
        $daysPassed = now()->diffInDays($startOfMonth) + 1; // +1 untuk termasuk hari ini

        $pengeluaranBulanIni = Transaksi::where('user_id', $userId)
            ->where('type', 'pengeluaran')
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        $rataRataPengeluaran = $daysPassed > 0 ? $pengeluaranBulanIni / $daysPassed : 0;

        // Ambil 3 transaksi terbaru
        $recentTransactions = Transaksi::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Ambil kategori budget untuk user ini
        $categories = BudgetCategory::whereHas('budget', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        // Data budget bulan ini
        $currentBudget = $this->getCurrentBudget($userId);
        $pendapatanBulanIni = $this->getMonthlyIncome($userId);
        $expensePercentage = $this->calculateExpensePercentage($currentBudget, $pengeluaranBulanIni);

        return view('user.mahasiswa.index', compact(
            'totalTabungan',
            'pengeluaranHariIni',
            'totalPemasukan',
            'totalPengeluaran',
            'rataRataPengeluaran',
            'recentTransactions',
            'categories',
            'currentBudget',
            'pengeluaranBulanIni',
            'pendapatanBulanIni',
            'expensePercentage'
        ));
    }

    public function budget(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;

        // Get month/year from request or use current
        $month = $request->input('month', date('n'));
        $year = $request->input('year', date('Y'));

        // Calculate date objects
        $currentDate = Carbon::create($year, $month, 1);
        $prevMonth = $currentDate->copy()->subMonth();
        $nextMonth = $currentDate->copy()->addMonth();

        // Get budget for selected month
        $currentBudget = Budget::where('user_id', $userId)
            ->where('month', $month)
            ->where('year', $year)
            ->first();

        // Calculate monthly amounts
        $startOfMonth = $currentDate->copy()->startOfMonth();
        $endOfMonth = $currentDate->copy()->endOfMonth();

        $pengeluaranBulanIni = Transaksi::where('user_id', $userId)
            ->where('type', 'pengeluaran')
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        $pendapatanBulanIni = Transaksi::where('user_id', $userId)
            ->where('type', 'pemasukan')
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->sum('amount');

        $tabunganBulanIni = $pendapatanBulanIni - $pengeluaranBulanIni;

        // Calculate percentages
        $expensePercentage = $this->calculateExpensePercentage($currentBudget, $pengeluaranBulanIni);

        $savingsPercentage = 0;
        if ($currentBudget && $currentBudget->savings_goal > 0) {
            $savingsPercentage = min(100, ($tabunganBulanIni / $currentBudget->savings_goal) * 100);
        }

        // Get categories with spent amounts
        $categories = [];
        if ($currentBudget) {
            foreach ($currentBudget->categories as $category) {
                $spent = Transaksi::where('user_id', $userId)
                    ->where('budget_category_id', $category->id)
                    ->where('type', 'pengeluaran') // Hanya pengeluaran
                    ->whereBetween('date', [$startOfMonth, $endOfMonth])
                    ->sum('amount');

                $percentage = ($category->amount > 0)
                    ? min(100, ($spent / $category->amount) * 100)
                    : 0;

                $categories[] = [
                    'id' => $category->id,
                    'name' => $category->name,
                    'limit' => $category->amount,
                    'spent' => $spent,
                    'remaining' => $category->amount - $spent,
                    'percentage' => $percentage
                ];
            }
        }

        return view('user.mahasiswa.budget', [
            'currentBudget' => $currentBudget,
            'pengeluaranBulanIni' => $pengeluaranBulanIni,
            'pendapatanBulanIni' => $pendapatanBulanIni,
            'tabunganBulanIni' => $tabunganBulanIni,
            'expensePercentage' => $expensePercentage,
            'savingsPercentage' => $savingsPercentage,
            'categories' => $categories,
            'currentDate' => $currentDate,
            'prevMonth' => $prevMonth,
            'nextMonth' => $nextMonth
        ]);
    }

    // ===== HELPER FUNCTIONS =====

    /**
     * Get current month's budget
     */
    private function getCurrentBudget($userId)
    {
        $currentMonth = date('n');
        $currentYear = date('Y');

        return Budget::where('user_id', $userId)
            ->where('month', $currentMonth)
            ->where('year', $currentYear)
            ->first();
    }

    /**
     * Get monthly expense
     */
    private function getMonthlyExpense($userId)
    {
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        return Transaksi::where('user_id', $userId)
            ->where('type', 'pengeluaran')
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->sum('amount');
    }

    /**
     * Get monthly income
     */
    private function getMonthlyIncome($userId)
    {
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        return Transaksi::where('user_id', $userId)
            ->where('type', 'pemasukan')
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->sum('amount');
    }

    /**
     * Calculate expense percentage
     */
    private function calculateExpensePercentage($budget, $expense)
    {
        if ($budget && $budget->expense_limit > 0) {
            return min(100, ($expense / $budget->expense_limit) * 100);
        }
        return 0;
    }
}
