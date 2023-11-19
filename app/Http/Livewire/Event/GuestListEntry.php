<?php

namespace App\Http\Livewire\Event;

use Livewire\Component;
use App\Models\Response;
use App\Models\Person;

class GuestListEntry extends Component
{

    public Response $response;

    public $open = false;

    public $deleting = false;

    public $selected = false;

    protected $listeners = ['selection.clear' => 'clearSelection'];

    public function respond($transition)
	{
		$this->response->response_state->transitionTo($transition, 'Marked as '.$transition.' by host.' );
		$this->emit('response.submitted');
	}

    public function toggle()
    {
        $this->selected = !$this->selected;
        $this->emit('response.toggle', $this->response->id);
    }

    public function delete()
    {
        $this->response->delete();
        $this->emit('response.deleted');
    }

    public function clearSelection()
    {
        $this->selected = false;
    }

    public function mount(Response $response)
    {
        $this->response = $response;
    }

    public function render()
    {
        return view('livewire.event.guest-list-entry');
    }
}
