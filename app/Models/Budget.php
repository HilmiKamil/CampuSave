<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Budget extends Model
{
    use HasFactory;

    protected $table = 'budgets';

    protected $fillable = [
        'user_id',
        'year',
        'month',
        'income_target',
        'expense_limit',
    ];

    protected $casts = [
        'income_target' => 'decimal:2',
        'expense_limit' => 'decimal:2',
        'year' => 'integer',
        'month' => 'integer',
    ];

    protected $appends = ['start_date', 'end_date'];

    public function getStartDateAttribute()
    {
        return Carbon::create($this->year, $this->month, 1)->startOfMonth();
    }

    public function getEndDateAttribute()
    {
        return Carbon::create($this->year, $this->month, 1)->endOfMonth();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->hasMany(BudgetCategory::class);
    }
}
