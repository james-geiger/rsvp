<?php

namespace App\Http\Livewire\Event;

use Livewire\Component;
use App\Models\Event;

class StateSelector extends Component
{
    public Event $event;

    public $showDropdown = false;

    public $state = '';

    public function mount($event)
    {
        $this->event = $event;
        $this->state = $event->state->display();
    }

    public function changeState($state)
    {
        $this->event->state->transitionTo($state);
        $this->event->refresh();
        $this->state = $this->event->state->display();
        $this->showDropdown = false;
    }

    public function render()
    {
        return view('livewire.event.state-selector');
    }
}
