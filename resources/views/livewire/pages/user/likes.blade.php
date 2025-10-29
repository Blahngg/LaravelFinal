<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Liked Songs') }}
        </h2>
    </x-slot>

    <div id="detailed-pricing" class="w-full overflow-x-auto">
        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input type="text" id="table-search" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items" wire:model.live="search" >
            </div>
        </div>
        <div class="overflow-hidden min-w-max">
            <div class="grid grid-cols-3 p-4 text-sm font-medium text-gray-900 bg-gray-100 border-t border-b border-gray-200 gap-x-16 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                <div class="flex items-center cursor-pointer" wire:click="sortBy('title')">
                    Title
                    <x-tables.header-direction field="title" :sortField="$sortField" :sortDirection="$sortDirection"/>
                </div>
                <div class="cursor-pointer" wire:click="sortBy('artist')">
                    Artist
                    <x-tables.header-direction field="artist" :sortField="$sortField" :sortDirection="$sortDirection"/>
                </div>
                <div class="cursor-pointer" wire:click="sortBy('created_at')">
                    Date Added
                    <x-tables.header-direction field="created_at" :sortField="$sortField" :sortDirection="$sortDirection"/>
                </div>
            </div>
            @foreach ($likes as $music)
                <a href="{{ route('music.view', $music) }}" class="">
                    <div class="grid grid-cols-3 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-16 dark:border-gray-700 hover:bg-gray-700">
                        <div class="flex items-center space-x-3 text-gray-800 dark:text-gray-100">
                            <img src="{{ asset('storage/' . $music->image) }}"
                                alt="{{ $music->title }}"
                                class="w-10 h-10 object-cover rounded-md shadow-sm border border-gray-200 dark:border-gray-700">
                            <span class="text-sm font-medium truncate max-w-[150px]">
                                {{ $music->title }}
                            </span>
                        </div>
                        <div class="text-gray-500 dark:text-gray-400 flex items-center">
                            {{ $music->artist }}
                        </div>
                        <div class="text-gray-500 dark:text-gray-400 flex items-center">
                            {{ $music->pivot->created_at->format('M d, Y') }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    {{-- <div class="flex mb-2">
      @foreach ($likes as $music)
        <a href="{{ route('music.view', $music) }}" class="mr-3">
            <div class="w-40 bg-white border border-gray-200 rounded-md shadow-sm dark:bg-gray-800 dark:border-gray-700 flex flex-col overflow-hidden">
                <div>
                    <img class="h-28 w-full object-cover" src="{{ asset('storage/' . $music->image) }}" alt="{{ $music->title }}" />
                </div>
                <div class="p-2 flex-1 flex flex-col">
                    <h5 class="mb-1 text-sm font-semibold tracking-tight text-gray-900 dark:text-white truncate">
                        {{ $music->title }}
                    </h5>
                    <p class="text-xs text-gray-600 dark:text-gray-400 truncate">
                        {{ $music->artist }}
                    </p>
                </div>
            </div>
        </a>
      @endforeach
    </div> --}}
</div>
