<div >
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Playlist') }}
        </h2>
    </x-slot>

    <div>
        <div class="relative flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
            <div>
                <button id="dropdownRadioButton" data-dropdown-toggle="dropdownRadio" class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button" wire:click="openFilterDropdown">
                    {{ $sortName }}
                    @if($toggleFilterDropdown)
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 5 4-4 4 4"/>
                        </svg>
                    @else
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    @endif
                </button>
                <!-- Dropdown menu -->
                @if($toggleFilterDropdown)
                    <div class="fixed inset-0 z-40" wire:click="openFilterDropdown"></div>
                    <div id="dropdownRadio" class="z-50 mt-2 absolute w-48 bg-white divide-y divide-gray-100 rounded-lg shadow-sm dark:bg-gray-700 dark:divide-gray-600" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top">
                        <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownRadioButton">
                            <li>
                                <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer" wire:click="sortBy('created_at', 'Recently Added')">
                                    <div class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">Recently Added</div>
                                    <x-tables.header-direction field="created_at" :sortField="$sortField" :sortDirection="$sortDirection"/>
                                </div>
                            </li>
                            <li>
                                <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer" wire:click="sortBy('title', 'Name')">
                                    <div class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">Name</div>
                                    <x-tables.header-direction field="title" :sortField="$sortField" :sortDirection="$sortDirection"/>
                                </div>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input type="text" id="table-search" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items" wire:model.live="search" >
            </div>
        </div>
        <div class="flex mb-2">
            @foreach ($playlists as $playlist)
                <a href="{{ route('playlist.view', $playlist) }}" class="mr-3">
                    <div class="w-40 bg-white border border-gray-200 rounded-md shadow-sm dark:bg-gray-800 dark:border-gray-700 flex flex-col overflow-hidden">
                        <div>
                            <img class="h-28 w-full object-cover" src="{{ asset('storage/' . $playlist->image) }}" alt="{{ $playlist->title }}" />
                        </div>
                        <div class="relative p-2 flex-1 flex flex-col">
                            <h5 class="mb-1 text-sm font-semibold tracking-tight text-gray-900 dark:text-white truncate">
                                {{ $playlist->title }}
                            </h5>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
