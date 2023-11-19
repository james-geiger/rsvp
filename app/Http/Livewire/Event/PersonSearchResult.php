<?php

namespace App\Http\Livewire\Event;

use App\Models\Event;
use App\Models\Person;
use App\Models\Response;
use Livewire\Component;

class PersonSearchResult extends Component
{
    public Event $event;

    public Person $person;

    public function mount(Event $event, Person $person)
    {
        $this->event = $event;
        $this->person = $person;
    }

    public function add()
    {
        $response = Response::create([
            'event_id' => $this->event->id,
            'person_id' => $this->person->id
        ]);

        $this->emit('response.added');
    }

    public function render()
    {
        return view('livewire.event.person-search-result');
    }
}
