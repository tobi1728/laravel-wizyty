<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Appointment;
use App\Models\Medicine;

class Prescription extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'appointment_id',
        'medicine_id',
        'prescription_code',
        'issue_date',
        'notes',
    ];

    /**
     * Recepta należy do jednej wizyty.
     */
    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

    /**
     * Recepta dotyczy jednego leku.
     */
    public function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class);
    }
}
