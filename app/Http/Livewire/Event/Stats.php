<?php

namespace App\Http\Livewire\Event;

use Livewire\Component;

use App\Models\Event;

use Illuminate\Database\Eloquent\Builder;

class Stats extends Component
{

	public Event $event;

	protected $listeners = ['updateGuests' => 'updateEvent'];

	public function mount($event)
	{
		$this->event = $event;
	}

	public function updateEvent()
	{
		$this->event->update();
		$this->event->loadCount([
            'invites',
            'invites as accepted_invites_count' => function (Builder $query) {
                $query->where('response_state', '=', 'accepted');
            },
            'invites as declined_invites_count' => function (Builder $query) {
                $query->where('response_state', '=', 'declined');
            },
        ]);
	}

    public function render()
    {
        return view('livewire.event.stats');
    }
}
