<div>
    <div class="relative flex flex-col items-center mb-5 bg-white border border-gray-200 rounded-lg shadow-sm md:flex-row md:max-w-full hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
        <img src="{{ asset('storage/' . $music->image) }}"
            class="w-60 h-60 object-cover rounded-t-lg md:rounded-none md:rounded-s-lg"
            alt="">
        <div class="flex flex-col justify-between p-4 leading-normal">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $music->title }}</h5>
            <p class="mb-10 font-normal text-gray-700 dark:text-gray-400">{{ $music->artist }}</p>
        </div>
    </div>

    <h3 class="text-3xl font-bold dark:text-white">Similar Songs</h3>
    @if($musics->isNotEmpty())
        <div id="detailed-pricing" class="w-full overflow-x-auto">
            <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
            </div>
            <div class="overflow-hidden min-w-max">
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
        </div>
    @else
        <h1 class="text-5xl font-extrabold text-center mt-20 dark:text-white">Can't find similar songs</h1>
    @endif
</div>
