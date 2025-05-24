<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Doctor;

class DoctorSchedule extends Model
{
    public $timestamps = false;

    protected $table = 'doctors_schedules';

    protected $fillable = [
        'doctor_id',
        'dateStart',
        'dateEnd',
        'timeStart',
        'timeEnd',
    ];

    /**
     * Harmonogram należy do jednego lekarza.
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
}