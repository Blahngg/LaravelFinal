<x-app>
    <x-slot:title>Add Music</x-slot:title>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Edit Music') }}
        </h2>
    </x-slot>

    <form action="{{ route( 'music.update', $music) }}" method="POST" class=" bg-gray-900" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-5">
            <label for="title" 
                class="block mb-2 text-sm font-medium text-gray-900"
                >Title</label>
            <input type="text" id="title" name="title" 
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                placeholder="Enter music title"
                value="{{  old('title', $music->title) }}"/>
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
                value="{{  old('artist', $music->artist) }}"/>
            @error('artist')
                <p class="mt-2 text-sm text-red-600">
                    <span class="font-medium">Oops!</span> {{ $message }}
                </p>
            @enderror
        </div>
        <div class="mb-5">
            <label class="block mb-2 text-sm font-medium text-gray-900" 
                for="image"
                >Upload audio file</label>
            <input id="image" type="file" name="image"
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
            <div id="user_avatar_help"
                class="mt-1 text-sm text-gray-500">
                    Upload the Image file
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
