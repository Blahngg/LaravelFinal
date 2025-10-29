<div>
    <div class="max-w-full mx-auto relative">
        <div class="flex ">
            <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your Email</label>
            <button id="dropdown-button" data-dropdown-toggle="dropdown" class="shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600" type="button" wire:click="toggleSearchFilter">
                {{ $searchFilterName }}
                <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>  
            </button>
            @if($showSearchFilter)
                <div class="fixed inset-0 z-40" wire:click="toggleSearchFilter"></div>
                <div id="dropdown" class="z-50 mt-3 absolute top-9 bg-white  divide-gray-100 rounded-lg shadow-sm w-full dark:bg-gray-700">
                    <h2 class="text-4xl font-bold text-center dark:text-white pt-3">Filters</h2>
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                        <li>
                            <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" wire:click="changeSearchFilter('title', 'Title')">Title</button>
                        </li>
                        <li>
                            <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" wire:click="changeSearchFilter('artist', 'Artist')">Artist</button>
                        </li>
                    </ul>
                    <div class="">
                        <ul class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-6 lg:grid-cols-7 xl:grid-cols-8 gap-2 w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white p-2">
                            @foreach ($genres as $genre)
                                <li class="flex items-center p-2 border border-gray-200 rounded-md dark:border-gray-600">
                                    <input 
                                        id="genre-{{ $genre->id }}"
                                        type="checkbox" 
                                        value="{{ $genre->id }}" 
                                        wire:model="selectedGenres"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="genre-{{ $genre->id }}" 
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                        {{ $genre->name }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <div class="relative w-full">
                <input type="search" id="search-dropdown" 
                    class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" 
                    placeholder="Search Mockups, Logos, Design Templates..." 
                    wire:model.live="search"
                    autocomplete="off"/>
                <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </div>
        </div>
    </div>
    
    {{-- @if($music)
        <div class="relative flex flex-col items-center mb-5 bg-white border border-gray-200 rounded-lg shadow-sm md:flex-row md:max-w-full hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
            <img src="{{ asset('storage/' . $music->image) }}"
                class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-80 md:rounded-none md:rounded-s-lg"  
                alt="">
            <div class="flex flex-col justify-between p-4 leading-normal">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $music->title }}</h5>
                <p class="mb-10 font-normal text-gray-700 dark:text-gray-400">{{ $music->description }}</p>
            </div>
        </div>
    @endif --}}
    @if($musics->isNotEmpty())
        <div id="detailed-pricing" class="w-full overflow-x-auto">
            <div class="overflow-hidden min-w-max mb-5 mt-4">
                <x-tables.user-table-header-row class="grid-cols-4">
                    <div class="flex items-center cursor-pointer" wire:click="sortBy('title')">
                        Title
                        <x-tables.header-direction field="title" :sortField="$sortField" :sortDirection="$sortDirection"/>
                    </div>
                    <div class="cursor-pointer" wire:click="sortBy('artist')">
                        Artist
                        <x-tables.header-direction field="artist" :sortField="$sortField" :sortDirection="$sortDirection"/>
                    </div>
                    <div class="cursor-pointer" wire:click="sortBy('ratings_avg_rating')">
                        Rating
                        <x-tables.header-direction field="ratings_avg_rating" :sortField="$sortField" :sortDirection="$sortDirection"/>
                    </div>
                    <div class="cursor-pointer" wire:click="sortBy('artist')">
                    </div>
                </x-tables.user-table-header-row>
                @foreach ($musics as $music)
                    <x-tables.user-table-row-link class="grid-cols-4">
                        <x-tables.user-table-title-cell 
                            :image="$music->image" 
                            :title="$music->title">
                                {{ $music->title }}
                        </x-tables.user-table-title-cell>

                        <x-tables.user-table-cell>
                            {{ $music->artist }}
                        </x-tables.user-table-cell>

                        <x-tables.user-table-cell class="ml-2">
                            {{ number_format($music->ratings_avg_rating, 2) }}
                        </x-tables.user-table-cell>

                        <x-tables.user-table-cell class="space-x-2">
                            <a href="{{ route('music.view', $music) }}">
                                <x-buttons.show-button>
                                    View
                                </x-buttons.show-button>
                            </a>
                            <a href="{{ route('similar', $music) }}">
                                <x-buttons.add-button>
                                    Find Similar Songs
                                </x-buttons.add-button>
                            </a>
                        </x-tables.user-table-cell>
                    </x-tables.user-table-row-link>
                @endforeach
            </div>
            {{ $musics->links() }}
        </div>
    @endif

</div>
