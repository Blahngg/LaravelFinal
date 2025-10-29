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
                <div class="grid grid-cols-3 p-4 text-sm font-medium text-gray-900 bg-gray-100 border-t border-b border-gray-200 gap-x-16 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                    <div class="flex items-center cursor-pointer" wire:click="sortBy('title')">
                        Title
                        <x-tables.header-direction field="title" :sortField="$sortField" :sortDirection="$sortDirection"/>
                    </div>
                    <div class="cursor-pointer" wire:click="sortBy('artist')">
                        Artist
                        <x-tables.header-direction field="artist" :sortField="$sortField" :sortDirection="$sortDirection"/>
                    </div>
                </div>
                @foreach ($musics as $music)
                    <div class="grid grid-cols-3 items-center px-4 py-5 text-sm text-gray-700 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-700">
            
                        <!-- Music Info -->
                        <div class="flex items-center space-x-3 text-gray-800 dark:text-gray-100">
                            <img src="{{ asset('storage/' . $music->image) }}"
                                alt="{{ $music->title }}"
                                class="w-10 h-10 object-cover rounded-md shadow-sm border border-gray-200 dark:border-gray-700">
                            <span class="text-sm font-medium truncate max-w-[150px]">
                                {{ $music->title }}
                            </span>
                        </div>

                        <!-- Artist -->
                        <div class="text-gray-500 dark:text-gray-400 flex items-center">
                            {{ $music->artist }}
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center space-x-2 text-gray-500 dark:text-gray-400">
                            <!-- Go to song page -->
                            <a href="{{ route('music.view', $music) }}" 
                            class="px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">
                                View
                            </a>

                            <!-- Find similar song page -->
                            <a href="{{ route('similar', $music) }}" 
                            class="px-3 py-1 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm">
                                Find Similar Songs
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <h1 class="text-5xl font-extrabold text-center mt-20 dark:text-white">Can't find similar songs</h1>
    @endif
</div>
