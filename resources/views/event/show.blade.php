<x-app-layout>
	<x-slot name="header">
		<div class="flex-1 min-w-0">
			<h1 class="mt-2 text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">{{ $event->name }}</h1>
			<livewire:event.stats :event="$event" />
		</div>
		<div class="flex mt-5 xl:mt-0 xl:ml-4">
			<span class="hidden sm:block">
				<button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-50">
					<!-- Heroicon name: mini/pencil -->
					<svg class="w-5 h-5 mr-2 -ml-1 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
						<path d="M2.695 14.763l-1.262 3.154a.5.5 0 00.65.65l3.155-1.262a4 4 0 001.343-.885L17.5 5.5a2.121 2.121 0 00-3-3L3.58 13.42a4 4 0 00-.885 1.343z" />
					</svg>
					Edit
				</button>
			</span>

			<span class="hidden ml-3 sm:block">
				<a as="button" href="{{ route('rsvp.show', $event->slug) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-50">
					<!-- Heroicon name: mini/link -->
					<svg class="w-5 h-5 mr-2 -ml-1 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
						<path d="M12.232 4.232a2.5 2.5 0 013.536 3.536l-1.225 1.224a.75.75 0 001.061 1.06l1.224-1.224a4 4 0 00-5.656-5.656l-3 3a4 4 0 00.225 5.865.75.75 0 00.977-1.138 2.5 2.5 0 01-.142-3.667l3-3z" />
						<path d="M11.603 7.963a.75.75 0 00-.977 1.138 2.5 2.5 0 01.142 3.667l-3 3a2.5 2.5 0 01-3.536-3.536l1.225-1.224a.75.75 0 00-1.061-1.06l-1.224 1.224a4 4 0 105.656 5.656l3-3a4 4 0 00-.225-5.865z" />
					</svg>
					View
				</a>
			</span>

			<div class="sm:ml-3" x-data="{ open: false }">
				<label id="listbox-label" class="sr-only"> Change published status </label>
				<div class="relative">
					<div class="inline-flex divide-x divide-purple-600 rounded-md shadow-sm">
						<div class="inline-flex divide-x divide-purple-600 rounded-md shadow-sm">
							<div class="inline-flex items-center py-2 pl-3 pr-4 text-white bg-purple-500 border border-transparent shadow-sm rounded-l-md">
								<!-- Heroicon name: mini/check -->
								<svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
									<path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
								</svg>
								<p class="ml-2.5 text-sm font-medium">{{ $event->state->display() }}</p>
							</div>
							<button x-on:click="open = !open" type="button" class="inline-flex items-center p-2 text-sm font-medium text-white bg-purple-500 rounded-l-none rounded-r-md hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-50" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
								<span class="sr-only">Change published status</span>
								<!-- Heroicon name: mini/chevron-down -->
								<svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
									<path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
								</svg>
							</button>
						</div>
					</div>
					<ul x-show="open" x-cloak
					x-transition:leave="transition ease-in duration-100"
					x-transition:leave-start="opacity-100"
					x-transition:leave-end="opacity-0"
					class="absolute left-0 z-10 mt-2 -mr-1 overflow-hidden origin-top-right bg-white divide-y divide-gray-200 rounded-md shadow-lg w-72 ring-1 ring-black ring-opacity-5 focus:outline-none sm:left-auto sm:right-0" tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-0">
						<!--
                Select option, manage highlight styles based on mouseenter/mouseleave and keyboard navigation.

                Highlighted: "text-white bg-purple-500", Not Highlighted: "text-gray-900"
              -->
			  <li class="p-4 text-sm text-gray-900 cursor-default select-none group hover:text-white hover:bg-purple-500" id="listbox-option-0" role="option">
							<div class="flex flex-col">
								<div class="flex justify-between">
									<!-- Selected: "font-semibold", Not Selected: "font-normal" -->
									<p :class="{'font-semibold': @js($event->state) == 'Draft', 'font-normal': @js($event->state) != 'draft'}">Draft</p>
									<!--
                      Checkmark, only display for selected option.

                      Highlighted: "text-white", Not Highlighted: "text-purple-500"
                    -->
									<span x-show="@js($event->state) == 'draft'" class="text-purple-500 group-hover:text-white">
										<!-- Heroicon name: mini/check -->
										<svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
											<path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
										</svg>
									</span>
								</div>
								<!-- Highlighted: "text-purple-200", Not Highlighted: "text-gray-500" -->
								<p class="mt-2 text-gray-500 group-hover:text-purple-200">This event cannot be viewed or receive RSVPs.</p>
							</div>
						</li>
					<!--
                Select option, manage highlight styles based on mouseenter/mouseleave and keyboard navigation.

                Highlighted: "text-white bg-purple-500", Not Highlighted: "text-gray-900"
              -->
						<li class="p-4 text-sm text-gray-900 cursor-default select-none group hover:text-white hover:bg-purple-500" id="listbox-option-0" role="option">
							<div class="flex flex-col">
								<div class="flex justify-between">
									<!-- Selected: "font-semibold", Not Selected: "font-normal" -->
									<p :class="{'font-semibold': @js($event->state) == 'published', 'font-normal': @js($event->state) != 'published'}">Published</p>
									<!--
                      Checkmark, only display for selected option.

                      Highlighted: "text-white", Not Highlighted: "text-purple-500"
                    -->
									<span x-show="@js($event->state) == 'published'" class="text-purple-500 group-hover:text-white">
										<!-- Heroicon name: mini/check -->
										<svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
											<path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
										</svg>
									</span>
								</div>
								<!-- Highlighted: "text-purple-200", Not Highlighted: "text-gray-500" -->
								<p class="mt-2 text-gray-500 group-hover:text-purple-200">This event can be viewed by anyone who has the link.</p>
							</div>
						</li>
						<!-- More items... -->
					</ul>
				</div>
			</div>

			<!-- Dropdown -->
			<div class="relative ml-3 sm:hidden">
				<button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2" id="mobile-menu-button" aria-expanded="false" aria-haspopup="true">
					More
					<!-- Heroicon name: mini/chevron-down -->
					<svg class="w-5 h-5 ml-2 -mr-1 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
						<path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
					</svg>
				</button>

				<!--
            Dropdown menu, show/hide based on menu state.

            Entering: "transition ease-out duration-200"
              From: "transform opacity-0 scale-95"
              To: "transform opacity-100 scale-100"
            Leaving: "transition ease-in duration-75"
              From: "transform opacity-100 scale-100"
              To: "transform opacity-0 scale-95"
          -->
				<div class="absolute right-0 z-10 w-48 py-1 mt-2 -mr-1 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="mobile-menu-button" tabindex="-1">
					<!-- Active: "bg-gray-100", Not Active: "" -->
					<a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="mobile-menu-item-0">Edit</a>
					<a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="mobile-menu-item-1">View</a>
				</div>
			</div>
		</div>
	</x-slot>

	<div class="py-12">
		<div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
			<div class="bg-white shadow-sm sm:rounded-lg">
				<div class="p-6 bg-white border-b border-gray-200">
					<livewire:event.guest-list :event="$event" />
				</div>
			</div>
		</div>
	</div>
</x-app-layout>