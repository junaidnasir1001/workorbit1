<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function siteType()
    {
        return $this->belongsTo(SiteType::class);
    }

    public function staff()
    {
        return $this->hasMany(ShiftStaff::class);
    }

    public static function workingDays()
    {
        return ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    }
}
