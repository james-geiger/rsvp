<x-guest-layout>
	<div class="py-12">
		@if(!$event->state->public())
		<div class="max-w-4xl p-4 mx-auto mb-8 rounded-md bg-yellow-50">
			<div class="flex">
				<div class="flex-shrink-0">
				<!-- Heroicon name: mini/information-circle -->
				<svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
					<path fill-rule="evenodd" d="M19 10.5a8.5 8.5 0 11-17 0 8.5 8.5 0 0117 0zM8.25 9.75A.75.75 0 019 9h.253a1.75 1.75 0 011.709 2.13l-.46 2.066a.25.25 0 00.245.304H11a.75.75 0 010 1.5h-.253a1.75 1.75 0 01-1.709-2.13l.46-2.066a.25.25 0 00-.245-.304H9a.75.75 0 01-.75-.75zM10 7a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
				</svg>
				</div>
				<div class="flex-1 ml-3 md:flex md:justify-between">
				<p class="text-sm text-yellow-700">This is a preview of an event that is in <b>draft</b>.  You must publish the event for it to be visible.</p>
				<p class="mt-3 text-sm md:mt-0 md:ml-6">
					<a href="{{ route('events.show', $event->slug) }}" class="font-medium text-yellow-700 whitespace-nowrap hover:text-yellow-600">
					Event Details
					<span aria-hidden="true"> &rarr;</span>
					</a>
				</p>
				</div>
			</div>
		</div>
		@endif
		<div class="max-w-xl px-6 mx-auto lg:px-8">
			<h1 class="mt-2 text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">{{ $event->name }}</h1>
			<h2 class="mt-1 text-sm text-gray-500">{{ $event->owner->name }} (Host)</h2>
			<div class="flex flex-col mt-1 sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-8">
				<div class="flex items-center mt-2 text-sm text-gray-500">
					<!-- Heroicon name: mini/calendar -->
					<svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
						<path fill-rule="evenodd" d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z" clip-rule="evenodd" />
					</svg>
					{{ $event->date->format('F j, Y') }}
				</div>
				<div class="flex items-center mt-2 text-sm text-gray-500">
					<!-- Heroicon name: mini/clock -->
					<svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
						<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z" clip-rule="evenodd" />
					</svg>
					{{ $event->begin_time->format('g:i A') }}
				</div>
				<div class="flex items-center mt-2 text-sm text-gray-500">
					<!-- Heroicon name: mini/map_pin -->
					<svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
						<path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 103 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 002.273 1.765 11.842 11.842 0 00.976.544l.062.029.018.008.006.003zM10 11.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z" clip-rule="evenodd" />
					</svg>
					{{ $event->location }}
				</div>
			</div>
			<div class="mt-6 mb-8">
				@if($event->description)
				<p class="text-lg font-normal text-gray-900 sm:text-base"> {{ $event->description }}</p>
				@endif
			</div>
			<livewire:response.guest-lookup :event="$event" />
		</div>
	</div>
</x-guest-layout>
