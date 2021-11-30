<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftStaff extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }
}
