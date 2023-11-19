<?php

namespace App\Http\Livewire\Event;

use Livewire\Component;
use App\Models\Event;
use App\Models\Person;
use App\Models\Response;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class GuestList extends Component
{
    public Event $event;

    public $responses;

    public $selections;

    protected $listeners = ['response.added' => 'update', 'response.deleted' => 'update', 'response.toggle' => 'toggle'];

    public function __construct()
    {
        $this->selections = collect([]);
    }

    public function mount($event)
    {
        $this->event = $event;
        $this->responses = $this->event->responses;
    }

    public function render()
    {
        return view('livewire.event.guest-list');
    }

    public function group()
    {
        $group = Group::create(['event_id' => $this->event->id]);

        Response::whereIn('id',$this->selections->all())->update(['group_id' => $group->id]);

        $this->clearSelected();
    }

    public function clearSelected()
    {
        $this->selections = collect();
        $this->emit('selection.clear');
    }

    public function update()
    {
        $this->event = $this->event->refresh();
        $this->responses = $this->event->responses;
    }

    public function toggle($response)
    {
        if ($this->selections->contains($response)) {
            $this->selections = $this->selections->diff([$response]);
            return;
        }

        $this->selections->push($response);
    }
}
