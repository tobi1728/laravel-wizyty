<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\AppointmentStatus;

class Appointment extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'appointment_date',
        'notes',
        'appointment_status_id',
    ];

    /**
     * Wizyta należy do pacjenta.
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Wizyta należy do lekarza.
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Wizyta ma status (np. zaplanowana, zakończona).
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(AppointmentStatus::class, 'appointment_status_id');
    }
}
