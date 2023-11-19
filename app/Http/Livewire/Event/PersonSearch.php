<?php

namespace App\Http\Livewire\Event;

use Livewire\Component;

use App\Models\Person;
use App\Models\Event;
use App\Models\Response;
use Illuminate\Support\Facades\Auth;

class PersonSearch extends Component
{

    public $query;

    public $results;

	public $all_found_results;

    public Event $event;

    protected $listeners = ['response.added' => 'clear'];

    public function mount(Event $event)
    {
        $this->query = '';
        $this->event = $event;
        $this->results = collect([]);
		$this->all_found_results = collect([]);
    }

    public function search()
    {
        $all_found_results = Person::search($this->query)->where('owner_id', auth()->user()->id)->get();
        $found = $all_found_results->diff($this->event->invites);

        $this->results = $found;
		$this->all_found_results = $all_found_results;
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

        $response = Response::create([
            'event_id' => $this->event->id,
            'person_id' => $person->id
        ]);

        $this->emit('response.added');

	}

    public function clear()
    {
        $this->query = '';
    }

    public function render()
    {
        return view('livewire.event.person-search');
    }
}
