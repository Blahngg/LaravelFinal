<x-user-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Music List') }}
        </h2>
    </x-slot>
    
    <div class="flex flex-col items-center mb-5 bg-white border border-gray-200 rounded-lg shadow-sm md:flex-row md:max-w-full hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
            <img src="{{ asset('storage/' . $music->image) }}"
                class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-80 md:rounded-none md:rounded-s-lg"  
                alt="">
            <div class="flex flex-col justify-between p-4 leading-normal">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $music->title }}</h5>
                <p class="mb-10 font-normal text-gray-700 dark:text-gray-400">{{ $music->artist }}</p>
                <audio controls>
                    <source src="{{ asset('storage/' . $music->audio) }}" type="audio/ogg">
                    <source src="{{ asset('storage/' . $music->audio) }}" type="audio/mpeg">
                </audio>
            </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
            <div class="">
                <select id="countries" 
                    class="appearance-none inline-flex items-center text-gray-500 bg-white border border-gray-300 rounded-lg px-3 py-1.5 pr-8 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                    wire:model.live="filter">
                    <option selected value="">Filter Ratings</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>

            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input type="text" id="table-search" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items" wire:model.live="search" >
            </div>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('user_id')">
                        User
                        <x-tables.header-direction field="user_id" :sortField="$sortField" :sortDirection="$sortDirection"/>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer">
                        Rating
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Review
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('created_at')">
                        Created
                        <x-tables.header-direction field="created_at" :sortField="$sortField" :sortDirection="$sortDirection"/>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="sortBy('updated_at')">
                        Last Updated
                        <x-tables.header-direction field="updated_at" :sortField="$sortField" :sortDirection="$sortDirection"/>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ratings as $rating)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $rating->user_id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $rating->rating }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $rating->review }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $rating->created_at }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $rating->updated_at }}
                        </td>
                        <td class="px-6 py-4">
                            <x-buttons.delete-button
                                wire:click="delete({{ $rating->id }})"
                                wire:confirm="Are you sure you want to delete this?">
                                Delete
                            </x-buttons.delete-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $ratings->links() }}
    </div>

    <x-messages.success-message class="me-3" on="music-deleted">
        {{ __('Music deleted successfully!') }}
    </x-messages.success-message>

</x-user-layout>
