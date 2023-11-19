<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = ['event_id'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

	public function members()
	{
		return $this->hasMany(Response::class);
	}

}
