<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteChargeRateCard extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function site_type()
    {
        return $this->belongsTo(SiteType::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

}
