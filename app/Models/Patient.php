<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;



class Patient extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'pesel',
        'birth_date',
        'phone_number',
        'address',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}