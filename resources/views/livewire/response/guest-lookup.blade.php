<div>
@if(count($responses) == 0)
<div class="">
<label for="name" class="block ml-px text-sm font-medium text-gray-700">To lookup your invitation, please enter your name.</label>
  <div class="mt-1">
    <input wire:model="query" type="text" name="query" id="query" class="block w-full px-4 border-gray-300 rounded-full shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Jane Smith">
  </div>

  <span class="block mt-1 text-sm font-medium text-red-600">{{ $error_message }}</span>
  <button wire:click="find" type="button" class="inline-flex items-center px-3 py-2 mt-2 text-sm font-medium leading-4 text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Find my invitation</button>
</div>
  @endif
@if(count($responses) > 0 && $submitted == false)
    @foreach($responses as $index => $response)
    <div wire:key="response-field-{{ $response->id }}" class="mb-8">
    <fieldset>
    <legend class="text-lg font-medium text-gray-900">{{ $response->person->name }}</legend>
    <div class="mt-4 border-t border-b border-gray-200 divide-y divide-gray-200">
        <div class="relative flex items-start">
        <label for="response-{{ $response->id }}-accepted" class="flex-1 min-w-0 my-4">
            <span class="font-medium text-gray-700 select-none">Attending</span>
        </label>
        <div class="flex items-center h-5 my-4 ml-3">
            <input wire:model="responses.{{ $index }}.transition_to_state" value='accepted' id="response-{{ $response->id }}-accepted" name="response-{{ $response->id }}-accepted" type="radio" class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
        </div>
        </div>

        <div class="relative flex items-start">
        <label for="response-{{ $response->id }}-declined" class="flex-1 min-w-0 my-4">
            <span class="font-medium text-gray-700 select-none">Regrets</span>
        </label>
        <div class="flex items-center h-5 my-4 ml-3">
            <input wire:model="responses.{{ $index }}.transition_to_state" value='declined' id="response-{{ $response->id }}-declined" name="response-{{ $response->id }}-declined" type="radio" class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
        </div>
        </div>
    </div>
    </fieldset>
</div>
    @endforeach
	<div class="">
<label for="message" class="block text-sm font-medium text-gray-700">Leave a message for the host</label>
  <div class="mt-1">
    <textarea wire:model="message" rows="4" name="message" id="message" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
  </div>
</div>

    <button wire:click="save" type="button" class="inline-flex items-center px-3 py-2 mt-4 text-sm font-medium leading-4 text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Submit RSVP</button>

@endif

@if(count($responses) > 0 && $submitted == true)
<p>Thank you for your RSVP!</p>
<p>If you should need to, you can come back to this page to change your response.</p>
@endif
</div>
