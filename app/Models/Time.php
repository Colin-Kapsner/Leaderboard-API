<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Time extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'time',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
