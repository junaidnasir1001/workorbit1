<?php

namespace App\Models;

use App\Http\Controllers\Admin\SiteChargeRateCardController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Clients::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notes()
    {
        return $this->morphMany(Notes::class, 'noteable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function contact_person()
    {
        return $this->morphMany(ContactPerson::class, 'contactable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function document()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payratecard()
    {
        return $this->hasMany(SitePayRateCard::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chargeratecard()
    {
        return $this->hasMany(SiteChargeRateCard::class);
    }

    public function pay_rate_card()
    {
        return $this->hasMany(SitePayRateCard::class);
    }

    public function charge_rate_card()
    {
        return $this->hasMany(SiteChargeRateCard::class);
    }

    public function banned_staff()
    {
        return $this->hasMany(SiteStaff::class,'site_id','id')->where('type','banned');
    }
    public function preferred_staff()
    {
        return $this->hasMany(SiteStaff::class,'site_id','id')->where('type','preferred');;
    }
}
