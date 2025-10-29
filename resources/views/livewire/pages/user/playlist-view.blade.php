<div>
    <div class="relative flex flex-col items-center mb-5 bg-white border border-gray-200 rounded-lg shadow-sm md:flex-row md:max-w-full hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
        <img src="{{ asset('storage/' . $playlist->image) }}"
            class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-80 md:rounded-none md:rounded-s-lg"  
            alt="">
        <div class="flex flex-col justify-between p-4 leading-normal">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $playlist->title }}</h5>
            <p class="mb-10 font-normal text-gray-700 dark:text-gray-400">{{ $playlist->description }}</p>
        </div>
        <div class="absolute bottom-4 right-4">
            <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" wire:click="openEditModal">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                    <path d="M13.488 2.513a1.75 1.75 0 0 0-2.475 0L6.75 6.774a2.75 2.75 0 0 0-.596.892l-.848 2.047a.75.75 0 0 0 .98.98l2.047-.848a2.75 2.75 0 0 0 .892-.596l4.261-4.262a1.75 1.75 0 0 0 0-2.474Z" />
                    <path d="M4.75 3.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h6.5c.69 0 1.25-.56 1.25-1.25V9A.75.75 0 0 1 14 9v2.25A2.75 2.75 0 0 1 11.25 14h-6.5A2.75 2.75 0 0 1 2 11.25v-6.5A2.75 2.75 0 0 1 4.75 2H7a.75.75 0 0 1 0 1.5H4.75Z" />
                </svg>
            </button>
            <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" wire:click="deletePlaylist">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                    <path fill-rule="evenodd" d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>

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
        <div class="overflow-hidden min-w-max mb-4">
            <div class="grid grid-cols-3 p-4 text-sm font-medium text-gray-900 bg-gray-100 border-t border-b border-gray-200 gap-x-16 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                <div class="flex items-center cursor-pointer" wire:click="sortBy('title')">
                    Title
                    <x-tables.header-direction field="title" :sortField="$sortField" :sortDirection="$sortDirection"/>
                </div>
                <div class="cursor-pointer" wire:click="sortBy('artist')">
                    Artist
                    <x-tables.header-direction field="artist" :sortField="$sortField" :sortDirection="$sortDirection"/>
                </div>
                <div class="cursor-pointer" wire:click="sortBy('pivot_created_at')">
                    Date Added
                    <x-tables.header-direction field="pivot_created_at" :sortField="$sortField" :sortDirection="$sortDirection"/>
                </div>
            </div>
            @foreach ($musics as $music)
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
        {{ $musics->links() }}
    </div>

    @if ($showEditModal)
        <!-- Main modal -->
        <div id="crud-modal" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Write a review
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" wire:click="closeEditModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5" wire:submit.prevent="updatePlaylist">
                        <div class="mb-5">
                            
                            <input id="audio" type="file" name="audio" wire:model="image"
                                class=" hidden block mb-2 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                            <label class="block mb-2 text-sm font-medium text-white" for="audio">
                                <div class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg bg-gray-50  dark:bg-gray-700 dark:border-gray-600 p-4">
                                    @if($image)
                                        <img class="max-h-full max-w-full object-contain" src="{{ $image->temporaryUrl() }}">
                                    @else
                                        <img class="max-h-full max-w-full object-contain" src="{{ asset('storage/' . $playlistImage) }}">
                                    @endif
                                </div>
                            </label>
                            @error('image')
                                <p class="mt-2 text-sm text-red-600">
                                    <span class="font-medium">Oops!</span> {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="col-span-2 mb-4">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="" wire:model="title">
                        </div>
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                <textarea id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write product description here" wire:model="description"></textarea>                    
                            </div>
                        </div>
                        <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div> 
    @endif

    <x-messages.success-message class="me-3" on="playlist-updated">
        {{ __('Playlist updated successfully!') }}
    </x-messages.success-message>
    <x-messages.error-message class="me-3" on="playlist-update-failed">
        {{ __('There is an error updating the playlist') }}
    </x-messages.error-message>
    <x-messages.error-message class="me-3" on="playlist-delete-failed">
        {{ __('There is an error deleting the playlist') }}
    </x-messages.error-message>
</div>
