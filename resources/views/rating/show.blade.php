<x-app>
    
    
        <div class="bg-gray-900">
            <div class="mb-5">
                <label for="title"
                    class="block mb-2 text-sm font-medium text-gray-900"
                    >Title</label>
                <input type="text" id="title" name="title"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Enter music title"
                    value="{{  $rating->rating }}"
                    disabled/>
            </div>
            <div class="mb-5">
                <label for="review"
                    class="block mb-2 text-sm font-medium text-gray-900">
                        Your review
                </label>
                <textarea id="review" rows="4" name="review"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Leave a review..."
                    disabled>
                        {{ $rating->review }}
                </textarea>
            </div>
            <div class="flex">
                <a href="{{ route( 'rating.edit', $rating) }}"
                class="font-medium text-blue-600 hover:underline">
                    <button type="button"
                    class="focus:outline-none text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 cursor-pointer">
                        Edit
                    </button>
                </a>
                <form action="{{ route('rating.destroy', $rating) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" name="delete"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 cursor-pointer">
                </form>
            </div>
        </div>

</x-app>
