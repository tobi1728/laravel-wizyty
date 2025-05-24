<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $table = 'medicines'; 

    public $timestamps = false;

    protected $fillable = [
        'medicine_name',
        'medicine_form',
        'active_substance',
        'medicine_category',
        'medicine_producer',
        'medicine_description',
    ];
}