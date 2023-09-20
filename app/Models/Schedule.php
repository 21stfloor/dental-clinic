<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getFormattedStartTimeAttribute()
    {
        return date('h:i A', strtotime($this->attributes['start_time']));
    }

    public function getFormattedEndTimeAttribute()
    {
        return date('h:i A', strtotime($this->attributes['end_time']));
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
