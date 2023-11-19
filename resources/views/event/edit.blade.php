<x-app-layout>
<x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
					<form class="" action="{{ route('events.update', ['event' => $event]) }}" method="post">
                    @method('PATCH')
					@csrf
						<div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
							<div class="sm:col-span-6">
								<label for="name" class="block text-sm font-medium text-gray-700">Event title</label>
								<div class="mt-1">
									<input type="text" value="{{ $event->name }}" name="name" id="name" class="flex-1 block w-full min-w-0 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
								</div>
							</div>
							<div class="sm:col-span-6">
								<label for="description" class="block text-sm font-medium text-gray-700">Description</label>
								<div class="mt-1">
									<textarea id="description" name="description" rows="3" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ $event->description }}</textarea>
								</div>
								<p class="mt-2 text-sm text-gray-500">This description will be shown to your guests when they RSVP.</p>
							</div>
							<div class="sm:col-span-3">
								<label for="date" class="block text-sm font-medium text-gray-700">Date</label>
								<div class="mt-1">
									<input type="date" value="{{ $event->date->format('Y-m-d') }}" name="date" id="date" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
								</div>
							</div>

							<div class="sm:col-span-3">
								<label for="begin_time" class="block text-sm font-medium text-gray-700">Start time</label>
								<div class="mt-1">
									<input type="time" value="{{ $event->begin_time->format('H:i') }}" name="begin_time" id="begin_time" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
								</div>
							</div>

							<div class="sm:col-span-6">
								<label for="title" class="block text-sm font-medium text-gray-700">Event location</label>
								<div class="mt-1">
									<input type="text" value="{{ $event->location }}" name="location" id="location" class="flex-1 block w-full min-w-0 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
								</div>
								<p class="mt-2 text-sm text-gray-500">This location will be shown to your guests when they RSVP.</p>
							</div>
						</div>
						<div class="pt-5">
							<button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save Event</button>
                            <a as="button" href="{{ url()->previous() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-50">
                                Cancel
                            </a>
						</div>
					</form>
				</div>
            </div>
        </div>
    </div>
</x-app-layout>
