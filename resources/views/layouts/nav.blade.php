<nav x-data="{ open: false }" class="bg-gray-50">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-16 border-b border-gray-200">
        <div class="flex items-center">
          <div class="flex-shrink-0">
			<x-application-logo class="w-auto h-8 text-indigo-800" />
            <!--<img class="w-auto h-8" src="https://tailwindui.com/img/logos/mark.svg?color=violet&shade=500" alt="Your Company">-->
          </div>

          <!-- Links section -->
          <div class="hidden lg:ml-10 lg:block">
            <div class="flex space-x-4">
              <!-- Current: "bg-gray-100", Default: "hover:text-gray-700" -->
              <x-nav-responsive-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
                </x-nav-responsive-link>
                <x-nav-responsive-link :href="route('events.index')" :active="request()->routeIs('events.*')">
                {{ __('Events') }}
                </x-nav-responsive-link>
            </div>
          </div>
        </div>

        <div class="flex justify-center flex-1 px-2 lg:ml-6 lg:justify-end">
          <!-- Search section -->
          <div class="w-full max-w-lg lg:max-w-xs">
            <label for="search" class="sr-only">Search</label>
            <div class="relative text-gray-400 focus-within:text-gray-500">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <!-- Heroicon name: mini/magnifying-glass -->
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                </svg>
              </div>
              <input id="search" class="block w-full py-2 pl-10 pr-3 leading-5 text-gray-900 placeholder-gray-500 bg-white border border-gray-300 rounded-md focus:border-purple-500 focus:placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-purple-500 sm:text-sm" placeholder="Search" type="search" name="search">
            </div>
          </div>
        </div>
        <div class="flex lg:hidden">
          <!-- Mobile menu button -->
          <button type="button" @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 rounded-md bg-gray-50 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-50" aria-controls="mobile-menu" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <!--
              Heroicon name: outline/bars-3

              Menu open: "hidden", Menu closed: "block"
            -->
            <svg class="block w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
              <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <!-- Actions section -->
        <div class="hidden lg:ml-4 lg:block">
          <div class="flex items-center">
            <button type="button" class="flex-shrink-0 p-1 mr-4 text-gray-400 rounded-full bg-gray-50 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-50">
              <span class="sr-only">View notifications</span>
              <!-- Heroicon name: outline/bell -->
              <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
              </svg>
            </button>


            <!-- Profile dropdown -->
            <x-dropdown class="relative flex-shrink-0 ml-3">
              <x-slot name="trigger">
                <button type="button" class="flex text-sm text-white rounded-full bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-50" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                  <span class="sr-only">Open user menu</span>
                  <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&color=7F9CF5&background=EBF4FF" alt="">
                </button>
            </x-slot>

              <!--
                Dropdown menu, show/hide based on menu state.

                Entering: "transition ease-out duration-100"
                  From: "transform opacity-0 scale-95"
                  To: "transform opacity-100 scale-100"
                Leaving: "transition ease-in duration-75"
                  From: "transform opacity-100 scale-100"
                  To: "transform opacity-0 scale-95"
              -->
              <x-slot name="content">
				
				<x-dropdown-link href="#">Your Profile</x-dropdown-link>
				
				<x-dropdown-link href="#">Settings</x-dropdown-link>

                <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
            </x-slot>
</x-dropdown>
          </div>
        </div>
      </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" class="hidden border-b border-gray-200 sm:hidden bg-gray-50" id="mobile-menu">
      <div class="px-2 pt-2 pb-3 space-y-1">
        <!-- Current: "bg-gray-100", Default: "hover:bg-gray-100" -->
		<x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('events.index')" :active="request()->routeIs('events.*')">
                {{ __('Events') }}
                </x-responsive-nav-link>
      </div>
      <div class="pt-4 pb-3 border-t border-gray-200">
        <div class="flex items-center px-5">
          <div class="flex-shrink-0">
            <img class="w-10 h-10 rounded-full" src="https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
          </div>
          <div class="ml-3">
            <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
            <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email_address }}</div>
          </div>
          <button type="button" class="flex-shrink-0 p-1 ml-auto text-gray-400 rounded-full bg-gray-50 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-50">
            <span class="sr-only">View notifications</span>
            <!-- Heroicon name: outline/bell -->
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
          </button>
        </div>
        <div class="px-2 mt-3 space-y-1">
          <a href="#" class="block px-3 py-2 text-base font-medium text-gray-900 rounded-md hover:bg-gray-100">Your Profile</a>

          <a href="#" class="block px-3 py-2 text-base font-medium text-gray-900 rounded-md hover:bg-gray-100">Settings</a>

          <a href="#" class="block px-3 py-2 text-base font-medium text-gray-900 rounded-md hover:bg-gray-100">Sign out</a>
        </div>
      </div>
    </div>
  </nav>