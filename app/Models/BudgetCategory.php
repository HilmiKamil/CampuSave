<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BudgetCategory extends Model
{
    protected $fillable = [
        'budget_id',
        'user_id', // Tambahkan ini
        'name',
        'amount',
    ];

    public function budget(): BelongsTo
    {
        return $this->belongsTo(Budget::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'budget_category_id');
    }

    public function calculateSpent()
    {
        return $this->transactions()
            ->where('type', 'pengeluaran')
            ->sum('amount');
    }
}
