<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Appointment;

class Referral extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'appointment_id',
        'refferal_code',
        'target_specialization',
        'reason',
        'issue_date',
    ];

    /**
     * Skierowanie należy do jednej wizyty.
     */
    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }
}
