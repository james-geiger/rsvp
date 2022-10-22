<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use App\Models\Scopes\OwnedScope;


class Person extends Model
{
    use HasFactory, HasUlids, Searchable;

    protected $fillable = [
		'owner_id',
        'name',
		'email_address',
        'street_address',
        'city',
        'state',
        'postal_code'
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = [
            'name' => $this->name
        ];

        return $array;
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'responses');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    //public function response()
    //{
//return $this->hasMany(Response::class);
    //}

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new OwnedScope);
    }
}
