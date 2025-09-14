<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\UserBudgetController;
use App\Http\Controllers\UserSavingController;
use App\Http\Controllers\BudgetCategoryController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\DashboardController;

// Halaman utama (user)
Route::get('/', fn() => view('user.index'))->name('user.index');

// Redirect setelah login ke halaman utama
Route::get('/dashboard', fn() => redirect()->route('user.index'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rute admin
Route::middleware(['auth'])->get('/admin/index', function () {
    return view('admin.index');
})->name('admin.index');

Route::middleware('auth')->group(function () {
    // ... rute lainnya ...

    // Rute untuk transaksi user (mahasiswa)
    Route::prefix('user/transaksi')->name('user.transaksi.')->group(function () {
        Route::post('/store', [TransaksiController::class, 'storeByUser'])->name('store');
    });
});



// Rute tabungan mahasiswa
Route::middleware(['auth', 'verified'])->prefix('mahasiswa')->group(function () {
    Route::prefix('saving')->group(function () {
        Route::get('/', [UserSavingController::class, 'index'])->name('mahasiswa.saving');
        Route::post('/', [UserSavingController::class, 'store'])->name('mahasiswa.saving.store');
        Route::get('/history', [UserSavingController::class, 'history'])->name('mahasiswa.saving.history');
    });
});



// Group route dengan middleware 'auth'
Route::middleware('auth')->group(function () {
    // Profil pengguna
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    // Rute untuk user mahasiswa
    Route::get('/user/mahasiswa/riwayat', [TransaksiController::class, 'show'])->name('user.riwayat');

    // Dashboard user
    Route::get('/user/mahasiswa', [DashboardController::class, 'index'])->name('user.mahasiswa');


    Route::prefix('user/budget')->group(function () {
        Route::get('/', [DashboardController::class, 'budget'])->name('user.budget');
        Route::post('/', [UserBudgetController::class, 'store'])->name('user.budget.store');
        Route::put('/{budget}', [UserBudgetController::class, 'update'])->name('user.budget.update');

        // ✅ Store untuk kategori baru
        Route::post('/{budget}/categories', [BudgetCategoryController::class, 'store'])
            ->name('user.budget.categories.store');

        // ✅ Bulk update untuk semua kategori
        Route::post('/{budget}/categories/bulk-update', [BudgetCategoryController::class, 'bulkUpdate'])
            ->name('user.budget.categories.bulkUpdate');

        // routes/web.php
        Route::delete('/categories/{category}', [BudgetCategoryController::class, 'destroy'])
            ->name('user.budget.categories.destroy');
    });



    // Manajemen Mahasiswa (Admin)
    Route::prefix('admin/pengguna')->name('admin.pengguna.')->controller(MahasiswaController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}', 'show')->name('show');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    // Transaksi (Admin)
    Route::prefix('admin/transaksi')->name('admin.transaksi.')->controller(TransaksiController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/mahasiswa/{mahasiswa}', 'show')->name('show');
        Route::get('/mahasiswa/{mahasiswa}', 'show')->name('show');
        Route::get('/{transaksi}/edit', 'edit')->name('edit');
        Route::put('/{transaksi}', 'update')->name('update');
        Route::delete('/{transaksi}', 'destroy')->name('destroy');
    });

    // Budget (Admin)
    Route::prefix('admin/budget')->name('admin.budget.')->controller(BudgetController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{budget}', 'show')->name('show');
        Route::get('/{budget}/edit', 'edit')->name('edit');
        Route::put('/{budget}', 'update')->name('update');
        Route::delete('/{budget}', 'destroy')->name('destroy');
    });

    // Saving (Admin)
    Route::prefix('admin/saving')->name('admin.saving.')->controller(SavingController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{saving}', 'show')->name('show');
        Route::get('/{saving}/edit', 'edit')->name('edit');
        Route::put('/{saving}', 'update')->name('update');
        Route::delete('/{saving}', 'destroy')->name('destroy');
    });
});

require __DIR__ . '/auth.php';
