<?php

namespace App\Http\Livewire\Response;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use App\Models\Event;
use App\Models\Person;
use App\Models\Response;

use App\States\Response\Accepted;
use App\States\Response\Declined;

class GuestLookup extends Component
{

    public $event;
    public $query;
    public $error_message;
    public $found_count;
    public $responses;
    public $message;
    public $submitted;

    protected $rules = [
        'responses.*.transition_to_state' => 'required',
    ];

    public function mount($event)
    {
        $this->event = $event;
        $this->query = '';
        $this->responses = [];
        $this->error_message = '';
        $this->message = '';
        $this->submitted = false;
    }

    /**
     * Search for the specified resource.
     *
     */
    public function find()
    {

		$found_exact = Response::where('event_id', $this->event->id)
					->whereHas('person', function (Builder $query) {
						$query->where('name', $this->query)->withoutOwner();
					})
					->with(['person' => function ($query) {
						$query->withoutOwner();
					}])
					->get();

        $found_fuzzy = Response::where('event_id', $this->event->id)
                    ->whereHas('person', function (Builder $query) {
                        $query->whereFullText('name', $this->query)->withoutOwner();
                    })
					->with(['person' => function ($query) {
						$query->withoutOwner();
					}])
                    ->get();

		$found_exact_count = $found_exact->count();
        $found_fuzzy_count = $found_fuzzy->count();

		if ($found_exact_count === 1) {
			$this->load_response($found_exact);
			return;
		}

		if ($found_fuzzy_count === 1)
		{
			$this->load_response($found_fuzzy);
			return;
		}

        if ($found_fuzzy_count > 1) {
            $this->error_message = 'We found multiple people who match that name.  Please adjust your search to be more specific and try again.';
			return;
		}

		$this->error_message = 'It looks like we can\'t find that invite.  If you believe this is in error, please adjust your search and try again.  Could the host have listed a different name?';

    }

	/**
     * This function takes one response, searches for any group members, and returns it to the user.
     *
     */
	private function load_response($response)
	{
		if ($response[0]->group) {
			$this->responses = $response[0]->group->members->load(['person' => function ($query) {
				$query->withoutOwner();
			}]);
		} else {
			$this->responses = $response;
		}

		\Illuminate\Support\Facades\Log::debug($response);

        $this->responses->each(function ($item, $key) {
            $item['transition_to_state'] = $item['response_state'];
        });
		
	}

    public function save()
    {
        $this->validate();
 
        foreach ($this->responses as $response) {

            $transition = $response->transition_to_state;

            unset($response['transition_to_state']);
            
            $response->response_state->transitionTo($transition, $this->message);

        }

        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.response.guest-lookup');
    }
}