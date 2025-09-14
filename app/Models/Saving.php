<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'saved_at',
        'description'
    ];

    protected $casts = [
        'saved_at' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
