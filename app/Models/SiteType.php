<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeIsActive($query)
    {
        return $query->where('is_active', 1);
    }
}
