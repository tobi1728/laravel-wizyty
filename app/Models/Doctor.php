<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;



class Doctor extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'specialization',
        'license_number',
    ];

    /**
     * Relacja do użytkownika.
     * Lekarz należy do jednego użytkownika (User).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
