<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

use Spatie\ModelStates\HasStates;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use App\Models\Scopes\OwnedScope;

use App\States\Event\EventState;
use App\States\Event\Published;

class Event extends Model
{
    use HasFactory, HasUlids, HasSlug, HasStates;

    protected $fillable = [
        'name',
		'description',
        'owner_id',
        'date',
        'begin_time',
        'location'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'datetime:Y-m-d',
        'begin_time' => 'datetime:H:i:s',
		'state' => EventState::class
    ];

    /*
    public function invites()
    {
        return $this->belongsToMany(Person::class);
    }
    */

    public function invites()
    {
        return $this->belongsToMany(Person::class,'responses')->withPivot(Response::PIVOT_ATTRIBUTES)->using(Response::class)->as('response');
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

	public function owner()
	{
		return $this->belongsTo(User::class);
	}

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new OwnedScope);
    }

	public function scopePublished($query)
    {
        return $query->whereState('state', Published::class);
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

}
