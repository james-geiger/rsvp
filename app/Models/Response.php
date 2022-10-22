<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\ModelStates\HasStates;
use App\States\Response\ResponseState;

class Response extends Pivot
{
    use HasFactory, HasUlids, HasStates;

    protected $table = 'responses';

    protected $fillable = [
        'event_id',
        'person_id'
    ];

    const PIVOT_ATTRIBUTES = [
		'id',
        'response_state',
        'response_message',
        'response_date'
    ];


    protected $casts = [
        'response_state' => ResponseState::class,
		'response_date' => 'datetime',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

	public function group()
	{
		return $this->belongsTo(Group::class);
	}

}
