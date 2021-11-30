<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

/**
 * Class Clients
 * @package App\Models
 */
class Clients extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $guarded = [];

    protected $appends = ['profile_url'];


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

    public function getProfileUrlAttribute()
    {
        return URL::to($this->profile_path);
    }
}
