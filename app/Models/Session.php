<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Session extends Model
{
    use HasFactory;

    protected $table = 'training_sessions';

    protected $fillable = [
        'training_id',
        'date',
        'start_time',
        'capacity',
        'status',
    ];

    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'training_session_id');
    }
}
