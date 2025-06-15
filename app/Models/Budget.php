<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Budget extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika tidak sesuai dengan konvensi Laravel
    protected $table = 'budgets'; // Ganti dengan nama tabel Anda jika berbeda

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'year',
        'month',
        'income_target',
        'expense_limit',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'income_target' => 'decimal:2',
        'expense_limit' => 'decimal:2',
        'year' => 'integer',
        'month' => 'integer',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    // Add to Budget model
    protected $appends = ['start_date', 'end_date'];

    public function getStartDateAttribute()
    {
        return Carbon::create($this->year, $this->month, 1)->startOfMonth();
    }

    public function getEndDateAttribute()
    {
        return Carbon::create($this->year, $this->month, 1)->endOfMonth();
    }

    /**
     * Get the user that owns the budget.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->hasMany(BudgetCategory::class);
    }
}
