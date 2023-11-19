<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();

        return view('event.index', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
		$event = Event::create([
			'name' => $request->name,
			'owner_id' => Auth::id(),
			'description' => $request->description,
			'date' => $request->date,
			'begin_time' => $request->begin_time,
			'location' => $request->location
		]);

		return redirect()->route('events.show', ['event' => $event]);
    }

    /**
     * Display the specified resource.
     *
	 * @param  \App\Models\User $user
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Event $event)
    {

        $event->loadCount([
            'invites',
            'invites as accepted_invites_count' => function (Builder $query) {
                $query->where('response_state', '=', 'accepted');
            },
            'invites as declined_invites_count' => function (Builder $query) {
                $query->where('response_state', '=', 'declined');
            },
        ])->get();

        return view('event.show', ['event' => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('event.edit', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->fill($request->validated());

        $event->save();

        return redirect()->route('events.show', ['event' => $event]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }

	/**
     * View the page to respond to the resource.
     *
	 * @param  \App\Models\User $user
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function respond(User $user, Event $event)
    {

		return $event->state->public() | Auth::id() === $event->owner_id ? view('response.create', ['event' => $event]) : abort(404);

		//if ($event->state->public()) {
		//	return view('response.create', ['event' => $event]);
		//}

		//return abort(404);

    }
}
