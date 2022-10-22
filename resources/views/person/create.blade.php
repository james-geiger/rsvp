<x-app-layout>
<x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Add New Person') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
					<form class="" action="{{ route('person.store') }}" method="post">
					@csrf
					<div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
        <div class="sm:col-span-6">
          <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
          <div class="mt-1">
            <input type="text" value="{{ $name }}" name="name" id="name" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
          </div>
        </div>

        <div class="sm:col-span-4">
          <label for="email_address" class="block text-sm font-medium text-gray-700">Email address</label>
          <div class="mt-1">
            <input id="email_address" name="email_address" type="email" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
          </div>
        </div>

        <div class="sm:col-span-6">
          <label for="street_address" class="block text-sm font-medium text-gray-700">Street address</label>
          <div class="mt-1">
            <input type="text" name="street_address" id="street_address" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
          </div>
        </div>

        <div class="sm:col-span-2">
          <label for="city" class="block text-sm font-medium text-gray-700">City</label>
          <div class="mt-1">
            <input type="text" name="city" id="city" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
          </div>
        </div>

        <div class="sm:col-span-2">
          <label for="state" class="block text-sm font-medium text-gray-700">State</label>
          <div class="mt-1">
            <input type="text" name="state" id="state"  class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
          </div>
        </div>

        <div class="sm:col-span-2">
          <label for="postal_code" class="block text-sm font-medium text-gray-700">ZIP / Postal code</label>
          <div class="mt-1">
            <input type="text" name="postal_code" id="postal_code" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
          </div>
        </div>
      </div>
						<div class="pt-5">
							<button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Create Person</button>
						</div>
					</form>
				</div>
            </div>
        </div>
    </div>
</x-app-layout>