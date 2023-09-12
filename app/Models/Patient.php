<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getFormattedBirthdayAttribute()
    {
        return Carbon::parse($this->attributes['birthday'])->format('M d, Y');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
