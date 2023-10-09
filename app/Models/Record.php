<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'doctor_id',
        // Other fields you want to allow for mass assignment
        'date_completed',
        'type',
        'summary',
        'image',
    ];
}
