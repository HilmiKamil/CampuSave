<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Budget;
use App\Models\BudgetCategory;

class BudgetCategoryController extends Controller
{
    /**
     * Bulk update categories (create, update)
     */
    public function bulkUpdate(Request $request, Budget $budget)
    {
        // Validate input
        $request->validate([
            'categories' => 'required|array',
            'categories.*.id' => 'sometimes|nullable|exists:budget_categories,id,budget_id,' . $budget->id,
            'categories.*.name' => 'required|string|max:255',
            'categories.*.limit' => 'required|numeric|min:0',
        ]);

        $submittedIds = []; // Simpan ID kategori yang ada di request

        // Process categories
        foreach ($request->categories as $categoryData) {
            // Jika ada ID, update kategori yang sudah ada
            if (!empty($categoryData['id'])) {
                $category = BudgetCategory::where('id', $categoryData['id'])
                    ->where('budget_id', $budget->id)
                    ->first();

                if ($category) {
                    $category->update([
                        'name' => $categoryData['name'],
                        'amount' => $categoryData['limit']
                    ]);
                    $submittedIds[] = $category->id;
                }
            }
            // Jika tidak ada ID, buat kategori baru
            else {
                $newCategory = $budget->categories()->create([
                    'name' => $categoryData['name'],
                    'amount' => $categoryData['limit']
                ]);
                $submittedIds[] = $newCategory->id;
            }
        }

        // === LOGIKA NOMOR 5: HAPUS KATEGORI YANG TIDAK ADA DI REQUEST ===
        // Dapatkan semua kategori yang ada di database untuk budget ini
        $existingCategories = $budget->categories()->pluck('id')->toArray();

        // Identifikasi kategori yang perlu dihapus
        $categoriesToDelete = array_diff($existingCategories, $submittedIds);

        // Hapus kategori yang tidak ada di request
        if (!empty($categoriesToDelete)) {
            BudgetCategory::whereIn('id', $categoriesToDelete)
                ->where('budget_id', $budget->id)
                ->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil diperbarui'
        ]);
    }

    // app/Http/Controllers/BudgetCategoryController.php
    public function destroy(BudgetCategory $category)
    {
        // Authorization
        if ($category->budget->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action'
            ], 403);
        }

        try {
            $category->delete();
            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus kategori: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a new category
     */
    public function store(Request $request, Budget $budget)
    {
        // Authorization check


        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'limit' => 'required|numeric|min:0',
        ]);

        // Buat kategori baru
        $budget->categories()->create([
            'name' => $validated['name'],
            'amount' => $validated['limit']
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }
}
