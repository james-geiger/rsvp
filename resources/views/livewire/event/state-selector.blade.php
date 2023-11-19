<div x-data="{ open: @entangle('showDropdown'), state: @entangle('state') }" @click.outside="open = false">
    <label id="listbox-label" class="sr-only"> Change published status </label>
    <div class="relative">
        <div class="inline-flex rounded-md shadow-sm">
            <div class="inline-flex rounded-md shadow-sm">
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
  <li wire:click="changeState('draft')" class="p-4 text-sm text-gray-900 cursor-pointer select-none group hover:text-white hover:bg-purple-500" id="listbox-option-0" role="option">
                <div class="flex flex-col">
                    <div class="flex justify-between">
                        <!-- Selected: "font-semibold", Not Selected: "font-normal" -->
                        <p :class="{'font-semibold': state == 'Draft', 'font-normal': state != 'Draft'}">Draft</p>
                        <!--
          Checkmark, only display for selected option.

          Highlighted: "text-white", Not Highlighted: "text-purple-500"
        -->
                        <span x-show="state == 'Draft'" class="text-purple-500 group-hover:text-white">
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
            <li wire:click="changeState('published')" class="cursor-pointer p-4 text-sm text-gray-900 select-none group hover:text-white hover:bg-purple-500" id="listbox-option-0" role="option">
                <div class="flex flex-col">
                    <div class="flex justify-between">
                        <!-- Selected: "font-semibold", Not Selected: "font-normal" -->
                        <p :class="{'font-semibold': @js($event->state) == 'published', 'font-normal': @js($event->state) != 'published'}">Published</p>
                        <!--
          Checkmark, only display for selected option.

          Highlighted: "text-white", Not Highlighted: "text-purple-500"
        -->
                        <span x-show="state == 'Published'" class="text-purple-500 group-hover:text-white">
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
