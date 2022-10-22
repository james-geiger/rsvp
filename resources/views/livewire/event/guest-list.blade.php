<div>
	<div class="">
		<div class="relative" x-data>
			<label for="search" class="sr-only">Add a person search</label>
			<div class="relative flex items-center mt-1">
				<input wire:model="query" wire:keydown.debounce.250ms="search" wire:keydown.enter="addNew" type="text" name="search" id="search" class="block w-full pr-12 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Search for a person to add...">
				<div class="absolute inset-y-0 right-0 flex py-1.5 pr-2.5">
				@if($all_found_results->count() === 0 & $query != '')
					<span class="text-gray-400"><kbd class="inline-flex items-center px-2 font-sans text-sm font-medium text-gray-400 border border-gray-200 rounded">Enter</kbd> to create or <a href="#" class="underline cursor-pointer" wire:click="addNewDetail">click to add detail...</a></span>
				@endif
				</div>
			</div>
			<!--
			Select popover, show/hide based on select state.

			Entering: ""
				From: ""
				To: ""
			Leaving: "transition ease-in duration-100"
				From: "opacity-100"
				To: "opacity-0"
			-->
			<ul x-show="$wire.query != ''" x-cloak class="absolute z-10 w-full py-1 mt-1 overflow-auto text-base bg-white rounded-md shadow-lg max-h-60 ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm" tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-3">
				@foreach($results as $person)
				<li wire:click="add({{$person}})" class="relative py-2 pl-3 text-gray-900 cursor-default select-none pr-9 hover:text-white hover:bg-indigo-600" role="option">
					<span class="block font-normal truncate">{{ $person->name }}</span>
				</li>
				@endforeach
				@if($all_found_results->count() === 0 & $query != '')
				<li class="relative py-2 pl-3 text-gray-900 cursor-default select-none pr-9" role="option">
					<span class="block font-normal truncate">No Results Found</span>
				</li>
				@endif
			</ul>
		</div>
	</div>
	@if($invites->count() > 0)
	<ul role="list" class="mt-6 divide-y divide-gray-200">
    	@foreach($invites as $invite)
		<li class="px-4 py-4 sm:px-0" x-data="{ open: false }">
			<div class="flex items-start w-full">
				<div class="flex-none w-28">
					<x-invite-tag :type="$invite->response->response_state->display()">
						{{ $invite->response->response_state->display() }}
					</x-invite-tag>
				</div>
				<div class="flex flex-col items-center grow">
					<div class="flex items-center w-full grow">
						<div class="grow">
							{{ $invite->name }}
						</div>
							<button @click="open = ! open" class="inline-flex items-center justify-center p-0 text-gray-400 transition duration-150 ease-in-out hover:text-gray-500 focus:outline-none focus:text-gray-500">
								<svg :class="{ 'rotate-90' : open, 'rotate-0': !open }" class="w-6 h-6 transition ease-in duration-250" stroke="currentColor" fill="none" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
								</svg>
							</button>
					</div>
					<div x-show="open" x-cloak class="flex items-start w-full mt-4 space-x-8">
						<div class="flex-none">
							<dt class="text-sm font-medium text-gray-500">Responded</dt>
							@if($invite->response->response_date)
							<dd class="mt-1 text-sm text-gray-900">{{ $invite->response->response_date->diffForHumans() }}</dd>
							@else
							<dd class="mt-1 text-sm text-gray-900">No response yet</dd>
							@endif
						</div>
						<div class="grow">
							<dt class="text-sm font-medium text-gray-500">Message</dt>
							@if($invite->response->response_message)
							<dd class="mt-1 text-sm text-gray-900">{{ $invite->response->response_message }}</dd>
							@else
							<dd class="mt-1 text-sm text-gray-900">&nbsp;</dd>
							@endif
						</div>
						<div class="text-right">
							<dt class="sr-only">Actions</dt>
							<dd class="inline-flex mt-1 space-x-4 text-sm">
								<a class="text-gray-500 hover:text-gray-900 hover:underline hover:cursor-pointer" href="#" wire:click="respond('{{ $invite->response->id }}', 'accepted')">Accept</a>
								<a class="text-gray-500 hover:text-gray-900 hover:underline hover:cursor-pointer" href="#" wire:click="respond('{{ $invite->response->id }}', 'declined')">Decline</a>
								<!-- TODO: Need to implement better logic to show delete confirmation dialogue and retain page scroll -->
								<a class="text-gray-500 hover:text-gray-900 hover:underline hover:cursor-pointer" href="#" @click="open = ! open" wire:click="delete('{{ $invite->response->id }}')">Delete Invite</a>
							</dd>
						</div>
					</div>
				</div>
			</div>
		</li>
		@endforeach
	</ul>
	@endif
</div>
