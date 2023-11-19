    <li class="px-4 py-4 sm:px-0" x-data="{ 'open': @entangle('open'), 'selected': @entangle('selected') }">
        <div class="flex items-start w-full">
            <div class="flex-none pr-4">
                <div x-show="selected" class="inset-y-0 left-0 w-0.5 bg-purple-600"></div>
                <input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-purple-600 focus:ring-purple-600" wire:click.prevent="toggle" :value="selected" />
            </div>
            <div class="flex-none w-28">
                <x-invite-tag :type="$response->response_state->display()">
                    {{ $response->response_state->display() }}
                </x-invite-tag>
            </div>

            <div class="flex flex-col items-center grow" >
                <div class="flex items-center w-full grow" @click="open = ! open">
                    <div class="grow">
                        {{ $response->person->name }}
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
                        @if($response->response_date)
                        <dd class="mt-1 text-sm text-gray-900">{{ $response->response_date->diffForHumans() }}</dd>
                        @else
                        <dd class="mt-1 text-sm text-gray-900">No response yet</dd>
                        @endif
                    </div>
                    <div class="grow">
                        <dt class="text-sm font-medium text-gray-500">Message</dt>
                        @if($response->response_message)
                        <dd class="mt-1 text-sm text-gray-900">{{ $response->response_message }}</dd>
                        @else
                        <dd class="mt-1 text-sm text-gray-900">&nbsp;</dd>
                        @endif
                    </div>
                    <div class="text-right" x-data="{ 'deleting': @entangle('deleting') }">
                        <dt class="sr-only">Actions</dt>
                        <dd class="inline-flex mt-1 text-sm">
                            <div x-show="!deleting" class="space-x-4">
                                <a class="text-gray-500 hover:text-gray-900 hover:underline hover:cursor-pointer" href="#" wire:click.prevent="respond('accepted')">Accept</a>
                                <a class="text-gray-500 hover:text-gray-900 hover:underline hover:cursor-pointer" href="#" wire:click.prevent="respond('declined')">Decline</a>
                                <a class="text-gray-500 hover:text-gray-900 hover:underline hover:cursor-pointer" href="#" @click.prevent="deleting = true">Delete Invite</a>
                            </div>
                            <div x-show="deleting">
                                <span x-show="deleting" class="text-gray-500 mr-1">Are you sure?</span>
                                <a x-show="deleting" class="text-gray-500 hover:text-gray-900 hover:underline hover:cursor-pointer mr-2" href="#" @click.prevent="deleting = false">Cancel</a>
                                <a x-show="deleting" class="text-red-500 hover:text-red-900 hover:underline hover:cursor-pointer" href="#" @click.prevent="open = ! open; deleting = false" wire:click="delete('{{ $response->id }}')">Delete.</a>
                            </div>
                        </dd>
                    </div>
                </div>
            </div>
        </div>
    </li>
