<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Create Music') }}
        </h2>
    </x-slot>

    <x-messages.success-message class="me-3" on="music-created">
        {{ __('Music created successfully!') }}
    </x-messages.success-message>

    <form wire:submit.prevent="save" method="POST" class=" bg-gray-900" enctype="multipart/form-data">
        @csrf
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div class="mb-5">
                <label for="title"
                    class="block mb-2 text-sm font-medium text-white"
                    >Title</label>
                <input type="text" id="title" name="title" wire:model="title"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Enter music title"/>
                @error('title')
                    <p class="mt-2 text-sm text-red-600">
                        <span class="font-medium">Oops!</span> {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="artist"
                    class="block mb-2 text-sm font-medium text-white"
                    >Artist</label>
                <input type="text" id="artist" name="artist" wire:model="artist"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Enter artist"/>
                @error('artist')
                    <p class="mt-2 text-sm text-red-600">
                        <span class="font-medium">Oops!</span> {{ $message }}
                    </p>
                @enderror
            </div>
        </div>
        <div class="">
            <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">Identification</h3>
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
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium text-white"
                    for="audio"
                    >Upload image file</label>
                <input id="audio" type="file" name="audio" wire:model="image"
                    class="block mb-2 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                <div class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg bg-gray-50  dark:bg-gray-700 dark:border-gray-600 p-4">
                    @if($image)
                        <img class="max-h-full max-w-full object-contain" src="{{ $image->temporaryUrl() }}">
                    @else
                        <p class="text-gray-500">No image uploaded</p>
                    @endif
                </div>
                @error('image')
                    <p class="mt-2 text-sm text-red-600">
                        <span class="font-medium">Oops!</span> {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium text-white"
                    for="audio"
                    >Upload audio file</label>
                <input id="audio" type="file" name="audio" wire:model="audio"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                @error('audio')
                    <p class="mt-2 text-sm text-red-600">
                        <span class="font-medium">Oops!</span> {{ $message }}
                    </p>
                @enderror
            </div>
        </div>
        <div class="flex justify-between">
            <div>
                <a href="{{ route('music.index') }}">
                    <x-buttons.show-button>
                        Return
                    </x-buttons.show-button>
                </a>
            </div>
            <div>
                <x-buttons.delete-button wire:click="clearFields">
                    Clear
                </x-buttons.delete-button>
                <x-buttons.add-button type="submit">
                    Submit
                </x-buttons.add-button>
            </div>
        </div>
    </form>
</div>
