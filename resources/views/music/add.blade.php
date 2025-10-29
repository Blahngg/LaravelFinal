<x-app>
    <x-slot:title>Add Music</x-slot:title>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Create Music') }}
        </h2>
    </x-slot>

    <form action="{{ route( 'music.store') }}" method="POST" class=" bg-gray-900" enctype="multipart/form-data">
        @csrf
        <div class="mb-5">
            <label for="title" 
                class="block mb-2 text-sm font-medium text-gray-900"
                >Title</label>
            <input type="text" id="title" name="title" 
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                placeholder="Enter music title"
                value="{{  old('title') }}"/>
            @error('title')
                <p class="mt-2 text-sm text-red-600">
                    <span class="font-medium">Oops!</span> {{ $message }}
                </p>
            @enderror
        </div>
        <div class="mb-5">
            <label for="artist" 
                class="block mb-2 text-sm font-medium text-gray-900"
                >Artist</label>
            <input type="text" id="artist" name="artist" 
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                placeholder="Enter artist"
                value="{{  old('artist') }}"/>
            @error('artist')
                <p class="mt-2 text-sm text-red-600">
                    <span class="font-medium">Oops!</span> {{ $message }}
                </p>
            @enderror
        </div>
        <div class="mb-5">
            <div class="flex items-center justify-center w-full">
                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                    </div>
                    <input id="dropzone-file" type="file" class="hidden" />
                </label>
            </div> 
            @error('image')
                <p class="mt-2 text-sm text-red-600">
                    <span class="font-medium">Oops!</span> {{ $message }}
                </p>
            @enderror
        </div>
        <div class="mb-5">
            <label class="block mb-2 text-sm font-medium text-gray-900" 
                for="audio"
                >Upload audio file</label>
            <input id="audio" type="file" name="audio"
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
            <div id="user_avatar_help"
                class="mt-1 text-sm text-gray-500">
                    Upload the Audio file
            </div>
            @error('audio')
                <p class="mt-2 text-sm text-red-600">
                    <span class="font-medium">Oops!</span> {{ $message }}
                </p>
            @enderror
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
    </form>
</x-app>
