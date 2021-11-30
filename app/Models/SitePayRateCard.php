<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SitePayRateCard extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }


}
