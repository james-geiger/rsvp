<?php

namespace App\Http\Livewire\Event;

use Livewire\Component;
use App\Models\Event;
use App\Models\Person;
use App\Models\Response;
use Illuminate\Support\Facades\Auth;

class GuestList extends Component
{
    public Event $event;

    public $invites;

    public $query;

    public $results;

	public $all_found_results;

    public function mount($event)
    {
        $this->event = $event;
        $this->invites = $this->event->invites;
        $this->query = '';
        $this->results = collect([]);
		$this->all_found_results = collect([]);
    }

    public function booted()
    {
        $this->invites = $this->event->invites;
    }

    public function render()
    {
        return view('livewire.event.guest-list');
    }

    public function add(Person $person)
    {
        $response = Response::create([
            'event_id' => $this->event->id,
            'person_id' => $person->id
        ]);
		$this->emit('updateGuests');
        $this->event = $this->event->refresh();
        $this->invites = $this->event->invites;
        $this->query = '';
    }

	public function addNewDetail()
	{
		if ($this->all_found_results->count() === 0) {
			return redirect()->route('person.create', ['name' => $this->query, 'event' => $this->event->id]);
		}
	}

	public function addNew()
	{
		$person = Person::create([
			'name' => $this->query,
			'owner_id' => Auth::id()
		]);

		$this->add($person);
		
	}

    public function search()
    {
        
        $all_found_results = Person::search($this->query)->where('owner_id', auth()->user()->id)->get();
        $found = $all_found_results->diff($this->invites);

        $this->results = $found;
		$this->all_found_results = $all_found_results;
    }

	public function respond(Response $response, $transition)
	{
		$response->response_state->transitionTo($transition, 'Marked as '.$transition.' by host.' );
		$this->emit('updateGuests');
		$this->event = $this->event->refresh();
        $this->invites = $this->event->invites;
	}

	public function delete(Response $response)
	{
		$response->delete();
		$this->emit('updateGuests');
        $this->event = $this->event->refresh();
        $this->invites = $this->event->invites;
	}
}
