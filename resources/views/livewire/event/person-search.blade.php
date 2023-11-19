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
                    <livewire:event.person-search-result :event="$event" :person="$person" :wire:key="$person->id" />
				@endforeach
				@if($all_found_results->count() === 0 & $query != '')
				<li class="relative py-2 pl-3 text-gray-900 cursor-default select-none pr-9" role="option">
					<span class="block font-normal truncate">No Results Found</span>
				</li>
				@endif
			</ul>
		</div>
	</div>
</div>
