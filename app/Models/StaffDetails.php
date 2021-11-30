<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffDetails extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public static function gender()
    {
        return ['Male', 'Female'];
    }

    public static function ethnic_origin()
    {
        return ['British', 'African', 'Asian', 'Caribbean', 'Chinese', 'White'];
    }

    public static function driving_license()
    {
        return ['Full', 'Provisional', 'None'];
    }
}
