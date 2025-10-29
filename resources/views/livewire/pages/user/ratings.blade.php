<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Rated Songs') }}
        </h2>
    </x-slot>

    <div id="detailed-pricing" class="w-full overflow-x-auto">
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
        <div class="overflow-hidden min-w-max">
            <div class="grid grid-cols-5 p-4 text-sm font-medium text-gray-900 bg-gray-100 border-t border-b border-gray-200 gap-x-16 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                <div class="flex items-center cursor-pointer" wire:click="sortBy('title')">
                    Title
                    <x-tables.header-direction field="title" :sortField="$sortField" :sortDirection="$sortDirection"/>
                </div>
                <div class="cursor-pointer" wire:click="sortBy('artist')">
                    Artist
                    <x-tables.header-direction field="artist" :sortField="$sortField" :sortDirection="$sortDirection"/>
                </div>
                <div class="cursor-pointer" wire:click="sortBy('artist')">
                    Rating
                    <x-tables.header-direction field="artist" :sortField="$sortField" :sortDirection="$sortDirection"/>
                </div>
                <div class="cursor-pointer" wire:click="sortBy('created_at')">
                    Date Added
                    <x-tables.header-direction field="created_at" :sortField="$sortField" :sortDirection="$sortDirection"/>
                </div>
                <div class="cursor-pointer" wire:click="sortBy('created_at')">
                    Actions
                </div>
            </div>
            @foreach ($ratings as $rating)
                <div class="">
                    <div class="grid grid-cols-5 px-4 py-5 text-sm text-gray-700 border-b border-gray-200 gap-x-10 dark:border-gray-700 hover:bg-gray-700 cursor-pointer">
                        <div class="flex items-center space-x-3 text-gray-800 dark:text-gray-100">
                            <img src="{{ asset('storage/' . $rating->music->image) }}"
                                alt="{{ $rating->music->title }}"
                                class="w-10 h-10 object-cover rounded-md shadow-sm border border-gray-200 dark:border-gray-700">
                            <span class="text-sm font-medium truncate max-w-[150px]">
                                {{ $rating->music->title }}
                            </span>
                        </div>
                        <div class="text-gray-500 dark:text-gray-400 flex items-center">
                            {{ $rating->music->artist }}
                        </div>
                        <div class="text-gray-500 dark:text-gray-400 flex items-center">
                            <x-buttons.show-button wire:click="openReviewModal({{ $rating->id }})">
                                {{ $rating->rating }}
                            </x-buttons.show-button>
                        </div>
                        <div class="text-gray-500 dark:text-gray-400 flex items-center">
                            {{ $rating->created_at->format('M d, Y') }}
                        </div>
                        <div class="text-gray-500 dark:text-gray-400 flex items-center">
                            <x-buttons.edit-button wire:click="openEditModal({{ $rating->id }})">
                                Edit
                            </x-buttons.edit-button>
                            <x-buttons.delete-button wire:click="deleteRating({{ $rating->id }})" wire:confirm="Are you sure you want to delete this?">
                                Delete
                            </x-buttons.delete-button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @if ($showReviewModal)
        <!-- Main modal -->
        <div id="crud-modal" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Review
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" wire:click="closeReviewModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5" wire:submit.prevent="saveRating">
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <textarea id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write product description here" wire:model="review" disabled></textarea>                    
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
    @endif

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
                    <form class="p-4 md:p-5" wire:submit.prevent="updateRating">
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rating</label>
                                <select id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" wire:model="rating">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="col-span-2">
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Review</label>
                                <textarea id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write product description here" wire:model="review"></textarea>                    
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

    <x-messages.success-message class="me-3" on="rating-updated">
        {{ __('Rating updated successfully!') }}
    </x-messages.success-message>
    <x-messages.success-message class="me-3" on="rating-deleted">
        {{ __('Rating deleted successfully!') }}
    </x-messages.success-message>

    <x-messages.error-message class="me-3" on="rating-update-failed'">
        {{ __('Rating update failed') }}
    </x-messages.error-message>
    <x-messages.error-message class="me-3" on="rating-delete-failed">
        {{ __('Rating delete failed') }}
    </x-messages.error-message>
</div>
