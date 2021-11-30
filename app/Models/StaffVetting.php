<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class StaffVetting extends Model
{
    use HasFactory;

    /**
     *
     */
    const VERIFIED = "verified";
    /**
     *
     */
    const NOT_VERIFIED = "not_verified";
    /**
     *
     */
    const REJECTED = "rejected";

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vetting()
    {
        return $this->belongsTo(Vetting::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vetting_by()
    {
        return $this->belongsTo(Admin::class, 'vetting_by');
    }
}
