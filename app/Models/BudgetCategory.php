<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BudgetCategory extends Model
{
    use HasFactory; // Include HasFactory for model factories

    protected $fillable = [
        'budget_id',
        'user_id', // User who created the category
        'name',
        'amount',
    ];

    /**
     * Get the budget that owns the category.
     */
    public function budget(): BelongsTo
    {
        return $this->belongsTo(Budget::class);
    }

    /**
     * Get the user that owns the category.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the transactions associated with the category.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'budget_category_id');
    }

    /**
     * Calculate the total amount spent in this category.
     */
    public function calculateSpent(): float
    {
        return $this->transactions()
            ->where('type', 'pengeluaran')
            ->sum('amount');
    }
}
