<div>
	@if($responses->count() > 0)
    @if($selections->count() > 1)
    <a as="button" href="#" wire:click.prevent="group" class="mt-6 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-50">
        <!-- Heroicon name: mini/link -->
        <svg class="w-5 h-5 mr-2 -ml-1 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path d="M12.232 4.232a2.5 2.5 0 013.536 3.536l-1.225 1.224a.75.75 0 001.061 1.06l1.224-1.224a4 4 0 00-5.656-5.656l-3 3a4 4 0 00.225 5.865.75.75 0 00.977-1.138 2.5 2.5 0 01-.142-3.667l3-3z"></path>
            <path d="M11.603 7.963a.75.75 0 00-.977 1.138 2.5 2.5 0 01.142 3.667l-3 3a2.5 2.5 0 01-3.536-3.536l1.225-1.224a.75.75 0 00-1.061-1.06l-1.224 1.224a4 4 0 105.656 5.656l3-3a4 4 0 00-.225-5.865z"></path>
        </svg>
        Group {{ $selections->count() }} invites
    </a>
    @endif
	<ul role="list" class="mt-6 divide-y divide-gray-200">
    	@foreach($responses as $item)
            <livewire:event.guest-list-entry :response="$item" :wire:key="'response-'.$item->id" />
		@endforeach
	</ul>
	@endif
</div>
